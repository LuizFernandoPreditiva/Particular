<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="auth-logo" />
            </a>
        </x-slot>

        <div class="auth-message">
            {{ __('Esta e uma area segura da aplicacao. Confirme sua senha para continuar.') }}
        </div>

        <!-- Validation Errors -->
        <x-auth-validation-errors :errors="$errors" />

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Password -->
            <div class="form-grid">
                <x-field label="Senha" for="password">
                    <x-input id="password"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
                </x-field>
            </div>

            <div class="form-actions">
                <x-button>
                    {{ __('Confirmar') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
