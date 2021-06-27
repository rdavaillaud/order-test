<?php


namespace App\Order\Application;

use App\Order\Domain\OrderId;

interface OrderDisplayRepositoryInterface
{
    /**
     * @throws OrderNotFoundException
     */
    public function getById(OrderId $orderId): Order;
}
