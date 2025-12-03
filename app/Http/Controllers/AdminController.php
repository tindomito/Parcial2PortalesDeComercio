<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Muestra el panel de administración con todos los usuarios
     */
    public function users()
    {
        // Obtener todos los usuarios ordenados por fecha de creación
        $users = User::orderBy('created_at', 'desc')->get();

        return view('admin.users', [
            'users' => $users
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
