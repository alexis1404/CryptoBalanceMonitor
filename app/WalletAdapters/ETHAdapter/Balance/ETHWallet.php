<?php

namespace App\WalletAdapters\ETHAdapter\Balance;

use App\Exceptions\CurrencyException;
use App\Exceptions\IncorrectStatusCodeException;
use App\Facades\DecimalHelperFacade;
use App\WalletAdapters\ETHAdapter\HTTPClient\ETHExplorerClient;
use App\WalletAdapters\WalletAdapterInterfaces\WalletStandardInterface;

class ETHWallet implements WalletStandardInterface
{
    protected const SUCCESS_STATUS_CODE = 'OK';
    /** @var ETHExplorerClient */
    protected ETHExplorerClient $ethExplorerClient;

    public function __construct()
    {
        $this->ethExplorerClient = new ETHExplorerClient(
            config('currencies.explorer.eth'),
            config('currencies.api_key.eth_explorer_api_key')
        );
    }

    public function getHumanReadableWalletBalance(string $address): string
    {
        try {
            $networkBalanceResult = $this->ethExplorerClient->getEthereumBalance($address);
        } catch (IncorrectStatusCodeException $exception) {
            throw new CurrencyException($exception->getMessage());
        }

        if ($networkBalanceResult['message'] !== self::SUCCESS_STATUS_CODE) {
            throw new CurrencyException(strval($networkBalanceResult));
        }

        return DecimalHelperFacade::numberWithoutPrecisionToDecimal(
            $networkBalanceResult['result'],
            config('currencies.assets_data.eth.decimal')
        );
    }
}
