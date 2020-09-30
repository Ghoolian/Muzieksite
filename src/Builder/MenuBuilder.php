<?php


namespace App\Builder;


use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;



final class MenuBuilder implements ContainerAwareInterface
{

    use ContainerAwareTrait;

    public function __construct(FactoryInterface $_factory)
    {
        $this->factory = $_factory;
    }

    public function mainMenu(): ItemInterface
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild('Home', ['route' => 'home']);

        // create another menu item
        $menu->addChild('Register', ['route' => 'app_register']);
        $menu->addChild('Inloggen', ['route' => 'app_login']);

        // ... add more children
        $menu->addChild('Albums', ['route' => 'albums_index']);
        $menu->addChild('Nummers', ['route' => 'nummers_index']);
        $menu->addChild('Artiesten', ['route' => 'artiesten_index']);
        return $menu;
    }

    public function guestMenu(): ItemInterface
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild('Home', ['route' => 'home']);

        // create another menu item
        $menu->addChild('Register', ['route' => 'app_register']);
        $menu->addChild('Inloggen', ['route' => 'app_login']);
        return $menu;
    }

}