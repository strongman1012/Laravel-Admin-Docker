<?php

use App\Http\Controllers\LineController;
use App\Http\Controllers\ProductVolumeController;
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

Auth::routes();

Route::get('/', [LineController::class, 'index'])->name('home');
Route::get('/home', [LineController::class, 'index'])->name('product.volume.index');

Route::get('/product/index', [ProductVolumeController::class, 'index'])->name('product.volume.index');
Route::post('/product/update', [ProductVolumeController::class, 'update'])->name('product.volume.update');

