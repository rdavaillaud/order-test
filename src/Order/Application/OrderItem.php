<?php

declare(strict_types=1);

namespace App\Order\Application;

class OrderItem
{
    /**
     * @var Product
     */
    protected $product;

    /**
     * @var int
     */
    protected $quantity;

    public static function order(Product $product, int $quantity): self
    {
        $item = new self();
        $item->product = $product;
        $item->quantity = $quantity;

        return $item;
    }

    public function getPrice(): int
    {
        return $this->quantity * $this->product->getPrice();
    }

    public function getUnitPrice(): int
    {
        return $this->product->getPrice();
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getBrand()
    {
        return $this->product->getBrand();
    }

    public function getTitle()
    {
        return $this->product->getTitle();
    }
}
