<div class="menuLogin">
    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <button type="submit" class="btn-secondary"
            onclick="event.preventDefault(); this.closest('form').submit();">
            {{ __('Sair') }}
        </button>
    </form>
</div>


