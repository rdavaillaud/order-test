<?php

declare(strict_types=1);

namespace App\Tests\Order\Application;

use App\Order\Application\ShippingCost\ShippingCostRule;
use PHPUnit\Framework\TestCase;

class ShippingCostRuleTest extends TestCase
{
    public function dataset()
    {
        return [
            'farmitoo 0 product' => [20, 3, 0, 0],
            'farmitoo 1 product' => [20, 3, 1, 20],
            'farmitoo 4 product' => [20, 3, 4, 40],
            'farmitoo 10 product' => [20, 3, 10, 80],
            'Gallagher 0 product' => [15, 0, 0, 0],
            'Gallagher 1 product' => [15, 0, 1, 15],
            'Gallagher 4 product' => [15, 0, 4, 15],
            'Gallagher 10 product' => [15, 0, 10, 15],
        ];
    }
    /**
     * @dataProvider dataset
     * @test
     */
    public function testItEvaluatesPrice(int $price, int $count, int $productCount, int $expectedPrice)
    {
        $rule = new ShippingCostRule('dummy', $price, $count);

        $this->assertEquals($expectedPrice, $rule->evaluatePrice($productCount));
    }
}
