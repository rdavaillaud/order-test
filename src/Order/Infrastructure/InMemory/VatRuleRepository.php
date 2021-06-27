<?php

declare(strict_types=1);

namespace App\Order\Infrastructure\InMemory;

use App\Order\Application\Vat\VatRuleRepositoryInterface;
use App\Order\Application\Vat\VatRule;

class VatRuleRepository implements VatRuleRepositoryInterface
{
    private $rules;

    public function __construct()
    {
        $this->rules = [
            new VatRule('Farmitoo', 20),
            new VatRule('Gallagher', 5)
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
