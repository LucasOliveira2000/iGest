<?php

use App\Http\Controllers\ContatoController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;



Route::get('/index', function () {

    $logado = Auth::check();

    return Inertia::render('Site/Index.vue',[
        'logado' => $logado,
    ]);
})->name('site.index');


Route::controller(UserController::class)->group( function(){
    Route::get('/user/create', 'create')->name('user.create');
    Route::post('/user', 'register')->name('user.register');
    Route::get('/login', 'index')->name('login.index');
    Route::post('/login/store', 'store')->name('login.store');
    Route::post('/logout/destroy', 'destroy')->name('login.destroy');
});

Route::middleware(['autenticador', 'verified'])->controller(ProdutoController::class)->group( function() {
    Route::get('/produto', 'home')->name('produto.home');
    Route::get('/create', 'create')->name('produto.create');
    Route::get('/produto/search', 'search')->name('produto.search');
    Route::post('/store', 'store')->name('produto.store');
    Route::get('/produto/edit/{id}', 'edit')->name('produto.edit');
    Route::post('/produto/update/{id}', 'update')->name('produto.update');
    Route::delete('/produto/{id}', 'destroy')->name('produto.destroy');
});

Route::middleware(['autenticador', 'verified'])->controller(ContatoController::class)->group( function() {
    Route::get('/contato/create', 'create')->name('contato.create');
    Route::post('/contato/store', 'store')->name('contato.store');
});

Route::fallback( function () {
    return Inertia::render('Site/Index.vue');
});
