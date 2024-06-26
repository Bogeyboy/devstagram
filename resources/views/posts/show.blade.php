@extends('layouts.app')

@section('titulo')
    {{ $post->titulo }}
@endsection

@section('contenido')
    <div class="container mx-auto md:flex">
        <div class="md:w-1/2">{{-- Div que muestra la información del post --}}
            <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen de la publicación {{ $post->titulo }}">
            
            <div class="p-3 flex items-center gap-4">
                @auth
                    {{-- @livewire('like-post') --}}
                    {{-- <livewire:like-post>  --> Este lo usaremos para cuando queramos añadir alguna información adicional no común
                        Esto parece que va funcionando
                    </livewire:like-post> --}}
                    
                    <livewire:like-post :post="$post" />

                    {{-- Usuario ya dio like a la publicación --}}
                    {{-- @if($post->checkLike(auth()->user()))
                        <form method="POST" action="{{ route('posts.likes.destroy',$post) }}">
                            @method('DELETE')
                            @csrf
                            <div class="my-4">
                            </div>
                        </form> --}}
                    {{-- Usuario no dio like a la publicación todavía --}}
                    {{-- @else
                        <form method="POST" action="{{ route('posts.likes.store',$post) }}">
                            @csrf
                            <div class="my-4">
                                <button type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312
                                                2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78
                                                9-12Z" />
                                    </svg>
                                </button>
                            </div>
                        </form>
                    @endif --}}
                @endauth
                
            </div>

            <div>{{-- Datos de creación del post --}}
                <p class="font-bold">{{ $post->user->username }}</p>
                <p class="text-sm-text-gray-500">
                    {{ $post->created_at->diffForHumans() }}
                </p>
                <p class="mt-5">
                    {{ $post->descripcion }}
                </p>
            </div>
            @auth{{-- Comprobamos si el usuario es el propietario del post a eliminar --}}
                @if ($post->user_id === auth()->user()->id)
                    <form method="POST"  action="{{ route('posts.destroy',$post) }}">
                        @method('DELETE')
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

        {{-- Div para los comentarios del post --}}
        <div class="md:w-1/2 p-5">
            <div class="shadow bg-white p-5 mb-5">
                @auth {{-- Si está autenticado el usuario podrá realizar comentarios del post --}}
                    <p class="text-xl font-bold text-center mb-4">
                        Agrega un nuevo comentario
                    </p>
                    @if (session('mensaje')){{-- Mensaje de éxito al realizar comentario --}}
                        <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                            {{session('mensaje')}}
                        </div>
                    @endif
                    {{-- Formulario para el envío de comentarios --}}
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
                {{-- Comentarios ya existentes del post --}}
                <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10">
                    @if ($post->comentarios->count())
                        @foreach ( $post->comentarios as $comentario)
                            <div class="p-5 borde-gray-300 border-b">{{-- Contiene el comentario del usuario --}}
                                <div class="flex items-center">{{-- Imagen del usuario que ha hecho el comentario --}}
                                    <img class="rounded-full h-8 w-8 mr-1 object-cover" 
                                        src="{{ $user->imagen ? asset('perfiles').'/'.$user->imagen : asset('img/usuario.svg')}}"
                                        alt="Avatar de {{ $post->user->username }}"/>

                                    <a href="{{ route('posts.index',$comentario->user) }}" class="font-bold">
                                        {{$comentario->user->username}}
                                    </a>
                                </div>
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