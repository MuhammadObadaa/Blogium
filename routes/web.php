<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AuthController as auth;
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

Route::group(['prefix' => '/blogs','as' => 'blogs.'],function(){

    Route::post('/',[BlogController::class,'store'])->name('store');
    Route::get('/',[BlogController::class,'index'])->name('list');
    Route::get('/{blog}',[BlogController::class,'show'])->name('show')->where('blog','[0-9]+');
    Route::put('/{blog}',[BlogController::class,'update'])->name('update')->where('blog','[0-9]+');
    Route::delete('/{blog}',[BlogController::class,'destroy'])->name('delete')->where('blog','[0-9]+');

});

Route::group( ['middleware' => 'guest','as' =>'auth.'], function () {

    Route::get('/register', [auth::class, 'register'])->name('register');
    Route::post('/register', [auth::class, 'store'])->name('store');
    Route::get('/login', [auth::class, 'login'])->name('login');
    Route::post('/login', [auth::class, 'authenticate'])->name('authenticate');

});

Route::post('/logout', [auth::class, 'logout'])->middleware('auth')->name('auth.logout');

Route::group(['prefix' => '/admin','as' => 'admin.'],function(){

    Route::post('/setAsAdmin/{user}',[AdminController::class,'setAsAdmin'])->name('setAsAdmin');
    Route::post('/setOwners/{blog}',[AdminController::class,'setOwners'])->name('setOwners');
    Route::put('/resetPassword/{admin}',[AdminController::class,'resetPassword'])->name('resetPassword');

});


