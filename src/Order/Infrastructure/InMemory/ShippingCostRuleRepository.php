<?php

declare(strict_types=1);

namespace App\Order\Infrastructure\InMemory;

use App\Order\Application\ShippingCost\ShippingCostRuleRepositoryInterface;
use App\Order\Application\ShippingCost\ShippingCostRule;

class ShippingCostRuleRepository implements ShippingCostRuleRepositoryInterface
{
    private $rules;

    public function __construct()
    {
        $this->rules = [
            new ShippingCostRule('Farmitoo', 20, 3),
            new ShippingCostRule('Gallagher', 15, 0)
        ];
    }

    /**
     * @inheritDoc
     */
    public function find(): array
    {
        return $this->rules;
    }
}
