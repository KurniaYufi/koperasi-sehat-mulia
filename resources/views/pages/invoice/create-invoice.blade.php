<x-layouts::app :title="__('Buat Kwitansi')">
    <div class="max-w-7xl mx-auto pb-20" x-data="invoiceForm({{ $mitras->toJson() }})">

        <div class="mb-8 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('invoice') }}" class="p-3 rounded-lg bg-white border border-zinc-200 text-zinc-900 hover:bg-zinc-50 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>
                </a>
                <div>
                    <h1 class="text-3xl font-bold text-zinc-900 dark:text-white">Buat Kwitansi Baru</h1>
                    <p class="text-zinc-500 text-sm mt-1">Lengkapi data di bawah untuk membuat kwitansi.</p>
                </div>
            </div>
        </div>

        {{-- Error Validation --}}
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                <ul class="list-disc list-inside text-sm text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('invoices.store') }}" method="POST" class="space-y-8">
            @csrf

            <div class="bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
                <h2 class="text-lg font-semibold text-zinc-900 dark:text-white mb-6 flex items-center gap-2 border-b border-zinc-200 dark:border-zinc-700 pb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-zinc-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                    Informasi Umum
                </h2>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">No. Kwitansi</label>
                        <div class="flex items-center gap-3 border border-zinc-300 dark:border-zinc-600 rounded-lg px-4 py-3 bg-zinc-50 dark:bg-zinc-800">
                            <span class="text-zinc-500 font-medium">#</span>
                            <input type="text" name="invoice_number" value="{{ old('invoice_number', $invoiceNumber) }}"
                                class="w-full bg-transparent border-none focus:ring-0 p-0 font-medium text-zinc-900 dark:text-white placeholder-zinc-400"
                                placeholder="Contoh: 03/KSM/I/2026" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Tanggal</label>
                        <input type="date" name="invoice_date" value="{{ old('invoice_date') }}"
                            class="w-full rounded-lg border border-zinc-300 bg-zinc-50 dark:border-zinc-600 dark:bg-zinc-800 dark:text-white py-3 px-4 focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition"
                            required>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
                    <div class="mb-5 pb-4 border-b border-zinc-200 dark:border-zinc-700">
                        <h3 class="font-semibold text-zinc-900 dark:text-white flex items-center gap-2">
                            <span class="flex h-6 w-6 items-center justify-center rounded bg-zinc-100 dark:bg-zinc-800 text-xs text-zinc-600 dark:text-zinc-400">1</span>
                            Terima Dari
                        </h3>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-medium text-zinc-600 dark:text-zinc-400 uppercase mb-2">Nama Perusahaan / Institusi</label>
                            <input type="text" name="issuer_company" value="{{ old('issuer_company') }}"
                                class="w-full rounded-lg border border-zinc-300 bg-zinc-50 dark:border-zinc-600 dark:bg-zinc-800 dark:text-white py-2.5 px-3 focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition"
                                placeholder="Nama Perusahaan">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-zinc-600 dark:text-zinc-400 uppercase mb-2">Nama Orang (Pihak Ke-1)</label>
                            <input type="text" name="issuer_name" value="{{ old('issuer_name') }}"
                                class="w-full rounded-lg border border-zinc-300 bg-zinc-50 dark:border-zinc-600 dark:bg-zinc-800 dark:text-white py-2.5 px-3 focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition"
                                placeholder="Nama Lengkap Pembayar">
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
                    <div class="mb-5 pb-4 border-b border-zinc-200 dark:border-zinc-700">
                        <h3 class="font-semibold text-zinc-900 dark:text-white flex items-center gap-2">
                            <span class="flex h-6 w-6 items-center justify-center rounded bg-zinc-100 dark:bg-zinc-800 text-xs text-zinc-600 dark:text-zinc-400">2</span>
                            Mitra
                        </h3>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-medium text-zinc-600 dark:text-zinc-400 uppercase mb-2">Pilih Mitra <span class="text-red-500">*</span></label>
                            <select name="mitra_id" x-model="selectedMitraId" @change="updateContactPerson()"
                                class="w-full rounded-lg border border-zinc-300 bg-zinc-50 dark:border-zinc-600 dark:bg-zinc-800 dark:text-white py-2.5 px-3 focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition"
                                required>
                                <option value="">-- Pilih Mitra --</option>
                                @foreach($mitras as $mitra)
                                    <option value="{{ $mitra->id }}">{{ $mitra->company_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-zinc-600 dark:text-zinc-400 uppercase mb-2">Nama Orang (Pihak Ke-2)</label>
                            <input type="text" x-model="selectedContact" readonly
                                class="w-full rounded-lg border border-zinc-300 bg-zinc-200 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-400 py-2.5 px-3 cursor-not-allowed"
                                placeholder="Nama Lengkap Penerima">
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
                <div class="flex items-center justify-between mb-6 border-b border-zinc-200 dark:border-zinc-700 pb-4">
                    <h2 class="text-lg font-semibold text-zinc-900 dark:text-white flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-zinc-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z" />
                        </svg>
                        Rincian Pembayaran
                    </h2>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Deskripsi / Keterangan Kwitansi</label>
                    <input type="text" name="description" value="{{ old('description') }}"
                        class="w-full rounded-lg border border-zinc-300 bg-zinc-50 dark:border-zinc-600 dark:bg-zinc-800 dark:text-white py-3 px-4 focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition"
                        placeholder="Contoh: Pembayaran Biaya Langganan Software Tahunan">
                </div>

                <div class="hidden md:grid grid-cols-12 gap-4 px-4 py-3 bg-zinc-50 dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 text-xs font-medium text-zinc-600 dark:text-zinc-400 uppercase mb-4">
                    <div class="col-span-5">Keterangan Item</div>
                    <div class="col-span-2 text-right">Qty</div>
                    <div class="col-span-2 text-right">Harga (Rp)</div>
                    <div :class="items.length > 1 ? 'col-span-2' : 'col-span-3'" class="text-right">Total</div>
                    <div x-show="items.length > 1" class="col-span-1 text-center"></div>
                </div>

                <div class="space-y-4">
                    <template x-for="(item, index) in items" :key="index">
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end relative p-4 md:p-0 bg-zinc-50 md:bg-transparent rounded-lg md:rounded-none border border-zinc-200 md:border-none">
                            <div class="col-span-5">
                                <label class="md:hidden text-xs font-medium text-zinc-600 mb-1 block">KETERANGAN ITEM</label>
                                <input type="text" :name="`items[${index}][item_name]`" x-model="item.name"
                                    class="w-full rounded-lg border border-zinc-300 bg-white dark:border-zinc-600 dark:bg-zinc-800 dark:text-white py-2.5 px-3 focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition"
                                    placeholder="Nama Item" required>
                            </div>

                            <div class="col-span-2">
                                <label class="md:hidden text-xs font-medium text-zinc-600 mb-1 block">QTY</label>
                                <input type="number" :name="`items[${index}][quantity]`" x-model="item.qty" min="1"
                                    class="w-full rounded-lg border border-zinc-300 bg-white dark:border-zinc-600 dark:bg-zinc-800 dark:text-white py-2.5 px-3 focus:ring-2 focus:ring-zinc-900 focus:border-transparent text-right transition"
                                    required>
                            </div>

                            <div class="col-span-2">
                                <label class="md:hidden text-xs font-medium text-zinc-600 mb-1 block">HARGA</label>
                                <input type="number" :name="`items[${index}][unit_price]`" x-model="item.price" min="0"
                                    class="w-full rounded-lg border border-zinc-300 bg-white dark:border-zinc-600 dark:bg-zinc-800 dark:text-white py-2.5 px-3 focus:ring-2 focus:ring-zinc-900 focus:border-transparent text-right transition"
                                    required>
                            </div>

                            <div :class="items.length > 1 ? 'col-span-2' : 'col-span-3'">
                                <label class="md:hidden text-xs font-medium text-zinc-600 mb-1 block">TOTAL</label>
                                <div class="w-full flex items-center justify-end h-[46px] bg-zinc-50 dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-lg px-3 text-right font-medium text-zinc-900 dark:text-white">
                                    <span x-text="formatMoney(item.qty * item.price)"></span>
                                </div>
                            </div>

                            <div x-show="items.length > 1" class="col-span-1 flex justify-center pb-2.5 md:pb-0 md:pt-2">
                                <button type="button" @click="removeItem(index)"
                                    class="text-zinc-400 hover:text-red-500 transition p-2 hover:bg-red-50 rounded-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </template>

                    <div class="pt-4">
                        <button type="button" @click="addItem()" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-zinc-900 dark:text-white bg-white dark:bg-zinc-800 border border-zinc-300 dark:border-zinc-600 rounded-lg hover:bg-zinc-50 dark:hover:bg-zinc-700 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            Tambah Baris
                        </button>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-zinc-200 dark:border-zinc-700">
                    <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Terbilang (Jumlah dalam Huruf):</label>
                    <textarea name="amount_in_words" rows="2"
                        class="w-full rounded-lg border border-zinc-300 bg-white dark:border-zinc-600 dark:bg-zinc-800 dark:text-white py-3 px-4 focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition"
                        placeholder="Contoh: Sepuluh Juta Rupiah">{{ old('amount_in_words') }}</textarea>
                </div>
            </div>

            <div class="flex flex-col items-end">
                <div class="w-full md:w-5/12 lg:w-4/12 bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
                    <h3 class="text-sm font-medium text-zinc-600 dark:text-zinc-400 uppercase mb-4 border-b border-zinc-200 dark:border-zinc-700 pb-2">Total Pembayaran</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-xl font-semibold text-zinc-900 dark:text-white">Total</span>
                            <span class="text-2xl font-semibold text-zinc-900 dark:text-white" x-text="formatMoney(calculateTotal())"></span>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex items-center justify-end gap-4 w-full">
                    <a href="{{ route('invoice') }}" class="px-6 py-3 rounded-lg border border-zinc-300 text-zinc-700 dark:text-zinc-300 font-medium hover:bg-zinc-50 dark:hover:bg-zinc-800 transition bg-white dark:bg-zinc-900">
                        Batal
                    </a>
                    <button type="submit" class="cursor-pointer px-8 py-3 rounded-lg bg-zinc-900 text-white font-medium hover:bg-zinc-800 transition">
                        Simpan Kwitansi
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        function invoiceForm(mitraData) {
            return {
                items: [{ name: '', qty: 1, price: 0 }],
                mitras: mitraData,
                selectedMitraId: '',
                selectedContact: '',
                updateContactPerson() {
                    const selected = this.mitras.find(m => m.id == this.selectedMitraId);
                    this.selectedContact = selected ? selected.contact_person : '';
                },
                addItem() {
                    this.items.push({ name: '', qty: 1, price: 0 });
                },
                removeItem(index) {
                    this.items.splice(index, 1);
                },
                calculateTotal() {
                    return this.items.reduce((sum, item) => sum + (parseFloat(item.qty) * parseFloat(item.price || 0)), 0);
                },
                formatMoney(amount) {
                    if (isNaN(amount)) amount = 0;
                    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(amount);
                }
            }
        }
    </script>
</x-layouts::app>
