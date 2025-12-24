<?php

use App\Http\Controllers\BasicController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VendingController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Console\Completion\Output\BashCompletionOutput;

Route::get('/', [VendingController::class, 'showAll'])->name('home');
Route::get('/home', [App\Http\Controllers\VendingController::class, 'showAll'])->name('home');

Route::get('/products', [ProductController::class, 'showAll'])->name('products');

Route::get('/adduser', [BasicController::class, 'authpage'])->name('authpage');

Route::post('/adduser', [BasicController::class, 'submit'])->name('authpage.post');

Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

//Route::get('/product/{id}/{item}', [BasicController::class, 'home'])->name('item');

Route::middleware(['auth'])->group(function () {
    // Архивация/восстановление
    Route::patch('/product/{id}/archive', [ProductController::class, 'archive'])->name('product.archive');
    Route::patch('/product/{id}/restore', [ProductController::class, 'restore'])->name('product.restore');
    Route::patch('/product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');

    // Получение информации о продукте
    Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

    Route::middleware(['auth','admin'])->group(function () {
        Route::delete('/product/{id}/permanent', [ProductController::class, 'permanentDelete'])->name('product.permanent');
    });
});

Auth::routes();
