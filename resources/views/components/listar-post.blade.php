<div>
    @if ($posts->count())
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($posts as $post)
                <div class="max-w-sm">
                    <!--  $post me trae el id del post por defecto pero si se lo quiero agregar hace completamente lo mismo   -->
                    <a href="{{ route('posts.show', ['post' => $post->id, 'user' => $post->user]) }}">
                        <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{ $post->titulo }}">
                    </a>
                </div>
            @endforeach
        </div>
        <!--Con esta funcion me trae toda la funcionalidad de un paginador ! -->
        <div class="my-10">
            {{ $posts->links() }}
        </div>
    @else
        <p class="text-center">No hay posts, Sigue a alguien para ver sus Posts</p>
    @endif
</div>
