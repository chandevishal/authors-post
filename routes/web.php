<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return redirect('posts');
});

Auth::routes();

//change password
Route::get('/change-password', [App\Http\Controllers\Auth\ChangePasswordController::class, 'index'])->name('password.change.index');
Route::post('/change-password', [App\Http\Controllers\Auth\ChangePasswordController::class, 'changePassword'])->name('password.change.update');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//post resource routes
Route::resource('posts', App\Http\Controllers\PostController::class);

//comments routes
Route::post('/comment', [App\Http\Controllers\CommentController::class, 'storeComment'])->name('comment.store');
