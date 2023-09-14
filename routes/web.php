<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleriesController;
use App\Http\Controllers\Admin\TravelPackageController;
use App\Http\Controllers\Admin\TransactionsController;

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

Route::prefix('admin')->namespace('Admin') ->group(function () {
    Route::get('/',  [DashboardController::class, 'index']) ->name('dashboard');
    Route::get('/galleries',  [GalleriesController::class, 'index']) -> name('galleries');
    Route::get('/travel-package',  [TravelPackageController::class, 'index']) -> name('travel-package');
    Route::get('/transactions',  [TransactionsController::class, 'index']) -> name('transactions');
});