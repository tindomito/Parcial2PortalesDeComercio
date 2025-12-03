<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/quienes-somos',[\App\Http\Controllers\AboutController::class, 'about'])
    ->name('about');

Route::get('/novedades', [\App\Http\Controllers\NewsController::class, 'index'])
    ->name('news.index');

Route::get('/novedades/publicar', [\App\Http\Controllers\NewsController::class, 'create'])
    ->name('news.create')
    ->middleware(['auth', 'admin']);

Route::post('/novedades/publicar', [\App\Http\Controllers\NewsController::class, 'store'])
    ->name('news.store')
    ->middleware(['auth', 'admin']);

Route::get('/novedades/{id}/editar', [\App\Http\Controllers\NewsController::class, 'edit'])
    ->name('news.edit')
    ->middleware(['auth', 'admin']);

Route::put('/novedades/{id}/editar', [\App\Http\Controllers\NewsController::class, 'update'])
    ->name('news.update')
    ->middleware(['auth', 'admin']);

Route::get('/novedades/{id}/eliminar', [\App\Http\Controllers\NewsController::class, 'delete'])
    ->name('news.delete')
    ->middleware(['auth', 'admin']);

Route::delete('/novedades/{id}/eliminar', [\App\Http\Controllers\NewsController::class, 'destroy'])
    ->name('news.destroy')
    ->middleware(['auth', 'admin']);

Route::get('cartelera/listado', [\App\Http\Controllers\EventsController::class, 'index'])
    ->name('events.index');

Route::get('cartelera/{event}', [\App\Http\Controllers\EventsController::class, 'view'])
    ->name('events.view')
    ->middleware('require-age')
    ->whereNumber('event');

Route::get('cartelera/{id}/verificar-edad', [\App\Http\Controllers\AgeVerificationController::class, 'show'])
    ->name('events.age-verification.show')
    ->whereNumber('id');

Route::post('cartelera/{id}/verificar-edad', [\App\Http\Controllers\AgeVerificationController::class, 'save'])
    ->name('events.age-verification.save')
    ->whereNumber('id');

Route::get('cartelera/publicar',[\App\Http\Controllers\EventsController::class, 'create'] )
    ->name('events.create')
    ->middleware(['auth', 'admin']);

Route::post('cartelera/publicar',[\App\Http\Controllers\EventsController::class, 'store'] )
    ->name('events.store')
    ->middleware(['auth', 'admin']);

Route::get('cartelera/{id}/eliminar', [\App\Http\Controllers\EventsController::class, 'delete'] )
    ->name('events.delete')
    ->middleware(['auth', 'admin']);

Route::delete('cartelera/{id}/eliminar', [\App\Http\Controllers\EventsController::class, 'destroy'] )
    ->name('events.destroy')
    ->middleware(['auth', 'admin']);

Route::get('cartelera/editar/{event}', [\App\Http\Controllers\EventsController::class, 'edit'])
    ->name('events.edit')
    ->middleware(['auth', 'admin']);

Route::put('cartelera/editar/{id}', [\App\Http\Controllers\EventsController::class, 'update'])
    ->name('events.update')
    ->middleware(['auth', 'admin']);

Route::post('cartelera/{event}/reservar', [\App\Http\Controllers\ReservationController::class, 'store'])
    ->name('reservations.store')
    ->middleware('auth');

Route::get('mis-reservas', [\App\Http\Controllers\ReservationController::class, 'index'])
    ->name('reservations.index')
    ->middleware('auth');

Route::post('reservas/{id}/cancelar', [\App\Http\Controllers\ReservationController::class, 'cancel'])
    ->name('reservations.cancel')
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

