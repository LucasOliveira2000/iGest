<?php

use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;



Route::controller(UserController::class)->group( function(){
    Route::get('/user/create', 'create')->name('user.create');
    Route::post('/user', 'register')->name('user.register');
    Route::get('/login', 'index')->name('login.index');
    Route::post('/login/store', 'store')->name('login.store');
});

Route::controller(ProdutoController::class)->group( function () {
    Route::get('/index', 'index')->name('site.index');
    Route::get('/produto' , 'home')->name('produto.home');
    Route::get('/create' , 'create')->name('produto.create');
    Route::post('/store' , 'store')->name('produto.store');
    Route::delete('/produto/{id}', 'destroy')->name('produto.destroy');
});

Route::fallback( function () {
    return Inertia::render('Site/Index.vue');
});
