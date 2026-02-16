<x-layouts::app :title="__('Tambah User Baru')">
    <div class="max-w-7xl mx-auto pb-20">

        {{-- Header --}}
        <div class="mb-8 flex items-center gap-4">
            <a href="{{ route('users.index') }}" class="p-3 rounded-lg bg-white border border-zinc-200 text-zinc-900 hover:bg-zinc-50 transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-zinc-900 dark:text-white">Tambah User Baru</h1>
                <p class="text-zinc-500 text-sm mt-1">Buat akun pengguna baru untuk akses sistem</p>
            </div>
        </div>

        {{-- Form --}}
        <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6 shadow-sm">
                <h2 class="text-lg font-semibold text-zinc-900 dark:text-white mb-6 flex items-center gap-2 border-b border-zinc-200 dark:border-zinc-700 pb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-zinc-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                    Informasi Akun
                </h2>

                <div class="space-y-4">
                    {{-- Username (Name) --}}
                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Username / Nama <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="w-full rounded-lg border border-zinc-300 bg-zinc-50 dark:border-zinc-600 dark:bg-zinc-800 dark:text-white py-2.5 px-4 focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition"
                            placeholder="Masukkan username" required autofocus>
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Alamat Email <span class="text-red-500">*</span></label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="w-full rounded-lg border border-zinc-300 bg-zinc-50 dark:border-zinc-600 dark:bg-zinc-800 dark:text-white py-2.5 px-4 focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition"
                            placeholder="email@example.com" required>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password Fields --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Password <span class="text-red-500">*</span></label>
                            <input type="password" name="password"
                                class="w-full rounded-lg border border-zinc-300 bg-zinc-50 dark:border-zinc-600 dark:bg-zinc-800 dark:text-white py-2.5 px-4 focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition"
                                placeholder="Minimal 8 karakter" required>
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Konfirmasi Password <span class="text-red-500">*</span></label>
                            <input type="password" name="password_confirmation"
                                class="w-full rounded-lg border border-zinc-300 bg-zinc-50 dark:border-zinc-600 dark:bg-zinc-800 dark:text-white py-2.5 px-4 focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition"
                                placeholder="Ulangi password" required>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Buttons --}}
            <div class="flex items-center gap-3">
                <button type="submit" class="cursor-pointer inline-flex items-center gap-2 px-6 py-2.5 text-sm font-medium text-white bg-zinc-900 rounded-lg hover:bg-zinc-800 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-200 transition-colors shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Simpan User
                </button>
                <a href="{{ route('users.index') }}" class="inline-flex items-center gap-2 px-6 py-2.5 text-sm font-medium text-zinc-700 bg-white border border-zinc-300 rounded-lg hover:bg-zinc-50 dark:bg-zinc-800 dark:text-zinc-100 dark:border-zinc-600 dark:hover:bg-zinc-700 transition-colors">
                    Batal
                </a>
            </div>
        </form>

    </div>
</x-layouts::app>
