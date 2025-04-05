<?php

namespace Tests\Unit;

use App\Helpers\DecimalHelper;
use Tests\TestCase;
use Illuminate\Support\Facades\Log;

class DecimalHelperTest extends TestCase
{
    private DecimalHelper $decimalHelper;

    protected function setUp(): void
    {
        parent::setUp();
        $this->decimalHelper = new DecimalHelper();
    }

    public function test_converts_small_number_to_decimal()
    {
        $result = $this->decimalHelper->numberWithoutPrecisionToDecimal('123', 8);
        $this->assertEquals('0.00000123', $result);
    }

    public function test_converts_large_number_to_decimal()
    {
        $result = $this->decimalHelper->numberWithoutPrecisionToDecimal('123456789', 8);
        $this->assertEquals('1.23456789', $result);
    }

    public function test_converts_integer_to_decimal()
    {
        $result = $this->decimalHelper->numberWithoutPrecisionToDecimal(123, 8);
        $this->assertEquals('0.00000123', $result);
    }

    public function test_throws_exception_for_non_digit_input()
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage('NumberWithoutPrecision: value must contains only digits. Received: 12.34');

        $this->decimalHelper->numberWithoutPrecisionToDecimal('12.34', 8);
    }

    public function test_converts_zero_to_decimal()
    {
        $result = $this->decimalHelper->numberWithoutPrecisionToDecimal('0', 8);
        $this->assertEquals('0.00000000', $result);
    }

    public function test_logs_error_for_non_digit_input()
    {
        Log::shouldReceive('error')
            ->once()
            ->with('NumberWithoutPrecision: value must contains only digits. Received: 12.34');

        $this->expectException(\LogicException::class);
        $this->decimalHelper->numberWithoutPrecisionToDecimal('12.34', 8);
    }
}
