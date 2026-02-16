<x-layouts::app :title="__('Detail Kwitansi')">
    <div class="max-w-7xl mx-auto pb-20">

        {{-- Header --}}
        <div class="mb-8 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('invoice') }}" class="p-3 rounded-lg bg-white border border-zinc-200 text-zinc-900 hover:bg-zinc-50 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>
                </a>
                <div>
                    <h1 class="text-3xl font-bold text-zinc-900 dark:text-white">Detail Kwitansi</h1>
                    <p class="text-zinc-500 text-sm mt-1">{{ $invoice->invoice_number }}</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                {{-- Tombol Approve Khusus Admin jika masih Pending --}}
                @role('admin')
                    @if($invoice->status === 'pending')
                    <form action="{{ route('invoices.approve', $invoice->id) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-2 rounded-lg bg-green-600 text-white font-medium hover:bg-green-700 transition inline-flex items-center gap-2 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                            </svg>
                            Approve Sekarang
                        </button>
                    </form>
                    @endif
                @endrole

                {{-- Tombol PDF Hanya Muncul Jika Sudah Approve --}}
                @if($invoice->status === 'approve')
                    <a href="{{ route('invoices.print', $invoice->id) }}" target="_blank" class="px-4 py-2 rounded-lg bg-zinc-900 dark:bg-white dark:text-zinc-900 text-white font-medium hover:bg-zinc-800 dark:hover:bg-zinc-100 transition inline-flex items-center gap-2 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a60.773 60.773 0 0 1 2.25-.384m0 0a29.848 29.848 0 0 1 8.48.368.45.45 0 0 1 .502.422c0 .255-.162.489-.408.588m0 0a24.614 24.614 0 0 1-7.894 1.561m0 0A14.982 14.982 0 0 1 9 13.5H5.25a4.5 4.5 0 0 1 0-9h3.75a6 6 0 0 1 6 6v.75a3 3 0 0 1-3 3M9 6.75h6m-6 0a1.5 1.5 0 0 0-1.5 1.5v3m6-3a1.5 1.5 0 0 1 1.5 1.5v3m0 0h3" />
                        </svg>
                        Lihat PDF
                    </a>
                    <a href="{{ route('invoices.pdf', $invoice->id) }}" class="px-4 py-2 rounded-lg bg-emerald-600 text-white font-medium hover:bg-emerald-700 transition inline-flex items-center gap-2 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                        </svg>
                        Download PDF
                    </a>
                @endif

                {{-- Edit & Hapus: Hanya untuk Admin atau Pembuat --}}
                @if(Auth::user()->hasRole('admin') || $invoice->user_id === Auth::id())
                    <a href="{{ route('invoices.edit', $invoice->id) }}" class="px-4 py-2 rounded-lg bg-blue-600 text-white font-medium hover:bg-blue-700 transition inline-flex items-center gap-2 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z" />
                        </svg>
                        Edit
                    </a>
                    <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kwitansi ini?')" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 rounded-lg bg-red-600 text-white font-medium hover:bg-red-700 transition inline-flex items-center gap-2 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                            Hapus
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Left Content --}}
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6 shadow-sm">
                    <h2 class="text-lg font-semibold text-zinc-900 dark:text-white mb-4 flex items-center gap-2 border-b border-zinc-200 dark:border-zinc-700 pb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-zinc-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>
                        Informasi Umum
                    </h2>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs font-medium text-zinc-600 dark:text-zinc-400 uppercase mb-1">No. Kwitansi</p>
                            <p class="text-lg font-bold text-zinc-900 dark:text-white">{{ $invoice->invoice_number }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-zinc-600 dark:text-zinc-400 uppercase mb-1">Tanggal</p>
                            <p class="text-lg font-bold text-zinc-900 dark:text-white">{{ $invoice->invoice_date->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6 shadow-sm">
                        <h3 class="font-semibold text-zinc-900 dark:text-white mb-4 flex items-center gap-2 border-b border-zinc-200 dark:border-zinc-700 pb-3">
                            <span class="flex h-6 w-6 items-center justify-center rounded bg-zinc-100 dark:bg-zinc-800 text-xs text-zinc-600 dark:text-zinc-400">1</span>
                            Terima Dari
                        </h3>
                        <div class="space-y-3">
                            <div>
                                <p class="text-xs font-medium text-zinc-600 dark:text-zinc-400 uppercase">Instansi</p>
                                <p class="text-sm font-medium text-zinc-900 dark:text-white">{{ $invoice->received_from ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-zinc-600 dark:text-zinc-400 uppercase">Nama PIC</p>
                                <p class="text-sm font-medium text-zinc-900 dark:text-white">{{ $invoice->issuer_name ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6 shadow-sm">
                        <h3 class="font-semibold text-zinc-900 dark:text-white mb-4 flex items-center gap-2 border-b border-zinc-200 dark:border-zinc-700 pb-3">
                            <span class="flex h-6 w-6 items-center justify-center rounded bg-blue-100 dark:bg-blue-900/30 text-xs text-blue-600 dark:text-blue-400">2</span>
                            Mitra Penerima
                        </h3>
                        <div class="space-y-3">
                            <div>
                                <p class="text-xs font-medium text-zinc-600 dark:text-zinc-400 uppercase">Perusahaan</p>
                                <p class="text-sm font-medium text-zinc-900 dark:text-white">{{ $invoice->mitra?->company_name ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-zinc-600 dark:text-zinc-400 uppercase">Nama PIC</p>
                                <p class="text-sm font-medium text-zinc-900 dark:text-white">{{ $invoice->mitra?->contact_person ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6 shadow-sm">
                    <h2 class="text-lg font-semibold text-zinc-900 dark:text-white mb-4 flex items-center gap-2 border-b border-zinc-200 dark:border-zinc-700 pb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-zinc-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z" />
                        </svg>
                        Rincian Pembayaran
                    </h2>

                    @if($invoice->description)
                    <div class="mb-6 p-4 bg-zinc-50 dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700">
                        <p class="text-xs font-medium text-zinc-600 dark:text-zinc-400 uppercase">Deskripsi</p>
                        <p class="text-sm text-zinc-900 dark:text-white">{{ $invoice->description }}</p>
                    </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="border-b border-zinc-200 dark:border-zinc-700">
                                    <th class="text-left py-3 px-2 font-semibold text-zinc-900 dark:text-white uppercase tracking-wider text-[10px]">Keterangan</th>
                                    <th class="text-right py-3 px-2 font-semibold text-zinc-900 dark:text-white uppercase tracking-wider text-[10px]">Qty</th>
                                    <th class="text-right py-3 px-2 font-semibold text-zinc-900 dark:text-white uppercase tracking-wider text-[10px]">Harga (Rp)</th>
                                    <th class="text-right py-3 px-2 font-semibold text-zinc-900 dark:text-white uppercase tracking-wider text-[10px]">Total (Rp)</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                                @foreach($invoice->items as $item)
                                <tr>
                                    <td class="py-3 px-2 text-zinc-900 dark:text-white">{{ $item->item_name }}</td>
                                    <td class="text-right py-3 px-2 text-zinc-900 dark:text-white">{{ $item->quantity }}</td>
                                    <td class="text-right py-3 px-2 text-zinc-900 dark:text-white">{{ number_format($item->unit_price, 0, ',', '.') }}</td>
                                    <td class="text-right py-3 px-2 font-medium text-zinc-900 dark:text-white">{{ number_format($item->total_price, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($invoice->amount_in_words)
                    <div class="mt-6 p-4 bg-amber-50 dark:bg-amber-900/20 rounded-lg border border-amber-200 dark:border-amber-800">
                        <p class="text-xs font-medium text-amber-600 dark:text-amber-400 uppercase mb-1">Terbilang (Jumlah dalam Huruf)</p>
                        <p class="text-sm font-medium text-amber-900 dark:text-amber-100 italic">"{{ $invoice->amount_in_words }}"</p>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Right Summary --}}
            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6 sticky top-20 shadow-sm">
                    <h3 class="text-lg font-semibold text-zinc-900 dark:text-white mb-4 border-b border-zinc-200 dark:border-zinc-700 pb-3">Audit Log</h3>
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-1">Total Nilai Kwitansi</p>
                            <p class="text-3xl font-bold text-zinc-900 dark:text-white">Rp {{ number_format($invoice->total_amount, 0, ',', '.') }}</p>
                        </div>
                        <div class="pt-4 border-t border-zinc-200 dark:border-zinc-700">
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Status Approval</span>
                                @if($invoice->status === 'approve')
                                    <span class="inline-flex items-center rounded-md bg-green-50 px-3 py-1 text-xs font-bold text-green-700 ring-1 ring-inset ring-green-600/20 dark:bg-green-400/10 dark:text-green-400 dark:ring-green-400/20 uppercase">
                                        Approved
                                    </span>
                                @else
                                    <span class="inline-flex items-center rounded-md bg-amber-50 px-3 py-1 text-xs font-bold text-amber-700 ring-1 ring-inset ring-amber-600/10 dark:bg-amber-400/10 dark:text-amber-400 dark:ring-amber-400/20 uppercase">
                                        Pending
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="pt-4 border-t border-zinc-200 dark:border-zinc-700">
                            <div class="text-[11px] text-zinc-600 dark:text-zinc-400 space-y-3">
                                <div class="flex justify-between items-center">
                                    <span>Petugas Pembuat:</span>
                                    <span class="font-bold text-zinc-900 dark:text-zinc-200 bg-zinc-100 dark:bg-zinc-800 px-2 py-0.5 rounded">{{ $invoice->user?->name }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Waktu Input:</span>
                                    <span class="font-medium">{{ $invoice->created_at->format('d/m/Y H:i') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Update Terakhir:</span>
                                    <span class="font-medium">{{ $invoice->updated_at->format('d/m/Y H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts::app>
