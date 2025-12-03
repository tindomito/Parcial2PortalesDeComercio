<?php
    /** @var \App\Models\Event $event  */
?>

<x-layout>

<x-slot:title> Detalle del Evento {{ $event->name }} </x-slot:title>

<h1 class="mb-3"> {{ $event->name }} </h1>

<div class="d-flex gap-3 align-items-start">
    <div class="col-3">
        @if ($event->cover)
            <img
                src="{{ \Illuminate\Support\Facades\Storage::url($event->cover) }}"
                alt="{{ $event->cover_description }}"
                class="img-fluid"
            >
        @else
            <p>No tiene portada</p>
        @endif
    </div>

    <dl class="mb-3">
        <dt>Precio Entrada:</dt>
        <dd>$ {{ $event->ticket_price }}</dd>
        <dt>Fecha</dt>
        <dd>{{ $event->date }}</dd>
    </dl>
</div>


<hr class="mb-3">

<h2 class="mb-3" >Descripción</h2>
<div>{{ $event->description }}</div>

</x-layout>
