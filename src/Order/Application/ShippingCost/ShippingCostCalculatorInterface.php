<?php


namespace App\Order\Application\ShippingCost;

use App\Order\Application\Order;

interface ShippingCostCalculatorInterface
{
    public function evaluateForOrder(Order $order): float;
}
