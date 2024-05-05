<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Página principal</title>
    </head>
    <body>
        <nav>
            <a href="/">Principal</a>
            <a href="/nosotros">Nosotros</a>
            <a href="/tienda-virtual">Tienda Virtual</a>
        </nav>
        <h1>@yield('titulo')</h1>
        <hr>
        @yield('contenido')
    </body>
</html>