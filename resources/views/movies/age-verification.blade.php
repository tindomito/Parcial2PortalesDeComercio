<?php
    /** @var \App\Models\Movie $movie */
?>
<x-layout>

    <x-slot:title> Confirmacion de Edad Necesaria </x-slot:title>

    <h1 class="mb-3">Se necesita confirmacion de edad para continuar</h1>

    <p>La pelicula <b>{{$movie->title}}</b> esta marcada como <b>solo para mayores de 18 años</b>.</p>
    <p>Para continuar, es necesario confirmar que cumplis con este requerimiento.</p>

    <form action="{{route('movies.age-verification.save', ['id' => $movie->movie_id])}}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Si, soy mayor de edad</button>
        <a href="{{route('movies.index')}}" class="btn btn-danger">No, soy menor de edad</a>
    </form>
</x-layout>