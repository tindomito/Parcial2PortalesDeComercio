<?php
    /** @var \App\Models\Event $event */
    /** @var int $quantity */
    /** @var float $totalPrice */
?>

<x-layout>

<x-slot:title>Checkout - {{ $event->name }}</x-slot:title>

<style>
    .checkout-card {
        background: rgba(30, 30, 30, 0.8);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        padding: 1.5rem;
    }

    .summary-card {
        background: linear-gradient(135deg, rgba(255, 0, 0, 0.1) 0%, rgba(100, 0, 0, 0.1) 100%);
        border: 1px solid rgba(255, 0, 0, 0.2);
        border-radius: 12px;
        padding: 1.5rem;
    }

    .form-control, .form-select {
        background: rgba(20, 20, 20, 0.8);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #ffffff;
        border-radius: 8px;
    }

    .form-control:focus, .form-select:focus {
        background: rgba(20, 20, 20, 0.9);
        border-color: rgba(255, 0, 0, 0.5);
        color: #ffffff;
        box-shadow: 0 0 0 0.2rem rgba(255, 0, 0, 0.25);
    }

    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.5);
    }

    .form-select option {
        background: #1a1a1a;
        color: #ffffff;
    }

    .btn-checkout {
        background: linear-gradient(135deg, #ff0000 0%, #cc0000 100%);
        border: none;
        color: #ffffff;
        font-weight: 600;
        padding: 0.75rem 2rem;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .btn-checkout:hover {
        background: linear-gradient(135deg, #ff3333 0%, #ff0000 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(255, 0, 0, 0.3);
    }

    .payment-method-card {
        background: rgba(40, 40, 40, 0.5);
        border: 2px solid rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        padding: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .payment-method-card:hover {
        border-color: rgba(255, 0, 0, 0.3);
    }

    .payment-method-card.selected {
        border-color: #ff0000;
        background: rgba(255, 0, 0, 0.1);
    }

    .payment-method-card input[type="radio"] {
        display: none;
    }

    .card-fields {
        display: none;
    }

    .card-fields.show {
        display: block;
    }

    .section-title {
        color: #ffffff;
        font-weight: 600;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid rgba(255, 0, 0, 0.3);
    }

    .total-price {
        font-size: 1.75rem;
        font-weight: 700;
        color: #ff0000;
    }
</style>

<h1 class="mb-4">Finalizar Compra</h1>

<div class="row">
    <div class="col-lg-8">
        <form action="{{ route('checkout.process', ['event' => $event->event_id]) }}" method="POST" id="checkout-form">
            @csrf
            <input type="hidden" name="quantity" value="{{ $quantity }}">

            <!-- Datos Personales -->
            <div class="checkout-card mb-4">
                <h3 class="section-title">Datos Personales</h3>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="full_name" class="form-label">Nombre Completo</label>
                        <input
                            type="text"
                            id="full_name"
                            name="full_name"
                            class="form-control"
                            value="{{ old('full_name', auth()->user()->name) }}"
                            placeholder="Ingresa tu nombre completo"
                            required
                        >
                        @error('full_name')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control"
                            value="{{ old('email', auth()->user()->email) }}"
                            placeholder="tu@email.com"
                            required
                        >
                        @error('email')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Teléfono</label>
                    <input
                        type="tel"
                        id="phone"
                        name="phone"
                        class="form-control"
                        value="{{ old('phone') }}"
                        placeholder="Ej: 11-1234-5678"
                        required
                    >
                    @error('phone')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Método de Pago -->
            <div class="checkout-card mb-4">
                <h3 class="section-title">Método de Pago</h3>

                <div class="row mb-3">
                    <div class="col-md-4 mb-2">
                        <label class="payment-method-card d-block text-center" id="card-credit">
                            <input type="radio" name="payment_method" value="credit_card" {{ old('payment_method', 'credit_card') == 'credit_card' ? 'checked' : '' }}>
                            <div class="py-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1H2zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V7z"/>
                                    <path d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1z"/>
                                </svg>
                                <div class="mt-2 fw-semibold">Tarjeta de Crédito</div>
                            </div>
                        </label>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="payment-method-card d-block text-center" id="card-debit">
                            <input type="radio" name="payment_method" value="debit_card" {{ old('payment_method') == 'debit_card' ? 'checked' : '' }}>
                            <div class="py-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1H2zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V7z"/>
                                </svg>
                                <div class="mt-2 fw-semibold">Tarjeta de Débito</div>
                            </div>
                        </label>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="payment-method-card d-block text-center" id="card-mp">
                            <input type="radio" name="payment_method" value="mercado_pago" {{ old('payment_method') == 'mercado_pago' ? 'checked' : '' }}>
                            <div class="py-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M8 0c-.69 0-1.378.02-2.058.058l-.002.002c-.614.037-1.22.095-1.816.175l-.002.001C2.8.4 1.617.68.82 1.2l-.003.002c-.396.258-.74.568-1.02.928l-.001.001C-.6 2.668-.4 3.36-.18 4.08l.001.002c.21.69.47 1.36.78 2.01l.001.002c.29.61.62 1.2.99 1.76l.001.001c.74 1.12 1.64 2.11 2.68 2.93l.001.001c1.04.82 2.21 1.46 3.47 1.9l.001.001C8.98 13.4 10.35 14 12 14c1.61 0 3.1-.55 4.27-1.47l.001-.001c.52-.41.98-.89 1.36-1.42l.001-.001c.38-.54.69-1.12.92-1.73l.001-.002c.23-.62.38-1.27.44-1.94v-.002c.06-.67.04-1.35-.06-2.02v-.001c-.1-.67-.28-1.33-.54-1.96l-.001-.001C18.1 2.77 17.76 2.16 17.36 1.6l-.001-.001c-.41-.57-.9-1.08-1.47-1.5l-.001-.001C15.31-.31 14.68-.65 14-.92l-.002-.001C13.32-1.2 12.62-1.4 11.9-1.52l-.001-.001C11.18-1.64 10.45-1.7 9.71-1.7c-.57 0-1.14.03-1.71.1z"/>
                                </svg>
                                <div class="mt-2 fw-semibold">Mercado Pago</div>
                            </div>
                        </label>
                    </div>
                </div>
                @error('payment_method')
                    <div class="text-danger mb-3">{{ $message }}</div>
                @enderror

                <!-- Datos de Tarjeta -->
                <div id="card-fields" class="card-fields">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="card_number" class="form-label">Número de Tarjeta</label>
                            <input
                                type="text"
                                id="card_number"
                                name="card_number"
                                class="form-control"
                                placeholder="1234 5678 9012 3456"
                                maxlength="16"
                                value="{{ old('card_number') }}"
                            >
                            @error('card_number')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="card_holder" class="form-label">Nombre del Titular</label>
                            <input
                                type="text"
                                id="card_holder"
                                name="card_holder"
                                class="form-control"
                                placeholder="NOMBRE APELLIDO"
                                value="{{ old('card_holder') }}"
                            >
                            @error('card_holder')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="card_expiry" class="form-label">Fecha de Vencimiento</label>
                            <input
                                type="text"
                                id="card_expiry"
                                name="card_expiry"
                                class="form-control"
                                placeholder="MM/AA"
                                maxlength="5"
                                value="{{ old('card_expiry') }}"
                            >
                            @error('card_expiry')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="card_cvv" class="form-label">CVV</label>
                            <input
                                type="text"
                                id="card_cvv"
                                name="card_cvv"
                                class="form-control"
                                placeholder="123"
                                maxlength="3"
                                value="{{ old('card_cvv') }}"
                            >
                            @error('card_cvv')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Mensaje para Mercado Pago -->
                <div id="mp-message" class="alert alert-info" style="display: none;">
                    <strong>Mercado Pago:</strong> Al confirmar, serás redirigido a Mercado Pago para completar el pago de forma segura. (Simulado)
                </div>
            </div>

            <button type="submit" class="btn btn-checkout btn-lg w-100">
                Confirmar y Pagar ${{ number_format($totalPrice, 2, ',', '.') }}
            </button>
        </form>
    </div>

    <!-- Resumen del Pedido -->
    <div class="col-lg-4">
        <div class="summary-card position-sticky" style="top: 100px;">
            <h3 class="section-title">Resumen del Pedido</h3>

            <div class="d-flex gap-3 mb-3">
                @if ($event->cover)
                    <img
                        src="{{ \Illuminate\Support\Facades\Storage::url($event->cover) }}"
                        alt="{{ $event->cover_description }}"
                        class="rounded"
                        style="width: 80px; height: 80px; object-fit: cover;"
                    >
                @endif
                <div>
                    <h5 class="mb-1">{{ $event->name }}</h5>
                    <p class="text-white-50 mb-0">{{ \Carbon\Carbon::parse($event->date)->format('d/m/Y H:i') }}</p>
                </div>
            </div>

            <hr class="border-secondary">

            <div class="d-flex justify-content-between mb-2">
                <span>Precio por entrada:</span>
                <span>${{ number_format($event->ticket_price, 2, ',', '.') }}</span>
            </div>

            <div class="d-flex justify-content-between mb-2">
                <span>Cantidad:</span>
                <span>{{ $quantity }}</span>
            </div>

            <hr class="border-secondary">

            <div class="d-flex justify-content-between">
                <span class="fw-bold">Total:</span>
                <span class="total-price">${{ number_format($totalPrice, 2, ',', '.') }}</span>
            </div>

            <hr class="border-secondary">

            <a href="{{ route('events.view', ['event' => $event->event_id]) }}" class="btn btn-outline-secondary w-100">
                Volver al Evento
            </a>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const paymentMethods = document.querySelectorAll('input[name="payment_method"]');
        const cardFields = document.getElementById('card-fields');
        const mpMessage = document.getElementById('mp-message');
        const paymentCards = document.querySelectorAll('.payment-method-card');

        function updatePaymentUI() {
            const selectedMethod = document.querySelector('input[name="payment_method"]:checked');

            // Actualizar tarjetas seleccionadas
            paymentCards.forEach(card => {
                const input = card.querySelector('input[type="radio"]');
                if (input.checked) {
                    card.classList.add('selected');
                } else {
                    card.classList.remove('selected');
                }
            });

            // Mostrar/ocultar campos según el método
            if (selectedMethod) {
                if (selectedMethod.value === 'mercado_pago') {
                    cardFields.classList.remove('show');
                    mpMessage.style.display = 'block';
                } else {
                    cardFields.classList.add('show');
                    mpMessage.style.display = 'none';
                }
            }
        }

        paymentMethods.forEach(method => {
            method.addEventListener('change', updatePaymentUI);
        });

        // Inicializar
        updatePaymentUI();

        // Formatear número de tarjeta
        const cardNumberInput = document.getElementById('card_number');
        cardNumberInput.addEventListener('input', function(e) {
            this.value = this.value.replace(/\D/g, '');
        });

        // Formatear fecha de vencimiento
        const cardExpiryInput = document.getElementById('card_expiry');
        cardExpiryInput.addEventListener('input', function(e) {
            let value = this.value.replace(/\D/g, '');
            if (value.length >= 2) {
                value = value.substring(0, 2) + '/' + value.substring(2, 4);
            }
            this.value = value;
        });

        // Formatear CVV
        const cardCvvInput = document.getElementById('card_cvv');
        cardCvvInput.addEventListener('input', function(e) {
            this.value = this.value.replace(/\D/g, '');
        });
    });
</script>

</x-layout>
