<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\Wallet;
use Illuminate\Support\Collection;

class WalletRepository implements WalletRepositoryInterface
{
    public function create(array $data): Wallet
    {
        return Wallet::create($data);
    }

    public function findByWalletId(string $walletId): ?Wallet
    {
        return Wallet::where('wallet_id', $walletId)
            ->select('wallet_id', 'address', 'asset_ticker', 'balance', 'created_at', 'updated_at')
            ->first();
    }

    public function updateBalance(Wallet $wallet, string $newBalance): bool
    {
        $wallet->balance = $newBalance;
        return $wallet->save();
    }
    public function getAllWithoutId(): \Illuminate\Support\Collection
    {
        return Wallet::select('wallet_id', 'address', 'asset_ticker', 'balance', 'created_at', 'updated_at')->get();
    }

}
