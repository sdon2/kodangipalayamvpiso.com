<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\FrontendController;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'role:admin'])->name('dashboard');

Route::group(['middleware' => ['auth:sanctum', 'role:admin'], 'prefix' => '/admin', 'as' => 'admin.'], function () {
    Route::get('/pages', [PageController::class, 'index'])->name('pages');
    Route::get('/pages/add', [PageController::class, 'add'])->name('pages.add');
    Route::post('/pages/add', [PageController::class, 'store'])->name('pages.store');
    Route::get('/pages/edit/{id}', [PageController::class, 'edit'])->name('pages.edit');
    Route::post('/pages/edit/{id}', [PageController::class, 'update'])->name('pages.update');
    Route::post('/pages/delete', [PageController::class, 'delete'])->name('pages.delete');

    Route::get('/sliders', [SliderController::class, 'index'])->name('sliders');
    Route::get('/sliders/add', [SliderController::class, 'add'])->name('sliders.add');
    Route::post('/sliders/add', [SliderController::class, 'store'])->name('sliders.store');
    Route::post('/sliders/delete', [SliderController::class, 'delete'])->name('sliders.delete');
});

Route::group(['middleware' => ['auth:sanctum', 'role:admin'], 'prefix' => '/image', 'as' => 'image.'], function () {
    Route::get('/list', [ImageController::class, 'list'])->name('list');
    Route::post('/upload', [ImageController::class, 'upload'])->name('upload')->withoutMiddleware(VerifyCsrfToken::class);
    Route::post('/delete', [ImageController::class, 'delete'])->name('delete')->withoutMiddleware(VerifyCsrfToken::class);
});

Route::get('/', [FrontendController::class, 'home'])
    ->name('home');

Route::get('/{slug}', [FrontendController::class, 'page'])->name('page');
