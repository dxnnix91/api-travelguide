<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\DestinationsController;
use App\Http\Controllers\PenaltiesController;
use App\Http\Controllers\UsersController;

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


//Metodos Get***********
//Usuarios
Route::get('/user', [UsersController::class, 'user']);
//Posts
Route::get('/posts', [PostsController::class, 'posts']);
//Destinos
Route::get('/destinations', [DestinationsController::class, 'destinations']);
//Penalizaciones
Route::get('/penalties', [PenaltiesController::class, 'penalties']);


//Metodos Post********************
//Usuarios
Route::post('/user-register', [UsersController::class, 'register']);
Route::post('/user-login', [UsersController::class, 'login']);
Route::post('/user-update', [UsersController::class, 'update']);
//Posts
Route::post('/posts-create', [PostsController::class, 'create']);
Route::post('/posts-update', [PostsController::class, 'update']);



//Metodo Delete*******************
Route::delete('/user-delete', [UsersController::class, 'delete']);
Route::delete('/posts-delete', [PostsController::class, 'delete']);