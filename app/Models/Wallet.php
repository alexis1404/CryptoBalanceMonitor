<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Wallet extends Model
{
    use HasFactory;

    protected $table = 'wallets';

    protected $fillable = [
        'wallet_id',
        'address',
        'asset_ticker',
        'balance'
    ];

    public $timestamps = true;

    public function balanceHistory(): HasMany
    {
        return $this->hasMany(BalanceHistory::class);
    }
}
