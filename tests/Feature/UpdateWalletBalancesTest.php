<?php

namespace Tests\Feature;

use App\Console\Commands\UpdateWalletBalances;
use App\Models\BalanceHistory;
use App\Models\Wallet;
use App\WalletAdapters\BTCAdapter\Balance\BTCWallet;
use App\WalletAdapters\ETHAdapter\Balance\ETHWallet;
use App\WalletAdapters\LTCAdapter\Balance\LTCWallet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateWalletBalancesTest extends TestCase
{
    public function test_updates_wallet_balances_successfully()
    {
        $btcWallet = Wallet::create([
            'wallet_id' => 'btc1_' . uniqid(),
            'address' => '1A1zP1eP5QGefi2DMPTfTL5SLmv7DivfNa',
            'asset_ticker' => 'BTC',
            'balance' => '0'
        ]);
        $ethWallet = Wallet::create([
            'wallet_id' => 'eth1_' . uniqid(),
            'address' => '0x1234567890abcdef1234567890abcdef12345678',
            'asset_ticker' => 'ETH',
            'balance' => '0'
        ]);
        $ltcWallet = Wallet::create([
            'wallet_id' => 'ltc1_' . uniqid(),
            'address' => 'LKrA9VvGTD7P4WTRXv5YgM3zQo2vB7eW8r',
            'asset_ticker' => 'LTC',
            'balance' => '0'
        ]);

        $this->mock(BTCWallet::class, function ($mock) {
            $mock->shouldReceive('getHumanReadableWalletBalance')
                ->once()
                ->with('1A1zP1eP5QGefi2DMPTfTL5SLmv7DivfNa')
                ->andReturn('1.23456789');
        });

        $this->mock(ETHWallet::class, function ($mock) {
            $mock->shouldReceive('getHumanReadableWalletBalance')
                ->once()
                ->with('0x1234567890abcdef1234567890abcdef12345678')
                ->andReturn('2.34567890');
        });

        $this->mock(LTCWallet::class, function ($mock) {
            $mock->shouldReceive('getHumanReadableWalletBalance')
                ->once()
                ->with('LKrA9VvGTD7P4WTRXv5YgM3zQo2vB7eW8r')
                ->andReturn('3.45678901');
        });

        $this->artisan('wallets:update-balances')
            ->expectsOutput("Refreshed wallet {$btcWallet->wallet_id}, new balance: 1.23456789")
            ->expectsOutput("Refreshed wallet {$ethWallet->wallet_id}, new balance: 2.34567890")
            ->expectsOutput("Refreshed wallet {$ltcWallet->wallet_id}, new balance: 3.45678901")
            ->assertExitCode(0);

        $this->assertEquals('1.23456789', $btcWallet->fresh()->balance);
        $this->assertEquals('2.34567890', $ethWallet->fresh()->balance);
        $this->assertEquals('3.45678901', $ltcWallet->fresh()->balance);

        $this->assertDatabaseHas('balance_histories', [
            'wallet_id' => $btcWallet->id,
            'balance' => '1.23456789',
        ]);
        $this->assertDatabaseHas('balance_histories', [
            'wallet_id' => $ethWallet->id,
            'balance' => '2.34567890',
        ]);
        $this->assertDatabaseHas('balance_histories', [
            'wallet_id' => $ltcWallet->id,
            'balance' => '3.45678901',
        ]);
    }

//    public function test_skips_wallet_with_unknown_ticker()
//    {
//        $wallet = Wallet::create(['wallet_id' => 'wtf', 'address' => 'wtf123qwerty', 'asset_ticker' => 'WTF', 'balance' => '0']);
//
//        $this->artisan('wallets:update-balances')
//            ->expectsOutput('Not found adapter: WTF')
//            ->assertExitCode(0);
//
//        $this->assertEquals('0', $wallet->fresh()->balance);
//        $this->assertDatabaseMissing('balance_histories', ['wallet_id' => $wallet->id]);
//    }
}
