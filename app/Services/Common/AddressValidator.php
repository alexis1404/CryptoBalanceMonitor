<?php
declare(strict_types=1);

namespace App\Services\Common;

class AddressValidator
{
    private array $patterns = [ //ПРИМЕЧАНИЕ: Вообще для валидации адресов лучше подключать соответствующие библиотеки, так что это - временное решение
        'BTC' => [
            '/^[13][a-km-zA-HJ-NP-Z1-9]{25,34}$/', // Legacy
            '/^bc1[a-z0-9]{39,59}$/',              // Bech32
        ],
        'LTC' => [
            '/^[LM][a-km-zA-HJ-NP-Z1-9]{25,34}$/', // Legacy
            '/^ltc1[a-z0-9]{39,59}$/',             // Bech32
        ],
        'ETH' => [
            '/^0x[a-fA-F0-9]{40}$/',              // Hex
        ],
    ];

    public function validate(string $address, string $ticker): bool
    {
        $ticker = strtoupper($ticker);

        if (!isset($this->patterns[$ticker])) {
            throw new \LogicException('Unknown ticker: ' . $ticker );
        }

        foreach ($this->patterns[$ticker] as $pattern) {
            if (preg_match($pattern, $address)) {
                return true;
            }
        }

        return false;
    }
}
