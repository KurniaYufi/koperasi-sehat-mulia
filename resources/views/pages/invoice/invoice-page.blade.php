<x-layouts::app :title="__('Invoices')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        {{-- Stats Section --}}
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative overflow-hidden rounded-xl border border-neutral-200 p-4 dark:border-neutral-700 bg-white dark:bg-zinc-900 shadow-sm">
                <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Total Invoices</h3>
                <p class="text-sm text-zinc-500 dark:text-zinc-400">Hasil filter/pencarian</p>
                <div class="mt-4 text-3xl font-semibold text-zinc-900 dark:text-white">
                    {{ number_format($totalInvoices) }}
                </div>
            </div>

            <div class="relative overflow-hidden rounded-xl border border-neutral-200 p-4 dark:border-neutral-700 bg-white dark:bg-zinc-900 shadow-sm">
                <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Approved Amount</h3>
                <p class="text-sm text-zinc-500 dark:text-zinc-400">Akumulasi terfilter</p>
                <div class="mt-4 text-3xl font-semibold text-green-600">
                    Rp {{ number_format($approvedAmount, 0, ',', '.') }}
                </div>
            </div>

            <div class="relative overflow-hidden rounded-xl border border-neutral-200 p-4 dark:border-neutral-700 bg-white dark:bg-zinc-900 shadow-sm">
                <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Pending</h3>
                <p class="text-sm text-zinc-500 dark:text-zinc-400">Unpaid terfilter</p>
                <div class="mt-4 text-3xl font-semibold text-amber-600">
                    Rp {{ number_format($pendingAmount, 0, ',', '.') }}
                </div>
            </div>
        </div>

        {{-- Controls Section --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            {{-- Search Box --}}
            <div class="bg-white dark:bg-zinc-900 p-6 rounded-xl border border-neutral-200 dark:border-neutral-700 shadow-sm">
                <form action="{{ route('invoice') }}" method="GET" class="flex items-end gap-3">
                    {{-- Keep filter values during search --}}
                    <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                    <input type="hidden" name="end_date" value="{{ request('end_date') }}">

                    <div class="flex-1">
                        <label class="block text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase mb-2">Search Invoice</label>
                        <div class="relative">
                            <input type="text" name="search" value="{{ request('search') }}"
                                class="w-full rounded-lg border border-zinc-300 bg-zinc-50 dark:border-zinc-600 dark:bg-zinc-800 dark:text-white py-2 pl-9 pr-3 text-sm focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition"
                                placeholder="Masukkan nomor kwitansi...">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="size-4 text-zinc-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <button type="submit"
                        class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-zinc-900 dark:bg-white dark:text-zinc-900 rounded-lg border border-zinc-300 hover:bg-zinc-100 transition">
                        Cari
                    </button>
                </form>
            </div>

            {{-- Date Filter Box --}}
            <div class="bg-white dark:bg-zinc-900 p-6 rounded-xl border border-neutral-200 dark:border-neutral-700 shadow-sm">
                <form action="{{ route('invoice') }}" method="GET" class="flex items-end gap-3">
                    {{-- Keep search value during filter --}}
                    <input type="hidden" name="search" value="{{ request('search') }}">

                    <div class="flex-1 grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase mb-2">Start Date</label>
                            <input type="date" name="start_date" value="{{ request('start_date') }}"
                                class="w-full rounded-lg border border-zinc-300 bg-zinc-50 dark:border-zinc-600 dark:bg-zinc-800 dark:text-white py-2 px-3 text-sm focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase mb-2">End Date</label>
                            <input type="date" name="end_date" value="{{ request('end_date') }}"
                                class="w-full rounded-lg border border-zinc-300 bg-zinc-50 dark:border-zinc-600 dark:bg-zinc-800 dark:text-white py-2 px-3 text-sm focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition">
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-zinc-900 rounded-lg hover:bg-zinc-800 transition">
                            Filter
                        </button>
                        @if(request()->hasAny(['search', 'start_date', 'end_date']))
                            <a href="{{ route('invoice') }}" class="inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-zinc-700 bg-zinc-100 rounded-lg hover:bg-zinc-200 transition">
                                Reset
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        {{-- Table Section --}}
        <div class="relative flex flex-col h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-900 shadow-sm">
            <div class="flex items-center justify-between p-6 border-b border-neutral-200 dark:border-neutral-700">
                <h2 class="text-xl font-bold text-zinc-900 dark:text-white">List Invoice</h2>
                <a href="{{ route('invoices.create') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-zinc-900 rounded-lg hover:bg-zinc-800 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-200 transition-colors shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Create Invoice
                </a>
            </div>

            <div class="flex-1 overflow-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-zinc-50 dark:bg-zinc-800/50 border-b border-neutral-200 dark:border-neutral-700">
                        <tr>
                            <th class="whitespace-nowrap py-3 px-4 font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider text-[10px]">Invoice No</th>
                            <th class="whitespace-nowrap py-3 px-4 font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider text-[10px]">Date</th>
                            <th class="whitespace-nowrap py-3 px-4 font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider text-[10px]">Mitra</th>
                            <th class="whitespace-nowrap py-3 px-4 font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider text-[10px]">Nama PIC</th>
                            <th class="whitespace-nowrap py-3 px-4 font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider text-[10px]">Status</th>
                            <th class="whitespace-nowrap py-3 px-4 font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider text-[10px]">Created By</th>
                            <th class="whitespace-nowrap py-3 px-4 font-medium text-right text-zinc-500 dark:text-zinc-400 uppercase tracking-wider text-[10px]">Jumlah</th>
                            <th class="whitespace-nowrap py-3 px-4 font-medium text-right text-zinc-500 dark:text-zinc-400 uppercase tracking-wider text-[10px]">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                        @forelse ($invoices as $invoice)
                            <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                                <td class="whitespace-nowrap py-3 px-4 font-medium text-zinc-900 dark:text-zinc-100">
                                    {{ $invoice->invoice_number }}
                                </td>
                                <td class="whitespace-nowrap py-3 px-4 text-zinc-500 dark:text-zinc-400">
                                    {{ $invoice->invoice_date ? $invoice->invoice_date->format('d M Y') : '-' }}
                                </td>
                                <td class="whitespace-nowrap py-3 px-4 font-medium text-zinc-900 dark:text-zinc-100">
                                    {{ $invoice->mitra?->company_name ?? '-' }}
                                </td>
                                <td class="whitespace-nowrap py-3 px-4 text-zinc-900 dark:text-zinc-100">
                                    {{ $invoice->mitra?->contact_person ?? '-' }}
                                </td>
                                <td class="whitespace-nowrap py-3 px-4 text-[10px]">
                                    @if($invoice->status === 'approve')
                                        <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 font-bold text-green-700 ring-1 ring-inset ring-green-600/20 dark:bg-green-400/10 dark:text-green-400 dark:ring-green-400/20">
                                            APPROVE
                                        </span>
                                    @else
                                        <span class="inline-flex items-center rounded-md bg-amber-50 px-2 py-1 font-bold text-amber-700 ring-1 ring-inset ring-amber-600/10 dark:bg-amber-400/10 dark:text-amber-400 dark:ring-amber-400/20">
                                            PENDING
                                        </span>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap py-3 px-4">
                                    <div class="flex items-center gap-2">
                                        <div class="size-6 rounded-full bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center text-[10px] font-bold text-zinc-500 border border-zinc-200 dark:border-zinc-700 uppercase">
                                            {{ substr($invoice->user?->name ?? '?', 0, 1) }}
                                        </div>
                                        <span class="text-zinc-600 dark:text-zinc-400 font-medium">{{ $invoice->user?->name ?? 'Unknown' }}</span>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap py-3 px-4 font-medium text-right text-zinc-900 dark:text-zinc-100">
                                    Rp {{ number_format($invoice->total_amount, 0, ',', '.') }}
                                </td>
                                <td class="whitespace-nowrap py-3 px-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('invoices.show', $invoice->id) }}" class="p-1 text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-300" title="View">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                        </a>

                                        @if(Auth::user()->hasRole('admin') || $invoice->user_id === Auth::id())
                                        <a href="{{ route('invoices.edit', $invoice->id) }}" class="p-1 text-zinc-400 hover:text-blue-600 dark:hover:text-blue-400" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.763a1.875 1.875 0 0 0-2.652-2.652L19.5 13.763Z" />
                                            </svg>
                                        </a>
                                        @endif

                                        @role('admin')
                                            @if($invoice->status === 'pending')
                                            <form action="{{ route('invoices.approve', $invoice->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="p-1 text-green-600 hover:text-green-700" title="Approve">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                                    </svg>
                                                </button>
                                            </form>
                                            @endif
                                        @endrole

                                        @if($invoice->status === 'approve')
                                        <a href="{{ route('invoices.print', $invoice->id) }}" target="_blank" class="p-1 text-zinc-400 hover:text-green-600 dark:hover:text-green-400" title="Print">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a60.773 60.773 0 0 1 2.25-.384m0 0a29.848 29.848 0 0 1 8.48.368.45.45 0 0 1 .502.422c0 .255-.162.489-.408.588m0 0a24.614 24.614 0 0 1-7.894 1.561m0 0A14.982 14.982 0 0 1 9 13.5H5.25a4.5 4.5 0 0 1 0-9h3.75a6 6 0 0 1 6 6v.75a3 3 0 0 1-3 3M9 6.75h6m-6 0a1.5 1.5 0 0 0-1.5 1.5v3m6-3a1.5 1.5 0 0 1 1.5 1.5v3m0 0h3" />
                                            </svg>
                                        </a>
                                        @endif

                                        @if(Auth::user()->hasRole('admin') || $invoice->user_id === Auth::id())
                                        <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kwitansi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1 text-zinc-400 hover:text-red-600 dark:hover:text-red-400" title="Delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="py-20 text-center text-zinc-500 dark:text-zinc-400">
                                    No invoices found matching your criteria.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-neutral-200 dark:border-neutral-700">
                {{ $invoices->links() }}
            </div>
        </div>
    </div>
</x-layouts::app>
