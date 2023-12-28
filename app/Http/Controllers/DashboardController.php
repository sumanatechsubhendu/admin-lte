<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Route;

class DashboardController extends Controller
{
    /**
     * Show the dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (!Auth::user()->hasRole('User')) {
            // User is not authorized to view the dashboard
            abort(403, 'Unauthorized action.');
        }
        return Inertia::render('Dashboard');
    }

    /**
     * Show the dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function home()
    {
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    }
}
