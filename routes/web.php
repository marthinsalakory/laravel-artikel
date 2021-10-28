<?php

use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\AuthController;
use App\Models\Artikel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



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

Route::get('/logout', [AuthController::class, 'logout']);

if (isLogin()) {
    Route::get('/', [ArtikelController::class, 'index']);
    Route::get('/semua_komentar', [ArtikelController::class, 'semua_komentar']);
    Route::post('/add_comment_artikel', [ArtikelController::class, 'add_comment_artikel']);
    Route::post('/simpan_artikel', [ArtikelController::class, 'simpan']);
    Route::get('/like', [ArtikelController::class, 'like']);
    Route::get('/unlike', [ArtikelController::class, 'unlike']);
    Route::get('/hapus_artikel', [ArtikelController::class, 'hapus_artikel']);

    Route::get('/login', [ArtikelController::class, 'index']);
    Route::get('/register', [ArtikelController::class, 'index']);
    Route::post('/register/add', [ArtikelController::class, 'index']);
    Route::post('/login/in', [ArtikelController::class, 'index']);
} else {
    Route::get('/', [AuthController::class, 'login']);
    Route::post('/simpan_artikel', [AuthController::class, 'login']);
    Route::post('/add_comment_artikel', [AuthController::class, 'login']);
    Route::get('/semua_komentar', [AuthController::class, 'login']);
    Route::get('/like', [AuthController::class, 'login']);
    Route::get('/unlike', [AuthController::class, 'login']);
    Route::get('/hapus_artikel', [AuthController::class, 'login']);

    Route::get('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'register']);
    Route::post('/register/add', [AuthController::class, 'add']);
    Route::post('/login/in', [AuthController::class, 'masuk']);
}
