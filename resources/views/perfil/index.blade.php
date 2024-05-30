@extends('layouts.app')

@section('titulo')
    Editar perfil: {{ auth()->user()->username }}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form action="" class="mt-10 md:mt-0">
                @csrf
                <div mb-5>{{-- Nombre de usuario --}}
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Nombre de usuario:
                    </label>
                    <input 
                        class="border p-3 w-full rounded-lg
                            @error('username')
                                border-red-500
                            @enderror"
                        id="username"
                        name="username"
                        type="text"
                        placeholder="Aquí tu nombre de usuario"
                        value="{{ auth()->user()->username }}"
                        >
                    @error('username'){{-- Validación del nombre con mensaje --}}
                        <p class="bg-red-600 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div mb-5>{{-- Imagen de perfil --}}
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">
                        Imagen de perfil:
                    </label>
                    <input 
                        class="border p-3 w-full rounded-lg"
                        id="imagen"
                        name="imagen"
                        type="file"
                        value=""
                        accept=".jpg, .jpeg, .png">
                </div>
                
                <input {{-- Botón de confirnmación --}}
                    class="mt-5  bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3
                        text-white rounded-lg"
                    type="submit"
                    value="Guardar cambios">
            </form>
        </div>
    </div>
@endsection