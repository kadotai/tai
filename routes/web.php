<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

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

Auth::routes();

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/todos',[TodoController::class,'index'])->name('todos.index');
Route::post('/todos', [TodoController::class, 'store'])->name('todos.store');
Route::put('/todos/{id}', [TodoController::class, 'update'])->name('todos.update');
Route::put('/todos/{id}',[TodoController::class,'update'])->name('todos.update');
Route::delete('/todos/{id}', [TodoController::class, 'destroy'])->name('todos.destroy');

Route::get('/todos/{id}', [TodoController::class,'edit'])->name('todos.edit');