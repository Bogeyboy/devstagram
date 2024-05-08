@extends('layouts.app')

@section('titulo')
    Regístrate en DevStagram
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12 p-5">
            <img src="{{ asset('img/registrar.jpg') }}" alt="Imagen de registro de usuarios">
        </div>
        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div mb-5>{{-- Nombre real --}}
                    <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">
                        Nombre:
                    </label>
                    <input 
                        class="border p-3 w-full rounded-lg"
                        id="name"
                        name="name"
                        type="text"
                        placeholder="Aquí tu nombre">
                </div>
                <div mb-5>{{-- Nombre de usuario --}}
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Username:
                    </label>
                    <input 
                        class="border p-3 w-full rounded-lg"
                        id="username"
                        name="username"
                        type="text"
                        placeholder="Aquí tu username">
                </div>
                <div mb-5>{{-- Email --}}
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Email:
                    </label>
                    <input 
                        class="border p-3 w-full rounded-lg"
                        id="email"
                        name="email"
                        type="email"
                        placeholder="Aquí tu email">
                </div>
                <div mb-5>{{-- Password --}}
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Password:
                    </label>
                    <input 
                        class="border p-3 w-full rounded-lg"
                        id="password"
                        name="password"
                        type="password"
                        placeholder="Aquí tu password">
                </div>
                <div mb-5>{{-- Confirmación de Password --}}
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">
                        Repetir password:
                    </label>
                    <input 
                        class="border p-3 w-full rounded-lg"
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        placeholder="Repite tu password">
                </div>
                {{-- Botón --}}
                <input
                    class="mt-5  bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3
                        text-white rounded-lg"
                    type="submit"
                    value="Crear cuenta">
            </form>
        </div>
    </div>
@endsection