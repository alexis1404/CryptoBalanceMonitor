<?php
declare(strict_types=1);

namespace Tests\Unit;

use App\Services\Common\AddressValidator;
use PHPUnit\Framework\TestCase;

class AddressValidatorTest extends TestCase
{
    private AddressValidator $addressValidator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->addressValidator = new AddressValidator();
    }

    public function test_success_eth_address_validate(): void
    {
        $result = $this->addressValidator->validate(
            '0x4e83362442b8d1bec281594cea3050c8eb01311c',
            'ETH',
        );

        $this->assertTrue($result);
    }

    public function test_fail_eth_address_validate(): void
    {
        $result = $this->addressValidator->validate(
            'WTF-4e83362442b8d1bec281594cea3050c8eb01311c',
            'ETH',
        );

        $this->assertFalse($result);
    }

    public function test_success_btc_address_validate(): void
    {
        $result = $this->addressValidator->validate(
            '1A1zP1eP5QGefi2DMPTfTL5SLmv7DivfNa',
            'BTC',
        );

        $this->assertTrue($result);
    }

    public function test_fail_btc_address_validate(): void
    {
        $result = $this->addressValidator->validate(
            'WTF-1A1zP1eP5QGefi2DMPTfTL5SLmv7DivfNa',
            'BTC',
        );

        $this->assertFalse($result);
    }

    public function test_success_ltc_address_validate(): void
    {
        $result = $this->addressValidator->validate(
            'ltc1qunlusnm7ra2zun8vxey8dntajg9tkd9jcse3qf',
            'LTC',
        );

        $this->assertTrue($result);
    }

    public function test_fail_ltc_address_validate(): void
    {
        $result = $this->addressValidator->validate(
            'WTF-ltc1qunlusnm7ra2zun8vxey8dntajg9tkd9jcse3qf',
            'LTC',
        );

        $this->assertFalse($result);
    }

    public function test_throws_exception_for_unknown_ticker(): void
    {
        $ticker = 'WTF';

        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage('Unknown ticker: ' . $ticker);

        $this->addressValidator->validate('any_address', $ticker);
    }
}
