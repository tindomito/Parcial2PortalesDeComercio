<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Muestra el panel de administración con todos los usuarios
     */
    public function users()
    {
        // Obtener todos los usuarios ordenados por fecha de creación
        $users = User::orderBy('created_at', 'desc')->get();

        // Obtener el evento con más ventas (sumando la cantidad de tickets vendidos)
        $topEvent = Event::withCount([
            'reservations as total_tickets_sold' => function ($query) {
                $query->select(DB::raw('COALESCE(SUM(quantity), 0)'));
            },
            'reservations as total_reservations'
        ])
        ->with(['rating', 'categories'])
        ->orderBy('total_tickets_sold', 'desc')
        ->first();

        // Calcular el total de ingresos del evento con más ventas
        $topEventRevenue = 0;
        if ($topEvent) {
            $topEventRevenue = $topEvent->reservations()->sum('total_price');
        }

        return view('admin.users', [
            'users' => $users,
            'topEvent' => $topEvent,
            'topEventRevenue' => $topEventRevenue
        ]);
    }

    /**
     * Muestra los detalles de un usuario específico con sus reservas
     */
    public function userDetails($id)
    {
        // Obtener el usuario con sus reservas y los eventos relacionados
        $user = User::with(['reservations.event'])->findOrFail($id);

        // Obtener las reservas ordenadas por fecha de creación (más recientes primero)
        $reservations = $user->reservations()->with('event')->orderBy('created_at', 'desc')->get();

        return view('admin.user-details', [
            'user' => $user,
            'reservations' => $reservations
        ]);
    }
}
