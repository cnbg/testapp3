<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/upload/list', [UploadController::class, 'list'])->name('upload.list');
Route::get('/upload/show', [UploadController::class, 'show'])->name('upload.show');
Route::post('/upload/store', [UploadController::class, 'store'])->name('upload.store');
