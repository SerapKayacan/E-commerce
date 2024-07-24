<?php

use App\Http\Controllers\DefaultController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\User\UserController;

// Users
Route::middleware('auth')->group(function () {
    Route::name('user.')->prefix('user')->group(function () {
        Route::get('/add', [UserController::class, 'create'])->name('add');
        Route::get('/list', [UserController::class, 'index'])->name('list');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::get('/delete/{id}', [UserController::class, 'destroy'])->name('delete');

        Route::post('/add', [UserController::class, 'store'])->name('store');
        Route::post('/list', [UserController::class, 'create'])->name('list');
        Route::post('/update/{id}', [UserController::class, 'update'])->name('update');
    });
});


// Categories
Route::middleware('auth')->group(function () {
    Route::name('category.')->prefix('category')->group(function () {
        Route::get('/add', [CategoryController::class, 'create'])->name('add');
        Route::get('/list', [CategoryController::class, 'index'])->name('list');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
        Route::get('/delete/{id}', [CategoryController::class, 'destroy'])->name('delete');


        Route::post('/add', [CategoryController::class, 'store'])->name('store');
        Route::post('/list', [CategoryController::class, 'create'])->name('list');
        Route::post('/update/{id}', [CategoryController::class,  'update'])->name('update');
    });
});

// Products
Route::middleware('auth')->group(function () {
    Route::name('product.')->prefix('product')->group(function () {
        Route::get('/add', [ProductController::class, 'create'])->name('add');
        Route::get('/list', [ProductController::class, 'index'])->name('list');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit');
        Route::get('/delete/{id}', [ProductController::class, 'destroy'])->name('delete');

        Route::post('/add', [ProductController::class, 'store'])->name('store');
        Route::post('/list', [ProductController::class, 'create'])->name('list');
        Route::post('/update/{id}', [ProductController::class, 'update'])->name('update');
    });
});


// Registration
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Login/Logout
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Home
Route::middleware('auth')->group(function () {
    Route::get('home', [HomeController::class, 'showHomepage'])->name('home');
});
