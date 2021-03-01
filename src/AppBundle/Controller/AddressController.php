<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Address;
use AppBundle\Form\AddressType;
use AppBundle\Form\ApplicationType;
use AppBundle\Service\SetGallery;
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


        foreach ($addresses as $address){
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

        return $this->render(
            'address/address.html.twig',
            [
                'addresses' => $addresses,
                'gallery' => $galleryArray,
                'formComment' => $form->createView(),
                'sendForm' => $sendForm->createView(),
            ]
        );
    }

    /**
     *
     * @Route("/comment/{id}", name="editComment", methods={"POST","HEAD"})
     */
    public function editCommentAction(Request $request, $id)
    {

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
