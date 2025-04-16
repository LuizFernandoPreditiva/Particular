<header class="container">

    <nav class="navbar">
        <a href="{{route('logado')}}"><img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo"></a>
        <ul class="nav-links">
            <li>
                <div class="menuBarLogado">
                    <a href="{{route('logado')}}">Inicio</a>
                </div>
            </li>
            <li>
                <div class="dropdown">
                    <a class="btn btn-secondary dropdown-toggle" href="{{route('clientes.index')}}" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Pacientes
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route('clientes.index')}}">Lista</a></li>
                        <li><a class="dropdown-item" href="{{route('clientes.create')}}">Novo</a></li>
                        <li><a class="dropdown-item" href="{{route('clientes.pesquisar')}}">Buscar</a></li>
                        <hr>
                        <li><a class="dropdown-item" href="{{route('clientes.ativo')}}">Atendimentos</a></li>
                        <li><a class="dropdown-item" href="{{route('clientes.alta')}}">Alta</a></li>
                        <li><a class="dropdown-item" href="{{route('clientes.inativo')}}">Desistencia</a></li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="dropdown">
                    <a class="btn btn-secondary dropdown-toggle" href="{{route('pagamentos.pesquisar')}}" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Pagamentos
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route('pagamentos.pesquisar')}}">Lancar</a></li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="dropdown">
                    <a class="btn btn-secondary dropdown-toggle" href="{{route('atendimentos.index')}}" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Atendimentos
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route('atendimentos.create')}}">Novo</a></li>
                    </ul>
                </div>
            </li>      
        </ul>
        <div class="menuLogin">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
        
                <x-responsive-nav-link :href="route('logout')"
                    onclick="event.preventDefault();
                    this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-responsive-nav-link>
            </form>
        </div>
    </nav>
</header>


<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

<!-- Popper.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>

<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<script>
    // Inicialize o Bootstrap
    $(document).ready(function () {
        $('[data-toggle="dropdown"]').dropdown();
    });
</script>

