<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
Route::get('/', [DashboardController::class, 'home'])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('webpanel')->middleware(['role:Admin'])->group(function () {
        Route::resource('users', UserController::class);
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('webpanel.dashboard');
    });

    Route::resource('posts', PostController::class);
    Route::resource('listing', ListingController::class);
    Route::get('/user-list', [UserController::class, 'getUserList']);
});

require __DIR__.'/auth.php';
