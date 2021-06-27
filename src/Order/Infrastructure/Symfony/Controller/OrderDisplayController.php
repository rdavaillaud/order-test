<?php

namespace App\Order\Infrastructure\Symfony\Controller;

use App\Order\Application\Command\RetrieveOrder;
use App\Order\Application\Command\RetrieveOrderHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class OrderDisplayController extends AbstractController
{
    /**
     * @var RetrieveOrderHandler
     */
    private $retrieveOrderHandler;

    public function __construct(RetrieveOrderHandler $retrieveOrderHandler)
    {
        $this->retrieveOrderHandler = $retrieveOrderHandler;
    }

    public function index(): Response
    {
        $orderId = 1138;

        $order = ($this->retrieveOrderHandler)(new RetrieveOrder($orderId));

        return $this->render('order_display.html.twig', ['order' => $order]);
    }
}
