<?php

use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AuthenAdminController;
use App\Http\Controllers\ProductController;
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

Route::get('login', [AuthenAdminController::class, 'showFormLogin'])->name('login');
Route::post('login', [AuthenAdminController::class, 'handleLogin']);

Route::get('register', [AuthenAdminController::class, 'showFormRegister'])->name('register');
Route::post('register', [AuthenAdminController::class, 'handleregister']);

Route::post('logout', [AuthenAdminController::class, 'logout'])->name('logout');

// Route::post('logout', [AuthenAdminController::class, 'logoutAdmin']);



Route::get('/', [ProductController::class, 'index'])->name('client.index');
Route::get('shop', [ProductController::class, 'shop'])->name('client.shop');

Route::get('/shop-detail/{id}', [ProductController::class, 'show'])->name('client.shop-detail');

Route::get('/shop-by-key', [ProductController::class, 'findByKey'])->name('client.shop-by-key');


Route::get('cart', function () {
    return view('client.cart');
});

Route::get('check-out', function () {
    return view('client.check-out');
});

Route::get('contact', function () {
    return view('client.contact');
});


// middleware('auth')->
Route::middleware('auth')->prefix('/admin')->group(function () {

    Route::get('/', [AdminProductController::class, 'dashboard'])->name('admin.dashboard');

    Route::resource('products', AdminProductController::class);

    Route::resource('categories', AdminCategoryController::class);
});
