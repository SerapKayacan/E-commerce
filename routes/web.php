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
Route::middleware('auth')->group(function() {

    Route::get('add_user', [UserController::class, 'create']);
    Route::get('list_user', [UserController::class, 'index']);
    Route::get('edit_user/{id}', [UserController::class, 'edit']);
    Route::get('delete_user', [UserController::class, 'destroy']);
});
Route::post('add_user', [UserController::class, 'store']);
Route::post('list_user', [UserController::class, 'create']);
Route::post('update_user/{id}', [UserController::class, 'update']);
Route::post('delete_user', [UserController::class, 'showDeletePage']);


// Categories
Route::middleware('auth')->group(function() {
    Route::get('add_category', [CategoryController::class, 'create']);
    Route::get('list_category', [CategoryController::class, 'index']);
    Route::get('edit_category', [CategoryController::class, 'edit']);
    Route::get('delete_category', [CategoryController::class, 'destroy']);
});

Route::post('add_category', [CategoryController::class, 'store']);
Route::post('list_category', [CategoryController::class, 'showListPage']);
Route::post('edit_category', [CategoryController::class,  'showEditPage']);
Route::post('delete_category', [CategoryController::class, 'showDeletePage']);

// Products
Route::middleware('auth')->group(function() {
    Route::get('add_product', [ProductController::class, 'showAddPage']);
    Route::get('list_product', [ProductController::class, 'showListPage']);
    Route::get('delete_product', [ProductController::class, 'showDeletePage']);

});

Route::post('add_product', [ProductController::class, 'add_product']);
Route::post('list_product', [ProductController::class, 'list_product']);
Route::post('delete_product', [ProductController::class, 'delete_product']);

// Registration
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Login/Logout
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Home
Route::middleware('auth')->group(function() {
    Route::get('home', [HomeController::class, 'showHomepage'])->name('home');
});
Route::post('home', [HomeController::class, 'home']);
