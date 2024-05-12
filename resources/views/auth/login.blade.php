@extends('layouts.app')

@section('titulo')
    Inicia sesión en DevStagram
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12 p-5">
            <img src="{{ asset('img/login.jpg') }}" alt="Imagen login de usuarios">
        </div>
        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            <form action="{{ route('login') }}" method="POST" novalidate>
                @csrf

                @if (session('mensaje'))
                    <p class="bg-red-600 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ session('mensaje') }}
                    </p>
                @endif

                <div mb-5>{{-- Email --}}
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Email:
                    </label>
                    <input 
                        class="border p-3 w-full rounded-lg
                            @error('email')
                                border-red-500
                            @enderror"
                        id="email"
                        name="email"
                        type="email"
                        placeholder="Aquí tu email"
                        value="{{ old('email') }}"
                        >
                    @error('email'){{-- Validación del email con mensaje --}}
                        <p class="bg-red-600 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div mb-5>{{-- Password --}}
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Password:
                    </label>
                    <input 
                        class="border p-3 w-full rounded-lg
                            @error('email')
                                border-red-500
                        @enderror"
                        id="password"
                        name="password"
                        type="password"
                        placeholder="Aquí tu password">
                        @error('password'){{-- Validación del password con mensaje --}}
                            <p class="bg-red-600 text-white my-2 rounded-lg text-sm p-2 text-center">
                                {{ $message }}
                            </p>
                        @enderror
                </div>

                {{-- Botón --}}
                <input
                    class="mt-5  bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3
                        text-white rounded-lg"
                    type="submit"
                    value="Iniciar sesion">
            </form>
        </div>
    </div>
@endsection