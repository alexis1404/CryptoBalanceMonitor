<?php

namespace App\WalletAdapters\ETHAdapter\Balance;

use App\Exceptions\CurrencyException;
use App\Exceptions\IncorrectStatusCodeException;
use App\Facades\DecimalHelperFacade;
use App\WalletAdapters\ETHAdapter\HTTPClient\LTCExplorerClient;
use App\WalletAdapters\WalletAdapterInterfaces\WalletStandardInterface;

class ETHWallet implements WalletStandardInterface
{
    protected const ETH_DECIMAL = 18; //Отвратительная затея - хранить точность валюты хардкодом. Тикеры валют, их пресижны, etc - выносим в БД (assets) + добвляем эндпоинты для управления ими
    protected const SUCCESS_STATUS_CODE = 'OK';
    /** @var LTCExplorerClient */
    protected LTCExplorerClient $ethExplorerClient;

    public function __construct()
    {
        $this->ethExplorerClient = new LTCExplorerClient(
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

        return DecimalHelperFacade::numberWithoutPrecisionToDecimal($networkBalanceResult['result'], self::ETH_DECIMAL);
    }
}
