<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Facades\AddressValidationFacade;
use App\Facades\JsonResponseServiceFacade;
use App\Http\Requests\CreateWalletRequest;
use App\Http\Requests\WalletIdRequest;
use App\Repositories\WalletRepository;

class BaseCryptoBalanceController extends Controller
{
    /** @var WalletRepository */
    protected WalletRepository$walletRepository;
    public function __construct(WalletRepository $walletRepository)
    {
        $this->walletRepository = $walletRepository;
    }

    public function getWalletList()
    {
        $wallets = $this->walletRepository->getAllWithoutId();

        return JsonResponseServiceFacade::getSuccessResponse(['response' => $wallets]);
    }

    public function getWalletById(WalletIdRequest $request)
    {
        $wallet = $request->wallet();
        if ($wallet === null) {
            return JsonResponseServiceFacade::getErrorResponse('Wallet not found');
        }
        return JsonResponseServiceFacade::getSuccessResponse(['response' => $wallet]);
    }

    public function addWallet(CreateWalletRequest $request)
    {
        if (AddressValidationFacade::validate($request->address, $request->assetTicker) !== true) {
            return JsonResponseServiceFacade::getErrorResponse('Address validation failed');
        }
        $wallet = $this->walletRepository->create([
            'wallet_id' => $request->walletId,
            'address' => $request->address,
            'asset_ticker' => $request->assetTicker,
            'balance' => '0',//Initial balance
        ]);

        return JsonResponseServiceFacade::getSuccessResponse(['response' => 'Wallet ' .  $wallet->address .  ' created']);
    }
}
