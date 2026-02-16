<x-layouts::app :title="__('Detail Draft Dokumen')">
    <div class="max-w-7xl mx-auto pb-20">

        {{-- Header --}}
        <div class="mb-8 flex items-center gap-4">
            <a href="{{ route('draft-documents.index') }}" class="p-3 rounded-lg bg-white border border-zinc-200 text-zinc-900 hover:bg-zinc-50 transition shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-zinc-900 dark:text-white">Detail Dokumen</h1>
                <p class="text-zinc-500 text-sm mt-1">{{ $doc->name }}</p>
            </div>
        </div>

        {{-- Content --}}
        <div class="bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-zinc-900 dark:text-white mb-6 flex items-center gap-2 border-b border-zinc-200 dark:border-zinc-700 pb-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-zinc-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                </svg>
                Informasi Dokumen
            </h2>

            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-zinc-500 dark:text-zinc-400 mb-1">Nama Dokumen</label>
                        <p class="text-zinc-900 dark:text-zinc-100 font-semibold text-lg">{{ $doc->name }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-zinc-500 dark:text-zinc-400 mb-1">Tanggal Terbit</label>
                        <p class="text-zinc-900 dark:text-zinc-100 font-medium">{{ $doc->date?->format('d F Y') ?? '-' }}</p>
                    </div>
                </div>

                <div class="pt-4 border-t border-zinc-100 dark:border-zinc-800">
                    <label class="block text-sm font-medium text-zinc-500 dark:text-zinc-400 mb-3">Lampiran File</label>

                    @if($doc->file_url)
                        <div class="inline-flex items-center gap-4 p-4 bg-zinc-50 dark:bg-zinc-800/50 rounded-xl border border-zinc-200 dark:border-zinc-700">
                            <div class="w-12 h-12 flex items-center justify-center bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 shadow-sm text-red-500">
                                @if(str_contains($doc->mime_type, 'pdf'))
                                    <svg class="size-8" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 4a2 2 0 012-2h4.586A1 1 0 0111.293.293l5.414 5.414A1 1 0 0117 6.586V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" />
                                    </svg>
                                @else
                                    <svg class="size-8 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                                    </svg>
                                @endif
                            </div>
                            <div>
                                <p class="text-sm font-bold text-zinc-900 dark:text-white truncate max-w-xs">
                                    {{ $doc->file_original_name }}
                                </p>
                                <p class="text-xs text-zinc-500 mt-1">
                                    {{ number_format($doc->size / 1024, 1) }} KB • {{ strtoupper(explode('/', $doc->mime_type)[1] ?? 'FILE') }}
                                </p>
                            </div>
                            <div class="ml-4">
                                <a href="{{ $doc->file_url }}" target="_blank" class="px-4 py-2 text-xs font-bold text-zinc-900 bg-white border border-zinc-200 rounded-lg">
                                    BUKA FILE
                                </a>
                            </div>
                        </div>
                    @else
                        <p class="text-zinc-500 italic">Tidak ada lampiran file.</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- Buttons --}}
        <div class="flex items-center gap-3 mt-8">
            <a href="{{ route('draft-documents.edit', $doc->id) }}" class="inline-flex items-center gap-2 px-6 py-2.5 text-sm font-medium text-white bg-zinc-900 rounded-lg hover:bg-zinc-800 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-200 transition-colors shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.763a1.875 1.875 0 0 0-2.652-2.652L19.5 13.763Z" />
                </svg>
                Edit Dokumen
            </a>
            <a href="{{ route('draft-documents.index') }}" class="inline-flex items-center gap-2 px-6 py-2.5 text-sm font-medium text-zinc-700 bg-white border border-zinc-300 rounded-lg hover:bg-zinc-50 dark:bg-zinc-800 dark:text-zinc-100 dark:border-zinc-600 dark:hover:bg-zinc-700 transition-colors">
                Kembali
            </a>
        </div>

    </div>
</x-layouts::app>
