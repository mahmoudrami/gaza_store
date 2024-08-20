<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\NotificationController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::prefix(LaravelLocalization::setLocale())->group(function(){
    Route::prefix('admin')->middleware(['auth', 'is_admin','verified'])->name('admin.')->group(function(){
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::get('edit', [AdminController::class, 'edit'])->name('edit');
        Route::put('edit', [AdminController::class, 'editProfile'])->name('editProfile');
        Route::post('checkPassword', [AdminController::class, 'checkPassword'])->name('checkPassword');

        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);

        Route::get('orders', [AdminController::class, 'orders'])->name('orders');
        // الحين ليش خليت الرقم مش اجباري عشان اقدر اكون تربط في جافاسكربت يعني موحود ب حذف الصورة في  نعديل
        Route::get('delete-img/{id?}',[ProductController::class, 'delete_img'])->name('delete_img');

        Route::get('notifiycations', [NotificationController::class, 'notifications'])->name('notifications');
    });

});
