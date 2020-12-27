<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Address;
use AppBundle\Form\AddressType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AddressController extends Controller
{
    /**
     * @Route("/address_list", name="address_list")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $addresses = $em->getRepository('AppBundle:Address')
        ->findAll();


        $address = new Address();
        $form = $this->createForm(AddressType::class, $address);
        $form->handleRequest($request);
        return $this->render('address/address.html.twig',
            [
                'addresses' => $addresses,
                'formComment' => $form->createView()
            ]);
    }

    /**
     *
     * @Route("/comment/{id}", name="editComment", methods={"POST","HEAD"})
     */
    public function editCommentAction(Request $request, $id){

        $em = $this->getDoctrine()->getManager();
        $orders = $em->getRepository('AppBundle:Address')
            ->findOneBy(['id' => $id]);

        $orders->setComment($_POST['comment']);
        $this->addFlash('success', 'Комментарий успешно изменен!');

        $em->persist($orders);
        $em->flush();

        return $this->redirectToRoute('address_list');
    }
}
