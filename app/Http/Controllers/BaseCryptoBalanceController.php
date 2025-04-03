<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\WalletIdRequest;

class BaseCryptoBalanceController extends Controller
{
    public function getWalletList()
    {
        dd(111);
    }

    public function getWalletById(WalletIdRequest $request)
    {
        dd($request->wallet());
    }

    public function addWallet()
    {
        dd(333);
    }
}
