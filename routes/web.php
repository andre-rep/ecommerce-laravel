<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\FileController;

/**
 * 
 * Post routes
 * 
 */

//Auth
Route::prefix('auth')->group(function(){
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'authenticate']);
    Route::post('logout', [AuthController::class, 'logout']);
});
Route::get('activate/{mail}', [AuthController::class, 'verifyMail'])->name('activateLink')->middleware('signed');

//Mail Sending
Route::post('getPasswordRecoverLink', [MailController::class, 'getPasswordRecoverLink']);
Route::get('mail', [MailController::class, 'sendEmail']);

//Products
Route::prefix('product')->group(function(){
    Route::post('insert', [ProductController::class, 'insertProduct']);
    Route::post('insert-category-brand', [ProductController::class, 'insertCategoryOrBrand']);
    Route::post('brands-retrieve', [ProductController::class, 'retrieveBrands']);
    Route::post('update', [ProductController::class, 'updateProduct']);
    Route::post('category-update', [ProductController::class, 'updateProductCategory']);
    Route::post('brand-update', [ProductController::class, 'updateProductBrand']);
});

//Users
Route::prefix('users')->group(function(){
    Route::post('insertPhone', [UsersController::class, 'insertPhone']);
    Route::post('insertEmail', [UsersController::class, 'insertEmail']);
    Route::post('updateAddress', [UsersController::class, 'updateAddress']);
    Route::post('insertProfileImage', [UsersController::class, 'insertProfileImage']);
    Route::post('alterUserStatus', [UsersController::class, 'alterUserStatus']);
});

//Cart
Route::post('cart/add', [CartController::class, 'add']);
Route::post('cart/delete', [CartController::class, 'delete']);

//Purchase
Route::prefix('purchase')->group(function(){
    Route::post('add', [PurchaseController::class, 'add']);
    Route::post('changeStatus', [PurchaseController::class, 'changeStatus']);
    Route::post('rate', [PurchaseController::class, 'rate']);
    Route::post('changeRateCommentVisibility', [PurchaseController::class, 'changeRateCommentVisibility']);
});

//Banner
Route::post('banner/insert', [BannerController::class, 'add']);

//Gallery
Route::post('gallery/insert', [GalleryController::class, 'add']);

//Files
Route::get('retrieveFile', [FileController::class, 'fileRetrieve']);
Route::post('uploadFile', [FileController::class, 'fileUpload']);

/** 
 * 
 * Routes for pages 
 * 
 * */

//Public Pages
Route::get('/', [PagesController::class, 'main']);
Route::get('auth', [PagesController::class, 'auth']);
Route::get('recover/{mail}', [PagesController::class, 'recoverPassword'])->name('recoverPage')->middleware('signed');
Route::get('search', [PagesController::class, 'search']);
Route::get('product/{productName?}', [PagesController::class, 'product']);

//User Pages
Route::prefix('user')->group(function(){
    Route::get('edit-profile', [PagesController::class, 'editProfile']);
    Route::get('shopping-historic', [PagesController::class, 'shoppingHistoric']);
    Route::get('order/{orderNumber?}', [PagesController::class, 'order']);
    Route::get('cart', [PagesController::class, 'cart']);
    Route::get('checkout', [PagesController::class, 'checkout']);
});

//Admin Pages
Route::prefix('dashboard')->group(function(){
    Route::get('product-list', [PagesController::class, 'productList']);
    Route::get('product-categories', [PagesController::class, 'productCategories']);
    Route::get('product-add', [PagesController::class, 'productAdd']);
    Route::get('product-orders', [PagesController::class, 'productOrders']);
    Route::get('product-order-detail/{orderId?}', [PagesController::class, 'productOrderDetail']);
    Route::get('product-transactions', [PagesController::class, 'productTransactions']);
    Route::get('product-reviews', [PagesController::class, 'productReviews']);
    Route::get('product-edit/{product?}', [PagesController::class, 'productEdit']);
    Route::get('clients', [PagesController::class, 'clients']);
    Route::get('client/{email?}', [PagesController::class, 'client']);
    Route::get('main-page', [PagesController::class, 'mainPage']);
});