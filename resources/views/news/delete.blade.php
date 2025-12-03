<x-layout>
    <x-slot:title>Eliminar Novedad</x-slot:title>
    <h1>Eliminar Novedad</h1>
    <p>¿Estás seguro de que deseas eliminar la novedad <b>{{ $news->title }}</b>?</p>
    <form action="{{ route('news.destroy', ['id' => $news->id]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Sí, eliminar</button>
        <a href="{{ route('news.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</x-layout>
