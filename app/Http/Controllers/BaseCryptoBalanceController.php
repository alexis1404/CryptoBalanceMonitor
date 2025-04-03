<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Facades\DecimalHelperFacade;
use App\WalletAdapters\BTCAdapter\Base\BTCWallet;
use App\WalletAdapters\BTCAdapter\HTTPClient\BTCExplorerClient;
use App\WalletAdapters\ETHAdapter\Base\ETHWallet;
class BaseCryptoBalanceController extends Controller
{
    public function test()
    {
        $btcWallet = new BTCWallet();

        dd($btcWallet->getHumanReadableWalletBalance('3MP3vQXhSbuhtbgXTA1Xi72hU9Whw9n6aR'));

        //dd($btcExplorerClient->getBtcBalance('3MP3vQXhSbuhtbgXTA1Xi72hU9Whw9n6aR'));
        //$ethWallet = new ETHWallet();
        //dd($ethWallet->getHumanReadableWalletBalance('0xd11D7D2cb0aFF72A61Df37fD016EE1bd9F180633'));
        //dd(DecimalHelperFacade::numberWithoutPrecisionToDecimal(10000, 8));
    }
}
