<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});
route::get('/users',[UserController::class,'index'])->name('users.index');
route::get('/users/create',[UserController::class,'create'])->name('users.create');
route::post('/users',[UserController::class,'store'])->name('users.store');
route::get('/users/{id}/edit',[UserController::class,'edit'])->name('users.edit');
route::put('/users/{id}',[UserController::class,'update'])->name('users.update');
route::delete('/users/{id}',[UserController::class,'destroy'])->name('users.destroy');
                       ///routes for products///

// عرض نموذج إضافة منتج
Route::get('products/create', [ProductController::class, 'create'])->name('products.create');

// تخزين منتج جديد
Route::post('products', [ProductController::class, 'store'])->name('products.store');

// عرض قائمة المنتجات
Route::get('products', [ProductController::class, 'index'])->name('products.index');

// عرض تفاصيل منتج محدد
Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');

// عرض نموذج تحرير منتج محدد
Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');

// تحديث منتج محدد
Route::put('products/{product}', [ProductController::class, 'update'])->name('products.update');

// حذف منتج محدد
Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

                       ///routes for categories///
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

route::get('/categories/create',[CategoryController::class,'create'])->name('categories.create');
route::post('/categories',[CategoryController::class,'store'])->name('categories.store');
route::get('/categories/{id}/edit',[CategoryController::class,'edit'])->name('categories.edit');
route::put('/categories/{id}',[CategoryController::class,'update'])->name('categories.update');
route::delete('/categories/{id}',[CategoryController::class,'destroy'])->name('categories.destroy');
/////
route::get('/login',[AdminController::class,'index'])->name('login');
route::post('/login',[AdminController::class,'postLogin'])->name('postLogin');