<x-layout>
    <x-slot:title>Publicar Novedad</x-slot:title>
    <h1>Publicar Novedad</h1>
    <form action="{{ route('news.store') }}" method="POST">
        @include('news.form')
    </form>
</x-layout>
