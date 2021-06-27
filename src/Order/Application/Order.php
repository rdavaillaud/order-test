<?php

declare(strict_types=1);

namespace App\Order\Application;

use App\Order\Domain\OrderId;

class Order
{
    /**
     * @var OrderId
     */
    private $id;
    /**
     * @var OrderItem[]
     */
    private $items;
    /**
     * @var Promotion[]
     */
    private $promotions;

    public function __construct(OrderId $id)
    {
        $this->id = $id;
    }

    public static function fromState(array $state, array $items, array $promotions): self
    {
        $order = new self(OrderId::fromInt($state['id']));
        $order->items = $items;
        $order->promotions = $promotions;

        return $order;
    }

    /**
     * @return OrderItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @return Promotion[]
     */
    public function getPromotions(): array
    {
        return $this->promotions;
    }

    public function getId(): OrderId
    {
        return $this->id;
    }

    public function getAllItemsPrice(): float
    {
        return array_reduce(
            $this->items,
            function ($carry, $item) {
                /** @var OrderItem $item */
                return $carry + $item->getPrice();
            },
            0
        );
    }

}
