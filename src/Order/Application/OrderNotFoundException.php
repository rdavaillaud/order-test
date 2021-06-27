<?php

declare(strict_types=1);

namespace App\Order\Application;

use App\Order\Domain\OrderId;
use Exception;

class OrderNotFoundException extends Exception
{

    /**
     * OrderNotFoundException constructor.
     * @param OrderId $orderId
     */
    public static function fromOrderId(OrderId $orderId): self
    {
        return new self(sprintf('The order #%s does not exist', $orderId->getId()));
    }
}
