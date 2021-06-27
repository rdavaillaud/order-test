<?php

declare(strict_types=1);

namespace App\Order\Application\Vat;

class VatRule
{
    /**
     * @var string
     */
    private $brand;
    /**
     * @var int
     */
    private $rate;

    /**
     * VatRule constructor.
     * @param string $brand
     * @param int $rate
     */
    public function __construct(string $brand, int $rate)
    {
        $this->brand = $brand;
        $this->rate = $rate;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function evaluateTax(int $amount): int
    {
        if ($amount === 0) {
            return 0;
        }
        if ($this->rate === 0) {
            return 0;
        }

        return $amount * $this->rate / 100;
    }
}
