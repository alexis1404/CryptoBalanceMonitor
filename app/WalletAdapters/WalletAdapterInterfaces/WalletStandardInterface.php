<?php
declare(strict_types=1);

namespace App\WalletAdapters\WalletAdapterInterfaces;

interface WalletStandardInterface
{
    public function getHumanReadableWalletBalance(string $address): string;
}
