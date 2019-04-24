<?php

namespace AppBundle\Form;

use AppBundle\Controller\OrderController;
use AppBundle\Entity\CarAdmin;
use AppBundle\Repository\CarAdminRepository;
use Application\Sonata\UserBundle\Entity\User;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\User\UserInterface;

class OrderFormType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('fromAddress')
            ->add('toAddress')
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'attr' => ['class' => 'js-datepicker'],
                'html5' => false,
            ])
            ->add('status', HiddenType::class, [
                'data' => 'call'
            ])
            ->add('driverIdOrd', HiddenType::class, [
                'data' => 1
            ])
//            ->add('userOrder', HiddenType::class, [
//                'data' => 2
//            ])
            ->add('car', EntityType::class, [
                'placeholder' => 'Choose car',
                'class' => CarAdmin::class,
                'query_builder' => function (CarAdminRepository $repository){
                return $repository->getCar();
                }
            ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Orders'
        ]);
    }

}
