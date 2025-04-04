<?php
declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\BalanceHistory;
use App\Models\Wallet;
use App\WalletAdapters\BTCAdapter\Balance\BTCWallet;
use App\WalletAdapters\ETHAdapter\Balance\ETHWallet;
use App\WalletAdapters\LTCAdapter\Balance\LTCWallet;
use App\WalletAdapters\WalletAdapterInterfaces\WalletStandardInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateWalletBalances extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wallets:update-balances';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Wallet-balances refresh';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        /* Коммит инициируется здесь, и заканчивается вне цикла
        Это не случайность, хотя мы, конечно, могли бы try-catch-ить каждый запрос
        Однако, если часть эндпоинтов у нас отпадёт, а часть - нет, мы получим не валидные балансы,
        а кашу из информации с нулевой степенью достоверности и правильных балансов. И обработчик ошибок + логирование
        в этом случае мало помогут */
        DB::beginTransaction();

        try {
            $wallets = Wallet::all();
            foreach ($wallets as $wallet) {
                $adapter = $this->getAdapterForTicker($wallet->asset_ticker);

                if (!$adapter) {
                    $this->warn('Not found adapter: ' . $wallet->asset_ticker);
                    continue;
                }

                $newBalance = $adapter->getHumanReadableWalletBalance($wallet->address);

                // History save
                BalanceHistory::create([
                    'wallet_id' => $wallet->id,
                    'balance' => $newBalance,
                ]);

                // Refresh wallet
                $wallet->balance = $newBalance;
                $wallet->save();

                $this->info('Refreshed wallet ' . $wallet->wallet_id . ', new balance: ' . $newBalance);
            }

            DB::commit();
            return Command::SUCCESS;

        } catch (\Throwable $exception) {
            DB::rollBack();
            $this->error('Error: ' . $exception->getMessage());
            return Command::FAILURE;
        }
    }

    private function getAdapterForTicker(string $ticker): ?WalletStandardInterface
    {
        return match (strtoupper($ticker)) {
            'BTC' => app(BTCWallet::class),
            'ETH' => app(ETHWallet::class),
            'LTC' => app(LTCWallet::class),
            default => null,
        };
    }
}
