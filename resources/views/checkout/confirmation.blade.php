<?php
    /** @var \App\Models\Reservation $reservation */
    /** @var \App\Models\Event $event */
    /** @var string $orderNumber */
    /** @var string $paymentMethod */
    /** @var string $customerName */
    /** @var string $customerEmail */
?>

<x-layout>

<x-slot:title>Compra Confirmada - {{ $orderNumber }}</x-slot:title>

<style>
    .confirmation-card {
        background: rgba(30, 30, 30, 0.8);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 16px;
        padding: 2rem;
        text-align: center;
        max-width: 600px;
        margin: 0 auto;
    }

    .success-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
    }

    .success-icon svg {
        width: 40px;
        height: 40px;
        color: white;
    }

    .order-number {
        background: linear-gradient(135deg, rgba(255, 0, 0, 0.1) 0%, rgba(100, 0, 0, 0.1) 100%);
        border: 1px solid rgba(255, 0, 0, 0.2);
        border-radius: 8px;
        padding: 1rem;
        margin: 1.5rem 0;
    }

    .order-number-text {
        font-size: 1.5rem;
        font-weight: 700;
        color: #ff0000;
        letter-spacing: 2px;
    }

    .details-card {
        background: rgba(40, 40, 40, 0.5);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        padding: 1.5rem;
        margin-top: 1.5rem;
        text-align: left;
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        padding: 0.5rem 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .detail-row:last-child {
        border-bottom: none;
    }

    .detail-label {
        color: rgba(255, 255, 255, 0.7);
    }

    .detail-value {
        font-weight: 600;
        color: #ffffff;
    }

    .total-row {
        font-size: 1.25rem;
        padding-top: 1rem;
        margin-top: 0.5rem;
        border-top: 2px solid rgba(255, 0, 0, 0.3);
    }

    .total-row .detail-value {
        color: #ff0000;
    }

    .btn-primary-custom {
        background: linear-gradient(135deg, #ff0000 0%, #cc0000 100%);
        border: none;
        color: #ffffff;
        font-weight: 600;
        padding: 0.75rem 2rem;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .btn-primary-custom:hover {
        background: linear-gradient(135deg, #ff3333 0%, #ff0000 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(255, 0, 0, 0.3);
    }

    .btn-outline-custom {
        background: transparent;
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: #ffffff;
        font-weight: 500;
        padding: 0.75rem 2rem;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .btn-outline-custom:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: rgba(255, 255, 255, 0.5);
        color: #ffffff;
    }

    .payment-badge {
        display: inline-block;
        background: rgba(40, 167, 69, 0.2);
        border: 1px solid rgba(40, 167, 69, 0.5);
        color: #28a745;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 600;
    }
</style>

<div class="confirmation-card">
    <div class="success-icon">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
        </svg>
    </div>

    <h1 class="mb-3">¡Compra Exitosa!</h1>
    <p class="text-white-50 mb-0">Tu reserva ha sido confirmada correctamente.</p>

    <div class="order-number">
        <small class="text-white-50 d-block mb-1">Número de Orden</small>
        <span class="order-number-text">{{ $orderNumber }}</span>
    </div>

    <p class="mb-0">
        <span class="payment-badge">Pago Confirmado</span>
    </p>

    <div class="details-card">
        <h5 class="mb-3">Detalles de la Compra</h5>

        <div class="detail-row">
            <span class="detail-label">Evento:</span>
            <span class="detail-value">{{ $event->name }}</span>
        </div>

        <div class="detail-row">
            <span class="detail-label">Fecha:</span>
            <span class="detail-value">{{ \Carbon\Carbon::parse($event->date)->format('d/m/Y H:i') }}</span>
        </div>

        <div class="detail-row">
            <span class="detail-label">Cantidad de Entradas:</span>
            <span class="detail-value">{{ $reservation->quantity }}</span>
        </div>

        <div class="detail-row">
            <span class="detail-label">Método de Pago:</span>
            <span class="detail-value">
                @switch($paymentMethod)
                    @case('credit_card')
                        Tarjeta de Crédito
                        @break
                    @case('debit_card')
                        Tarjeta de Débito
                        @break
                    @case('mercado_pago')
                        Mercado Pago
                        @break
                    @default
                        {{ $paymentMethod }}
                @endswitch
            </span>
        </div>

        <div class="detail-row">
            <span class="detail-label">Cliente:</span>
            <span class="detail-value">{{ $customerName }}</span>
        </div>

        <div class="detail-row">
            <span class="detail-label">Email:</span>
            <span class="detail-value">{{ $customerEmail }}</span>
        </div>

        <div class="detail-row total-row">
            <span class="detail-label">Total Pagado:</span>
            <span class="detail-value">${{ number_format($reservation->total_price, 2, ',', '.') }}</span>
        </div>
    </div>

    <div class="mt-4 d-flex gap-3 justify-content-center flex-wrap">
        <a href="{{ route('reservations.index') }}" class="btn btn-primary-custom">
            Ver Mis Reservas
        </a>
        <a href="{{ route('events.index') }}" class="btn btn-outline-custom">
            Ver Más Eventos
        </a>
    </div>

    <p class="text-white-50 mt-4 mb-0" style="font-size: 0.875rem;">
        Se ha enviado un email de confirmación a <strong>{{ $customerEmail }}</strong> (simulado)
    </p>
</div>

</x-layout>
