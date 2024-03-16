<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
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
});

require __DIR__ . '/auth.php';

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

Route::prefix('tasks')->group(function () {
    Route::middleware(['auth', 'isUser'])->group(function () {
        Route::get('/{id}/edit', [TaskController::class, 'edit'])
            ->whereNumber('id')
            ->name('tasks.edit');
        Route::put('/{id}', [TaskController::class, 'update'])
            ->name('tasks.update');
        Route::delete('/{id}/trash', [TaskController::class, 'trash'])
            ->name('tasks.trash');
        Route::put('/{id}/restore', [TaskController::class, 'restore'])
            ->name('tasks.trash');
        Route::delete('/{id}', [TaskController::class, 'destroy'])
            ->name('tasks.destroy');
    });

    Route::get('/trash', [TaskController::class, 'showTrash'])
        ->name('tasks.trash');
    Route::get('/create', [TaskController::class, 'create'])
        ->name('tasks.create');
    Route::post('/', [TaskController::class, 'store'])
        ->name('tasks.store');
    Route::get('/', [TaskController::class, 'index'])
        ->name('tasks.index');
    Route::get('/{id}', [TaskController::class, 'show'])
        ->whereNumber('id')
        ->name('tasks.show');
});

Route::fallback(function () {
    return view('errors.404');
});
