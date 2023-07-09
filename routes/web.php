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


//Metodos Get
Route::get('/user', [UsersController::class, 'user']);
Route::get('/posts', [PostsController::class, 'posts']);
Route::get('/destinations', [DestinationsController::class, 'destinations']);
Route::get('/penalties', [PenaltiesController::class, 'penalties']);

//Metodos Post
Route::post('/user-register', [UsersController::class, 'register']);
Route::post('/user-login', [UsersController::class, 'login']);
Route::post('/user-update', [UsersController::class, 'update']);


//Metodo Delete
Route::delete('/user-delete', [UsersController::class, 'delete']);