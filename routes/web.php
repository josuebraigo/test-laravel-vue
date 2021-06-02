<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\WishController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->name('dashboard');

Route::view('/', 'index');

Route::get('/dashboard', [WishController::class, 'index'])
    ->middleware('auth:sanctum')
    ->name('dashboard');

Route::resource('wishes', WishController::class)
    ->middleware('auth:sanctum');

Route::put('/comprar', [WishController::class, 'bought'])
    ->middleware('auth:sanctum')
    ->name('wishes.buy');

Route::get('/comprados', [WishController::class, 'bought'])
    ->middleware('auth:sanctum')
    ->name('wishes.bought');

Route::get('/no-comprados', [WishController::class, 'notBought'])
    ->middleware('auth:sanctum')
    ->name('wishes.not-bought');