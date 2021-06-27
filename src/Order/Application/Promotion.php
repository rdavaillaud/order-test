<?php

declare(strict_types=1);

namespace App\Order\Application;

class Promotion
{
    /**
     * @var int
     */
    protected $minAmount;

    /**
     * @var int
     */
    protected $reduction;

    /**
     * @var bool
     */
    protected $freeDelivery;

    /**
     * @param int $minAmount
     * @param int $reduction
     * @param bool $freeDelivery
     */
    public function __construct(int $minAmount, int $reduction, bool $freeDelivery)
    {
        $this->minAmount = $minAmount;
        $this->reduction = $reduction;
        $this->freeDelivery = $freeDelivery;
    }

    public function freeDelivery(float $amount): bool
    {
        return $this->promotionApplies($amount) && $this->freeDelivery;
    }
    public function promotionApplies(float $amount): bool
    {
        return $amount >= floatval($this->minAmount);
    }

    public function reduction(float $amount): float
    {
        return $this->promotionApplies($amount) ? $amount * $this->reduction / 100  : 0;
    }
}
