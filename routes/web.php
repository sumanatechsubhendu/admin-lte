<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        if (Auth::check() && Auth::user()->hasRole('Admin')) {
            return Inertia::render('Admin/Dashboard');
        }
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/webpanel/dashboard', function () {
        if (Auth::check() && Auth::user()->hasRole('Admin')) {
            return Inertia::render('Admin/Dashboard');
        }
        return Inertia::render('Dashboard');
    })->name('webpanel.dashboard');

    Route::prefix('webpanel')->middleware(['role:Admin'])->group(function () {
        Route::resource('users', UserController::class);
    });

    Route::resource('posts', PostController::class);
    Route::resource('listing', ListingController::class);
    Route::get('/user-list', [UserController::class, 'getUserList']);

});


require __DIR__.'/auth.php';
