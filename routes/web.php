<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleriesController;
use App\Http\Controllers\Admin\TravelPackageController;
use App\Http\Controllers\Admin\TransactionsController;
use App\Http\Controllers\Admin\TestCRUDController;

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

Route::prefix('admin')
->middleware(['auth', 'admin'])
->group(function(){
    Route::get('/',  [DashboardController::class, 'index']) ->name('dashboard');
    Route::get('/galleries',  [GalleriesController::class, 'index']) -> name('galleries');
    Route::get('/transactions',  [TransactionsController::class, 'index']) -> name('transactions');
    Route::resource('travel-package', TravelPackageController::class);
    Route::get('/items',  [TestCRUDController::class, 'index']) ->name('items');
    Route::put('/items/{id}',  [TestCRUDController::class, 'update'])->name('items.update');
    Route::delete('/items/{id}',  [TestCRUDController::class, 'destroy'])->name('items.destroy');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';