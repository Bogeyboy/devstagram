@extends('layouts.app')

@section('titulo')
    Página sobre tu cuenta
@endsection

@section('contenido')
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 md:flex">
            <div class="md:w-8/12 lg:w-6/12 px-5">
                <p>
                    <img src="{{ asset('img/usuario.svg') }}" alt="Imagen del usuario"/>
                </p>
            </div>
            <div class="md:w-8/12 lg:w-6/12 px-5 md:flex md:flex-col md:justify-center">
                {{-- {{dd($user)}} --}}
                <p class="text-gray-700 text-2xl">{{-- Nombre de usuario --}}
                    {{ $user->username }}
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">{{-- Seguidores --}}
                    0<span class="font-normal"> Seguidores</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">{{-- Seguidos --}}
                    0<span class="font-normal"> Siguiendo</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">{{-- Posts --}}
                    0<span class="font-normal"> Posts</span>
                </p>
            </div>
        </div>
    </div>
@endsection