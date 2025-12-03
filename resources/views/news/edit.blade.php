<x-layout>
    <x-slot:title>Editar Novedad</x-slot:title>
    <h1>Editar Novedad</h1>
    <form action="{{ route('news.update', ['id' => $news->id]) }}" method="POST">
        @method('PUT')
        @include('news.form')
    </form>
</x-layout>
