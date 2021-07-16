<!-- Definisce la navbar del sito -->
<header id="Header">
    <nav>
        <a href="{{ route('home') }}" id="Logo">
            <img alt="Home" src="{{ asset('img/logo.png') }}">
        </a>
        <!-- Tali bottoni non vengono mostrati se siamo nella pagina di login o signup -->
        @if(!auth::check())
        
        <div id="Login_Container">
            <a href="{{ route('login') }}">
                <button><i class="fa fa-sign-in fa-lg"></i> Accedi</button>
            </a>
            <a href="{{ route('register') }}">
                <button><i class="fa fa-user-plus fa-lg"></i> Registrati</button>
            </a>
        </div>
        @else
        
        <div id="Login_Container">
            @can('isUser')
            <a href="{{ route('profilo') }}">
                <button><i class="fa fa-user fa-lg"></i> Account</button>
            </a>
            @endcan

            @can('isOrg')
            <a href="{{ route('miei_eventi') }}">
                <button><i class="fa fa-user fa-lg"></i> Miei eventi</button>
            </a>
            @endcan

            @can('isAdmin')
            <a href="{{ route('elenco_utenti') }}">
                <button><i class="fa fa-user fa-lg"></i> Utenti</button>
            </a>
            @endcan

            <form id="logout-form" action="{{ route('logout') }}" method="POST">
            {{ csrf_field() }}
            
            <button type="submit" ><i class="fa fa-sign-out fa-lg"></i>Logout</button>
        </form>
        </div>
        @endif
    </nav>    
    <div id="Searchbar">
        @yield('search')
        <a href='{{ route('catalogo_filtro') }}'>
            <button><i class="fa fa-list fa-lg"></i> Catalogo</button>
        </a>
    </div>
</header>
