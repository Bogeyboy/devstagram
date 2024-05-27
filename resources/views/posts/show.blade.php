@extends('layouts.app')

@section('titulo')
    {{ $post->titulo }}
@endsection

@section('contenido')
    <div class="container mx-auto md:flex">
        <div class="md:w-1/2">{{-- Div que muestra la información del post --}}
            <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen de la publicación {{ $post->titulo }}">
            
            <div class="p-3">
                <p>
                    0 likes
                </p>
            </div>

            <div>
                <p class="font-bold">{{ $post->user->username }}</p>
                <p class="text-sm-text-gray-500">
                    {{ $post->created_at->diffForHumans() }}
                </p>
                <p class="mt-5">
                    {{ $post->descripcion }}
                </p>
            </div>
            @auth
                @if ($post->user_id === auth()->user()->id){{-- Comprobamos si el usuario es el propietario del post a eliminar --}}
                    <form action="">
                        @csrf
                        <input
                            type="submit"
                            value="Eiminar publicación"
                            class="bg-red-500
                                    hover:bg-red-600
                                    p-2
                                    rounded
                                    text-white
                                    font-bold
                                    mt-4
                                    cursor-pointer"
                            />
                    </form>
                @endif
            @endauth
        </div>

        <div class="md:w-1/2 p-5">{{-- Div para los comentarios del post --}}
            <div class="shadow bg-white p-5 mb-5">
                @auth {{-- Si está autenticado el usuario podrá realizar comentarios del post --}}
                    <p class="text-xl font-bold text-center mb-4">
                        Agrega un nuevo comentario
                    </p>

                    @if (session('mensaje'))
                        <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                            {{session('mensaje')}}
                        </div>
                    @endif

                    <form action="{{ route('comentarios.store', ['post'=>$post,'user'=>$user] ) }}" method="POST">
                        @csrf
                        <div mb-5>{{-- Contenido del post --}}
                            <label for="descripcion" class="mb-2 block uppercase text-gray-500 font-bold">
                                Comentario
                            </label>
                            <textarea 
                                class="border p-3 w-full rounded-lg
                                    @error('name')
                                        border-red-500
                                    @enderror"
                                id="comentario"
                                name="comentario"
                                placeholder="Agrega un comentario">
                            </textarea>
                        
                            @error('comentario'){{-- Validación del contenido del comentario --}}
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
                            value="Comentar">
                    </form>
                @endauth
                <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10">
                    @if ($post->comentarios->count())
                        @foreach ( $post->comentarios as $comentario)
                            <div class="p-5 borde-gray-300 border-p">
                                
                                <a href="{{ route('posts.index',$comentario->user) }}" class="font-bold">
                                    {{$comentario->user->username}}
                                </a>
                                <p>{{ $comentario->comentario }}</p>
                                <p class="text-sm text-gray-500">{{ $comentario->created_at->diffForHumans() }}</p>
                            </div>
                        @endforeach
                    @else
                        <p class="p-10 text-center">Todavía no hay comentarios</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection