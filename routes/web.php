<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\VerifyOrderController;
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

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'auth']);

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
});

Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/toko', [TokoController::class, 'index']);
Route::get('/toko/search', [TokoController::class, 'search']);
Route::get('/toko/product/{product:slug}', [TokoController::class, 'show']);

Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/topik/{kategori:slug}', [BlogController::class, 'category'])->name('blog.category');
Route::get('/blog/search', [BlogController::class, 'search']);
Route::get('/blog/{article:slug}', [BlogController::class, 'show'])->name('blog.show');

Route::middleware('auth')->group(function() {

    Route::get('/cart', [CartController::class, 'index']);
    Route::post('/cart/{product}', [CartController::class, 'store']);
    Route::put('/cart/{cart}', [CartController::class, 'update']);
    Route::delete('/cart/{cart}', [CartController::class, 'destroy']);

    Route::get('/cart/total', [CartController::class, 'getTotal']);

    Route::post('/order', [OrderController::class, 'store']);

    Route::get('/order/{order}/verify', [VerifyOrderController::class, 'show']);
    Route::get('/order/{order}', [VerifyOrderController::class, 'verify'])->name('order.verify')->middleware('admin');
    Route::get('/order/fail', [VerifyOrderController::class, 'notifyFailure']);
    Route::get('/order/{order}/success', [VerifyOrderController::class, 'notifySuccess']);

});

// Route::get('/review', [ReviewController::class, 'create']);
// Route::post('/review', [ReviewController::class, 'store']);

// Route::get('/admin/dashboard/review/{review:slug}', [ReviewController::class, 'show']);

Route::middleware('admin')->group(function() {

    Route::permanentRedirect('/admin', '/admin/dashboard');

    Route::get('/admin/dashboard', [DashboardController::class, 'view']);

    Route::get('/admin/dashboard/purchase', [PurchaseController::class, 'index']);
    Route::get('/admin/dashboard/purchase/create', [PurchaseController::class, 'create']);

    Route::post('/purchase', [PurchaseController::class, 'store']);

    Route::delete('/purchase/{id}', [PurchaseController::class, 'destroy']);

    Route::get('/admin/dashboard/sales', [SalesController::class, 'index']);
    Route::get('/admin/dashboard/sales/{sales}/order/{order}', [SalesController::class, 'show']);
    Route::get('/admin/dashboard/sales/create', [SalesController::class, 'create']);

    Route::post('/sales', [SalesController::class, 'store']);

    Route::get('/admin/dashboard/products', [ProductController::class, 'index']);
    Route::get('/admin/dashboard/products/create', [ProductController::class, 'create']);
    Route::post('/products', [ProductController::class, 'store']);

    Route::get('/product/{id}/ubah', [ProductController::class, 'edit']);
    Route::put('/product/{id}', [ProductController::class, 'update']);

    Route::delete('/product/{id}', [ProductController::class, 'destroy']);
    Route::get('/admin/dashboard/blog', [ArticleController::class, 'index'])->name('blog.index');
    Route::get('/admin/dashboard/blog/article/create', [ArticleController::class, 'create'])->name('article.create');
    Route::post('/article', [ArticleController::class, 'store']);
    Route::get('/admin/dashboard/blog/article/{article}', [ArticleController::class, 'show'])->name('article.show');
    Route::get('/admin/dashboard/blog/article/{article}/edit', [ArticleController::class, 'edit'])->name('article.edit');
    Route::put('/article/{article}', [ArticleController::class, 'update']);
    Route::delete('/article/{article}', [ArticleController::class, 'destroy'])->name('article.destroy');

    Route::get('/admin/dashboard/blog/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::post('/kategori', [KategoriController::class, 'store']);
    Route::get('/admin/dashboard/blog/kategori/{kategori}', [KategoriController::class, 'show'])->name('kategori.show');
    Route::put('/kategori/{kategori}', [KategoriController::class, 'update']);
    Route::delete('/kategori/{kategori}', [KategoriController::class, 'destroy']);
});
