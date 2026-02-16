<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log in</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
                        <x-auth-header :title="__('Log in to your account')" :description="__('Enter your username and password below to log in')" />

                        <x-auth-session-status class="text-center" :status="session('status')" />

                        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-6">
                            @csrf

                            <flux:input
                                name="name"
                                :label="__('Username')"
                                :value="old('name')"
                                type="text"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="Admin Koperasi"
                            />

                            <div class="relative">
                                <flux:input
                                    name="password"
                                    :label="__('Password')"
                                    type="password"
                                    required
                                    autocomplete="current-password"
                                    :placeholder="__('Password')"
                                    viewable
                                />

                                @if (Route::has('password.request'))
                                    <flux:link class="absolute top-0 text-sm end-0" :href="route('password.request')" wire:navigate>
                                        {{ __('Forgot your password?') }}
                                    </flux:link>
                                @endif
                            </div>

                            <flux:checkbox name="remember" :label="__('Remember me')" :checked="old('remember')" />

                            <div class="flex items-center justify-end">
                                <flux:button variant="primary" color='green' type="submit" class="w-full" data-test="login-button">
                                    {{ __('Log in') }}
                                </flux:button>
                            </div>
                        </form>

                        @if (Route::has('register'))
                            <div class="space-x-1 text-sm text-center rtl:space-x-reverse text-zinc-600 dark:text-zinc-400">
                                <span>{{ __('Don\'t have an account?') }}</span>
                                <flux:link :href="route('register')" wire:navigate>{{ __('Sign up') }}</flux:link>
                            </div>
                        @endif
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
