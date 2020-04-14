<!DOCTYPE html>
<html>
    <head>
        <title>Kodiak Charts - @yield('title')</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="/css/app.css">
    </head>
    <body class="admin">
        <header class="admin-header">
            <div class="admin-logo">Kodiak Charts</div>
            <a href="#" class="link-logout">Logout</a>
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
    </body>
</html>