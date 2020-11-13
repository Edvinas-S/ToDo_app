<?php

use App\Http\Controllers\AdminController as AdminController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register'=>false]);
// Auth::routes();

Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::resource('admin', AdminController::class);
Route::post('admin/{id}/edit', [AdminController::class, 'methods'])->name('methods');
Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user');
Route::resource('user', App\Http\Controllers\UserController::class);
