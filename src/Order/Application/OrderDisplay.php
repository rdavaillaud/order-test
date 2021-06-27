<?php

declare(strict_types=1);

namespace App\Order\Application;

class OrderDisplay
{
    /**
     * @var Order
     */
    private $order;
    /**
     * @var float
     */
    private $vat;
    /**
     * @var float
     */
    private $shippingCost;

    private function __construct(Order $order)
    {
        $this->order = $order;
    }

    public static function create(Order $order, float $vat, float $shippingCost)
    {
        $orderDisplay = new self($order);
        $orderDisplay->vat = $vat;
        $orderDisplay->shippingCost = $shippingCost;

        return $orderDisplay;
    }

    public function getOrderId(): string
    {
        return (string)$this->order->getId();
    }
    /**
     * @return float
     */
    public function getShippingCost(): float
    {
        return $this->shippingCost;
    }

    /**
     * @return float
     */
    public function getVat(): float
    {
        return $this->vat;
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        $items = [];
        foreach ($this->order->getItems() as $item) {
            if ($item->getQuantity() === 0) {
                continue;
            }
            $items[] = [
                "title" => $item->getTitle(),
                "brand" => $item->getBrand(),
                "unit_price" => $item->getUnitPrice(),
                "quantity" => $item->getQuantity(),
                "price" => $item->getPrice()
            ];
        }

        return $items;
    }

    /**
    tous les produits avec titre, prix unitaire, marque et quantité
    sous-total HT
    promotion (le cas échéant)
    frais de port HT
    total HT
    TVA
    Total TTC
     */
    public function getAllItemPrice(): float
    {
        return $this->order->getAllItemsPrice();
    }

    public function hasPromotion(): bool
    {
        //return count($this->order->getPromotions()) > 0;
        $allItemPrice =  $this->getAllItemPrice();
        return array_reduce(
            $this->order->getPromotions(),
            function ($carry, $item) use ($allItemPrice) {
                /** @var Promotion $item */
                return $carry || $item->promotionApplies($allItemPrice);
            },
            false
        );
    }

    public function getPromotionAmount(): float
    {
        $allItemPrice =  $this->getAllItemPrice();
        return array_reduce(
            $this->order->getPromotions(),
            function ($carry, $item) use ($allItemPrice) {
                /** @var Promotion $item */
                if ($item->freeDelivery($allItemPrice)) {
                    return $carry + $this->shippingCost;
                }
                return $carry + $item->reduction($allItemPrice);
            },
            0
        );
    }

    public function getTotalPrice(): float
    {
        return $this->getAllItemPrice() + $this->getShippingCost() - $this->getPromotionAmount();
    }

    public function getTotalPriceWithTax(): float
    {
        //TODO handle promotion to high, above 0 and co
        return $this->getTotalPrice() + $this->getVAT();
    }
}
