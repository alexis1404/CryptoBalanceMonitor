<?php
declare(strict_types=1);

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *
 *
 * @property-read \App\Models\Wallet|null $wallet
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BalanceHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BalanceHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BalanceHistory query()
 * @mixin Eloquent
 */
class BalanceHistory extends Model
{
    use HasFactory;

    protected $table = 'balance_histories';

    protected $fillable = [
        'wallet_id',
        'balance'
    ];

    public $timestamps = true;

    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }
}
