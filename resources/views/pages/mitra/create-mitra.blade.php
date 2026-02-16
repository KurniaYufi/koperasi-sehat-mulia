<x-layouts::app :title="__('Tambah Mitra Baru')">
    <div class="max-w-7xl mx-auto pb-20">

        {{-- Header --}}
        <div class="mb-8 flex items-center gap-4">
            <a href="{{ route('mitras.index') }}" class="p-3 rounded-lg bg-white border border-zinc-200 text-zinc-900 hover:bg-zinc-50 transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-zinc-900 dark:text-white">Tambah Mitra Baru</h1>
                <p class="text-zinc-500 text-sm mt-1">Lengkapi informasi mitra bisnis Anda</p>
            </div>
        </div>

        {{-- Form --}}
        <form action="{{ route('mitras.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
                <h2 class="text-lg font-semibold text-zinc-900 dark:text-white mb-6 flex items-center gap-2 border-b border-zinc-200 dark:border-zinc-700 pb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-zinc-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                    Informasi Mitra
                </h2>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Nama Perusahaan <span class="text-red-500">*</span></label>
                        <input type="text" name="company_name" value="{{ old('company_name') }}"
                            class="w-full rounded-lg border border-zinc-300 bg-zinc-50 dark:border-zinc-600 dark:bg-zinc-800 dark:text-white py-2.5 px-4 focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition"
                            placeholder="Nama Perusahaan" required>
                        @error('company_name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Nama Kontak Personel</label>
                        <input type="text" name="contact_person" value="{{ old('contact_person') }}"
                            class="w-full rounded-lg border border-zinc-300 bg-zinc-50 dark:border-zinc-600 dark:bg-zinc-800 dark:text-white py-2.5 px-4 focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition"
                            placeholder="Nama Orang / PIC">
                        @error('contact_person')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="w-full rounded-lg border border-zinc-300 bg-zinc-50 dark:border-zinc-600 dark:bg-zinc-800 dark:text-white py-2.5 px-4 focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition"
                                placeholder="email@example.com">
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Nomor Telepon</label>
                            <input type="text" name="phone" value="{{ old('phone') }}"
                                class="w-full rounded-lg border border-zinc-300 bg-zinc-50 dark:border-zinc-600 dark:bg-zinc-800 dark:text-white py-2.5 px-4 focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition"
                                placeholder="+62 123 4567 8900">
                            @error('phone')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Alamat</label>
                        <textarea name="address" rows="3"
                            class="w-full rounded-lg border border-zinc-300 bg-zinc-50 dark:border-zinc-600 dark:bg-zinc-800 dark:text-white py-2.5 px-4 focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition"
                            placeholder="Alamat lengkap perusahaan">{{ old('address') }}</textarea>
                        @error('address')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Buttons --}}
            <div class="flex items-center gap-3">
                <button type="submit" class="cursor-pointer inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-zinc-900 rounded-lg hover:bg-zinc-800 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-200 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Tambah Mitra
                </button>
                <a href="{{ route('mitras.index') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-zinc-700 bg-white border border-zinc-300 rounded-lg hover:bg-zinc-50 dark:bg-zinc-800 dark:text-zinc-100 dark:border-zinc-600 dark:hover:bg-zinc-700 transition-colors">
                    Batal
                </a>
            </div>
        </form>

    </div>
</x-layouts::app>
