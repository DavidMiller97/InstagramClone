<?php

use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/config', [UserController::class, 'config'])->name('config');
Route::post('/user/update', [UserController::class, 'update'])->name('user.update');
Route::get('/pass', [UserController::class, 'change_pass'])->name('change_pass');
Route::post('/user/changepass', [UserController::class, 'update_pass'])->name('user.changepass');
Route::get('/user/avatar/{filename}', [UserController::class, 'getImagen'])->name('user.avatar.imagen');

Route::get('/image', [ImageController::class, 'create'])->name('image.create');
Route::post('/image/save', [ImageController::class, 'save'])->name('image.save');
Route::get('/imagen/file/{filename}', [ImageController::class, 'getImagen'])->name('imagen.file');
Route::get('/imagen/{id}', [ImageController::class, 'detalle'])->name('imagen.detalle');