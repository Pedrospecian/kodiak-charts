<!DOCTYPE html>
<html>
    <head>
        <title>Kodiak Charts - @yield('title')</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="/css/app.css">        
        <link href="/vendor/css/select2.min.css" rel="stylesheet" />
        <link href="/vendor/css/bootstrap-tagsinput.css" rel="stylesheet" />
    </head>
    <body>
        <div>
            <header class="text-shadow">
                <div class="header-logo">Kodiak Charts</div>
                <ul class="navbar-top">
                    <li><a href="/">Charts</a></li>
                    <!--<li><a href="/charts/1">Artist Archives</a></li>-->
                    <li><a href="/archive">Archives</a></li>
                    <!--<li><a href="/archive/1">Archive Singles</a></li>-->
                    <li>
                        <form class="form-search js-search-form" action="/search" method="get">
                            <!-- Busca por artista -->
                            <div class="search-field-wrapper">
                                <input type="text" name="search" placeholder="Buscar"/>
                            </div>
                            <button type="button" class="closed js-open-search"><img src="{{ asset('images/icon-search.png') }}" alt="Busca" /></button>
                            <button type="submit" class="opened"><img src="{{ asset('images/icon-search.png') }}" alt="Busca" /></button>
                            <button type="button" class="btn-close js-close-search"><img src="{{ asset('images/icon-close.png') }}" alt="Fechar" /></button>
                        </form>
                    </li>
                </ul>
            </header>
            <div class="content">                
                @yield('content')
            </div>
            <footer class="text-center">
                Kodiak Charts - Since 2018
                <br>
                2020 © All Rights Reserved
            </footer>
        </div>
        
        <script src="/vendor/js/jquery-3.5.1.min.js"></script>
        <script src="/vendor/js/select2.min.js"></script>
        <script src="/vendor/js/typeahead.bundle.js"></script>
        <script src="/vendor/js/bootstrap-tagsinput.min.js"></script>
        <script src="/js/front.js"></script>
        @yield('customscript')
    </body>
</html>