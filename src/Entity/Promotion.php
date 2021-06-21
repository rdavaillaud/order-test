<?php


namespace App\Entity;


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
}
