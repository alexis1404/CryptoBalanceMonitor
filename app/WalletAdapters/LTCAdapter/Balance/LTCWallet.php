<?php
declare(strict_types = 1);

namespace App\WalletAdapters\LTCAdapter\Balance;

use App\Exceptions\CurrencyException;
use App\Exceptions\IncorrectStatusCodeException;
use App\Facades\DecimalHelperFacade;
use App\WalletAdapters\LTCAdapter\HTTPClient\LTCExplorerClient;
use App\WalletAdapters\WalletAdapterInterfaces\WalletStandardInterface;

class LTCWallet implements WalletStandardInterface
{
    const LTC_DECIMAL = 8;

    /** @var LTCExplorerClient */
    protected LTCExplorerClient $ltcExplorerClient;
    public function __construct()
    {
        $this->ltcExplorerClient = new LTCExplorerClient(
            config('currencies.explorer.ltc')
        );
    }

    public function getHumanReadableWalletBalance(string $address): string
    {
        try {
            $networkBalanceResult = $this->ltcExplorerClient->getLTCBalance($address);
        } catch (IncorrectStatusCodeException $exception) {
            throw new CurrencyException($exception->getMessage());
        }

        return DecimalHelperFacade::numberWithoutPrecisionToDecimal($networkBalanceResult['final_balance'], self::LTC_DECIMAL);
    }
}
