<x-layout>

    <x-slot:title>Novedades y Noticias</x-slot:title>

    <div class="row mb-4">
        <div class="col">
            <h1 class="mb-3">Novedades y Noticias</h1>
            <p class="text-muted">Mantente al día con las últimas actualizaciones de nuestra plataforma</p>
        </div>
    </div>

    <div class="row">
        @foreach($news as $item)
            <div class="col-md-6 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h5 class="card-title mb-0">{{ $item['title'] }}</h5>
                            <span class="badge bg-info">{{ \Carbon\Carbon::parse($item['date'])->format('d/m/Y') }}</span>
                        </div>
                        <p class="card-text text-muted mb-3">
                            <strong>{{ $item['summary'] }}</strong>
                        </p>
                        <p class="card-text">
                            {{ $item['content'] }}
                        </p>
                    </div>
                    <div class="card-footer bg-transparent">
                        <small class="text-muted">
                            Publicado el {{ \Carbon\Carbon::parse($item['date'])->format('d/m/Y') }}
                        </small>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if(empty($news))
        <div class="alert alert-info">
            No hay novedades disponibles en este momento.
        </div>
    @endif

</x-layout>
