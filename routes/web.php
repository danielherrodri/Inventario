<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\HomeController;
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

Route::get('/', [AuthenticatedSessionController::class, 'create']);

Route::get('/dashboard', [HomeController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/producto/search', [ProductController::class, 'search'])->name('producto.search');
    Route::get('/usuario/search', [UsuarioController::class, 'search'])->name('usuario.search');
    Route::resource('product', ProductController::class);
    Route::resource('usuario', UsuarioController::class);
});

require __DIR__ . '/auth.php';
