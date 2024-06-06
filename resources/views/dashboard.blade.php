@extends('layouts.app')

@section('titulo')
    Perfil: {{ $user->username }}
@endsection

@section('contenido')
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5">{{-- Contiene la imagen del usuario --}}
                <p>
                    <img class="rounded-full"
                        src="{{ $user->imagen ? asset('perfiles').'/'.$user->imagen : asset('img/usuario.svg')}}"
                        alt="Imagen del usuario"/>
                </p>
            </div>
            {{-- Todo lo relativo a usuarios seguidos, seguidores y posts y comentarios --}}
            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10 md:py-10">
                <div class="flex items-center gap-4">{{-- Nombre de usuario --}}
                    <p class="text-gray-700 text-2xl">
                        {{ $user->username }}
                    </p>
                    @auth
                        @if ($user->id === auth()->user()->id)
                            <a href="{{ route('perfil.index'/* ,$user */) }}"
                                class="text-gray-500 hover:text-gray-600 cursor-pointer">{{-- Icono para editar el perfil --}}
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
                    {{ $user->followers->count() }}
                    <span class="font-normal"> @choice('seguidor|seguidores',$user->followers->count())</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">{{-- Seguidos --}}
                    {{ $user->followings->count() }}
                    <span class="font-normal"> Siguiendo</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">{{-- Conteo de Posts --}}
                    {{ $user->posts->count() }}
                    <span class="font-normal"> Posts</span>
                </p>
                @auth {{-- Si el usuario está autenticado podrá ver los botones de seguir y dejar de seguir --}}
                    @if ($user->id !== auth()->user()->id)
                        @if (!$user->siguiendo(auth()->user()))
                            <form {{-- Formulario para el seguimiento de usuarios --}}
                                action="{{ route('users.follow',$user) }}" {{-- $user es el perfil que se está visitando --}}
                                method="POST">
                                @csrf
                                <input {{-- Botón de seguir usuario --}}
                                    type="submit" 
                                    class="bg-blue-600 text-white uppercase rounded-lg px-3 py-1 text-xs cursor-pointer"
                                    value="Seguir">
                            </form>
                        @else
                            <form {{-- Formulario para dejar de seguir a usuarios --}}
                                action="{{ route('users.unfollow',$user) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <input {{-- Botón para dejar de seguir a usuario --}}
                                    type="submit" 
                                    class="bg-red-600 text-white uppercase rounded-lg px-3 py-1 text-xs cursor-pointer"
                                    value="Dejar de seguir">
                            </form>
                        @endif
                    @endif
                @endauth
            </div>
        </div>
    </div>
    <section class="container mx-auto mt-10">{{-- Publicaciones --}}
        <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2>
        @if ($posts->count()>0)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 xl::grid-cols-4 gap-6">
                @foreach ($posts as $post){{-- Lo usamos para paginar --}}
                    <div>
                        <a href="{{ route('posts.show',['post'=>$post,'user'=>$user]) }}">
                            <p class="font-bold mb-3">{{ $post->titulo }}</p>{{-- Mostramos el título del post --}}
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
            <div class="my-10">{{-- Lo usamos para paginar --}}
                {{ $posts->links() }}
            </div>
        @else
            <div class="text-gray-600 uppercase text-sm text-center font-bold">No hay publicaciones todavía</div>
        @endif
    </section>
@endsection