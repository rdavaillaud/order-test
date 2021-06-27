<?php

declare(strict_types=1);

namespace App\Order\Infrastructure\InMemory;

use App\Order\Application\Order;
use App\Order\Application\OrderDisplayRepositoryInterface;
use App\Order\Application\OrderItem;
use App\Order\Application\OrderNotFoundException;
use App\Order\Application\Product;
use App\Order\Application\Promotion;
use App\Order\Domain\OrderId;

class OrderDisplayRepository implements OrderDisplayRepositoryInterface
{
    /**
     * @var array
     */
    private $orders;

    public function __construct()
    {
        $this->orders = [
            strval(OrderId::fromInt(1138)) => Order::fromState(
                ['id' => 1138],
                [
                    OrderItem::order(new Product('Cuve à gasoil', 250000, 'Farmitoo'), 1),
                    OrderItem::order(new Product('Nettoyant pour cuve', 5000, 'Farmitoo'), 3),
                    OrderItem::order(new Product('Piquet de clôture', 1000, 'Gallagher'), 5),
                ],
                [
                    new Promotion(50000, 8, false)
                ]
            )
        ];;
    }

    public function setOrders(array $orders)
    {
        $this->orders = $orders;
    }

    public function getById(OrderId $orderId): Order
    {
        if (!isset($this->orders[strval($orderId)])) {
            throw OrderNotFoundException::fromOrderId($orderId);
        }

        return $this->orders[strval($orderId)];
    }
}
