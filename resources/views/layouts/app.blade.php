<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Devstagram - @yield('titulo')</title>
        @vite('resources/css/app.css'){{-- ESTAMOS INDICANDO LA UBICACIÓN DEL ARCHIVO CSS A COMPILAR --}}
        @vite('resources/js/app.js'){{-- ESTAMOS INDICANDO LA UBICACIÓN DEL ARCHIVO JS A COMPILAR --}}
    </head>
    <body class="bg-red-300">
        @include('layouts.header')
    </body>
</html>