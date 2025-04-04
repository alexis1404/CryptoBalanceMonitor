<?php
declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Wallet;
use Illuminate\Foundation\Http\FormRequest;

class WalletIdRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $walletId = $this->route('walletId');
        $wallet = Wallet::where('wallet_id', $walletId)
            ->select('wallet_id', 'address', 'asset_ticker', 'balance', 'created_at', 'updated_at')
            ->first();
        $this->merge(['wallet' => $wallet]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        ];
    }

    public function wallet(): ?Wallet
    {
        return $this->get('wallet');
    }
}
