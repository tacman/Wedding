<?php

namespace Tac\WeddingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
      $params = array(
        'bride'=>'Linda G. Greenberg',
        'groom'=>'Michael "Tac" Tacelosky',
        'bride_first'=>'Linda',
        'groom_first'=>'Tac'
      );
      return $params;
    }
}
