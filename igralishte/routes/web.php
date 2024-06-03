<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Auth\GoogleLoginController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\FacebookLoginController;

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

Route::middleware([
    'auth:sanctum',
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware([
    'auth:sanctum',
    'verified',
    'admin',
])->group(function () {
    //PROFILE
    Route::get('/admin/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/admin/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    //PRODUCTS
    Route::get('/admin/products', [ProductController::class, 'index'])->name('products');
    Route::get('/admin/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/admin/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/admin/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/admin/products/{product}', [ProductController::class, 'update'])->name('products.update');
    //DISCOUNTS
    Route::get('/admin/discounts', [DiscountController::class, 'index'])->name('discounts');
    Route::get('/admin/discounts/create', [DiscountController::class, 'create'])->name('discounts.create');
    Route::post('/admin/discounts', [DiscountController::class, 'store'])->name('discounts.store');
    Route::get('/admin/discounts/{discount}/edit', [DiscountController::class, 'edit'])->name('discounts.edit');
    Route::put('/admin/discounts/{discount}', [DiscountController::class, 'update'])->name('discounts.update');
    //BRANDS
    Route::get('/admin/brands', [BrandController::class, 'index'])->name('brands');
    Route::get('/admin/brands/create', [BrandController::class, 'create'])->name('brands.create');
    Route::post('/admin/brands', [BrandController::class, 'store'])->name('brands.store');
    Route::get('/admin/brands/{brand}/edit', [BrandController::class, 'edit'])->name('brands.edit');
    Route::put('/admin/brands/{brand}', [BrandController::class, 'update'])->name('brands.update');
});

//Facebook auth with ngrok
Route::get('/auth/facebook', [FacebookLoginController::class, 'redirectToFacebook'])->name('auth.facebook');
Route::get('/auth/facebook/callback', [FacebookLoginController::class, 'handleFacebookCallback']);
//Google auth with ngrok
Route::get('auth/google', [GoogleLoginController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleLoginController::class, 'handleGoogleCallback']);

// Routes for all users
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/password/reset', [UserController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [UserController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [UserController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [UserController::class, 'reset'])->name('password.update');
Route::get('/register/step1', [RegistrationController::class, 'step1'])->name('register');
Route::post('/register/step1', [RegistrationController::class, 'postStep1'])->name('register');
Route::get('/register/step2', [RegistrationController::class, 'step2'])->name('second-register');
Route::post('/register/step2', [RegistrationController::class, 'postStep2'])->name('second-register');
Route::get('/register/step3', [RegistrationController::class, 'step3'])->name('third-register');
Route::post('/register/step3', [RegistrationController::class, 'postStep3'])->name('third-register');

// Routes for admin login
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
