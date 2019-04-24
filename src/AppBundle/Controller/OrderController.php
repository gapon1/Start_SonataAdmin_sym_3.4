<?php

namespace AppBundle\Controller;

use AppBundle\Form\OrderFormType;
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

    /**
     * @Route("/get_car", name="get_free_car")
     */
    public function getFreeCar()
    {
        $em = $this->getDoctrine()->getManager();
        $cars = $em->getRepository('AppBundle:CarAdmin')
            ->getFreeCars();

        return $this->render('orders/getFreeCar.html.twig', array(
            'get_cars' => $cars,
        ));
    }


    /**
     * @Route("/new_order/{carName}/{ordId}", name="newOrder")
     */
    public function getFreeCarNewOrder(Request $request, $carName, $ordId)
    {


        $form = $this->createForm(OrderFormType::class);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        //============   Get choos Car Id AND Car Name =====
        $order_car_name = $em->getRepository('AppBundle:CarAdmin')
            ->findOneBy(['carName' => $carName]);

        $change_status = $em->getRepository('AppBundle:Orders')
            ->findOneBy(['id' => $ordId]);
        $change_status->setStatus('call');

        if ($form->isSubmitted() && $form->isValid()) {

            $carId = $form->getData();
            $em = $this->getDoctrine()->getManager();


            $em->persist($carId);
            $em->persist($change_status);
            $em->flush();

            $this->addFlash(
                'success',
                sprintf('Order created - you (%s) -  Successful', $this->getUser()->getEmail())
            );
            return $this->redirectToRoute('get_free_car');
        }



        return $this->render('orders/newOrder.html.twig', [
            'orderForm' => $form->createView(),
            'order_car_name' => $order_car_name,

        ]);

    }

}