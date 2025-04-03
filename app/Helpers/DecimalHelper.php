<?php
declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

class DecimalHelper
{
    const DIGITS_AFTER_DECIMAL = 18;

    public function decimalToNumberWithoutPrecision(string $value, int $precision): string
    {
        $value = $this->toString($value, $precision);
        $strpos = strpos($value, '.');
        if ($strpos === false) {
            return $value . str_pad('', $precision, '0', STR_PAD_RIGHT);
        }
        return (substr($value, 0, $strpos) . str_pad(substr($value, $strpos + 1), $precision, '0', STR_PAD_RIGHT));
    }

    public function numberWithoutPrecisionToDecimal($value, int $precision): string
    {
        if (is_int($value)) {
            $value = (string) $value;
        }
        if (!ctype_digit($value)) {
            Log::error('NumberWithoutPrecision: value must contains only digits. Received: ' . $value);
            throw new \LogicException('NumberWithoutPrecision: value must contains only digits. Received: ' . $value);
        }
        $strlen = strlen($value);
        if ($strlen <= $precision) {
            return '0.' . str_pad($value, $precision, '0', STR_PAD_LEFT);
        }
        return substr_replace($value, '.', $strlen - $precision, 0);
    }

    public function toString($decimal, $maxDigitsAfterComa = self::DIGITS_AFTER_DECIMAL): string
    {
        $decimal = (string) $decimal;
        if (!$decimal || $decimal === '0') {
            return '0';
        }
        if (strpos($decimal, '.') === false) {
            return (string) $decimal;
        }
        $decimal = rtrim(rtrim($decimal, '0'), '.');
        $pos = strpos($decimal, '.');
        if ($pos === false) {
            return $decimal;
        }
        return substr($decimal, 0, $pos + $maxDigitsAfterComa + 1);
    }
}
