<?php

use App\Http\Controllers\DashboardController;
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
})->name('home');



Route::middleware(['auth'])->prefix('dashboard')->group(function () {
    Route::get('/',                     [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');
    Route::get('/orders',               [OrderController::class, 'index'])->name('order.index');
    Route::get('/order/edit/{order}',   [OrderController::class, 'edit'])->name('order.edit');
});

Route::middleware(['auth', 'role:administrator'])->prefix('dashboard')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('user.index');

    Route::get('/filemanager', function (){
        return view('FileManager.view');
    })->name('filemanager');

    Route::get('/products', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/trash', [ProductController::class, 'index'])->name('product.index.trash');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::get('/product/edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
    Route::get('/product/delete/{product}/{redirect?}', [ProductController::class, 'destroy'])->name('product.delete');
    Route::get('/product/delete/permanent/{product}/{redirect?}', [ProductController::class, 'destroyPermanent'])->name('product.deletePermanent');
    Route::get('/product/restore/{product}/{redirect?}', [ProductController::class, 'restore'])->name('product.restore');

    Route::get('/delivery-methods', [DeliveryMethodController::class, 'index'])->name('delivery-method.index');
    Route::get('/delivery-methods/trash', [DeliveryMethodController::class, 'index'])->name('delivery-method.index.trash');
    Route::get('/delivery-method/create', [DeliveryMethodController::class, 'create'])->name('delivery-method.create');
    Route::get('/delivery-method/edit/{deliveryMethod}', [DeliveryMethodController::class, 'edit'])->name('delivery-method.edit');
    Route::get('/delivery-method/delete/{deliveryMethod}/{redirect?}', [DeliveryMethodController::class, 'destroy'])->name('delivery-method.delete');
    Route::get('/delivery-method/delete/permanent/{deliveryMethod}/{redirect?}', [DeliveryMethodController::class, 'destroyPermanent'])->name('delivery-method.deletePermanent');
    Route::get('/delivery-method/restore/{deliveryMethod}/{redirect?}', [DeliveryMethodController::class, 'restore'])->name('delivery-method.restore');

    Route::get('/payment-methods', [PaymentMethodController::class, 'index'])->name('payment-method.index');
    Route::get('/payment-methods/trash', [PaymentMethodController::class, 'index'])->name('payment-method.index.trash');
    Route::get('/payment-method/create', [PaymentMethodController::class, 'create'])->name('payment-method.create');
    Route::get('/payment-method/edit/{paymentMethod}', [PaymentMethodController::class, 'edit'])->name('payment-method.edit');
    Route::get('/payment-method/delete/{paymentMethod}/{redirect?}', [PaymentMethodController::class, 'destroy'])->name('payment-method.delete');
    Route::get('/payment-method/delete/permanent/{paymentMethod}/{redirect?}', [PaymentMethodController::class, 'destroyPermanent'])->name('payment-method.deletePermanent');
    Route::get('/payment-method/restore/{paymentMethod}/{redirect?}', [PaymentMethodController::class, 'restore'])->name('payment-method.restore');

    Route::get('/orders/trash', [OrderController::class, 'index'])->name('order.index.trash');
    Route::get('/order/create', [OrderController::class, 'create'])->name('order.create');
    Route::get('/order/delete/{order}/{redirect?}', [OrderController::class, 'destroy'])->name('order.delete');
    Route::get('/order/delete/permanent/{order}/{redirect?}', [OrderController::class, 'destroyPermanent'])->name('order.deletePermanent');
    Route::get('/order/restore/{order}/{redirect?}', [OrderController::class, 'restore'])->name('order.restore');
});

Route::get('/order/checkout', [OrderController::class, 'checkout'])->name('order.checkout');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
Route::get('{path}', [FileController::class, 'show'])->where('path', '.*')->name('assets.show');
