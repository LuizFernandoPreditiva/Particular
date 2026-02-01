<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="auth-logo" />
            </a>
        </x-slot>

        <div class="auth-message">
            {{ __('Esqueceu sua senha? Sem problemas. Informe seu email e enviaremos um link para redefinir a senha.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- E-mail Address -->
            <div class="form-grid">
                <x-field label="E-mail" for="email">
                    <x-input id="email" type="email" name="email" :value="old('email')" required autofocus />
                </x-field>
            </div>

            <div class="form-actions">
                <x-button>
                    {{ __('Enviar link de redefinicao') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
