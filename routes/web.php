<?php

use Illuminate\Support\Facades\Route;

Route::group( ['prefix' => '/', 'as' => 'website.'], function () {

    Route::get('/', [App\Http\Controllers\WebsiteController::class, 'index'])->name('index');
    Route::get('/hora-planetaria', [App\Http\Controllers\WebsiteController::class, 'horaPlanetaria'])->name('hora-planetaria');
    Route::get('/calendario-lunar', [App\Http\Controllers\WebsiteController::class, 'calendarioLunar'])->name('calendario-lunar');
    Route::get('/planetas', [App\Http\Controllers\WebsiteController::class, 'planetas'])->name('planetas');
    Route::get('/ervas', [App\Http\Controllers\WebsiteController::class, 'ervas'])->name('ervas');
    Route::get('/ervas/{slug}', [App\Http\Controllers\WebsiteController::class, 'erva'])->name('erva');
    Route::get('/alquimias', [App\Http\Controllers\WebsiteController::class, 'alquimias'])->name('alquimias');
    Route::get('/alquimias/{slug}', [App\Http\Controllers\WebsiteController::class, 'alquimia'])->name('alquimia');
    Route::post('/alquimias/{slug}', [App\Http\Controllers\WebsiteController::class, 'comment'])->name('comentar');
    Route::get('/sobre', [App\Http\Controllers\WebsiteController::class, 'sobre'])->name('sobre');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
