<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class OrderController extends Controller
{
    /**
     * @Route("/orders_list", name="orders_list")
     */
    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $orders = $em->getRepository('AppBundle:Orders')
            ->findAll();

        /**
         * @var $paginator
         */
        $paginator = $this->get('knp_paginator');

        $result = $paginator->paginate(
            $orders,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 3)
        );

        return $this->render('orders/listOrders.html.twig', [
            'orders' => $result
        ]);
    }

    /**
     * @Route("order/{orderId}", name="order_show")
     *
     */
    public function showAction($orderId)
    {
        $em = $this->getDoctrine()->getManager();
        $order = $em->getRepository('AppBundle:Orders')
            ->findOneBy(['id' => $orderId]);
        if (!$order) {
            throw $this->createNotFoundException('Order not found');
        }
        return $this->render('orders/showOrder.html.twig', [
            'order' => $order
        ]);
    }

}