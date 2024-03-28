<?php

use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::resource('evento', EventoController::class)->only(['index', 'create', 'store'])->names([
        'index' => 'evento.index',
        'create' => 'evento.create',
        'store' => 'evento.store',
    ]);
    Route::delete('evento/{evento}', [EventoController::class, 'destroy'])->name('evento.destroy');


    Route::get('/user', [UserController::class, 'index'])->name('user.index');
//pagos
Route::resource('pago', PagoController::class)->only(['index', 'create', 'store', 'edit', 'update'])->names([
    'index' => 'pago.index',
    'create' => 'pago.create',
    'store' => 'pago.store',
    'edit' => 'pago.edit',
    'update' => 'pago.update',
]);
//Route::resource('pago', PagoController::class)->only(['edit', 'update']);


Route::delete('estudiante/{estudiante}', [EventoController::class, 'destroy'])->name('estudiante.destroy');
//estudiante
Route::resource('estudiante', EstudianteController::class)->only(['index', 'create', 'store'])->names([
    'index' => 'estudiante.index',
    'create' => 'estudiante.create',
    'store' => 'estudiante.store',
]);
Route::delete('estudiante/{estudiante}', [EventoController::class, 'destroy'])->name('estudiante.destroy');



});

require __DIR__.'/auth.php';
