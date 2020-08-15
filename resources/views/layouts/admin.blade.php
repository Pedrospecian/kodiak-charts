<!DOCTYPE html>
<html>
    <head>
        <title>Kodiak Charts - @yield('title')</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="/css/app.css">        
        <link href="/vendor/css/select2.min.css" rel="stylesheet" />
    </head>
    <body class="admin">
        <header class="admin-header">
            <div class="admin-logo">Kodiak Charts</div>
            <div>Bem-vindo, {{ Auth::user()->name }} - 
                <a href="{{ route('logout') }}" class="link-logout" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">Sair</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </header>
        <main class="admin-main">
            @section('sidebar')
                <div class="admin-sidebar">
                    <ul>
                        <li><a href="/admin/paises">Países</a></li>
                        <li><a href="/admin/generos">Gêneros</a></li>
                        <li><a href="/admin/artistas">Artistas</a></li>
                        <li><a href="/admin/listas">Listas</a></li>
                    </ul>
                </div>
            @show        
            <div class="admin-content-wrapper">
                @yield('content')
            </div>
        </main>
        <script src="/vendor/js/jquery-3.5.1.min.js"></script>
        <script src="/vendor/js/select2.min.js"></script>
        <script src="/js/admin.js"></script>
    </body>
</html>