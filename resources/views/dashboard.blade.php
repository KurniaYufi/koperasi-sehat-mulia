<x-layouts::app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-6">

        {{-- Welcome Section --}}
        <div class="relative overflow-hidden rounded-xl border border-zinc-200 bg-white p-8 dark:border-zinc-700 dark:bg-zinc-900 shadow-sm">
            <div class="relative z-10">
                <h1 class="text-3xl font-bold text-zinc-900 dark:text-white">
                    Selamat Datang, {{ auth()->user()->name }}! 👋
                </h1>
                <p class="mt-2 max-w-2xl text-zinc-500 dark:text-zinc-400">
                    Panel kendali Koperasi Sehat Mulia. Di sini Anda dapat mengelola invoice, data mitra, dan dokumen penting lainnya dengan cepat dan aman.
                </p>
                <div class="mt-6 flex gap-3">
                    <a href="{{ route('invoice') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-zinc-900 rounded-lg hover:bg-zinc-800 transition">
                        Buat Invoice Baru
                    </a>
                    <a href="{{ route('draft-documents.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-zinc-700 bg-zinc-100 rounded-lg hover:bg-zinc-200 transition dark:bg-zinc-800 dark:text-zinc-300 dark:hover:bg-zinc-700">
                        Lihat Dokumen
                    </a>
                </div>
            </div>
            {{-- Dekorasi Latar Belakang --}}
            <div class="absolute -right-10 -top-10 size-40 rounded-full bg-green-500/10 blur-3xl"></div>
            <div class="absolute -bottom-10 right-20 size-32 rounded-full bg-blue-500/10 blur-3xl"></div>
        </div>
    </div>
</x-layouts::app>
