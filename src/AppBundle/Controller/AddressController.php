<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Address;
use AppBundle\Form\AddressType;
use FOS\UserBundle\Mailer\Mailer;
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

        $defaultData = ['message' => '<h3>Сообщение с ( brokergma.com ), таблица Аренда</h3>'];
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
            $message = \Swift_Message::newInstance()
                ->setSubject('Заявка на аренду')
                ->setFrom('brokergma@thebroker.website')
                ->setTo('brokergma@thebroker.website')
                ->setBody(
                    $sendForm->getData()['message']. '<br>'.
                    "Name: " . $sendForm->getData()['name']. '<br>'.
                    "Phone: " . $sendForm->getData()['phone']. '<br>'.
                    "Email: " . $sendForm->getData()['email']. '<br>'.
                    "Id обекта: <b>" . $sendForm->getData()['id'] . '</b>',
                    'text/html'
                )
            ;

            $this->get('mailer')->send($message);
            $this->addFlash('success', 'Заявка успешно отправлена!');
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
