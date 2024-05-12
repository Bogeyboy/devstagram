<header class="p-5 border-b bg-white shadow">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-3xl font-black">
            DevStagram
        </h1>
        {{-- @if (auth()->user())
            <p>Autenticado</p>
        @else
            <p>No autenticado</p>
        @endif --}}
        
        @auth()
            <nav class="flex gap-2 items-center">
                <a class="font-bold {{-- uppercase --}} text-gray-600 text-sm" href="#">
                    Hola: <span class="font-normal">
                            {{ auth()->user()->username }}
                        </span>
                </a>
                <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('logout') }}">
                    Cerrar sesión
                </a>
            </nav>
        @endauth
        @guest()
            <nav class="flex gap-2 items-center">
                <a class="font-bold uppercase text-gray-600 text-sm" href="#">
                    Login
                </a>
                <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('register') }}">
                    Crear Cuenta
                </a>
            </nav>
        @endguest
        
    </div>
</header>
