<?php
declare(strict_types=1);

namespace Tests\Feature;

use App\WalletAdapters\BTCAdapter\Balance\BTCWallet;
use App\WalletAdapters\ETHAdapter\Balance\ETHWallet;
use App\WalletAdapters\LTCAdapter\Balance\LTCWallet;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Group;

class WalletAdaptersIntegrationTest extends TestCase
{
    #[Group('integration')]
    public function test_btc_wallet_balance_from_real_api(): void
    {
        $btcWallet = app(BTCWallet::class);
        $address = '1A1zP1eP5QGefi2DMPTfTL5SLmv7DivfNa'; // Genesis BTC

        $balance = $btcWallet->getHumanReadableWalletBalance($address);

        $this->assertNotNull($balance);
        $this->assertIsString($balance);
        $this->assertMatchesRegularExpression('/^\d+\.\d+$/', $balance);
    }

    #[Group('integration')]
    public function test_eth_wallet_balance_from_real_api(): void
    {
        $ethWallet = app(ETHWallet::class);
        $address = '0x4e83362442b8d1bec281594cea3050c8eb01311c'; // Valid ETH address

        $balance = $ethWallet->getHumanReadableWalletBalance($address);

        $this->assertNotNull($balance);
        $this->assertIsString($balance);
        $this->assertMatchesRegularExpression('/^\d+\.\d+$/', $balance);
    }

    #[Group('integration')]
    public function test_ltc_wallet_balance_from_real_api(): void
    {
        $ltcWallet = app(LTCWallet::class);
        $address = 'ltc1qunlusnm7ra2zun8vxey8dntajg9tkd9jcse3qf'; // Valid LTC address

        $balance = $ltcWallet->getHumanReadableWalletBalance($address);

        $this->assertNotNull($balance);
        $this->assertIsString($balance);
        $this->assertMatchesRegularExpression('/^\d+\.\d+$/', $balance);
    }
}
