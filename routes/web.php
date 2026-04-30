<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Tambahkan rute-rute yang error tadi di sini
    Route::get('/manajemen', function () { return view('manajemen'); })->name('manajemen');
    Route::get('/penjualan', function () { return view('penjualan'); })->name('transaksi.penjualan');
    
    // Rute untuk error yang baru ini
    Route::get('/pembelian-supplier', function () { 
        return view('supplier'); // Pastikan filenya ada di resources/views/supplier.blade.php
    })->name('pembelian.supplier');
});

require __DIR__.'/auth.php';
