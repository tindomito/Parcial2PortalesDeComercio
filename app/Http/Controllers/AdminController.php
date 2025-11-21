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
}
