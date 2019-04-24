<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepageAction()
    {
        $session = new Session();
        $user = $this->getUser()->getId();
        $session->set('UserInfo', $user);

        return $this->render('main/homepage.html.twig');
    }
    /**
     * @Route("/about", name="about")
     */
    public function aboutAction()
    {
        return $this->render('main/about.html.twig');
    }
    /**
     * @Route("/contact", name="contact")
     */
    public function contactAction()
    {
        return $this->render('main/contact.html.twig');
    }
    /**
     * @Route("/error", name="errorPage")
     */
    public function errorAction()
    {
        return $this->render('main/404.html.twig');
    }
}
