<?php
declare(strict_types=1);


namespace AppBundle\Admin;


use AppBundle\Entity\Address;
use AppBundle\Repository\ArchiveRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Entity;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ArchiveAdmin extends AbstractAdmin
{
    //protected $perPageOptions = [10, 32, 64, 128, 256, 'All'];

//    protected $datagridValues = [
//        '_sort_order' => 'ASC',
//        '_sort_by' => 'status',
//        'status' => array ( 'value' => 0),
//    ];
    public $data = '';

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id')
            ->add('objectId');
    }

    protected function configureListFields(ListMapper $listMapper)
    {

        $listMapper
            ->add('id')

          // ->add('custom', 'string', array('template' => '/archive/list_custom.html.twig'))
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ]
            ]);

    }


    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('id')
            ->add('objectId')
            ->add('objectType')
        ;
    }

    protected function configureFormFields(FormMapper $formMapper): void
    {

        $formMapper
            ->add('objectId')
            ->add('objectId')
        ;
    }


}