<?php

use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\CountryController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

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
