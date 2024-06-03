@extends('layouts.app')

@section('titulo')
    Editar perfil: {{ auth()->user()->username }}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form action="{{ route('perfil.store') }}"
                class="mt-10 md:mt-0"
                method="POST"
                enctype="multipart/form-data">
                @csrf
                @if (session('mensaje')){{-- Mensaje de error de credenciales --}}
                    <p class="bg-red-600 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ session('mensaje') }}
                    </p>
                @endif
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
                        value="{{ old('username', $username ?? auth()->user()->username) }}"
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
                
                <div mb-5>{{-- Email --}}
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Email:
                    </label>
                    <input 
                        class="border p-3 w-full rounded-lg
                            @error('email')
                                border-red-500
                            @enderror"
                        id="email"
                        name="email"
                        type="email"
                        placeholder="Aquí tu email"
                        {{-- value="{{ old('email') }}" --}}
                        value="{{ auth()->user()->email }}"
                        >
                    @error('email'){{-- Validación del email con mensaje --}}
                        <p class="bg-red-600 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div mb-5>{{-- Password antiguo que se comprobará si es correcto para realizar cambios--}}
                    <label for="oldpassword" class="mb-2 block uppercase text-gray-500 font-bold">
                        Password:
                    </label>
                    <input 
                        class="border p-3 w-full rounded-lg
                            @error('oldpassword')
                                border-red-500
                            @enderror"
                        id="oldpassword"
                        name="oldpassword"
                        type="password"
                        placeholder="Introducer tu contraseña actual">

                        @error('oldpassword'){{-- Validación del password con mensaje --}}
                            <p class="bg-red-600 text-white my-2 rounded-lg text-sm p-2 text-center">
                                {{ $message }}
                            </p>
                        @enderror
                </div>
                
                <div class=" mt-5 p-4 border-blue-700 border-2 rounded-lg">{{-- Cambio de password --}}
                    <p class="text-blue-700 font-bold">Opcional</p>
                    <div mb-5>{{-- Password nuevo --}}
                        <label for="newpassword" class="mb-2 block uppercase text-gray-500 font-bold">
                            Password:
                        </label>
                        <input 
                            class="border p-3 w-full rounded-lg
                                @error('newpassword')
                                    border-red-500
                                @enderror"
                            id="newpassword"
                            name="newpassword"
                            type="password"
                            placeholder="Aquí tu password nuevo">
                            @error('newpassword'){{-- Validación del password con mensaje --}}
                                <p class="bg-red-600 text-white my-2 rounded-lg text-sm p-2 text-center">
                                    {{ $message }}
                                </p>
                            @enderror
                    </div>

                    <div mb-5>{{-- Confirmación de Nuevo Password --}}
                        <label for="newpassword_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">
                            Repetir password:
                        </label>
                        <input 
                            class="border p-3 w-full rounded-lg"
                            id="newpassword_confirmation"
                            name="newpassword_confirmation"
                            type="password"
                            placeholder="Repite tu password nuevo">
                    </div>
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