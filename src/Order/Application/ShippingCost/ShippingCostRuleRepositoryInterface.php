<?php


namespace App\Order\Application\ShippingCost;

interface ShippingCostRuleRepositoryInterface
{
    /** @return ShippingCostRule[] */
    public function find(): array;
}
