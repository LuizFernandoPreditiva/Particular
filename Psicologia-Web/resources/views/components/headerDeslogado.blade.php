<header class="container">
    <nav class="navbar">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">

        <div class="menu-opener">
            <span></span>
            <span></span>
            <span></span>
        </div>

        <ul class="nav-links">
            <li><a href="#home" class="active">Home</a></li>
            <li><a href="#">Sobre Mim</a></li>
            <li><a href="#">Serviços</a></li>
            <li><a href="#">Contato</a></li>
        </ul>

        <div class="actions">
            <a href="#" class="btn-agendar">AGENDAR SESSÃO</a>
            <a href="{{ route('login') }}" class="login">Login</a>
        </div>
    </nav>
</header>




