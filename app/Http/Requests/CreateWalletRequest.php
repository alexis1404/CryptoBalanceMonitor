<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class CreateWalletRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $allowedTickers = array_column(config('currencies.assets_data', []), 'ticker');
        return [
            'assetTicker' => ['required', 'string', 'in:' . implode(',', $allowedTickers)],
            'walletId' => 'required|unique:wallets,wallet_id',
            'address' => 'required|string|unique:wallets',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator): ValidationException
    {
        throw new ValidationException($validator, response()->json([
            'message' => 'Validation failed',
            'errors' => $validator->errors(),
        ], 422));
    }
}
