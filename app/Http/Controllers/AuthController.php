<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        //TODO: Validar

        $credentials = $request->only(['email', 'password']);

        if(Auth::attempt($credentials)){
            return redirect()
                ->intended(route('movies.index'))
                ->with('feedback.message', 'Sesión Iniciada con éxito. ¡Bienvenido de nuevo!');
        }

        return redirect()
                ->back()
                ->withInput()
                ->with('feedback.message', 'Las credenciales ingresadas no coinciden con nuestros registros!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();


        return redirect()
            ->route('auth.login')
            ->with('feedback.message', 'Sesion Cerrada con exito ¡Te esperamos pronto!');
    }
}
