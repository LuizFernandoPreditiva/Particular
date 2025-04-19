@extends('layouts.principal')

@section('header')

@endsection

@section('main')

    <div class="login-container">
        <div class="login-box">
            <h2>Bem Vindo</h2>
            <a href="http://192.168.1.10/#home"><img src="{{ asset('images/logo.png') }}" alt="Logo" class="icon"></a>
    
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-label for="email" :value="__('Email')" placeholder="nome@dominio.com" required/>
        
                    <x-input id="email" placeholder="nome@dominio.com" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                </div>

                <!-- Password -->
                <div class="mt-4 password-field">
                    <x-label for="password" :value="__('Password')" placeholder="Password" required />

                    <x-input id="password"
                        type="password"
                        name="password"
                        placeholder="Password"
                        class="input-style"
                        required autocomplete="current-password" />
                        <span class="eye" id="togglePassword">
                            <img id="togglePasswordIcon" src="{{ asset('images/lock_password_icon.png') }}" alt="Ver senha" />
                        </span>
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <x-button class="login-button">
                    {{ __('Logar') }}
                </x-button>
            </form>

        </div>
    </div>

    <script type="text/javascript" src="{{ asset('js/login.js') }}"></script>

@endsection

@section('footer')

@endsection
