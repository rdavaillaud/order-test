<?php


namespace App\Order\Application\Vat;

use App\Order\Application\Order;

interface VatCalculatorInterface
{
    public function evaluateForOrder(Order $order): float;
}
