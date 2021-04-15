<?php

namespace AppBundle\Controller;

use AppBundle\Form\RegistrationType;
use Application\Sonata\UserBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends Controller
{

    /**
     * @Route("/register", name="user_registration")
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        // 1) build the form
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirect('/admin/login');
        }

        return $this->render(
            'security/registration.html.twig',
            ['form' => $form->createView()]
        );
    }

    /**
     * @Route("user/{userName}", name="user_show")
     */
    public function showAction($userName)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('ApplicationSonataUserBundle:User')
            ->findOneBy(['username' => $userName]);

        if (!$user) {
            throw $this->createNotFoundException('User not found');
        }

        return $this->render('users/show.html.twig', [
            'user' => $user
        ]);
    }


}