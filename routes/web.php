<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SalesController;
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

Route::get('/review', [ReviewController::class, 'create']);
Route::post('/review', [ReviewController::class, 'store']);

Route::get('/admin/dashboard/review/{review:slug}', [ReviewController::class, 'show']);

Route::middleware('admin')->group(function() {

    Route::permanentRedirect('/admin', '/admin/dashboard');

    Route::get('/admin/dashboard', [DashboardController::class, 'view']);

    Route::get('/admin/dashboard/purchase', [PurchaseController::class, 'index']);
    Route::get('/admin/dashboard/purchase/create', [PurchaseController::class, 'create']);

    Route::post('/purchase', [PurchaseController::class, 'store']);

    Route::get('/admin/dashboard/sales', [SalesController::class, 'index']);
    Route::get('/admin/dashboard/sales/create', [SalesController::class, 'create']);

    Route::post('/sales', [SalesController::class, 'store']);

    Route::get('/admin/dashboard/products', [ProductController::class, 'index']);
    Route::get('/admin/dashboard/products/create', [ProductController::class, 'create']);

    Route::post('/products', [ProductController::class, 'store']);

    Route::get('/admin/dashboard/blog', function () {
        return view('admin.dashboard.blog');
    });
    Route::get('/admin/dashboard/users', function () {
        return view('admin.dashboard.users');
    });
});
