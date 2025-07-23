<?php

use App\Http\Controllers\Api\KomisiController;
use App\Http\Controllers\Api\PembayaranController;
use App\Http\Controllers\Api\PenjualanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/penjualan', [PenjualanController::class, 'index']);
Route::get('/komisi', [KomisiController::class, 'index']);
Route::post('/pembayaran', [PembayaranController::class, 'store']);
Route::get('/pembayaran/{penjualan_id}', [PembayaranController::class, 'show']);
