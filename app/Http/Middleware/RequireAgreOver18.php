<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Movie;

class RequireAgreOver18
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $id = $request->route('id');
        $movie = $request->route('movie');
        if($movie->rating_fk == 4 && !$request->session()->has('age-verified'))
        {
            return to_route('movies.age-verification.show', ['id'=>$movie->movie_id]);
        }
        echo "Verificacion de la edad <br>";
        return $next($request);
    }
}
