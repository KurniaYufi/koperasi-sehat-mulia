<x-layouts::app :title="__('Edit Draft Dokumen')">
    <div class="max-w-7xl mx-auto pb-20">

        {{-- Header --}}
        <div class="mb-8 flex items-center gap-4">
            <a href="{{ route('draft-documents.index') }}" class="p-3 rounded-lg bg-white border border-zinc-200 text-zinc-900 hover:bg-zinc-50 transition shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-zinc-900 dark:text-white">Edit Draft Dokumen</h1>
                <p class="text-zinc-500 text-sm mt-1">Perbarui informasi atau lampiran dokumen Anda</p>
            </div>
        </div>

        {{-- Form --}}
        <form action="{{ route('draft-documents.update', $doc->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6 shadow-sm">
                <h2 class="text-lg font-semibold text-zinc-900 dark:text-white mb-6 flex items-center gap-2 border-b border-zinc-200 dark:border-zinc-700 pb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-zinc-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.763a1.875 1.875 0 0 0-2.652-2.652L19.5 13.763Z" />
                    </svg>
                    Informasi Dokumen
                </h2>

                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Nama Dokumen <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name', $doc->name) }}"
                            class="w-full rounded-lg border border-zinc-300 bg-zinc-50 dark:border-zinc-600 dark:bg-zinc-800 dark:text-white py-2.5 px-4 focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition"
                            placeholder="Masukkan nama dokumen" required>
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Tanggal Dokumen</label>
                        <input type="date" name="date" value="{{ old('date', $doc->date?->format('Y-m-d')) }}"
                            class="w-full rounded-lg border border-zinc-300 bg-zinc-50 dark:border-zinc-600 dark:bg-zinc-800 dark:text-white py-2.5 px-4 focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition">
                        @error('date')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-2">
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Ganti File Lampiran</label>

                        {{-- Info File Saat Ini --}}
                        @if($doc->file_url)
                            <div class="mb-4 flex items-center gap-3 p-3 bg-zinc-100 dark:bg-zinc-800 rounded-lg border border-dashed border-zinc-300 dark:border-zinc-600">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-zinc-400">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                                <span class="text-xs text-zinc-600 dark:text-zinc-400">File saat ini:</span>
                                <a href="{{ $doc->file_url }}" target="_blank" class="text-xs font-bold text-blue-600 hover:underline truncate max-w-xs">
                                    {{ $doc->file_original_name }}
                                </a>
                            </div>
                        @endif

                        <div class="relative group">
                            <input type="file" name="file" accept=".pdf,image/jpeg,image/jpg,image/png"
                                class="w-full text-sm text-zinc-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-zinc-900 file:text-white hover:file:bg-zinc-800 dark:file:bg-zinc-100 dark:file:text-zinc-900 transition cursor-pointer">
                        </div>
                        <p class="text-zinc-400 text-[11px] mt-2 italic text-right font-medium">Kosongkan jika tidak ingin mengganti file</p>
                        @error('file')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Buttons --}}
            <div class="flex items-center gap-3 mt-6">
                <button type="submit" class="cursor-pointer inline-flex items-center gap-2 px-6 py-2.5 text-sm font-medium text-white bg-zinc-900 rounded-lg hover:bg-zinc-800 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-200 transition-colors shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                    Simpan Perubahan
                </button>
                <a href="{{ route('draft-documents.index') }}" class="inline-flex items-center gap-2 px-6 py-2.5 text-sm font-medium text-zinc-700 bg-white border border-zinc-300 rounded-lg hover:bg-zinc-50 dark:bg-zinc-800 dark:text-zinc-100 dark:border-zinc-600 dark:hover:bg-zinc-700 transition-colors">
                    Batal
                </a>
            </div>
        </form>

    </div>
</x-layouts::app>
