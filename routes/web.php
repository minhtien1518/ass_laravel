<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;

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
Route::get('/', [UserController::class, 'index'])->name('index')->middleware('auth');
Route::prefix('/users')->name('users.')->middleware('auth')->group(function () {
    Route::get('', [UserController::class, 'index'])->name('index')->middleware('auth');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/store', [UserController::class, 'store'])->name('store');
    Route::get('/edit/{id}',[UserController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [UserController::class, 'update'])->name('update');
    Route::delete('/{cate}', [UserController::class, 'delete'])->name('delete');
    
  });
Route::prefix('/categories')->name('categories.')->middleware('auth')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('/create', [CategoryController::class, 'create'])->name('create');
    Route::post('/create', [CategoryController::class, 'store'])->name('post-create');
    Route::get('/edit/{id}',[CategoryController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [CategoryController::class, 'update'])->name('post-update');
    Route::delete('/{cate}', [CategoryController::class, 'delete'])->name('delete');
    
  });
  Route::prefix('/products')->name('products.')->middleware('auth')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/create', [ProductController::class, 'create'])->name('create');
    Route::post('/store', [ProductController::class, 'store'])->name('store');
    Route::get('/edit/{id}',[ProductController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [ProductController::class, 'update'])->name('update');
    Route::delete('/{cate}', [ProductController::class, 'delete'])->name('delete');
    
    
  });
  Route::prefix('/login')->name('login.')->group(function () {
    Route::get('/', [LoginController::class, 'getLogin'])->name('index');
    Route::post('/check', [LoginController::class, 'postLogin'])->name('check');

  });
  Route::get('/logout', [LoginController::class, 'getLogout'])->name('logout');

