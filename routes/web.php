<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\ProfileController as AuthProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductAttributeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



Route::prefix('admin')->name('admin.')->middleware(['guest:admin'])->group(function () {
    Route::get('/login',[AuthenticatedSessionController::class,'create'])->name('login');
    Route::post('/login',[AuthenticatedSessionController::class,'store']);
});

Route::prefix('admin')->name('admin.')->middleware(['admin'])->group(function () {
    Route::post('/logout',[AuthenticatedSessionController::class,'destroy'])->name('logout');
    Route::get('/profile',[AuthProfileController::class,'edit'])->name('profile.edit');
    Route::put('profile/update',[AuthProfileController::class,'updateProfile'])
    ->name('profile.update');
    Route::post('/check-current-pwd',[AuthProfileController::class,'checkCurrentPwd']);
    Route::put('/password/update',[AuthProfileController::class,'updatePassword'])
    ->name('password.update');
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');

    Route::resource('categories', CategoryController::class);
    Route::get('/category/status', [CategoryController::class,'status'])->name('category.status');

    Route::resource('products', ProductController::class);
    Route::get('/product/status', [ProductController::class,'status'])->name('product.status');
    Route::get('/get/category', [ProductController::class,'getCategory'])->name('get.category');
    // product-attributes
    Route::get('/product-attributes/{id}',[ProductAttributeController::class,'addProductAttr'])->name('product-attributes');
    Route::post('/product-attributes/store',[ProductAttributeController::class,'StoreProductAttr'])->name('product-attributes.store');
    Route::post('/product-attributes/update',[ProductAttributeController::class,'UpdateProductAttr'])->name('product-attributes.update');
    Route::delete('/product-attributes/delete/{id}',[ProductAttributeController::class,'DeleteProductAttr']);
    // product-images
    Route::get('/product-images/{id}',[ProductImageController::class,'addProductImg'])->name('product-images');
    Route::post('/product-images/store',[ProductImageController::class,'storeProductImg'])->name('product-images.store');
    Route::delete('/product-images/delete/{id}',[ProductImageController::class,'DeleteProductImg']);
});

;



require __DIR__.'/auth.php';
