<?php

use App\Http\Controllers\AnnounceController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/test', [MainController::class, 'test'])->name('test');
Route::get('/', [MainController::class, 'index'])->name('index');
Route::get('/search', [MainController::class, 'index'])->name('search');
Route::get('/terms', [MainController::class, 'index'])->name('terms');
Route::get('/users', [MainController::class, 'index'])->name('users');

Route::get('/forums/{slug}', [ForumController::class, 'show'])->name('forum');
Route::get('/topics/{topic:id}', [TopicController::class, 'show'])->name('topic');

Route::get('/bt/announce/{passkey}', [AnnounceController::class, 'index'])->name('announce');

/**
 * Upload
 */
Route::get('/test/upload', [MainController::class, 'showForm'])->name('upload');
Route::post('/test/upload', [MainController::class, 'test']);

Route::middleware('auth')->group(function () {
    Route::get('/posting/{forum:id}', [ForumController::class, 'showForm'])->name('add-topic');
    Route::post('/posting/{forum:id}', [ForumController::class, 'storeTopic']);
    Route::post('/topics/reply', [TopicController::class, 'storeReply'])->name('topic_reply');
    Route::get('/tracker', [MainController::class, 'index'])->name('tracker');
    Route::get('/groups', [MainController::class, 'index'])->name('groups');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('user');
    Route::get('/user/settings', [MainController::class, 'index'])->name('settings');
});
