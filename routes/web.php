<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\DashboardController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('items', ItemController::class);
Route::resource('vendors', VendorController::class);
Route::resource('warehouses', WarehouseController::class);
Route::resource('receipts', ReceiptController::class);
Route::resource('shipments', ShipmentController::class);