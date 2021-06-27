<?php


namespace App\Order\Application\Vat;

interface VatRuleRepositoryInterface
{
    /** @return VatRule[] */
    public function find(): array;
}
