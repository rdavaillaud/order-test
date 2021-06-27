<?php

declare(strict_types=1);

namespace App\Order\Application\Command;

use App\Order\Domain\OrderId;

class RetrieveOrder
{
    /**
     * @var int
     */
    private $orderId;

    public function __construct(int $orderId)
    {
        $this->orderId = $orderId;
    }

    public function getOrderId(): OrderId
    {
        return OrderId::fromInt($this->orderId);
    }
}
