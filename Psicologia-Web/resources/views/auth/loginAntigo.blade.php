<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="auth-logo" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- E-mail Address -->
            <div class="form-grid">
                <x-field label="E-mail" for="email">
                    <x-input id="email" type="email" name="email" :value="old('email')" required autofocus />
                </x-field>

                <x-field label="Senha" for="password">
                    <x-input id="password" type="password" name="password" required autocomplete="current-password" />
                </x-field>
            </div>

            <!-- Remember Me -->
            <div class="checkbox-row">
                <input id="remember_me" type="checkbox" name="remember">
                <label for="remember_me">{{ __('Lembrar de mim') }}</label>
            </div>

            <div class="form-actions">
                @if (Route::has('password.request'))
                    <a class="btn-secondary" href="{{ route('password.request') }}">
                        {{ __('Esqueceu sua senha?') }}
                    </a>
                @endif

                <x-button>
                    {{ __('Entrar') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
