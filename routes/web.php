<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/manajemen', function () { return view('manajemen'); })->name('manajemen');
    Route::get('/penjualan', function () { return view('penjualan'); })->name('transaksi.penjualan');
    
    Route::get('/pembelian-supplier', function () { return view('supplier');
    })->name('pembelian.supplier');
});

require __DIR__.'/auth.php';
