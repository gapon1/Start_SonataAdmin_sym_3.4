<?php

declare(strict_types=1);

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class OrdersAdmin extends AbstractAdmin
{
    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id')
            ->add('date')
            ->add('profile')
            ->add('address')
            ->add('district')
            ->add('status')
            ->add('name')
            ->add('complexName')
            ->add('totalArea')
            ->add('floor')
            ->add('flooring')
            ->add('priceM')
            ->add('totalPrice')
            ->add('photo')
            ->add('description')
            ->add('comments');
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('id')
            ->add('date')
            ->add('profile')
            ->add('address')
            ->add('district')
            ->add('status')
            ->add('name')
            ->add('complexName')
            ->add('totalArea')
            ->add(
                '_action',
                null,
                [
                    'actions' => [
                        'show' => [],
                        'edit' => [],
                        'delete' => [],
                    ],
                ]
            );
    }

    protected function configureFormFields(FormMapper $formMapper): void
    {

        $formMapper
            ->add('date')
            ->add('address')
            ->add('profile')
            ->add('district')
            ->add('status')
            ->add('driverIdOrd')
            ->add('name')
            ->add('complexName')
            ->add('totalArea')
            ->add('floor')
            ->add('flooring')
            ->add('priceM')
            ->add('totalPrice')
            ->add('photo')
            ->add('description')
            ->add('comments');
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('id')
            ->add('date')
            ->add('profile')
            ->add('address')
            ->add('district')
            ->add('status')
            ->add('name')
            ->add('complexName')
            ->add('totalArea')
            ->add('floor')
            ->add('flooring')
            ->add('priceM')
            ->add('totalPrice')
            ->add('photo')
            ->add('description')
            ->add('comments');
    }

}
