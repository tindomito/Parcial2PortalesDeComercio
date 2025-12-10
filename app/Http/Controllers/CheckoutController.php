<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function show(Request $request, Event $event)
    {
        $quantity = $request->input('quantity', 1);

        if ($quantity < 1) {
            $quantity = 1;
        }

        $totalPrice = $event->ticket_price * $quantity;

        return view('checkout.index', [
            'event' => $event,
            'quantity' => $quantity,
            'totalPrice' => $totalPrice,
        ]);
    }

    public function process(Request $request, Event $event)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'payment_method' => 'required|in:credit_card,debit_card,mercado_pago',
            'card_number' => 'required_if:payment_method,credit_card,debit_card|nullable|string|size:16',
            'card_expiry' => 'required_if:payment_method,credit_card,debit_card|nullable|string|max:5',
            'card_cvv' => 'required_if:payment_method,credit_card,debit_card|nullable|string|size:3',
            'card_holder' => 'required_if:payment_method,credit_card,debit_card|nullable|string|max:255',
        ], [
            'quantity.required' => 'La cantidad es obligatoria',
            'quantity.integer' => 'La cantidad debe ser un número entero',
            'quantity.min' => 'La cantidad debe ser al menos 1',
            'full_name.required' => 'El nombre completo es obligatorio',
            'email.required' => 'El email es obligatorio',
            'email.email' => 'El email debe ser válido',
            'phone.required' => 'El teléfono es obligatorio',
            'payment_method.required' => 'El método de pago es obligatorio',
            'payment_method.in' => 'El método de pago seleccionado no es válido',
            'card_number.required_if' => 'El número de tarjeta es obligatorio',
            'card_number.size' => 'El número de tarjeta debe tener 16 dígitos',
            'card_expiry.required_if' => 'La fecha de vencimiento es obligatoria',
            'card_cvv.required_if' => 'El CVV es obligatorio',
            'card_cvv.size' => 'El CVV debe tener 3 dígitos',
            'card_holder.required_if' => 'El nombre del titular es obligatorio',
        ]);

        $quantity = $request->input('quantity');
        $totalPrice = $event->ticket_price * $quantity;

        // Crear la reserva (simulando pago exitoso)
        $reservation = Reservation::create([
            'event_fk' => $event->event_id,
            'user_fk' => Auth::id(),
            'quantity' => $quantity,
            'total_price' => $totalPrice,
            'status' => 'confirmed',
        ]);

        // Generar número de orden simulado
        $orderNumber = 'UFC-' . str_pad($reservation->reservation_id, 6, '0', STR_PAD_LEFT);

        return view('checkout.confirmation', [
            'reservation' => $reservation,
            'event' => $event,
            'orderNumber' => $orderNumber,
            'paymentMethod' => $request->input('payment_method'),
            'customerName' => $request->input('full_name'),
            'customerEmail' => $request->input('email'),
        ]);
    }
}
