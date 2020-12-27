<?php


declare(strict_types=1);

namespace AppBundle\Admin;

use AppBundle\Controller\AddressController;
use AppBundle\Entity\Address;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use AppBundle\Form\Type\ImageType;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class AddressAdmin extends AbstractAdmin
{
    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id')
            ->add('createdAt')
            ->add('updateadAt')
            ->add('profile')
            ->add('cityArea')
            ->add('name')
            ->add('address')
        ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('id')
            ->add('createdAt')
            ->add('updateadAt')
            ->add('profile')
            ->add('cityArea')
            ->add('name')
            ->add('address')
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
        $image = new Address();

        $formMapper
            ->add('createdAt')
            ->add('updateadAt')
            ->add('profile')
            ->add('cityArea')
            ->add('name')
            ->add('address')
            ->add('totalArea')
            ->add('floor')
            ->add('houseFloor')
            ->add('cop')
            ->add('rentalRate')
            ->add('rentalM')
            ->add('nds')
            ->add('totalPayment')
            ->add('contactPerson')
            ->add('percent')
            ->add('description')
            ->add('image', FileType::class, [
                'allow_file_upload' => '/uploads/uploads/',
                'data_class' => null
        ])
            ->add('state')
            ->add('comment')
        ;
    }

    public function prePersist($image)
    {
        $this->manageFileUpload($image);
    }

    public function preUpdate($image)
    {
        $this->manageFileUpload($image);
    }

    private function manageFileUpload($image)
    {
//        var_dump($image);
//        die();
        if ($image->getFile()) {
            $image->refreshUpdated();
        }
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('id')
            ->add('createdAt')
            ->add('updateadAt')
            ->add('profile')
            ->add('cityArea')
            ->add('name')
            ->add('address')
        ;
    }

}