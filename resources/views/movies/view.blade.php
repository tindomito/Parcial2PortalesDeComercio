<?php
    /** @var \App\Models\Movie $movie  */
?>

<x-layout>

<x-slot:title> Detalle de la Pelicula {{ $movie->title }} </x-slot:title>

<h1 class="mb-3"> {{ $movie->title }} </h1>

<div class="d-flex gap-3 align-items-start">
    <div class="col-3">
        @if ($movie->cover)
            <img
                src="{{ \Illuminate\Support\Facades\Storage::url($movie->cover) }}"
                alt="{{ $movie->cover_description }}"
                class="img-fluid"
            >
        @else
            <p>No tiene portada</p>
        @endif
    </div>

    <dl class="mb-3">
        <dt>Precio:</dt>
        <dd>$ {{ $movie->price }}</dd>
        <dt>Fecha de Estreno</dt>
        <dd>{{ $movie->release_date }}</dd>
    </dl>
</div>


<hr class="mb-3">

<h2 class="mb-3" >Sinopsis</h2>
<div>{{ $movie->synopsis }}</div>

</x-layout>
