<?php

declare(strict_types=1);

namespace App\Order\Application;

class Product
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @var int
     */
    protected $price;

    /**
     * @var string
     */
    protected $brand;

    /**
     * @param string $title
     * @param int $price
     * @param string $brand
     */
    public function __construct(string $title, int $price, string $brand)
    {
        $this->title = $title;
        $this->price = $price;
        $this->brand = $brand;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getBrand(): string
    {
        return $this->brand;
    }
}
