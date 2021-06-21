<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\JsonResponse;
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
        return $this->render('main/homepage.html.twig',
            [
                'form' => $form->createView()
            ]);
    }

    /**
     * @Route("/form_new", name="form_new")
     */
    public function newAction()
    {
        if ($_POST) {
            $messageForm = \Swift_Message::newInstance()
                ->setSubject('Форма Контактная информация')
                ->setFrom('brokergma@thebroker.website')
                ->setTo('brokergma@thebroker.website')
                ->setBody(
                    $_POST['form']['message'] . '<br>' .
                    "Name: " . $_POST['form']['name'] . '<br>' .
                    "Email: " . $_POST['form']['email'] . '<br>',
                    'text/html'
                );

            $status = "success";
            $message = "new department saved";
            $this->get('mailer')->send($messageForm);

        }else{
            $message = "invalid form data";
        }

        $response = array(
            'status' => $status,
            'message' => $message
        );

        return new JsonResponse($response);

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
