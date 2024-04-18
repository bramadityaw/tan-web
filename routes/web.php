<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Middleware\RedirectIfAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [HomeController::class, 'index']);

Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'auth']);

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
});

Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware('admin')->group(function() {

    Route::permanentRedirect('/admin', '/admin/dashboard');

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard.index');
    });
    Route::get('/admin/dashboard/transactions', function () {
        return view('admin.dashboard.transactions');
    });
    Route::get('/admin/dashboard/products', function () {
        return view('admin.dashboard.products');
    });
    Route::get('/admin/dashboard/blog', function () {
        return view('admin.dashboard.blog');
    });
    Route::get('/admin/dashboard/users', function () {
        return view('admin.dashboard.users');
    });
});
