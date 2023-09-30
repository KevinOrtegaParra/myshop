<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
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

Route::get('/tareas', [PostController::class,'index'])->name('posts');

Route::post('/tareas', [PostController::class,'store'])->name('posts');

Route::get('/tareas/{id}', [PostController::class,'show'])->name('posts-edit');
Route::patch('/tareas/{id}', [PostController::class,'update'])->name('posts-update');
Route::delete('/tareas/{id}', [PostController::class,'destroy'])->name('posts-destroy');

Route::resource('category',CategoryController::class);

