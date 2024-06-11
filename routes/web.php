<?php

use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ScrollTextController;
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

    Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements');
    Route::get('/announcements/add', [AnnouncementController::class, 'add'])->name('announcements.add');
    Route::post('/announcements/add', [AnnouncementController::class, 'store'])->name('announcements.store');
    Route::get('/announcements/edit/{id}', [AnnouncementController::class, 'edit'])->name('announcements.edit');
    Route::post('/announcements/edit/{id}', [AnnouncementController::class, 'update'])->name('announcements.update');
    Route::post('/announcements/delete', [AnnouncementController::class, 'delete'])->name('announcements.delete');
    Route::post('/announcements/remove-attachment/{id}', [AnnouncementController::class, 'removeAttachment'])->name('announcements.remove-attachment');

    Route::get('/events', [EventController::class, 'index'])->name('events');
    Route::get('/events/add', [EventController::class, 'add'])->name('events.add');
    Route::post('/events/add', [EventController::class, 'store'])->name('events.store');
    Route::post('/events/delete', [EventController::class, 'delete'])->name('events.delete');

    Route::get('/scroll-texts', [ScrollTextController::class, 'index'])->name('scroll-texts');
    Route::get('/scroll-texts/add', [ScrollTextController::class, 'add'])->name('scroll-texts.add');
    Route::post('/scroll-texts/add', [ScrollTextController::class, 'store'])->name('scroll-texts.store');
    Route::post('/scroll-texts/delete', [ScrollTextController::class, 'delete'])->name('scroll-texts.delete');
});

Route::group(['middleware' => ['auth:sanctum', 'role:admin'], 'prefix' => '/image', 'as' => 'image.'], function () {
    Route::get('/list', [ImageController::class, 'list'])->name('list');
    Route::post('/upload', [ImageController::class, 'upload'])->name('upload')->withoutMiddleware(VerifyCsrfToken::class);
    Route::post('/delete', [ImageController::class, 'delete'])->name('delete')->withoutMiddleware(VerifyCsrfToken::class);
});

Route::get('/', [FrontendController::class, 'home'])
    ->name('home');

Route::get('/{slug}', [FrontendController::class, 'page'])->name('page');
Route::get('/announcement/{id}', [FrontendController::class, 'announcement'])->name('announcement.view');
Route::get('/event/{id}', [FrontendController::class, 'event'])->name('event.view');
