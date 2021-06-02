<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepageAction(Request $request)
    {

        $form = $this->createFormBuilder()
            ->add('name', TextType::class, ['label' => 'Ваше имя','required' => true])
            ->add('email', EmailType::class, ['label' => 'Ваш Email','required' => true])
            ->add('message', TextareaType::class, ['label' => 'Сообщение'])
            ->add('send', SubmitType::class, ['label' => 'Отправить',])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $message = \Swift_Message::newInstance()
                ->setSubject('Заявка на аренду')
                ->setFrom('brokergma@thebroker.website')
                ->setTo('gapon007@ukr.net')
                ->setBody(
                    $form->getData()['message'] . '<br>' .
                    "Name: " . $form->getData()['name'] . '<br>' .
                    "Email: " . $form->getData()['email'] . '<br>' .
                    'text/html'
                );

            $this->get('mailer')->send($message);
            $this->addFlash('success', 'Заявка успешно отправлена!');
        }

        return $this->render('main/homepage.html.twig',
            [
                'form' => $form->createView()
            ]);
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




}
