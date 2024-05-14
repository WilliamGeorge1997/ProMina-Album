<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\AuthenticationController;

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

Route::get('register', [AuthenticationController::class, 'registerform'])->name('register');
Route::post('register', [AuthenticationController::class, 'register'])->name('register');
Route::get('login', [AuthenticationController::class, 'loginform'])->name('login');
Route::post('login', [AuthenticationController::class, 'login'])->name('login');

Route::middleware(['auth'])->group(function () {
    Route::get('home', [HomeController::class, 'home'])->name('home');
    Route::resource('albums', AlbumController::class);
    Route::resource('pictures', PictureController::class);
    Route::post('pictures/{album}', [PictureController::class, 'store'])->name('pictures.store');
    Route::get('albums/confirm_delete/{id}', [AlbumController::class, 'confirmDelete'])->name('albums.confirm_delete');
    Route::delete('albums/delete/{id}', [AlbumController::class, 'delete'])->name('albums.delete');
    Route::delete('albums/move/{id}', [AlbumController::class, 'delete'])->name('albums.move');

});
