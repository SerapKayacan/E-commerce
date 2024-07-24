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

    Route::get('add_user', [UserController::class, 'create']);
    Route::get('list_user', [UserController::class, 'index']);
    Route::get('edit_user/{id}', [UserController::class, 'edit']);
    Route::get('delete_user/{id}', [UserController::class, 'destroy']);
});
Route::post('add_user', [UserController::class, 'store']);
Route::post('list_user', [UserController::class, 'create']);
Route::post('update_user/{id}', [UserController::class, 'update']);
Route::post('delete_user/{id}', [UserController::class, 'destroy']);


// Categories
Route::middleware('auth')->group(function () {
    Route::get('add_category', [CategoryController::class, 'create']);
    Route::get('list_category', [CategoryController::class, 'index']);
    Route::get('edit_category/{id}', [CategoryController::class, 'edit']);
    Route::get('delete_category/{id}', [CategoryController::class, 'destroy']);
});

Route::post('add_category', [CategoryController::class, 'store']);
Route::post('list_category', [CategoryController::class, 'create']);
Route::post('update_category/{id}', [CategoryController::class,  'update']);

// Products
Route::middleware('auth')->group(function () {
    Route::get('add_product', [ProductController::class, 'create']);
    Route::get('list_product', [ProductController::class, 'index']);
    Route::get('edit_product/{id}', [ProductController::class, 'edit']);
    Route::get('delete_product/{id}', [ProductController::class, 'destroy']);

    Route::post('add_product', [ProductController::class, 'store']);
    Route::post('list_product', [ProductController::class, 'create']);
    Route::post('update_product/{id}', [ProductController::class, 'update']);
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



