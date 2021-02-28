<?php

declare(strict_types=1);

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class CarAdminAdmin extends AbstractAdmin
{
    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id')
            ->add('carName')
            ->add('carImg')
            ->add('carType')
            ->add('carDiscript')
        ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('id')
            ->add('carName')
            ->add('carImg')
            ->add('carType')
            ->add('carDiscript')
            ->add('driverId')
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ])
        ;
    }

    protected function configureFormFields(FormMapper $formMapper): void
    {
        $formMapper
            ->add('carName')
            ->add('carImg')
            ->add('carType')
            ->add('carDiscript')
            ->add('driverId')
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('id')
            ->add('carName')
            ->add('carImg')
            ->add('carType')
            ->add('carDiscript')
            ->add('driverId')
        ;
    }
}
