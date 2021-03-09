<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Address;
use AppBundle\Form\AddressType;
use AppBundle\Form\ApplicationType;
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
        $sellAddresses = $em->getRepository('AppBundle:Address')
            ->getAddressesForSale();

        foreach ($sellAddresses as $address){
            if ($address->getGallery() != null){
                $galleryId = $address->getGallery()->getId();
                $repo = $this->getDoctrine()->getRepository('ApplicationSonataMediaBundle:Gallery');
                $gallery = $repo->find($galleryId);
                $galleryArray[] = $gallery->getGalleryHasMedias();
            }
        }


        $address = new Address();
        $form = $this->createForm(AddressType::class, $address);
        $form->handleRequest($request);

        $defaultData = ['message' => '<h3>Сообщение с ( brokergma.com ), таблица Аренда</h3>'];
        $sendForm = $this->createForm(ApplicationType::class, $defaultData);

        $sendForm->handleRequest($request);

        if ($sendForm->isSubmitted() && $sendForm->isValid()) {
            $message = \Swift_Message::newInstance()
                ->setSubject('Заявка на аренду')
                ->setFrom('brokergma@thebroker.website')
                ->setTo('brokergma@thebroker.website')
                ->setBody(
                    $sendForm->getData()['message'].'<br>'.
                    "Name: ".$sendForm->getData()['name'].'<br>'.
                    "Phone: ".$sendForm->getData()['phone'].'<br>'.
                    "Email: ".$sendForm->getData()['email'].'<br>'.
                    "Id обекта: <b>".$sendForm->getData()['id'].'</b>',
                    'text/html'
                );

            $this->get('mailer')->send($message);
            $this->addFlash('success', 'Заявка успешно отправлена!');
        }

        return $this->render('orders/listOrders.html.twig', [
            'orders' => $sellAddresses,
            'gallery' => $galleryArray,
            'formComment' => $form->createView(),
            'sendForm' => $sendForm->createView(),
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

        dump($cars);
        die();

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