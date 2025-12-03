<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Mostrar el perfil del usuario autenticado
     */
    public function show()
    {
        return view('profile.show', [
            'user' => auth()->user()
        ]);
    }

    /**
     * Mostrar el formulario de edición del perfil
     */
    public function edit()
    {
        return view('profile.edit', [
            'user' => auth()->user()
        ]);
    }

    /**
     * Actualizar el perfil del usuario
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        // Actualizar nombre y email
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        // Si se proporcionó una nueva contraseña, actualizarla
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()
            ->route('profile.show')
            ->with('feedback.message', 'Perfil actualizado con éxito.')
            ->with('feedback.type', 'success');
    }
}
