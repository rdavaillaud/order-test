<?php

declare(strict_types=1);

namespace App\Tests\Order\Application;

use App\Order\Application\Command\RetrieveOrder;
use App\Order\Application\Command\RetrieveOrderHandler;
use App\Order\Application\Order;
use App\Order\Application\OrderItem;
use App\Order\Application\Product;
use App\Order\Application\Promotion;
use App\Order\Application\ShippingCost\ShippingCostCalculator;
use App\Order\Application\Vat\VatCalculator;
use App\Order\Domain\OrderId;
use App\Order\Infrastructure\InMemory\OrderDisplayRepository;
use App\Order\Infrastructure\InMemory\ShippingCostRuleRepository;
use App\Order\Infrastructure\InMemory\VatRuleRepository;
use PHPUnit\Framework\TestCase;

class RetrieveOrderTest extends TestCase
{
    /**
     * @var RetrieveOrderHandler
     */
    private $retrieveOrderHandler;

    /**
     * @test
     * @group use_case
     */
    public function testItReturnsTheListOfItemsOfAnOrder()
    {
        $orderId = 1138;
        $order = ($this->retrieveOrderHandler)(new RetrieveOrder($orderId));

        $this->assertCount(3, $order->getItems());

        /**
         * tous les produits avec titre, prix unitaire, marque et quantité
         * sous-total HT
         * promotion (le cas échéant)
         * frais de port HT
         * total HT
         * TVA
         * Total TTC
         */
        $this->assertEquals(256000, $order->getAllItemPrice());
        $this->assertEquals(35, $order->getShippingCost());//20+15
        $this->assertEquals(20480, $order->getPromotionAmount());//floor(256000*0.08)
        $this->assertEquals(235555, $order->getTotalPrice());//256000 + 35 - 20480
        $this->assertEquals(51050, $order->getVAT());//51000+50
        $this->assertEquals(286605, $order->getTotalPriceWithTax());
    }

    protected function setUp(): void
    {
        $orders = [
            strval(OrderId::fromInt(1138)) => Order::fromState(
                ['id' => 1138],
                [
                    OrderItem::order(new Product('Cuve à gasoil', 250000, 'Farmitoo'), 1),
                    OrderItem::order(new Product('Nettoyant pour cuve', 5000, 'Farmitoo'), 1),
                    OrderItem::order(new Product('Piquet de clôture', 1000, 'Gallagher'), 1),
                ],
                [
                    new Promotion(50000, 8, false)
                ]
            )
        ];
        $orderDisplayRepository = new OrderDisplayRepository();
        $orderDisplayRepository->setOrders($orders);
        $this->retrieveOrderHandler = new RetrieveOrderHandler(
            $orderDisplayRepository,
            new VatCalculator(new VatRuleRepository()),
            new ShippingCostCalculator(new ShippingCostRuleRepository())
        );
    }
}
