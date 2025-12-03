<x-layout>

    <x-slot:title>Novedades y Noticias</x-slot:title>

    <div class="row mb-4">
        <div class="col">
            <h1 class="mb-3">Novedades y Noticias</h1>
            <p class="text-white">Mantente al día con las últimas actualizaciones de nuestra plataforma</p>
        </div>
    </div>

    @if(auth()->user()?->role === \App\Models\User::ROLE_ADMIN)
        <div class="mb-3">
            <a href="{{ route('news.create') }}" class="btn btn-primary">Publicar Novedad</a>
        </div>
    @endif

    @if($news->isNotEmpty())
        <div class="row">
            @foreach($news as $item)
                <article class="mb-3 border-bottom pb-3">
                    <h2>{{ $item->title }}</h2>
                    <p class="text-white">{{ $item->date->format('d/m/Y') }}</p>
                    <p>{{ $item->summary }}</p>
                    <button class="btn btn-link p-0" type="button" data-bs-toggle="collapse" data-bs-target="#news-{{ $item->id }}" aria-expanded="false" aria-controls="news-{{ $item->id }}">
                        Leer más
                    </button>
                    <div class="collapse mt-2" id="news-{{ $item->id }}">
                        <div class="card card-body bg-dark text-white">
                            {{ $item->content }}
                        </div>
                    </div>
                    @if(auth()->user()?->role === \App\Models\User::ROLE_ADMIN)
                        <div class="mt-2">
                            <a href="{{ route('news.edit', ['id' => $item->id]) }}" class="btn btn-sm btn-secondary">Editar</a>
                            <a href="{{ route('news.delete', ['id' => $item->id]) }}" class="btn btn-sm btn-danger">Eliminar</a>
                        </div>
                    @endif
                </article>
            @endforeach
        </div>
    @else
        <div class="alert alert-info">
            No hay novedades disponibles en este momento.
        </div>
    @endif

</x-layout>
