<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="auth-logo" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors :errors="$errors" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- E-mail Address -->
            <div class="form-grid">
                <x-field label="E-mail" for="email">
                    <x-input id="email" type="email" name="email" :value="old('email', $request->email)" required autofocus />
                </x-field>

                <x-field label="Senha" for="password">
                    <x-input id="password" type="password" name="password" required />
                </x-field>

                <x-field label="Confirmar Senha" for="password_confirmation">
                    <x-input id="password_confirmation" type="password" name="password_confirmation" required />
                </x-field>
            </div>

            <div class="form-actions">
                <x-button>
                    {{ __('Redefinir senha') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
