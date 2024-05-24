@extends('layouts.app')

@section('titulo')
    Perfil: {{ $user->username }}
@endsection

@section('contenido')
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5">
                <p>
                    <img src="{{ asset('img/usuario.svg') }}" alt="Imagen del usuario"/>
                </p>
            </div>
            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10 md:py-10">
                {{-- {{dd($user)}} --}}
                <p class="text-gray-700 text-2xl">{{-- Nombre de usuario --}}
                    {{ $user->username }}
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold mt-5">{{-- Seguidores --}}
                    0<span class="font-normal"> Seguidores</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">{{-- Seguidos --}}
                    0<span class="font-normal"> Siguiendo</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">{{-- Posts --}}
                    {{ $user->posts->count() }}
                    <span class="font-normal"> Posts</span>
                </p>
            </div>
        </div>
    </div>
    <section class="container mx-auto mt-10">
        <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2>

        {{-- {{dd($user->posts)}} --}}

        @if ($posts->count()>0)
        {{-- @if ($user->posts->count()>0)NO FUNCIONA PARA PAGINAR --}}
            <div class="grid md:grid-cols-2 lg:grid-cols-3 xl::grid-cols-4 gap-6">
                @foreach ($posts as $post)
                {{-- @foreach ($user->posts as $post)NO FUNCIONA PARA PAGINAR --}}
                    <div>
                        <a href="{{ route('posts.show',['post'=>$post,'user'=>$user]) }}">
                            <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{ $post->titulo }}">
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="my-10">
                {{ $posts->links() }}
                {{-- {{ $user->posts->links() }} NO FUNCIONA PARA PAGINAR--}}
            </div>
        @else
            <div class="text-gray-600 uppercase text-sm text-center font-bold">No hay publicaciones todavía</div>
        @endif
    </section>
@endsection