<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="auth-logo" />
            </a>
        </x-slot>

        <div class="auth-message">
            {{ __('Obrigado por se cadastrar! Antes de comecar, confirme seu email clicando no link que enviamos. Se nao recebeu, enviaremos outro.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="alert alert-success">
                {{ __('Um novo link de verificacao foi enviado para o email informado no cadastro.') }}
            </div>
        @endif

        <div class="form-actions">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-button>
                        {{ __('Reenviar email de verificacao') }}
                    </x-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="btn-secondary">
                    {{ __('Sair') }}
                </button>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout>
