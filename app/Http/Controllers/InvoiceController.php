<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Mitra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // Semua user bisa melihat semua invoice, diurutkan dari yang terbaru
        $query = Invoice::with(['user', 'mitra'])->latest();

        if ($request->filled('search')) {
            $query->where('invoice_number', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('start_date')) {
            $query->whereDate('invoice_date', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('invoice_date', '<=', $request->end_date);
        }

        // Statistik diselaraskan dengan hasil filter/pencarian
        $statsQuery = clone $query;

        $totalInvoices = $statsQuery->count();
        $approvedAmount = (clone $statsQuery)->where('status', 'approve')->sum('total_amount');
        $pendingAmount = (clone $statsQuery)->where('status', 'pending')->sum('total_amount');

        $invoices = $query->paginate(10)->withQueryString();

        return view('pages.invoice.invoice-page', compact('invoices', 'totalInvoices', 'approvedAmount', 'pendingAmount'));
    }

    public function create()
    {
        $invoiceNumber = '';
        $mitras = Mitra::all();
        return view('pages.invoice.create-invoice', compact('invoiceNumber', 'mitras'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'invoice_number' => 'required|string|unique:invoices',
            'invoice_date' => 'required|date',
            'mitra_id' => 'required|exists:mitras,id',
            'items' => 'required|array|min:1',
            'items.*.item_name' => 'required|string',
            'items.*.quantity' => 'required|numeric|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            $totalAmount = collect($request->items)->sum(fn($item) => $item['quantity'] * $item['unit_price']);

            $invoice = Invoice::create([
                'user_id' => Auth::id(),
                'mitra_id' => $request->mitra_id,
                'invoice_number' => $request->invoice_number,
                'invoice_date' => $request->invoice_date,
                'received_from' => $request->issuer_company,
                'issuer_name' => $request->issuer_name,
                'description' => $request->description,
                'total_amount' => $totalAmount,
                'amount_in_words' => $request->amount_in_words,
                'status' => 'pending',
            ]);

            foreach ($request->items as $item) {
                $invoice->items()->create([
                    'item_name' => $item['item_name'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'total_price' => $item['quantity'] * $item['unit_price'],
                ]);
            }

            DB::commit();
            return redirect()->route('invoice')->with('success', 'Kwitansi berhasil dibuat');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function approve(Invoice $invoice)
    {
        if (!Auth::user()->hasRole('admin')) abort(403);

        $invoice->update(['status' => 'approve']);

        return back()->with('success', 'Kwitansi berhasil di-approve');
    }

    public function show(Invoice $invoice)
    {
        // Semua user bisa melihat detail
        return view('pages.invoice.view-invoice-page', compact('invoice'));
    }

    public function edit(Invoice $invoice)
    {
        // Hanya Admin atau Pembuat yang bisa akses halaman edit
        if (!Auth::user()->hasRole('admin') && $invoice->user_id !== Auth::id()) abort(403);

        $mitras = Mitra::all();
        return view('pages.invoice.edit-invoice', compact('invoice', 'mitras'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        if (!Auth::user()->hasRole('admin') && $invoice->user_id !== Auth::id()) abort(403);

        $request->validate([
            'invoice_number' => 'required|string|unique:invoices,invoice_number,' . $invoice->id,
            'invoice_date' => 'required|date',
            'mitra_id' => 'required|exists:mitras,id',
            'items' => 'required|array|min:1',
            'items.*.item_name' => 'required|string',
            'items.*.quantity' => 'required|numeric|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            $totalAmount = collect($request->items)->sum(fn($item) => $item['quantity'] * $item['unit_price']);

            $invoice->update([
                'mitra_id' => $request->mitra_id,
                'invoice_number' => $request->invoice_number,
                'invoice_date' => $request->invoice_date,
                'received_from' => $request->issuer_company,
                'issuer_name' => $request->issuer_name,
                'description' => $request->description,
                'total_amount' => $totalAmount,
                'amount_in_words' => $request->amount_in_words,
            ]);

            $invoice->items()->delete();
            foreach ($request->items as $item) {
                $invoice->items()->create([
                    'item_name' => $item['item_name'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'total_price' => $item['quantity'] * $item['unit_price'],
                ]);
            }

            DB::commit();
            return redirect()->route('invoices.show', $invoice)->with('success', 'Kwitansi berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy(Invoice $invoice)
    {
        // Hanya Admin atau Pembuat yang bisa menghapus
        if (!Auth::user()->hasRole('admin') && $invoice->user_id !== Auth::id()) abort(403);

        $invoice->delete();
        return redirect()->route('invoice')->with('success', 'Kwitansi berhasil dihapus');
    }

    public function print(Invoice $invoice)
    {
        // Print hanya boleh jika status approve (kecuali admin mungkin butuh bypass, tapi konsisten approve dulu)
        if ($invoice->status !== 'approve') {
            return back()->with('error', 'Kwitansi belum di-approve oleh admin.');
        }

        $pdf = Pdf::loadView('pages.invoice.print-invoice', compact('invoice'));
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption(['isRemoteEnabled' => true, 'isHtml5ParserEnabled' => true]);

        $filename = 'Kwitansi-' . str_replace(['/', '\\'], '-', $invoice->invoice_number) . '.pdf';
        return $pdf->stream($filename);
    }

    public function downloadPdf(Invoice $invoice)
    {
        if ($invoice->status !== 'approve') {
            return back()->with('error', 'Kwitansi belum di-approve oleh admin.');
        }

        $html = view('pages.invoice.print-invoice', compact('invoice'))->render();
        $filename = 'Kwitansi-' . preg_replace('/[\/\\\\]/', '-', $invoice->invoice_number) . '.pdf';

        return Pdf::loadHTML($html)
            ->setPaper('a4', 'portrait')
            ->setOption([
                'isRemoteEnabled' => true,
                'margin-top' => 0, 'margin-right' => 0, 'margin-bottom' => 0, 'margin-left' => 0,
            ])
            ->download($filename);
    }
}
