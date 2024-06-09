<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @stack('styles')
        <title>Devstagram - @yield('titulo')</title>
        @vite('resources/css/app.css'){{-- ESTAMOS INDICANDO LA UBICACIÓN DEL ARCHIVO CSS A COMPILAR --}}
        @vite('resources/js/app.js'){{-- ESTAMOS INDICANDO LA UBICACIÓN DEL ARCHIVO JS A COMPILAR --}}

        @livewireStyles{{-- Agregamos los estilos de livewire --}}
    </head>
    <body class="bg-gray-200">
        @include('layouts.header'){{-- Navegación superior--}}
        @include('layouts.main'){{-- Parte del contenido de la página --}}
        @include('layouts.footer'){{-- Parte inferior de la página --}}

        @livewireScripts
    </body>
</html>