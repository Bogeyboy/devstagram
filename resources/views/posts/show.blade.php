@extends('layouts.app')

@section('titulo')
    {{ $post->titulo }}
@endsection

@section('contenido')
    <div class="container mx-auto flex">
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
        </div>

        <div class="md:w-1/2 p-5">{{-- Div para los comentarios del post --}}
            <div class="shadow bg-white p-5 mb-5">
                <p class="text-xl font-bold text-center mb-4">
                    Agrega un nuevo comentario
                </p>
                <form action="">
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
            </div>
        </div>
    </div>
@endsection