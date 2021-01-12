<?php


declare(strict_types=1);

namespace AppBundle\Admin;

use AppBundle\Controller\AddressController;
use AppBundle\Entity\Address;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ChoiceFieldMaskType;
use Sonata\AdminBundle\Form\Type\Filter\ChoiceType;
use Sonata\AdminBundle\Show\ShowMapper;
use AppBundle\Form\Type\ImageType;
use Sonata\DoctrineORMAdminBundle\Filter\StringFilter;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class AddressAdmin extends AbstractAdmin
{
    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add(
                'objectType',
                'doctrine_orm_string',
                ['label' => 'По типу'],
                'choice',
                array(
                    'choices' => array(
                        'Аренда' => 'rent',
                        'Продажа' => 'sell',
                    ),
                    'placeholder' => 'Выберите тип объекта',
                )
            )
            ->add(
                'status',
                'doctrine_orm_string',
                ['label' => 'По Архиву'],
                'choice',
                array(
                    'choices' => array(
                        'Архив' => '0',
                        'Опубликованные' => '1',
                    ),
                    'placeholder' => 'Выберите статус объекта',
                )
            )
            ->add(
                'createdAt',
                'doctrine_orm_date_range',
                ['label' => 'Дота создания'],
                'sonata_type_date_range_picker',
                [
                    'field_options_start' => [
                        'format' => 'dd.MM.yyyy',
                    ],
                    'field_options_end' => [
                        'format' => 'dd.MM.yyyy',
                    ],
                ]
            );

    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('id')
            ->add('objectType')
            ->add('createdAt')
            ->add('updateadAt')
            ->add('status')
            ->add('cityArea')
            ->add('name')
            ->add('address')
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
        $image = new Address();

        $formMapper
            ->add(
                'objectType',
                ChoiceFieldMaskType::class,
                [
                    'choices' => [
                        'Аренда' => 'rent',
                        'Продажа' => 'sell',
                    ],
                    'placeholder' => 'Выберите тип объекта',
                    'required' => true,
                ]
            )
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
            ->add(
                'image',
                ImageType::class,
                [
                    'allow_file_upload' => $image->getImagePath(),
                    'data_class' => null,
                ]
            )
            ->add('state')
            ->add('comment')
            ->add(
                'status',
                ChoiceFieldMaskType::class,
                [
                    'choices' => array(
                        'Архив' => '0',
                        'Опубликованные' => '1',
                    ),
                    'required' => true,
                ]
            );
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

        $uploads_dir = '../uploads/uploads/object/';
        foreach ($_FILES as $file) {
            foreach ($file["error"] as $key => $error) {
                if ($error == UPLOAD_ERR_OK) {
                    $tmp_name = $file["tmp_name"][$key];
                    // basename() может предотвратить атаку на файловую систему;
                    // может быть целесообразным дополнительно проверить имя файла
                    $name = basename($file["name"][$key]);
                    //move_uploaded_file($tmp_name, "$uploads_dir/$name");
                    move_uploaded_file(
                        $tmp_name,
                        $uploads_dir.$name
                    );
                }
            }
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
            ->add('address');
    }

}