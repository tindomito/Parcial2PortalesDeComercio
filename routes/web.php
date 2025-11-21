<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [\App\Http\Controllers\HomeController::class, 'home'])
    ->name('home');

Route::get('/quienes-somos',[\App\Http\Controllers\AboutController::class, 'about'])
    ->name('about');

Route::get('peliculas/listado', [\App\Http\Controllers\MoviesController::class, 'index'])
    ->name('movies.index');

Route::get('peliculas/{movie}', [\App\Http\Controllers\MoviesController::class, 'view'])
    ->name('movies.view')
    ->middleware('require-age')
    ->whereNumber('movie');

Route::get('peliculas/{id}/verificar-edad', [\App\Http\Controllers\AgeVerificationController::class, 'show'])
    ->name('movies.age-verification.show')
    ->whereNumber('id');

Route::post('peliculas/{id}/verificar-edad', [\App\Http\Controllers\AgeVerificationController::class, 'save'])
    ->name('movies.age-verification.save')
    ->whereNumber('id');

Route::get('peliculas/publicar',[\App\Http\Controllers\MoviesController::class, 'create'] )
    ->name('movies.create')
    ->middleware('auth');

Route::post('peliculas/publicar',[\App\Http\Controllers\MoviesController::class, 'store'] )
    ->name('movies.store')
    ->middleware('auth');

Route::get('peliculas/{id}/eliminar', [\App\Http\Controllers\MoviesController::class, 'delete'] )
    ->name('movies.delete')
    ->middleware('auth');

Route::delete('peliculas/{id}/eliminar', [\App\Http\Controllers\MoviesController::class, 'destroy'] )
    ->name('movies.destroy')
    ->middleware('auth');

Route::get('peliculas/editar/{movie}', [\App\Http\Controllers\MoviesController::class, 'edit'])
    ->name('movies.edit')
    ->middleware('auth');

Route::put('peliculas/editar/{id}', [\App\Http\Controllers\MoviesController::class, 'update'])
    ->name('movies.update')
    ->middleware('auth');

Route::get('iniciar-sesion', [\App\Http\Controllers\AuthController::class, 'login'])
    ->name('auth.login');

Route::post('iniciar-sesion', [\App\Http\Controllers\AuthController::class, 'authenticate'])
    ->name('auth.authenticate');

Route::get('registrarse', [\App\Http\Controllers\AuthController::class, 'register'])
    ->name('auth.register');

Route::post('registrarse', [\App\Http\Controllers\AuthController::class, 'store'])
    ->name('auth.register.store');

Route::post('cerrar-sesion', [\App\Http\Controllers\AuthController::class, 'logout'])
    ->name('auth.logout');

// Panel de Administración
Route::get('admin/usuarios', [\App\Http\Controllers\AdminController::class, 'users'])
    ->name('admin.users')
    ->middleware('auth');

