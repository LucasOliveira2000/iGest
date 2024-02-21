<?php

use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::controller(ProdutoController::class)->group( function () {
    Route::get('/', 'index')->name('site.index');
    Route::get('/produto' , 'home')->name('produto.home');
    Route::get('/create' , 'create')->name('produto.create');
    Route::post('/store' , 'store')->name('produto.store');
    Route::delete('/produto/{id}', 'destroy')->name('produto.destroy');
});

Route::fallback( function () {
    return Inertia::render('Site/Index.vue');
});
