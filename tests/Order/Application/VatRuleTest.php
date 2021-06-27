<?php

declare(strict_types=1);

namespace App\Tests\Order\Application;

use App\Order\Application\Order;
use App\Order\Application\Vat\VatRule;
use PHPUnit\Framework\TestCase;

class VatRuleTest extends TestCase
{
    /**
     * @var Order
     */
    private $order;

    public function dataset()
    {

        return [
            '20%' => [20, 255000, 51000.0],
            '5%' => [5, 1000, 50.0],
        ];
    }
    /**
     * @dataProvider dataset
     * @test
     */
    public function testItEvaluatesPrice(int $rate, int $amount, float $expectedTax)
    {
        $rule = new VatRule('dummy', $rate);

        $this->assertEquals($expectedTax, $rule->evaluateTax($amount));
    }
}
