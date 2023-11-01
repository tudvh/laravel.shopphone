<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\OrderController;

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

Route::group(['prefix' => ''], function () {

    Route::get('/', [HomeController::class, 'home'])->name('home.index');

    Route::get('/list-product/{categorySlug}/{brandSlug}', [HomeController::class, 'categoryBrand'])->name('home.category.brand');
    Route::get('/product/{product}-{productSlug}', [HomeController::class, 'productDetail'])->name('home.product.detail');

    Route::get('/login', [LoginController::class, 'login'])->name('home.login');
    Route::post('/login', [LoginController::class, 'postLogin'])->name('home.login');

    Route::get('/logout', [LoginController::class, 'logout'])->name('home.logout');

    Route::get('/register', [LoginController::class, 'register'])->name('home.register');
    Route::post('/register', [LoginController::class, 'postRegister'])->name('home.register');

    Route::get('/checkout', [OrderController::class, 'checkout'])->name('home.checkout');
    Route::post('/checkout', [OrderController::class, 'postCheckout'])->name('home.checkout');
    Route::get('/checkout-success', [OrderController::class, 'checkoutSuccess'])->name('home.checkout.success');

    Route::get('/my-orders', [OrderController::class, 'viewOrder'])->name('home.order.view');

    Route::group(['prefix' => 'cart'], function () {

        Route::get('/', [CartController::class, 'view'])->name('cart.view');
        Route::get('/add/{product}', [CartController::class, 'add'])->name('cart.add');
        Route::get('/update/{id}/{quantity}', [CartController::class, 'update'])->name('cart.update');
        Route::get('/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
        Route::get('/clear', [CartController::class, 'clear'])->name('cart.clear');
    });

    Route::group(['prefix' => 'address'], function () {

        Route::get('/province', [AddressController::class, 'getProvince'])->name('address.province');
        Route::get('/district/{provinceID}', [AddressController::class, 'getDistrict'])->name('address.district');
        Route::get('/ward/{districtID}', [AddressController::class, 'getWard'])->name('address.ward');
    });

    Route::group(['prefix' => 'comment'], function () {

        Route::post('/create', [CommentController::class, 'create'])->name('comment.create');
        Route::post('/create-reply', [CommentController::class, 'createReply'])->name('comment.create.reply');
        Route::post('/delete', [CommentController::class, 'delete'])->name('comment.delete');
    });
});
