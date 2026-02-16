<x-layouts::app :title="__('Detail User')">
    <div class="max-w-7xl mx-auto pb-20">

        {{-- Header --}}
        <div class="mb-8 flex items-center gap-4">
            <a href="{{ route('users.index') }}" class="p-3 rounded-lg bg-white border border-zinc-200 text-zinc-900 hover:bg-zinc-50 transition shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-zinc-900 dark:text-white">Detail User</h1>
                <p class="text-zinc-500 text-sm mt-1">Informasi lengkap akun {{ $user->name }}</p>
            </div>
        </div>

        {{-- Content Card --}}
        <div class="bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-zinc-900 dark:text-white mb-6 flex items-center gap-2 border-b border-zinc-200 dark:border-zinc-700 pb-3">
                Informasi Identitas
            </h2>

            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-zinc-500 dark:text-zinc-400 mb-1">Username / Nama</label>
                        <p class="text-zinc-900 dark:text-zinc-100 font-semibold text-lg">{{ $user->name }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-zinc-500 dark:text-zinc-400 mb-1">Alamat Email</label>
                        <p class="text-zinc-900 dark:text-zinc-100 font-medium">{{ $user->email }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-zinc-100 dark:border-zinc-800">
                    <div>
                        <label class="block text-sm font-medium text-zinc-500 dark:text-zinc-400 mb-1">Akun Dibuat</label>
                        <p class="text-zinc-900 dark:text-zinc-100">{{ $user->created_at->format('d F Y, H:i') }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-zinc-500 dark:text-zinc-400 mb-1">Terakhir Diperbarui</label>
                        <p class="text-zinc-900 dark:text-zinc-100">{{ $user->updated_at->format('d F Y, H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Footer Action --}}
        <div class="flex items-center gap-3 mt-8">
            <a href="{{ route('users.edit', $user->id) }}" class="inline-flex items-center gap-2 px-6 py-2.5 text-sm font-medium text-white bg-zinc-900 rounded-lg hover:bg-zinc-800 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-200 transition-colors shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z" />
                </svg>
                Edit Akun
            </a>
            <a href="{{ route('users.index') }}" class="inline-flex items-center gap-2 px-6 py-2.5 text-sm font-medium text-zinc-700 bg-white border border-zinc-300 rounded-lg hover:bg-zinc-50 dark:bg-zinc-800 dark:text-zinc-100 dark:border-zinc-600 dark:hover:bg-zinc-700 transition-colors">
                Kembali
            </a>
        </div>
    </div>
</x-layouts::app>
