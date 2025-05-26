<?php

use App\Http\Controllers\DeliveryMethodController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use LivewireFilemanager\Filemanager\Http\Controllers\Files\FileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified', 'role:administrator'])->prefix('dashboard')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('user.index');

    Route::get('/filemanager', function (){
        return view('FileManager.view');
    })->name('filemanager');

    Route::get('/products', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::get('/product/edit/{product}', [ProductController::class, 'edit'])->name('product.edit');

    Route::get('/delivery-methods', [DeliveryMethodController::class, 'index'])->name('delivery-method.index');
    Route::get('/delivery-method/create', [DeliveryMethodController::class, 'create'])->name('delivery-method.create');
    Route::get('/delivery-method/edit/{deliveryMethod}', [DeliveryMethodController::class, 'edit'])->name('delivery-method.edit');

    Route::get('/payment-methods', [PaymentMethodController::class, 'index'])->name('payment-method.index');
    Route::get('/payment-method/create', [PaymentMethodController::class, 'create'])->name('payment-method.create');
    Route::get('/payment-method/edit/{paymentMethod}', [PaymentMethodController::class, 'edit'])->name('payment-method.edit');

    Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
    Route::get('/order/create', [OrderController::class, 'create'])->name('order.create');
    Route::get('/order/edit/{order}', [OrderController::class, 'edit'])->name('order.edit');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
Route::get('{path}', [FileController::class, 'show'])->where('path', '.*')->name('assets.show');
