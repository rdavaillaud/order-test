<?php

declare(strict_types=1);

namespace App\Order\Application\Vat;

use App\Order\Application\Order;

class VatCalculator implements VatCalculatorInterface
{
    /**
     * @var VatRuleRepositoryInterface
     */
    private $vatRuleRepository;

    public function __construct(VatRuleRepositoryInterface $vatRuleRepository)
    {
        $this->vatRuleRepository = $vatRuleRepository;
    }

    private function getItemPricesByBrand(array $items): array
    {
        $priceByBrand = [];
        foreach ($items as $item) {
            if (!isset($priceByBrand[$item->getBrand()])) {
                $priceByBrand[$item->getBrand()] = 0;
            }
            $priceByBrand[$item->getBrand()] += $item->getPrice();
        }

        return $priceByBrand;
    }

    public function evaluateForOrder(Order $order): float
    {
        $totalVAT = 0;
        $priceByBrand = $this->getItemPricesByBrand($order->getItems());

        $vatRules = $this->vatRuleRepository->find();
        foreach($vatRules as $vatRule) {
            $totalVAT += $vatRule->evaluateTax($priceByBrand[$vatRule->getBrand()]);
        }

        return $totalVAT;
    }
}
