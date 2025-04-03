<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Facades\DecimalHelperFacade;
use App\WalletAdapters\BTCAdapter\Balance\BTCWallet;
use App\WalletAdapters\BTCAdapter\HTTPClient\BTCExplorerClient;
use App\WalletAdapters\ETHAdapter\Balance\ETHWallet;
use App\WalletAdapters\LTCAdapter\Balance\LTCWallet;
use App\WalletAdapters\LTCAdapter\HTTPClient\LTCExplorerClient;

class BaseCryptoBalanceController extends Controller
{
    public function test()
    {
        $ltc = new LTCWallet();

        dd($ltc->getHumanReadableWalletBalance('ltc1qunlusnm7ra2zun8vxey8dntajg9tkd9jcse3qf'));
        //dd($btcWallet->getHumanReadableWalletBalance('bc1qtmks386a85c09483mxf4ae3ntghr2zqhsjd7lket9r9hjmjs7g3q0ufcl6'));
        //dd($btcExplorerClient->getBtcBalance('3MP3vQXhSbuhtbgXTA1Xi72hU9Whw9n6aR'));
        //$ethWallet = new ETHWallet();
        //dd($ethWallet->getHumanReadableWalletBalance('0xd11D7D2cb0aFF72A61Df37fD016EE1bd9F180633'));
        //dd(DecimalHelperFacade::numberWithoutPrecisionToDecimal(10000, 8));
    }
}
