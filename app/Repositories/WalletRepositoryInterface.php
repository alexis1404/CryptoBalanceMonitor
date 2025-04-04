<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\Wallet;
use Illuminate\Support\Collection;

interface WalletRepositoryInterface
{
    public function create(array $data): Wallet;
    public function findByWalletId(string $walletId): ?Wallet;
    public function updateBalance(Wallet $wallet, string $newBalance): bool;
    public function getAllWithoutId(): Collection;
}
