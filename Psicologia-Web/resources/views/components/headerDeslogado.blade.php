<!--    @component("components.menulogin")
    @endcomponent -->

<header class="container">
    <div class="navbar">
        <div class="logo">
            <a href=""><img src="{{ asset('images/logo.png') }}" alt=""></a>
        </div>
        <div class="menu-opener">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
        <nav>
        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
            Login</a>
        <a href="home">Home</a>
        <a href="">Sobre</a>
        <a href="" class="button">Contato</a>
    </nav>
</header>




