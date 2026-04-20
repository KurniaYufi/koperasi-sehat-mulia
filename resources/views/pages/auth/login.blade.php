<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="/images/logo.png">
    <title>Log in</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="min-h-screen bg-white antialiased dark:bg-zinc-900">

    <div class="grid min-h-screen lg:grid-cols-2">

        <div class="flex flex-col gap-4 p-6 md:p-10">

            <div class="flex items-center gap-3">
                <img src="/images/logo.png" alt="Logo" class="w-10 h-10 rounded-lg object-contain">
                <div class="flex flex-col">
                    <span class="text-lg font-bold text-[#0f2a27] leading-none">KOPERASI</span>
                    <span class="text-sm font-bold text-[#994c2e] uppercase tracking-widest leading-none">SEHAT MULIA</span>
                </div>
            </div>

            <div class="flex flex-1 items-center justify-center">
                <div class="w-full max-w-xs">

                    <div class="flex flex-col gap-6">
                        <div class="space-y-1">
                            <h1 class="text-2xl font-semibold tracking-tight">{{ __('Log in to your account') }}</h1>
                            <p class="text-sm text-zinc-500 dark:text-zinc-400">{{ __('Enter your username and password below to log in') }}</p>
                        </div>

                        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-6">
                            @csrf

                            <div class="flex flex-col gap-2">
                                <label for="name" class="text-sm font-medium">{{ __('Username') }}</label>
                                <input 
                                    id="name"
                                    name="name" 
                                    type="text" 
                                    value="{{ old('name') }}"
                                    required 
                                    autofocus 
                                    placeholder="Admin Koperasi"
                                    class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 dark:border-zinc-800 dark:bg-zinc-950"
                                />
                            </div>

                            <div class="flex flex-col gap-2" x-data="{ show: false }">
                                <div class="flex items-center justify-between">
                                    <label for="password" class="text-sm font-medium">{{ __('Password') }}</label>
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="text-sm text-zinc-600 underline hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-zinc-50">
                                            {{ __('Forgot your password?') }}
                                        </a>
                                    @endif
                                </div>
                                
                                <div class="relative">
                                    <input 
                                        id="password"
                                        name="password" 
                                        :type="show ? 'text' : 'password'" 
                                        required 
                                        autocomplete="current-password"
                                        placeholder="••••••••"
                                        class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 dark:border-zinc-800 dark:bg-zinc-950"
                                    />
                                    
                                    <button 
                                        type="button" 
                                        @click="show = !show"
                                        tabindex="-1"
                                        class="absolute inset-y-0 right-0 flex items-center pr-3 text-zinc-500 hover:text-zinc-700 dark:text-zinc-400 dark:hover:text-zinc-200"
                                    >
                                        <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.644C3.301 8.844 7.428 6 12 6s8.699 2.844 9.964 5.678c.045.107.045.232 0 .339C20.699 15.156 16.572 18 12 18s-8.699-2.844-9.964-5.678Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                        <svg x-show="show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5" style="display: none;">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="flex items-center gap-2">
                                <input id="remember" name="remember" type="checkbox" class="h-4 w-4 rounded border-zinc-300 text-green-600 focus:ring-green-500">
                                <label for="remember" class="text-sm font-medium">{{ __('Remember me') }}</label>
                            </div>

                            <button type="submit" class="inline-flex h-10 items-center justify-center rounded-md bg-green-600 px-4 py-2 text-sm font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                {{ __('Log in') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="relative hidden bg-zinc-100 lg:block dark:bg-zinc-900">
            <img
                src="/images/hero.jpg"
                alt="Image"
                class="absolute inset-0 h-full w-full object-cover dark:brightness-[0.2] dark:grayscale"
            />
        </div>

    </div>
</body>
</html>