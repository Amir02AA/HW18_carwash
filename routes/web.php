<?php

use App\Http\Controllers\ReceiptsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('receipts/create/times',[\App\Http\Controllers\HomeController::class,'times'])->name('times');
Route::get('receipts/edit/times',[\App\Http\Controllers\HomeController::class,'timesEdit'])->name('times.edit');
Route::get('receipts/track',[ReceiptsController::class,'trackPage'])->name('receipts.track.page');
Route::post('receipts/track',[ReceiptsController::class,'track'])->name('receipts.track');

Route::resource('receipts', ReceiptsController::class);
