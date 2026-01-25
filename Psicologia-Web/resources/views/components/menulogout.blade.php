<div class="menuLogin">
    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <x-responsive-nav-link :href="route('logout')"
            onclick="event.preventDefault();
            this.closest('form').submit();">
            {{ __('Sair') }}
        </x-responsive-nav-link>
    </form>
</div>


