<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BaseCryptoBalanceController;

Route::get('/test', [BaseCryptoBalanceController::class, 'test'])->name('test');
