<x-layouts::app :title="__('Manajemen User')">
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
                    <h1 class="text-3xl font-bold text-zinc-900 dark:text-white">Manajemen User</h1>
                    <p class="text-zinc-500 text-sm mt-1">Kelola akun pengguna yang dapat mengakses sistem</p>
                </div>
            </div>
            <a href="{{ route('users.create') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-zinc-900 rounded-lg hover:bg-zinc-800 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-200 transition-colors shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tambah User
            </a>
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
                            <th class="whitespace-nowrap py-3 px-4 font-medium text-zinc-500 dark:text-zinc-400">Username</th>
                            <th class="whitespace-nowrap py-3 px-4 font-medium text-zinc-500 dark:text-zinc-400">Email</th>
                            <th class="whitespace-nowrap py-3 px-4 font-medium text-zinc-500 dark:text-zinc-400">Dibuat Pada</th>
                            <th class="whitespace-nowrap py-3 px-4 font-medium text-right text-zinc-500 dark:text-zinc-400">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                        @forelse ($users as $index => $user)
                            <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                                <td class="whitespace-nowrap py-3 px-4 text-zinc-500 dark:text-zinc-400">
                                    {{ ($users->currentPage() - 1) * $users->perPage() + $index + 1 }}
                                </td>
                                <td class="whitespace-nowrap py-3 px-4 text-zinc-900 dark:text-zinc-100 font-medium">
                                    {{ $user->name }}
                                </td>
                                <td class="whitespace-nowrap py-3 px-4 text-zinc-600 dark:text-zinc-300">
                                    {{ $user->email }}
                                </td>
                                <td class="whitespace-nowrap py-3 px-4 text-zinc-500 dark:text-zinc-400">
                                    {{ $user->created_at->format('d M Y') }}
                                </td>
                                <td class="whitespace-nowrap py-3 px-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        {{-- View Button --}}
                                        <a href="{{ route('users.show', $user->id) }}" class="p-1 text-zinc-400 hover:text-green-600 dark:hover:text-green-400 transition-colors" title="View">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                        </a>

                                        {{-- Edit Button --}}
                                        <a href="{{ route('users.edit', $user->id) }}" class="p-1 text-zinc-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.763a1.875 1.875 0 0 0-2.652-2.652L19.5 13.763Z" />
                                            </svg>
                                        </a>

                                        {{-- Delete Button (Hanya Admin yang bisa hapus user lain) --}}
                                        @if($user->id !== auth()->id())
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-1 text-zinc-400 hover:text-red-600 dark:hover:text-red-400 transition-colors" title="Delete">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-[10px] px-2 py-1 bg-zinc-100 dark:bg-zinc-800 text-zinc-500 rounded uppercase tracking-wider font-bold">You</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-12 px-4 text-center text-zinc-500 dark:text-zinc-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-12 mb-3 opacity-20">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-3.833-6.24H15v7.128Z" />
                                        </svg>
                                        <p>Belum ada user terdaftar</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if ($users->hasPages())
                <div class="border-t border-neutral-200 dark:border-neutral-700 p-4">
                    {{ $users->links() }}
                </div>
            @endif
        </div>

    </div>
</x-layouts::app>
