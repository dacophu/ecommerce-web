<?php

use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\CountryController;
use App\Http\Controllers\frontend\AccountController;
use App\Http\Controllers\frontend\BlogController as FrontendBlogController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\frontend\CheckoutController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\LoginController;
use App\Http\Controllers\frontend\ProductController;
use App\Http\Controllers\frontend\RegisterController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//frontend
Route::get('/', [HomeController::class, 'index']);

Route::get('/member/login', [LoginController::class, 'index']);
Route::post('/member/login', [LoginController::class, 'login']);

Route::get('/member/register', [RegisterController::class, 'index']);
Route::post('/member/register', [RegisterController::class, 'register']);

Route::get('/blog', [FrontendBlogController::class, 'index']);
Route::get('/blog/page/{page}', [FrontendBlogController::class, 'changePage']);
Route::get('/blog/{id}', [FrontendBlogController::class, 'index2']);

Route::post('blog/rate/ajax', [FrontendBlogController::class, 'rate']);
Route::post('blog/comment/ajax', [FrontendBlogController::class, 'comment']);

Route::get('/account', [AccountController::class, 'index']);
Route::post('/account/update', [AccountController::class, 'update']);
Route::get('/account/my-product', [AccountController::class, 'myProduct']);
Route::get('/account/add-product', [ProductController::class, 'add']);
Route::post('/account/add-product', [ProductController::class, 'create']);
Route::get('/account/edit-product/{id}', [ProductController::class, 'edit']);
Route::post('/account/edit-product/{id}', [ProductController::class, 'update']);
Route::get('/account/delete-product/{id}', [ProductController::class, 'delete']);
Route::get('/product-details/{id}', [ProductController::class, 'index']);
Route::post('/product/add-to-cart/ajax', [ProductController::class, 'addToCart']);

Route::get('/cart', [CartController::class, 'index']);
Route::post('/cart/update-quantity/ajax', [CartController::class, 'updateQty']);
Route::post('/cart/delete/ajax', [CartController::class, 'delete']);

Route::get('/checkout', [CheckoutController::class, 'index']);

//Admin
Route::get('/admin/dashboard', [DashboardController::class, 'index']);

Route::get('/admin/profile', [UserController::class, 'index']);
Route::post('/admin/profile', [UserController::class, 'update']);

Route::get('/admin/country', [CountryController::class, 'index']);
Route::get('/admin/country/add', [CountryController::class, 'add']);
Route::post('/admin/country/add', [CountryController::class, 'insert']);

Route::get('admin/country/delete/{id}', [CountryController::class, 'delete']);

Route::get('admin/blog', [BlogController::class, 'index']);
Route::get('admin/blog/add', [BlogController::class, 'add']);
Route::post('admin/blog/add', [BlogController::class, 'insert']);
Route::get('admin/blog/edit/{id}', [BlogController::class, 'edit']);
Route::post('admin/blog/edit/{id}', [BlogController::class, 'update']);
Route::get('admin/blog/delete/{id}', [BlogController::class, 'delete']);
