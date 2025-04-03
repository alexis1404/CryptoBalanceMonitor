<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BaseCryptoBalanceController;

Route::get('/wallets', [BaseCryptoBalanceController::class, 'getWalletList'])->name('get_wallet_list');
Route::get('/wallet/{walletId}', [BaseCryptoBalanceController::class, 'getWalletById'])->name('get_wallet_by_id');
Route::post('/wallets', [BaseCryptoBalanceController::class, 'addWallet'])->name('add_wallet');
