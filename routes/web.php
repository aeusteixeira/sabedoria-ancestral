<?php

use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\HerbController;
use App\Http\Controllers\AlchemyController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\XPController;
use App\Http\Controllers\AspectCalculatorController;
use Illuminate\Support\Facades\Route;
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['prefix' => '/', 'as' => 'website.'], function () {

    // 🏠 Páginas Principais
    Route::get('/', [WebsiteController::class, 'index'])->name('index');
    Route::get('/hora-planetaria', [WebsiteController::class, 'horaPlanetaria'])->name('hora-planetaria');
    Route::get('/calendario-lunar', [WebsiteController::class, 'calendarioLunar'])->name('calendario-lunar');
    Route::get('/planetas', [WebsiteController::class, 'planetas'])->name('planetas');
    Route::get('/numeros-misticos', [WebsiteController::class, 'numerosMisticos'])->name('numeros-misticos');
    Route::get('/elementos', action: [WebsiteController::class, 'elementos'])->name('elementos');
    Route::get('/chakras', [WebsiteController::class, 'chakras'])->name('chakras');
    Route::get('/sobre', [WebsiteController::class, 'sobre'])->name('sobre');

    // 🌿 Ervas
    Route::get('/ervas', [HerbController::class, 'index'])->name('herb.index');
    Route::get('/ervas/criar', [HerbController::class, 'create'])->name('herb.create');
    Route::post('/ervas', [HerbController::class, 'store'])->name('herb.store');
    Route::get('/ervas/{slug}', [HerbController::class, 'show'])->name('herb.show');
    Route::get('/ervas/{slug}/edit', [HerbController::class, 'edit'])->name('herb.edit');
    Route::put('/ervas/{id}', [HerbController::class, 'update'])->name('herb.update');
    Route::delete('/ervas/{id}', [HerbController::class, 'destroy'])->name('herb.destroy');

    // 🔮 Alquimias
    Route::get('/alquimias', [AlchemyController::class, 'index'])->name('alchemy.index');
    Route::get('/alquimias/criar', [AlchemyController::class, 'create'])->name('alchemy.create');
    Route::get('/alquimias/{slug}', [AlchemyController::class, 'show'])->name('alchemy.show');
    Route::post('/alquimias', [AlchemyController::class, 'store'])->name('alchemy.store');
    Route::get('/alquimias/{slug}/edit', [AlchemyController::class, 'edit'])->name('alchemy.edit');
    Route::put('/alquimias/{slug}', [AlchemyController::class, 'update'])->name('alchemy.update');
    Route::delete('/alquimias/{id}', [AlchemyController::class, 'destroy'])->name('alchemy.destroy');

    // 💬 Comentários
    Route::post('/alquimias/{slug}/comentar', [AlchemyController::class, 'comment'])->name('alchemy.comment');
    Route::post('/servicos/{slug}/comentar', [ServiceController::class, 'comment'])->name('service.comment');

    // 💼 Serviços
    Route::get('/servicos', [ServiceController::class, 'index'])->name('service.index');
    Route::get('/servicos/criar', [ServiceController::class, 'create'])->name('service.create');
    Route::get('/servicos/{slug}', [ServiceController::class, 'show'])->name('service.show');
    Route::post('/servicos', [ServiceController::class, 'store'])->name('service.store');
    Route::get('/servicos/{slug}/edit', [ServiceController::class, 'edit'])->name('service.edit');
    Route::put('/servicos/{slug}', [ServiceController::class, 'update'])->name('service.update');
    Route::delete('/servicos/{slug}', [ServiceController::class, 'destroy'])->name('service.destroy');

    // Mensagens
    // Route::get('/profile/messages', [ProfileController::class, 'messages'])->name('profile.messages');
    // Route::post('/profile/messages/{conversationId}', [ProfileController::class, 'sendMessage'])->name('profile.message');

    // 👤 Perfis de Usuários
    Route::get('/perfil/{username}', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/perfil/{username}/editar', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/perfil/{username}', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/perfil/{username}/configuracoes', [ProfileController::class, 'settings'])->name('profile.settings');

    // Rotas da Calculadora de Aspectos
    Route::get('/aspects', [AspectCalculatorController::class, 'index'])->name('aspects.index');
    Route::post('/aspects/calculate', [AspectCalculatorController::class, 'calculate'])->name('aspects.calculate');
});

Route::middleware(['auth'])->group(function () {
    // Rotas do sistema de XP
    Route::post('/xp/add', [XPController::class, 'addXP'])->name('xp.add');
    Route::get('/xp/history', [XPController::class, 'getHistory'])->name('xp.history');

    // Rotas do perfil
    Route::get('/profile/{username}', [ProfileController::class, 'index'])->name('website.profile.index');
    Route::get('/profile/{username}/edit', [ProfileController::class, 'edit'])->name('website.profile.edit');
    Route::put('/profile/{username}', [ProfileController::class, 'update'])->name('website.profile.update');
    Route::get('/profile/{username}/settings', [ProfileController::class, 'settings'])->name('website.profile.settings');

    // Seguir/Deixar de seguir
    Route::post('/profile/{username}/follow', [ProfileController::class, 'follow'])->name('website.profile.follow');
    Route::delete('/profile/{username}/unfollow', [ProfileController::class, 'unfollow'])->name('website.profile.unfollow');


});
