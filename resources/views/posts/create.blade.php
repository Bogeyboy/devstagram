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
                <div mb-5>{{-- Nombre real --}}
                    <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">
                        Nombre:
                    </label>
                    <input 
                        class="border p-3 w-full rounded-lg
                            @error('name')
                                border-red-500
                            @enderror"
                        id="name"
                        name="name"
                        type="text"
                        placeholder="Aquí tu nombre"
                        value="{{ old('name') }}"
                        >
                    @error('name'){{-- Validación del nombre con mensaje --}}
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
                    value="Crear post">
            </form>
        </div>
    </div>
@endsection