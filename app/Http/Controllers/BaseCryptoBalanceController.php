<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Facades\DecimalHelper;

class BaseCryptoBalanceController extends Controller
{
    public function test()
    {
        dd(DecimalHelper::numberWithoutPrecisionToDecimal(10000, 8));
    }
}
