@extends('layouts.principal')

@section('header')

@endsection

@section('main')

    <div class="login-container">
        <div class="login-box">
            <h2>Bem-vindo</h2>
            <a href="http://192.168.1.10/#home"><img src="{{ asset('images/logo.png') }}" alt="Logo" class="icon"></a>
    
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-grid">
                    <x-field label="E-mail" for="email">
                        <x-input id="email" placeholder="nome@dominio.com" type="email" name="email" :value="old('email')" required autofocus />
                    </x-field>

                    <x-field label="Senha" for="password">
                        <div class="password-field">
                            <x-input id="password"
                                type="password"
                                name="password"
                                placeholder="Senha"
                                required autocomplete="current-password" />
                            <span class="eye" id="togglePassword">
                                <img id="togglePasswordIcon" src="{{ asset('images/lock_password_icon.png') }}" alt="Ver senha" />
                            </span>
                        </div>
                    </x-field>
                </div>

                <!-- Remember Me -->
                <div class="checkbox-row">
                    <input id="remember_me" type="checkbox" name="remember">
                    <label for="remember_me">{{ __('Lembrar de mim') }}</label>
                </div>

                <x-button class="login-button">
                    {{ __('Entrar') }}
                </x-button>
            </form>

        </div>
    </div>

    <script type="text/javascript" src="{{ asset('js/login.js') }}"></script>

@endsection

@section('footer')

@endsection
