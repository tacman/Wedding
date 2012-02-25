<?php // autogenerated on DATE by SurvosCrudBundle:Generator:Controller.php.twig
# /usr/sites/sf/survos-standard/src/Acme/MovieBundle/Controller/ActorController.php


namespace Acme\MovieBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\PropelAdapter;

use Acme\MovieBundle\Model\ActorQuery;
use Acme\MovieBundle\Model\Actor;
use Acme\MovieBundle\Form\Type\ActorType;

/**
 * @Route("/Actor")
*/
class ActorController extends Controller
{

    /**
     * @Route("/", name="acme_movie_Actor_index")
     * @Template("AcmeMovieBundle:Actor:browse.html.twig")
     */
    public function indexAction()
    {
    $query = ActorQuery::create();
		$adapter = new PropelAdapter($query);
		$request = $this->getRequest();
    $q = $request->query->get('q', '');
    if ($q) {
      $query->filterByTitle("%$q%"); // ->_or()->filterByCity("%$q%"); ??
    }
		$page = $request->query->get('page', 1);

    $pagerfanta = new Pagerfanta($adapter);
    $pagerfanta->setMaxPerPage(20); // 10 by Actor
    $pagerfanta->setCurrentPage($page);
 	  return array(
    	  	'pager' => $pagerfanta,
    	  	'Actors' => $pagerfanta->getCurrentPageResults() );
    }

    /**
     * @Route("/edit/{id}", requirements={"id" = "\d+"}, name="acme_movie_Actor_edit")
     * @Template()
     */
    function editAction(Actor $Actor) {
        $form = $this->createForm(new ActorType(), $Actor);

        $request = $this->getRequest();
        if ('POST' === $request->getMethod()) {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $Actor->save();
                return $this->redirect($this->generateUrl('acme_movie_Actor_display',
                  array('id' => $Actor->getId())));
            }
        }

        return array(
            'Actor' => $Actor,
            'form' => $form->createView()
        );
    }

    /**
     * @Route("/new", name="acme_movie_Actor_new")
     * @Template()
     */
    function newAction() {
        $Actor = new Actor();
        $form = $this->createForm(new ActorType(), $Actor);

        $request = $this->getRequest();
        if ('POST' === $request->getMethod()) {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $Actor->save();
                return $this->redirect($this->generateUrl('acme_movie_Actor_display',
                  array('id' => $Actor->getId())));
            }
        }

        return array(
            'form' => $form->createView()
        );
    }

    /**
     * @Route("/{id}", name="acme_movie_Actor_display")
     * @Template()
     */
    function displayAction($id)
    {
        $actor = ActorQuery::create()->findOneById($id);
        return array(
            'actor' => $actor
        );
    }

}

