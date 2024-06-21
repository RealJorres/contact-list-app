<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Redis;

// Landing page route
Route::view('/', 'welcome');

// Authentication routes handled by Laravel Breeze
require __DIR__.'/auth.php';

// Dashboard route
Route::middleware(['auth', 'verified'])
    ->get('dashboard', [ContactController::class, 'index'])
    ->name('dashboard');

// Profile route
Route::view('profile', 'profile')->middleware('auth')->name('profile');



// Contact management routes, protected by auth middleware
Route::middleware(['auth'])->group(function () {
    Route::resource('contacts', ContactController::class);
    Route::get('contacts-trashed', [ContactController::class, 'trashed'])->name('contacts-trashed');
    Route::get('contacts/{id}/restore', [ContactController::class, 'restore'])->name('contacts.restore');
    Route::get('contacts/{id}/forceDelete', [ContactController::class, 'forceDelete'])->name('contacts.forceDelete');
});

// Trashed Contacts route
Route::middleware(['auth', 'verified'])
    ->get('contacts-trashed', [ContactController::class, 'trashed'])
    ->name('contacts-trashed');

// Redis test route
Route::get('/redis-test', function () {
    Redis::set('test_key', 'Redis is working!');
    return Redis::get('test_key');
});


