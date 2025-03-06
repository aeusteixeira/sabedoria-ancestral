<?php

use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\HerbController;
use App\Http\Controllers\AlchemyController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Services\PlantNetService;
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['prefix' => '/', 'as' => 'website.'], function () {

    // 🏠 Páginas Principais
    Route::get('/', [WebsiteController::class, 'index'])->name('index');
    Route::get('/hora-planetaria', [WebsiteController::class, 'horaPlanetaria'])->name('hora-planetaria');
    Route::get('/calendario-lunar', [WebsiteController::class, 'calendarioLunar'])->name('calendario-lunar');
    Route::get('/planetas', [WebsiteController::class, 'planetas'])->name('planetas');
    Route::get('/sobre', [WebsiteController::class, 'sobre'])->name('sobre');

    // 🌿 Ervas
    Route::get('/ervas', [HerbController::class, 'index'])->name('herb.index');
    Route::get('/ervas/criar', [HerbController::class, 'create'])->name('herb.create');
    Route::post('/ervas', [HerbController::class, 'store'])->name('herb.store');
    Route::get('/ervas/{slug}', [HerbController::class, 'show'])->name('herb.show');
    Route::get('/ervas/{slug}/edit', [HerbController::class, 'edit'])->name('herb.edit');
    Route::put('/ervas/{slug}', [HerbController::class, 'update'])->name('herb.update');
    Route::delete('/ervas/{slug}', [HerbController::class, 'destroy'])->name('herb.destroy');

    // 🔮 Alquimias
    Route::get('/alquimias', [AlchemyController::class, 'index'])->name('alchemy.index');
    Route::get('/alquimias/criar', [AlchemyController::class, 'create'])->name('alchemy.create');
    Route::get('/alquimias/{slug}', [AlchemyController::class, 'show'])->name('alchemy.show');
    Route::post('/alquimias', [AlchemyController::class, 'store'])->name('alchemy.store');
    Route::get('/alquimias/{slug}/edit', [AlchemyController::class, 'edit'])->name('alchemy.edit');
    Route::put('/alquimias/{slug}', [AlchemyController::class, 'update'])->name('alchemy.update');
    Route::delete('/alquimias/{slug}', [AlchemyController::class, 'destroy'])->name('alchemy.destroy');

    // 💬 Comentários
    Route::post('/alquimias/{slug}/comentar', [AlchemyController::class, 'comment'])->name('alchemy.comment');

    // 💼 Serviços
    Route::get('/servicos', [ServiceController::class, 'index'])->name('service.index');
    Route::get('/servicos/criar', [ServiceController::class, 'create'])->name('service.create');
    Route::get('/servicos/{slug}', [ServiceController::class, 'show'])->name('service.show');
    Route::post('/servicos', [ServiceController::class, 'store'])->name('service.store');
    Route::get('/servicos/{slug}/edit', [ServiceController::class, 'edit'])->name('service.edit');
    Route::put('/servicos/{slug}', [ServiceController::class, 'update'])->name('service.update');
    Route::delete('/servicos/{slug}', [ServiceController::class, 'destroy'])->name('service.destroy');

    // 👤 Perfis de Usuários
    Route::get('/perfil/{username}', [ProfileController::class, 'index'])->name('profile.index');
});
