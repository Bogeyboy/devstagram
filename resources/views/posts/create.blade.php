@extends('layouts.app')

@section('titulo')
    Crea una nueva publicación.
@endsection

@section('contenido')
    <div class="md:flex md:items-center">
        <div class="md:w-1/2 px-10">
            Imagen aquí
        </div>
        <div class="md:w-1/2 p-10 bg-white rounded-lg shadow-xl mt-10 md:mt-0">
            <form action="{{ route('register') }}" method="POST" novalidate>
                @csrf
                <div mb-5>{{-- Título del post --}}
                    <label for="titulo" class="mb-2 block uppercase text-gray-500 font-bold">
                        Titulo
                    </label>
                    <input 
                        class="border p-3 w-full rounded-lg
                            @error('name')
                                border-red-500
                            @enderror"
                        id="titulo"
                        name="titulo"
                        type="text"
                        placeholder="Aquí el título de la publicación"
                        value="{{ old('titulo') }}"
                        >
                    @error('titulo'){{-- Validación del título con mensaje --}}
                        <p class="bg-red-600 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div mb-5>{{-- Contenido del post --}}
                    <label for="descripcion" class="mb-2 block uppercase text-gray-500 font-bold">
                        Descripción
                    </label>
                    <textarea 
                        class="border p-3 w-full rounded-lg
                            @error('name')
                                border-red-500
                            @enderror"
                        id="descripcion"
                        name="descripcion"
                        placeholder="Descripción de la publicación">{{ old('titulo') }}</textarea>
                    
                    @error('titulo'){{-- Validación del contenido con mensaje --}}
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
                    value="Crear publicación">
            </form>
        </div>
    </div>
@endsection