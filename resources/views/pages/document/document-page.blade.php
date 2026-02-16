<x-layouts::app :title="__('Daftar Draft Dokumen')">
    <div class="max-w-7xl mx-auto pb-20">

        {{-- Header --}}
        <div class="mb-8 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('dashboard') }}" class="p-3 rounded-lg bg-white border border-zinc-200 text-zinc-900 hover:bg-zinc-50 transition shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>
                </a>
                <div>
                    <h1 class="text-3xl font-bold text-zinc-900 dark:text-white">Draft Dokumen</h1>
                    <p class="text-zinc-500 text-sm mt-1">Kelola dan arsipkan dokumen draft Anda</p>
                </div>
            </div>
            <a href="{{ route('draft-documents.create') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-zinc-900 rounded-lg hover:bg-zinc-800 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-200 transition-colors shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tambah Dokumen
            </a>
        </div>

        {{-- Search Section --}}
        <div class="mb-6 bg-white dark:bg-zinc-900 p-4 rounded-xl border border-neutral-200 dark:border-neutral-700 shadow-sm">
            <form action="{{ route('draft-documents.index') }}" method="GET" class="flex gap-3">
                <div class="flex-1 relative">
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="w-full rounded-lg border border-zinc-300 bg-zinc-50 dark:border-zinc-600 dark:bg-zinc-800 dark:text-white py-2 pl-10 pr-3 text-sm focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition"
                        placeholder="Cari nama dokumen...">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="size-4 text-zinc-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </div>
                </div>
                <button type="submit" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-zinc-900 rounded-lg hover:bg-zinc-800 transition">
                    Cari
                </button>
                @if(request('search'))
                    <a href="{{ route('draft-documents.index') }}" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-zinc-700 bg-zinc-100 rounded-lg hover:bg-zinc-200 transition">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg">
                <div class="flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-green-600 dark:text-green-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-sm text-green-700 dark:text-green-400">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        {{-- Table --}}
        <div class="relative flex flex-col h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-900 shadow-sm">
            <div class="flex-1 overflow-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-zinc-50 dark:bg-zinc-800/50 border-b border-neutral-200 dark:border-neutral-700">
                        <tr>
                            <th class="whitespace-nowrap py-3 px-4 font-medium text-zinc-500 dark:text-zinc-400">No</th>
                            <th class="whitespace-nowrap py-3 px-4 font-medium text-zinc-500 dark:text-zinc-400">Nama Dokumen</th>
                            <th class="whitespace-nowrap py-3 px-4 font-medium text-zinc-500 dark:text-zinc-400">Tanggal</th>
                            <th class="whitespace-nowrap py-3 px-4 font-medium text-zinc-500 dark:text-zinc-400">Format</th>
                            <th class="whitespace-nowrap py-3 px-4 font-medium text-right text-zinc-500 dark:text-zinc-400">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                        @forelse ($doc as $index => $item)
                            <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                                <td class="whitespace-nowrap py-3 px-4 text-zinc-500 dark:text-zinc-400">
                                    {{ ($doc->currentPage() - 1) * $doc->perPage() + $index + 1 }}
                                </td>
                                <td class="whitespace-nowrap py-3 px-4 text-zinc-900 dark:text-zinc-100 font-medium">
                                    {{ $item->name }}
                                </td>
                                <td class="whitespace-nowrap py-3 px-4 text-zinc-600 dark:text-zinc-400">
                                    {{ $item->date?->format('d M Y') ?? '-' }}
                                </td>
                                <td class="whitespace-nowrap py-3 px-4">
                                    <span class="px-2 py-1 rounded text-[10px] font-bold uppercase {{ str_contains($item->mime_type, 'pdf') ? 'bg-red-50 text-red-600 border border-red-100' : 'bg-blue-50 text-blue-600 border border-blue-100' }}">
                                        {{ explode('/', $item->mime_type)[1] ?? 'FILE' }}
                                    </span>
                                </td>
                                <td class="whitespace-nowrap py-3 px-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('draft-documents.show', $item->id) }}" class="p-1.5 text-zinc-400 hover:text-green-600 dark:hover:text-green-400 transition" title="View">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                        </a>

                                        <a href="{{ route('draft-documents.edit', $item->id) }}" class="p-1.5 text-zinc-400 hover:text-blue-600 dark:hover:text-blue-400 transition" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.763a1.875 1.875 0 0 0-2.652-2.652L19.5 13.763Z" />
                                            </svg>
                                        </a>

                                        <form action="{{ route('draft-documents.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 text-zinc-400 hover:text-red-600 dark:hover:text-red-400 transition" title="Delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-12 px-4 text-center text-zinc-500 dark:text-zinc-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="p-3 bg-zinc-50 dark:bg-zinc-800 rounded-full mb-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8 opacity-40">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                            </svg>
                                        </div>
                                        <p class="font-medium">Tidak ada dokumen ditemukan</p>
                                        <p class="text-xs text-zinc-400 mt-1">Coba kata kunci lain atau reset pencarian.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if ($doc->hasPages())
                <div class="border-t border-neutral-200 dark:border-neutral-700 p-4 bg-zinc-50/30">
                    {{ $doc->links() }}
                </div>
            @endif
        </div>

    </div>
</x-layouts::app>
