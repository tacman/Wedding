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
      $photos = array(

        array(
        'image'=>'/images/album/halong_bay.jpg',
        'caption'=>'Halong Bay, Vietnam'
        ),

        array(
        'image'=>'https://lh4.googleusercontent.com/-k7i32vbZtls/T0ljlLiejvI/AAAAAAAAAKo/6jgCfKx7O-Y/w532-h399-k/IMG_2771.JPG',
        'caption'=>'Antigua, Guatemala'
        ),
        array(
        'image'=>'https://lh5.googleusercontent.com/-1AKjkYA1www/T0lAi3Wss5I/AAAAAAAAJVA/b3uurMg5R80/s720/P1020598.JPG',
        'caption'=>'Angkor Wat, Cambodia (2010)'
        ),
        array(
        'image'=>'https://lh3.googleusercontent.com/-7rrj7HanuNg/T0lAkV_EKBI/AAAAAAAAJVY/5RQETnwaM80/s720/P1070266.JPG',
        'caption'=>'Lake Geneva, Switzerland'
        )
      );


      $params = array(
        'bride'=>'Linda G. Greenberg',
        'groom'=>'Michael "Tac" Tacelosky',
        'bride_first'=>'Linda',
        'groom_first'=>'Tac',
        'photos'=>$photos,
      );

        return $params;
    }

    /**
     * @Route("/send", name="wedding_contact_send")
     * @Template("TacWeddingBundle:Default:response.html.twig")
     */
    public function sendAction()
    {
    $request = $this->getRequest();

    $message = \Swift_Message::newInstance()
        ->setSubject('Wedding Message: ' . $request->request->get('subject', "Subject"))
        ->setFrom($request->request->get('email', ''))
        ->setTo('linda.g.greenberg@gmail.com')
        ->setCc('tacman@gmail.com')
        ->setBody($this->renderView('TacWeddingBundle:Default:email.txt.twig',
          array('message' => $request->request->get('message', 'MESSAGE'))))
    ;
    $this->get('mailer')->send($message);

    return array('response'=>"Message sent.");
    }

}
