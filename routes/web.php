<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;


Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/chat', [ChatController::class, 'index'])->middleware('auth')->name('chat.index');
Route::post('/chat', [ChatController::class, 'chat'])->middleware('auth');
Route::post('/chat/clear', [ChatController::class, 'clear'])->middleware('auth');

require __DIR__.'/auth.php';
