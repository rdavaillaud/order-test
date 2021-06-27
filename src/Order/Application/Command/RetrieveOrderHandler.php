<?php

declare(strict_types=1);

namespace App\Order\Application\Command;

use App\Order\Application\Command\RetrieveOrder;
use App\Order\Application\OrderDisplay;
use App\Order\Application\OrderDisplayRepositoryInterface;
use App\Order\Application\ShippingCost\ShippingCostCalculatorInterface;
use App\Order\Application\Vat\VatCalculatorInterface;

class RetrieveOrderHandler
{
    /**
     * @var OrderDisplayRepositoryInterface
     */
    private $orderDisplayRepository;
    /**
     * @var VatCalculatorInterface
     */
    private $vatCalculator;
    /**
     * @var ShippingCostCalculatorInterface
     */
    private $shippingCostCalculator;

    public function __construct(
        OrderDisplayRepositoryInterface $orderDisplayRepository,
        VatCalculatorInterface $vatCalculator,
        ShippingCostCalculatorInterface $shippingCostCalculator
    ) {
        $this->orderDisplayRepository = $orderDisplayRepository;
        $this->vatCalculator = $vatCalculator;
        $this->shippingCostCalculator = $shippingCostCalculator;
    }

    public function __invoke(RetrieveOrder $retrieveOrder): OrderDisplay
    {
        //TODO catch not found
        $order = $this->orderDisplayRepository->getById($retrieveOrder->getOrderId());
        $vat = $this->vatCalculator->evaluateForOrder($order);
        $shippingCost = $this->shippingCostCalculator->evaluateForOrder($order);

        return OrderDisplay::create($order, $vat, $shippingCost);
    }
}
