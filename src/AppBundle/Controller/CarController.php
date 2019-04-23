<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Car;
use AppBundle\Form\CarFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CarController extends Controller
{
    /**
     * @Route("/car_list", name="car_list")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $cars = $em->getRepository('AppBundle:Car')
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
        $car = $em->getRepository('AppBundle:Car')
            ->findOneBy(['carName' => $carName]);

        if (!$car) {
            throw $this->createNotFoundException('Car not found');
        }
        return $this->render('car/showCar.html.twig', [
            'car' => $car
        ]);
    }

    /**
     * @Route("/car/{id}/edit", name="car_edit")
     */
    public function editAction(Request $request, Car $users)
    {
        $form = $this->createForm(CarFormType::class, $users);
        // only handles data on POST
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $users = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($users);
            $em->flush();

            $this->addFlash('success', 'Car updated!');

            return $this->redirectToRoute('car_list');
        }

        return $this->render('car/edit.html.twig', [
            'carForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/delete_car/{id}", name="delete_car")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:Car')->find($id);
        if (!$user) {
            return $this->redirectToRoute('car_list');
        }
        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute('car_list');
    }

}