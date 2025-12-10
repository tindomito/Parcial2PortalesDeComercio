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

@auth
<hr class="mb-3">

<h2 class="mb-3">Reservar Entrada</h2>
<form action="{{ route('checkout.show', ['event' => $event->event_id]) }}" method="get">
    <div class="mb-3">
        <label for="quantity" class="form-label">Cantidad de entradas</label>
        <input
            type="number"
            id="quantity"
            name="quantity"
            class="form-control"
            min="1"
            value="{{ old('quantity', 1) }}"
            required
        >
        @error('quantity')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <p><strong>Total a pagar:</strong> $<span id="total-price">{{ $event->ticket_price }}</span></p>
    </div>

    <button type="submit" class="btn btn-primary">Confirmar Reserva</button>
</form>

<script>
    const ticketPrice = {{ $event->ticket_price }};
    const quantityInput = document.getElementById('quantity');
    const totalPriceElement = document.getElementById('total-price');

    quantityInput.addEventListener('input', function() {
        const quantity = parseInt(this.value) || 1;
        const total = ticketPrice * quantity;
        totalPriceElement.textContent = total;
    });
</script>
@endauth

@guest
<hr class="mb-3">
<p class="alert alert-info">
    <a href="{{ route('auth.login') }}">Inicia sesión</a> o <a href="{{ route('auth.register') }}">regístrate</a> para reservar entradas.
</p>
@endguest

</x-layout>
