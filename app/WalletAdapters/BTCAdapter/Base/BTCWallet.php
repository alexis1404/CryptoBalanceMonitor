<?php
declare(strict_types = 1);

namespace App\WalletAdapters\BTCAdapter\Base;

use App\Exceptions\CurrencyException;
use App\Exceptions\IncorrectStatusCodeException;
use App\Facades\DecimalHelperFacade;
use App\WalletAdapters\BTCAdapter\HTTPClient\BTCExplorerClient;
use App\WalletAdapters\WalletAdapterInterfaces\WalletStandardInterface;

class BTCWallet implements WalletStandardInterface
{
    const BTC_DECIMAL = 8;

    /** @var BTCExplorerClient */
    protected BTCExplorerClient $btcExplorerClient;
    public function __construct()
    {
        $this->btcExplorerClient = new BTCExplorerClient(
            config('currencies.explorer.btc')
        );
    }

    public function getHumanReadableWalletBalance(string $address): string
    {
        try {
            $networkBalanceResult = $this->btcExplorerClient->getBtcBalance($address);
        } catch (IncorrectStatusCodeException $exception) {
            throw new CurrencyException($exception->getMessage());
        }

        return DecimalHelperFacade::numberWithoutPrecisionToDecimal($networkBalanceResult, self::BTC_DECIMAL);
    }
}
