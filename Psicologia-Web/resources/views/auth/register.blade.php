<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="auth-logo" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="form-grid">
                <x-field label="Nome" for="name">
                    <x-input id="name" type="text" name="name" :value="old('name')" required autofocus />
                </x-field>

                <x-field label="E-mail" for="email">
                    <x-input id="email" type="email" name="email" :value="old('email')" required />
                </x-field>

                <x-field label="Senha" for="password">
                    <x-input id="password" type="password" name="password" required autocomplete="new-password" />
                </x-field>

                <x-field label="Confirmar Senha" for="password_confirmation">
                    <x-input id="password_confirmation" type="password" name="password_confirmation" required />
                </x-field>
            </div>

            <div class="form-actions">
                <a class="btn-secondary" href="{{ route('login') }}">
                    {{ __('Já possui cadastro?') }}
                </a>

                <x-button>
                    {{ __('Cadastrar') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
