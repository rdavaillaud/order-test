<?php

declare(strict_types=1);

namespace App\Tests\Order\Application;

use App\Order\Application\Promotion;
use PHPUnit\Framework\TestCase;

class PromotionTest extends TestCase
{
    /**
     * @test
     */
    public function testItGivesFreeShippingWhenExpected()
    {
        $promotion = new Promotion(100, 5, true);

        $this->assertTrue($promotion->freeDelivery(100));
        $this->assertTrue($promotion->freeDelivery(20480));
        $this->assertFalse($promotion->freeDelivery(99));
        $this->assertFalse($promotion->freeDelivery(0));
        $this->assertFalse($promotion->freeDelivery(-50));
    }

    /**
     * @test
     */
    public function testItGivesReductionWhenExpected()
    {
        $promotion = new Promotion(100, 10, true);

        $this->assertEquals(10, $promotion->reduction(100));
        $this->assertEquals(54.6, $promotion->reduction(546));
        $this->assertEquals(0, $promotion->reduction(90));
        $this->assertEquals(0, $promotion->reduction(0));
        $this->assertEquals(0, $promotion->reduction(-10));
    }

    /**
     * @test
     */
    public function testItCanApplyPromotionWhenExpected()
    {
        $promotion = new Promotion(100, 5, true);

        $this->assertTrue($promotion->promotionApplies(485));
        $this->assertTrue($promotion->promotionApplies(100));
        $this->assertFalse($promotion->promotionApplies(0));
        $this->assertFalse($promotion->promotionApplies(-50));
    }
}
