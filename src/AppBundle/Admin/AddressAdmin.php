<?php


declare(strict_types=1);

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ChoiceFieldMaskType;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\Form\Validator\ErrorElement;
use Symfony\Component\Form\Extension\Core\Type\TextType;


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
//            ->add('media', 'string', array('template' => 'SonataMediaBundle:MediaAdmin:list_image.html.twig'))
            ->add('address', TextType::class, [
                'header_style' => 'width: 25%'])
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
            ->add(
                'objectType',
                ChoiceFieldMaskType::class,
                [
                    'choices' => [
                        'Аренда' => 'rent',
                        'Продажа' => 'sell',
                    ],
                    'placeholder' => 'Выбрать Тип объекта',
                    'required' => false,
                    'empty_data' => 'John Doe',
                ]
            )
            ->add('createdAt', 'sonata_type_datetime_picker', array(
                'format' => 'yyyy-MM-dd H:m:s',
                'widget' => 'single_text',
            ))
            ->add('updateadAt', 'sonata_type_datetime_picker', array(
                'format' => 'yyyy-MM-dd H:m:s',
                'widget' => 'single_text',
            ))
            ->add(
                'profile',
                ChoiceFieldMaskType::class,
                [
                    'choices' => [
                        'Офис в бизнес центре' => 'Офис в бизнес центре',
                        'Офис в жилом комплексе' => 'Офис в жилом комплексе',
                        'Отдельно стоящее здание' => 'Отдельно стоящее здание',
                        'Коммерческое помещение' => 'Коммерческое помещение',
                    ],
                    'placeholder' => 'Выбрать профиль',
                    'required' => false,
                    'empty_data' => 'John Doe',
                ]
            )
            ->add(
                'cityArea',
                ChoiceFieldMaskType::class,
                [
                    'placeholder' => 'Выбрать район',
                    'choices' => [
                        'Голосеевский ' => 'Голосеевский',
                        'Святошинский' => 'Святошинский',
                        'Соломенский' => 'Соломенский',
                        'Оболонский' => 'Оболонский',
                        'Подольский' => 'Подольский',
                        'Печерский' => 'Печерский',
                        'Шевченковский' => 'Шевченковский',
                        'Дарницкий' => 'Дарницкий',
                        'Днепровский' => 'Днепровский',
                        'Деснянский' => 'Деснянский',
                    ],
                    'required' => false,
                    'empty_data' => 'John Doe',
                ]
            )
            ->add('name')
            ->add('address')
            ->add('totalArea')
            ->add('floor')
            ->add('houseFloor')
            ->add('cop')
//            ->add('rentalRate')
//            ->add('rentalM')
//            ->add('nds')
//            ->add('media', 'sonata_media_type', array(
//                'provider' => 'sonata.media.provider.image',
//                'context'  => 'default'
//            ))
            ->add('totalPayment')
            ->add('contactPerson',
                ChoiceFieldMaskType::class,
                [
                    'choices' => [
                        'Александр' => 'Александр',
                        'Сергей' => 'Сергей',
                    ],
                    'required' => true,
                ]
            )
            ->add('gallery', 'sonata_type_model_list',
                array('required' => false),
                array('link_parameters' => array('context' => 'address')))

            //            ->add('percent')
            ->add('description', TextType::class)
//            ->add('state')
//            ->add('comment')
            ->add(
                'status',
                ChoiceFieldMaskType::class,
                [
                    'choices' => array(
                        'Архив' => '0',
                        'Опубликованные' => '1',
                    ),
                ]
            );
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
            ->add('gallery')
//            ->add('media', 'string', array('template' => 'SonataMediaBundle:MediaAdmin:list_image.html.twig'))
            ->add('address');
    }



    // add this method
    public function validate(ErrorElement $errorElement, $object)
    {
        $errorElement
            ->with('description')
            ->assertLength(['max' => 200])
            ->end();
       }

}