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

//Auth
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'authenticate']);
Route::post('logout', [AuthController::class, 'logout']);
Route::get('activate/{mail}', [AuthController::class, 'verifyMail'])->name('activateLink')->middleware('signed');

//Mail Sending
Route::post('getPasswordRecoverLink', [MailController::class, 'getPasswordRecoverLink']);
Route::get('mail', [MailController::class, 'sendEmail']);

//Products
Route::post('product/insert', [ProductController::class, 'insertProduct']);
Route::post('category-brand/insert', [ProductController::class, 'insertCategoryOrBrand']);
Route::post('brands/retrieve', [ProductController::class, 'retrieveBrands']);
Route::post('product/update', [ProductController::class, 'updateProduct']);
Route::post('productCategory/update', [ProductController::class, 'updateProductCategory']);
Route::post('productBrand/update', [ProductController::class, 'updateProductBrand']);

//Users
Route::post('users/insertPhone', [UsersController::class, 'insertPhone']);
Route::post('users/insertEmail', [UsersController::class, 'insertEmail']);
Route::post('users/updateAddress', [UsersController::class, 'updateAddress']);
Route::post('users/insertProfileImage', [UsersController::class, 'insertProfileImage']);
Route::post('users/alterUserStatus', [UsersController::class, 'alterUserStatus']);

//Cart
Route::post('cart/add', [CartController::class, 'add']);
Route::post('cart/delete', [CartController::class, 'delete']);

//Purchase
Route::post('purchase/add', [PurchaseController::class, 'add']);
Route::post('puchase/changeStatus', [PurchaseController::class, 'changeStatus']);
Route::post('purchase/rate', [PurchaseController::class, 'rate']);
Route::post('purchase/changeRateCommentVisibility', [PurchaseController::class, 'changeRateCommentVisibility']);

//Banner
Route::post('banner/insert', [BannerController::class, 'add']);

//Gallery
Route::post('gallery/insert', [GalleryController::class, 'add']);

//Files
Route::get('retrieveFile', [FileController::class, 'fileRetrieve']);
Route::post('uploadFile', [FileController::class, 'fileUpload']);

//Public Pages
Route::get('/', [PagesController::class, 'main']);
Route::get('auth', [PagesController::class, 'auth']);
Route::get('recover/{mail}', [PagesController::class, 'recoverPassword'])->name('recoverPage')->middleware('signed');
Route::get('search', [PagesController::class, 'search']);
Route::get('product/{productName?}', [PagesController::class, 'product']);
//User Pages
Route::get('user/edit-profile', [PagesController::class, 'editProfile']);
Route::get('user/shopping-historic', [PagesController::class, 'shoppingHistoric']);
Route::get('user/order/{orderNumber?}', [PagesController::class, 'order']);
Route::get('cart', [PagesController::class, 'cart']);
Route::get('checkout', [PagesController::class, 'checkout']);
//Admin Pages
Route::get('dashboard/product-list', [PagesController::class, 'productList']);
Route::get('dashboard/product-categories', [PagesController::class, 'productCategories']);
Route::get('dashboard/product-add', [PagesController::class, 'productAdd']);
Route::get('dashboard/product-orders', [PagesController::class, 'productOrders']);
Route::get('dashboard/product-order-detail/{orderId?}', [PagesController::class, 'productOrderDetail']);
Route::get('dashboard/product-transactions', [PagesController::class, 'productTransactions']);
Route::get('dashboard/product-reviews', [PagesController::class, 'productReviews']);
Route::get('dashboard/product-edit/{product?}', [PagesController::class, 'productEdit']);
Route::get('dashboard/clients', [PagesController::class, 'clients']);
Route::get('dashboard/client/{email?}', [PagesController::class, 'client']);
Route::get('dashboard/main-page', [PagesController::class, 'mainPage']);