<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CarController extends Controller
{
    /**
     * @Route("/car_list", name="car_list")
     */
    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $cars = $em->getRepository('AppBundle:CarAdmin')
            ->findAll();

        /**
         * @var $paginator
         */
        $paginator = $this->get('knp_paginator');

        $result = $paginator->paginate(
            $cars,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 3)
        );

        return $this->render('car/carList.html.twig', [
            'cars' => $result
        ]);
    }

    /**
     * @Route("car/{carName}", name="car_show")
     */
    public function showAction($carName)
    {
        $em = $this->getDoctrine()->getManager();
        $car = $em->getRepository('AppBundle:CarAdmin')
            ->findOneBy(['carName' => $carName]);

        if (!$car) {
            throw $this->createNotFoundException('Car not found');
        }
        return $this->render('car/showCar.html.twig', [
            'car' => $car
        ]);
    }


}