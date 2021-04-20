<?php
namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav');
        $menu->addChild('Купить офис', ['route' => 'orders_list']);
        $menu->addChild('Арендовать офис', ['route' => 'address_list']);
        return $menu;
    }

    public function adminMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav');
        //$menu->addChild('CarsList', ['route' => 'car_list']);
        $menu->addChild('Продажа недвижемости', ['route' => 'orders_list']);
        $menu->addChild('Аренда недвижемости', ['route' => 'address_list']);
        // $menu->addChild('GetCar', ['route' => 'get_free_car']);
        // $menu->addChild('Take Orde', ['route' => 'ordersForDriver']);
        $menu->addChild('Admin', ['route' => 'sonata_admin_dashboard']);

        return $menu;
    }

    public function driverMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav');
        $menu->addChild('Take Order', ['route' => 'ordersForDriver']);

        return $menu;
    }

    public function customerMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav');
        $menu->addChild('Get taxi', ['route' => 'get_free_car']);

        return $menu;
    }


}