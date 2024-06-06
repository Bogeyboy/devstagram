<div>
    @if ($posts->count()){{-- Si existe algún post lo mostramos --}}
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl::grid-cols-4 gap-6">
            @foreach ($posts as $post){{-- Lo usamos para paginar --}}
                <div>
                    <a href="{{ route('posts.show',['post'=>$post,'user'=>$post->user]) }}">
                        <p class="font-bold mb-3">{{ $post->titulo }}</p>{{-- Mostramos el título del post --}}
                        <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{ $post->titulo }}">
                        <p class="font-bold mt-4">Autor: {{ $post->user->username }}</p>{{-- Mostramos el autor del post --}}
                    </a>
                </div>
            @endforeach
        </div>
        <div class="my-10">{{-- Lo usamos para paginar --}}
            {{ $posts->links() }}
        </div>
    @else
        <p class="text-center">No hay posts, sigue a alguien para poder mostrar sus posts</p>
    @endif
</div>