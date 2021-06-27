<?php

declare(strict_types=1);

namespace App\Order\Application\ShippingCost;

class ShippingCostRule
{
    /**
     * @var int
     */
    private $price;
    /**
     * @var int
     */
    private $productCount;
    /**
     * @var string
     */
    private $brand;

    public function __construct(string $brand, int $price, int $productCount)
    {
        $this->price = $price;
        $this->productCount = $productCount;
        $this->brand = $brand;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function evaluatePrice(int $productCount): int
    {
        if ($productCount === 0) {
            return 0;
        }
        if ($this->productCount === 0) {
            return $this->price;
        }

        return intval(ceil($productCount / $this->productCount)) * $this->price;
    }
}
