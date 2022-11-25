<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
//use App\Models\Image;
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
//Generales
Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('home');

//Usuario123
Route::get('/configuracion', [UserController::class, 'config'])->name('config');
Route::post('/user/update', [UserController::class, 'update'])->name('user.update');
Route::get('/user/avatar/{filename}', [UserController::class, 'getImage'])->name('user.avatar');
Route::get('/perfil/{id}', [UserController::class, 'profile'])->name('profile');
Route::get('/people/{search?}', [UserController::class, 'index'])->name('user.index');

//Imagen
Route::get('/subir-imagen', [ImageController::class, 'create'])->name('image.create');
Route::post('/image/save', [ImageController::class, 'save'])->name('image.save');
Route::get('/image/file/{filename}', [ImageController::class, 'getImage'])->name('image.file');
Route::get('/imagen/{id}', [ImageController::class, 'detail'])->name('image.detail');
Route::get('/image/delete/{id}', [ImageController::class, 'delete'])->name('image.delete');
Route::get('/image/edit/{id}', [ImageController::class, 'edit'])->name('image.edit');
Route::post('/image/update', [ImageController::class, 'update'])->name('image.update');

//Comentario
Route::post('/comment/save', [CommentController::class, 'save'])->name('comment.save');
Route::get('/comment/delete/{id}', [CommentController::class, 'delete'])->name('comment.delete');

//Like
Route::get('/like/{image_id}', [LikeController::class, 'like'])->name('like.save');
Route::get('/dislike/{image_id}', [LikeController::class, 'dislike'])->name('like.delete');
Route::get('/likes', [LikeController::class, 'index'])->name('likes');


