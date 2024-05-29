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
                <div class="flex items-center gap-4">
                    <p class="text-gray-700 text-2xl">{{-- Nombre de usuario --}}
                        {{ $user->username }}
                    </p>
                    @auth
                        @if ($user->id === auth()->user()->id)
                            <a href="" class="text-gray-500 hover:text-gray-600 cursor-pointer">{{-- Icono para editar el perfil --}}
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                    <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0
                                        0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0
                                        .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                    <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5
                                        1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                                </svg>
                            </a>
                        @endif
                    @endauth
                </div>
                
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
                        <p class="font-bold">{{-- Conteo de likes de la publicación --}}
                            {{ $post->likes->count() }} 
                            <span class="font-normal">
                                likes
                            </span>
                        </p>
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