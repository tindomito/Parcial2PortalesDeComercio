<?php
    /** @var \App\Models\Event $event  */
?>

<x-layout>

<x-slot:title> Detalle del Evento {{ $event->name }} </x-slot:title>

<h1 class="mb-3">Confirmación para eliminar {{ $event->name }} </h1>
<p class="mb-1">Estás a punto de <b>eliminar</b> el evento <b>{{ $event->name }}</b>.</p>
<p>¿Querés proceder con la eliminación?</p>

<form
    action="{{ route('events.destroy', ['id' => $event->event_id]) }}" method="POST"
    class="mb-3"
>
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">
        Sí, Eliminar {{ $event->name }}
    </button>
</form>

<hr class="mb-3">

<h2 class="mb-3">{{ $event->name }}</h2>

{{-- TODO: Agregar la imagen para la portada --}}

<dl class="mb-3">
    <dt>Precio Entrada:</dt>
    <dd>$ {{ $event->ticket_price }}</dd>
    <dt>Fecha</dt>
    <dd>{{ $event->date }}</dd>
</dl>

<hr class="mb-3">

<h2 class="mb-3" >Descripción</h2>
<div>{{ $event->description }}</div>

</x-layout>
