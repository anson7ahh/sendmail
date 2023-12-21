<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
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
Route::prefix('task')->group(function () {
    Route::get('/', [TaskController::class, 'index'])->name('index');
    Route::post('/', [TaskController::class, 'store'])->name('store.task');
    Route::delete('/{task}', [TaskController::class, 'delete'])->name('delete.task');
});
Route::prefix('')->group(function () {
    Route::get('/register', [UserController::class, 'index'])->name('user.index');
    Route::post('checkLogin', [UserController::class, 'store'])->name('user.store');
    Route::get('/edit/{id}', [UserController::class, 'show'])->name('user.show');
    Route::post('/edit/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('delete/{id}', [UserController::class, 'delete'])->name('delete');
});
