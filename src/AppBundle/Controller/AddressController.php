<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
//
//        var_dump($addresses);
//        die();

        /**
         * @var $paginator
         */
        $paginator = $this->get('knp_paginator');

        $result = $paginator->paginate(
            $addresses,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 3)
        );

        return $this->render('address/address.html.twig',
            [
                'addresses' => $result
            ]);
    }
}
