<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Address;
use AppBundle\Form\AddressType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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

        $defaultData = ['message' => 'Type your message here'];
        $sendForm = $this->createFormBuilder($defaultData)
            ->add('id', HiddenType::class, [
                'data' => '',
                'block_name' => 'send_id',
            ])
            ->add('name', TextType::class)
            ->add('phone', TelType::class)
            ->add('email', EmailType::class)
            ->add('send', SubmitType::class, [
                'label' => 'Отправить'
            ])
            ->getForm();

        $sendForm->handleRequest($request);

        if ($sendForm->isSubmitted() && $sendForm->isValid()) {
            $myappContactMail = 'am@brokergma.com';
            $myappContactPassword = '4756Mag1';

            // In this case we'll use the ZOHO mail services.
            // If your service is another, then read the following article to know which smpt code to use and which port
            // http://ourcodeworld.com/articles/read/14/swiftmailer-send-mails-from-php-easily-and-effortlessly
            $transport = \Swift_SmtpTransport::newInstance('smtp.hostinger.com.ua', 465,'ssl')
                ->setUsername($myappContactMail)
                ->setPassword($myappContactPassword);

            $mailer = \Swift_Mailer::newInstance($transport);

            $message = \Swift_Message::newInstance("Our Code World Contact Form ".'Subject')
                ->setFrom(array($myappContactMail => "Message by name"))
                ->setTo(array(
                    $myappContactMail => $myappContactMail
                ))
                ->setBody("<br>ContactMail :". 'email');
            $this->addFlash('success', 'Комментарий успешно изменен!');
            return $mailer->send($message);

        }

        return $this->render('address/address.html.twig',
            [
                'addresses' => $addresses,
                'formComment' => $form->createView(),
                'sendForm' => $sendForm->createView()
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
