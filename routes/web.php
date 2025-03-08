<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;

Route::get('/', [ImageController::class, 'showWelcome'])->name('welcome');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::get('/upload-image', [ImageController::class, 'create'])->name('image.create');
Route::post('/upload-image', [ImageController::class, 'store'])->name('image.store');

//download image
Route::get('/download-image/{image}', [ImageController::class, 'download'])->name('image.download');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/upload-image', [ImageController::class, 'create'])->name('image.create');
Route::post('/upload-image', [ImageController::class, 'store'])->name('image.store');
});

require __DIR__.'/auth.php';
