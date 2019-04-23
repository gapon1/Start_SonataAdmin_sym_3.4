<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CarController extends Controller
{
    /**
     * @Route("/car_list", name="car_list")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $cars = $em->getRepository('AppBundle:CarAdmin')
            ->findAll();

        return $this->render('car/carList.html.twig', [
            'cars' => $cars
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