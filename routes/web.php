<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;

Route::get('/', [ItemController::class, 'index'])->name('home');
Route::get('/items/history', [ItemController::class, 'history'])->name('items.history'); // Pindah ke atas
Route::resource('items', ItemController::class);
Route::patch('/items/{item}/update-status', [ItemController::class, 'updateStatus'])->name('items.updateStatus');