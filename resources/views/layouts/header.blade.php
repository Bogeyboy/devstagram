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
        
        @auth(){{-- En este bloque se comprueba si el usuario está autenticado --}}
            <nav class="flex gap-2 items-center">
                <a class="font-bold {{-- uppercase --}} text-gray-600 text-sm" href="#">
                    Hola: <span class="font-normal">
                            {{ auth()->user()->username }}
                        </span>
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="font-bold uppercase text-gray-600 text-sm">
                        Cerrar sesión
                    </button>
                </form>
                
            </nav>
        @endauth
        @guest()
            <nav class="flex gap-2 items-center">
                <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('login') }}">
                    Login
                </a>
                <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('register') }}">
                    Crear Cuenta
                </a>
            </nav>
        @endguest
        
    </div>
</header>
