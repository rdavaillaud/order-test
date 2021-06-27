<?php

declare(strict_types=1);

namespace App\Order\Application\ShippingCost;

use App\Order\Application\Order;

class ShippingCostCalculator implements ShippingCostCalculatorInterface
{
    /**
     * @var ShippingCostRuleRepositoryInterface
     */
    private $shippingCostRuleRepository;

    public function __construct(ShippingCostRuleRepositoryInterface $shippingCostRuleRepository)
    {
        $this->shippingCostRuleRepository = $shippingCostRuleRepository;
    }

    private function getBrandProductCount(array $items): array
    {
        $countByBrand = [];
        foreach ($items as $item) {
            if (!isset($countByBrand[$item->getBrand()])) {
                $countByBrand[$item->getBrand()] = 0;
            }
            $countByBrand[$item->getBrand()] = $countByBrand[$item->getBrand()] + 1;
        }

        return $countByBrand;
    }

    public function evaluateForOrder(Order $order): float
    {
        $totalShippingCost = 0;
        $countByBrand = $this->getBrandProductCount($order->getItems());

        $shippingCostRules = $this->shippingCostRuleRepository->find();
        foreach($shippingCostRules as $shippingCostRule) {
            $totalShippingCost += $shippingCostRule->evaluatePrice($countByBrand[$shippingCostRule->getBrand()]);
        }

        return $totalShippingCost;
    }
}
