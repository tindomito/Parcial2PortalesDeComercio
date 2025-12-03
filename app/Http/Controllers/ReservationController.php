<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function store(Request $request, Event $event)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ], [
            'quantity.required' => 'La cantidad debe tener un valor',
            'quantity.integer' => 'La cantidad debe ser un número entero',
            'quantity.min' => 'La cantidad debe ser al menos 1',
        ]);

        $quantity = $request->input('quantity');
        $totalPrice = $event->ticket_price * $quantity;

        Reservation::create([
            'event_fk' => $event->event_id,
            'user_fk' => Auth::id(),
            'quantity' => $quantity,
            'total_price' => $totalPrice,
            'status' => 'confirmed',
        ]);

        return redirect()
            ->route('reservations.index')
            ->with('feedback.message', 'Tu reserva para <b>' . e($event->name) . '</b> se realizó exitosamente');
    }

    public function index()
    {
        $reservations = Reservation::with(['event', 'event.rating'])
            ->where('user_fk', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('reservations.index', [
            'reservations' => $reservations,
        ]);
    }

    public function cancel(int $id)
    {
        $reservation = Reservation::findOrFail($id);

        if ($reservation->user_fk !== Auth::id()) {
            abort(403, 'No tienes permiso para cancelar esta reserva');
        }

        if ($reservation->status === 'cancelled') {
            return redirect()
                ->route('reservations.index')
                ->with('feedback.message', 'Esta reserva ya fue cancelada');
        }

        $reservation->update(['status' => 'cancelled']);

        return redirect()
            ->route('reservations.index')
            ->with('feedback.message', 'La reserva fue cancelada exitosamente');
    }
}
