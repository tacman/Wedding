<?php // eventually this may be auto-generated for defined AdminBundle

namespace Survos\AdminBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\Yaml\Yaml;

class AdminMenuBuilder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory)
    {
        $menu = $factory->createItem('root');
        $menu->setAttribute('class', 'nav'); // outer ul
        $menu->setCurrentUri($this->container->get('request')->getRequestUri());

        $menu->addChild('Home', array('route' => 'survos_admin_index'));

      // this is an awkward way to get the installed bundles with generated code
      // this is SELF -- how do we get this?
      $adminBundle = $this->container->get('kernel')->getBundle('SurvosAdminBundle');
      foreach (glob($adminBundle->getPath() .
        sprintf("/Resources/config/*.yml")) as $schemaMenu) {
        $sh = Yaml::parse($schemaMenu);
        $bMenu = $menu->addChild($sh['code'],
          array(
            'route' => 'henge_admin_index'));
        $bMenu->setLinkAttribute('class', 'dropdown-toggle');
        $bMenu->setAttribute('class', 'dropdown'); // goes on the li
        $bMenu->setChildrenAttribute('class', 'dropdown-menu'); // goes on the ul inside the above li
        foreach ($sh['controllers'] as $phpName=>$con) {
          $bMenu->addChild($phpName, array('route' => $con['route']));
        }
      }


        // $this->addGeneratedMenus($this);
        /*
        // $menu->addChild('Login', array('route' => 'henge_login'));
        $henge = $menu->addChild('Henge', array('route' => 'henge_admin_index'));
        $henge->setLinkAttribute('class', 'dropdown-toggle');

        $henge->setAttribute('class', 'dropdown'); // goes on the li
        $henge->setChildrenAttribute('class', 'dropdown-menu'); // goes on the ul inside the above li

        $henge->addChild('Events', array('route' => 'henge_Event_index'));
        $henge->addChild('Companies', array('route' => 'henge_Company_index'));
        $henge->addChild('Venues', array('route' => 'henge_Venue_index'));
        $henge->addChild('Attendees', array('route' => 'henge_Attendee_index'));
        $menu->addChild('Code Generation', array('route' => 'crud_bundles'));
        */

        return $menu;
    }
    public function sidebarMenu(FactoryInterface $factory)
    {
        $menu = $factory->createItem('root');
        $menu->setCurrentUri($this->container->get('request')->getRequestUri());

        $menu->addChild('Stonehenges', array('route' => 'henge_events'));
        $menu->addChild('People', array('route' => 'henge_people'));
        $menu->addChild('Production Companies', array('route' => 'henge_companies'));
        /*
        $ex_menu->addChild('Example 1', array('route'=>'ex_1'));
        */
        // ... add more children

        return $menu;
    }
}