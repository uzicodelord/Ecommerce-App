<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
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

Route::get('/', [HomeController::class, 'index']);

Route::get('/redirect', [HomeController::class, 'redirect'])->middleware('auth','verified');

Route::get('/view_category', [AdminController::class, 'viewCategory']);

Route::post('/add_category', [AdminController::class, 'addCategory']);

Route::get('/deleteCategory/{id}', [AdminController::class, 'deleteCategory']);

Route::get('/viewProduct', [AdminController::class, 'viewProduct']);

Route::get('/showProduct', [AdminController::class, 'showProduct']);

Route::post('/add_product', [AdminController::class, 'add_product']);

Route::get('/deleteProduct/{id}', [AdminController::class, 'deleteProduct']);

Route::get('/updateProduct/{id}', [AdminController::class, 'updateProduct']);

Route::post('/updateProductConfirm/{id}', [AdminController::class, 'updateProductConfirm']);

Route::get('/orders', [AdminController::class, 'orders']);

Route::get('/delivered/{id}', [AdminController::class, 'delivered']);

Route::get('/sendmail/{id}', [AdminController::class, 'sendmail']);

Route::post('/sendmailR/{id}', [AdminController::class, 'sendmailR']);

Route::get('/orders/search', [AdminController::class, 'searchOrders'])->name('admin.orders.search');


//Home Routes

Route::get('/product-details/{id}', [HomeController::class, 'productDetails']);

Route::post('/add-to-cart/{id}', [HomeController::class, 'addToCart']);

Route::get('/cart', [HomeController::class, 'showCart']);

Route::get('/remove-from-cart/{id}', [HomeController::class, 'removefromCart']);

Route::get('/payment', [HomeController::class, 'payment']);

Route::get('/stripe/{totalprice}', [HomeController::class, 'stripe']);

Route::post('stripe/{totalprice}', [HomeController::class, 'stripePost'])->name('stripe.post');

Route::get('/search', [HomeController::class, 'search'])->name('search');

//Contact Routes

Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// Category Routes
Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
Route::get('/categories/{categoryName}', [CategoryController::class, 'show'])->name('category.show');

// Product reviews
Route::post('product/{product}/review', [ProductController::class, 'storeReview'])->name('product.review.store');

// Product ratings
Route::post('product/{product}/rating', [ProductController::class, 'storeRating'])->name('product.rating.store');
