<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index'])
        ->name('users.index');
    Route::get('/create', [UserController::class, 'create'])
        ->name('users.create');
    Route::post('/', [UserController::class, 'store'])
        ->name('users.store');
    Route::get('/{id}', [UserController::class, 'show'])
        ->whereNumber('id')
        ->name('users.show');
    Route::get('/{id}/edit', [UserController::class, 'edit'])
        ->whereNumber('id')
        ->name('users.edit');
    Route::put('/{id}', [UserController::class, 'update'])
        ->name('users.update');
});

Route::fallback(function () {
    return view('errors.404');
});
