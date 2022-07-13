<?php

use App\Http\Resources\LikeResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\CommentController;
use App\Models\Like;

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
Route::get('/perfil/{id}', [UserController::class, 'profile'])->name('user.perfil');
Route::get('/imagen/likes/{id}', function($id){

    $likes = Like::where('imagen_id', $id)->get();
    return LikeResource::collection($likes);

});

Route::get('/image', [ImageController::class, 'create'])->name('image.create');
Route::post('/image/save', [ImageController::class, 'save'])->name('image.save');
Route::get('/imagen/file/{filename}', [ImageController::class, 'getImagen'])->name('imagen.file');
Route::get('/imagen/{id}', [ImageController::class, 'detalle'])->name('imagen.detalle');
Route::get('/comment/save', [CommentController::class, 'save'])->name('comment.save');
Route::get('/comment/delete/{id}', [CommentController::class, 'delete'])->name('comment.delete');
Route::get('/like/{id}', [LikeController::class, 'like'])->name('like.save');
Route::get('/dislike/{id}', [LikeController::class, 'dislike'])->name('like.delete');

Route::get('/likes', [LikeController::class, 'index'])->name('likes');

Route::get('/imagen/delete/{id}', [ImageController::class, 'delete'])->name('imagen.delete');
Route::get('/imagen/editar/{id}', [ImageController::class, 'edit'])->name('imagen.edit');
Route::post('/imagen/update', [ImageController::class, 'update'])->name('imagen.update');
Route::get('/users/{nick?}', [UserController::class, 'index'])->name('users');