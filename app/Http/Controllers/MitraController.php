<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MitraController extends Controller
{
    public function index()
    {
        $mitras = Mitra::latest()->paginate(10);

        return view('pages.mitra.mitra-page', compact('mitras'));
    }

    public function create()
    {
        return view('pages.mitra.create-mitra');
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string',
            'contact_person' => 'nullable|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        Mitra::create([
            'company_name' => $request->company_name,
            'contact_person' => $request->contact_person,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('mitras.index')->with('success', 'Mitra berhasil ditambahkan');
    }

    public function show(Mitra $mitra)
    {
        return view('pages.mitra.view-mitra', compact('mitra'));
    }

    public function edit(Mitra $mitra)
    {
        return view('pages.mitra.edit-mitra', compact('mitra'));
    }

    public function update(Request $request, Mitra $mitra)
    {
        $request->validate([
            'company_name' => 'required|string',
            'contact_person' => 'nullable|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        $mitra->update([
            'company_name' => $request->company_name,
            'contact_person' => $request->contact_person,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('mitras.index')->with('success', 'Mitra berhasil diperbarui');
    }

    public function destroy(Mitra $mitra)
    {
        $mitra->delete();
        return redirect()->route('mitras.index')->with('success', 'Mitra berhasil dihapus');
    }

    public function getMitras()
    {
        $mitras = Mitra::get(['id', 'company_name', 'contact_person']);

        return response()->json($mitras);
    }
}
