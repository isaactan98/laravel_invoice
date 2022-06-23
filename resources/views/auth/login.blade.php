{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ml-3">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout> --}}

@extends('layouts/app')

@section('title')Login @endsection

@section('login')

    <body class="login">
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="container sm:px-10">
                <div class="block xl:grid grid-cols-2 gap-4">
                    <!-- BEGIN: Login Info -->
                    <div class="hidden xl:flex flex-col min-h-screen">
                        <a href="" class="-intro-x flex items-center pt-5">
                            <img alt="Midone Tailwind HTML Admin Template" class="w-6"
                                src="{{ asset('images/logo.svg') }}">
                            <span class="text-white text-lg ml-3">
                                Invoice Tab
                            </span>
                        </a>
                        <div class="my-auto">
                            <img alt="Midone Tailwind HTML Admin Template" class="-intro-x w-1/2 -mt-16"
                                src="{{ asset('images/illustration.svg') }}">
                            <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">A few more clicks to
                                <br>
                                sign in to your account.
                            </div>
                            <div class="-intro-x mt-5 text-lg text-white dark:text-gray-500">Manage all your invoice
                                in one place</div>
                        </div>
                    </div>
                    <!-- END: Login Info -->
                    <!-- BEGIN: Login Form -->
                    <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                        <div
                            class="my-auto mx-auto xl:ml-20 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                            <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">Sign In</h2>
                            <div class="intro-x mt-2 text-gray-500 xl:hidden text-center">A few more clicks to sign in to
                                your
                                account. Manage all your invoice in one place</div>
                            <div class="intro-x mt-8">
                                <input type="text" class="intro-x login__input input input--lg border border-gray-300 block"
                                    placeholder="Email" name="email">
                                <input type="password"
                                    class="intro-x login__input input input--lg border border-gray-300 block mt-4"
                                    placeholder="Password" name="password">
                            </div>
                            <div class="intro-x flex text-gray-700 dark:text-gray-600 text-xs sm:text-sm mt-4">
                                <div class="flex items-center mr-auto">
                                    <input type="checkbox" class="input border mr-2" id="remember-me" name="remember">
                                    <label class="cursor-pointer select-none" for="remember-me">Remember me</label>
                                </div>
                                <a href="">Forgot Password?</a>
                            </div>
                            <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                                <button
                                    class="button button--lg w-full xl:w-32 text-white bg-theme-1 xl:mr-3 align-top">Login</button>
                                <button id="sign_up"
                                    class="button button--lg w-full xl:w-32 text-gray-700 border border-gray-300 dark:border-dark-5 dark:text-gray-300 mt-3 xl:mt-0 align-top">Sign
                                    up</button>
                            </div>
                            <div class="intro-x mt-10 xl:mt-24 text-gray-700 dark:text-gray-600 text-center xl:text-left">
                                By signin up, you agree to our <br> <a class="text-theme-1 dark:text-theme-10" href="">Terms
                                    and
                                    Conditions</a> & <a class="text-theme-1 dark:text-theme-10" href="">Privacy Policy</a>
                            </div>
                        </div>
                    </div>
                    <!-- END: Login Form -->
                </div>
            </div>
        </form>
        <script>
            document.getElementById("sign_up").addEventListener("click", function(event) {
                event.preventDefault();
                window.location.href = '{{ route('register') }}';
            });
        </script>
    </body>
@endsection
