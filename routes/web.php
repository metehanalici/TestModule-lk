<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

Route::get('/', function () {
    return redirect('/show-register-login-form');
});

// Üye Giriş ve Kayıt formu
Route::get('/show-register-login-form', [AuthController::class, 'showForm'])->name('register');
// Kayıt
Route::post('/register', [AuthController::class, 'register'])->name('register');
// Giriş
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Kullanıcı Sayfası
Route::get('/dashboard', [AuthController::class, 'Dashboard'])->name('dashboard');

// Admin Sayfası
Route::get('/admin/dashboard', [AuthController::class, 'Admindashboard'])->name('admin.dashboard');

// Çıkış
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Kategori Listeleme , Kategori ekleme , Kategori düzenleme , Kategori silme  
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::post('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

// Ürün Listeleme , Ürün ekleme , Ürün düzenleme , Ürün silme  
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
