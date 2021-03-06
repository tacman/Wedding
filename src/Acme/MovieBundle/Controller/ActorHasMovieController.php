<?php // autogenerated on DATE by SurvosCrudBundle:Generator:Controller.php.twig
# /usr/sites/sf/survos-standard/src/Acme/MovieBundle/Controller/ActorHasMovieController.php


namespace Acme\MovieBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\PropelAdapter;

use Acme\MovieBundle\Model\ActorHasMovieQuery;
use Acme\MovieBundle\Model\ActorHasMovie;
use Acme\MovieBundle\Form\Type\ActorHasMovieType;

/**
 * @Route("/ActorHasMovie")
*/
class ActorHasMovieController extends Controller
{

    /**
     * @Route("/", name="acme_movie_ActorHasMovie_index")
     * @Template("AcmeMovieBundle:ActorHasMovie:browse.html.twig")
     */
    public function indexAction()
    {
    $query = ActorHasMovieQuery::create();
		$adapter = new PropelAdapter($query);
		$request = $this->getRequest();
    $q = $request->query->get('q', '');
    if ($q) {
      $query->filterByTitle("%$q%"); // ->_or()->filterByCity("%$q%"); ??
    }
		$page = $request->query->get('page', 1);

    $pagerfanta = new Pagerfanta($adapter);
    $pagerfanta->setMaxPerPage(20); // 10 by ActorHasMovie
    $pagerfanta->setCurrentPage($page);
 	  return array(
    	  	'pager' => $pagerfanta,
    	  	'ActorHasMovies' => $pagerfanta->getCurrentPageResults() );
    }

    /**
     * @Route("/edit/{id}", requirements={"id" = "\d+"}, name="acme_movie_ActorHasMovie_edit")
     * @Template()
     */
    function editAction(ActorHasMovie $ActorHasMovie) {
        $form = $this->createForm(new ActorHasMovieType(), $ActorHasMovie);

        $request = $this->getRequest();
        if ('POST' === $request->getMethod()) {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $ActorHasMovie->save();
                return $this->redirect($this->generateUrl('acme_movie_ActorHasMovie_display',
                  array('id' => $ActorHasMovie->getId())));
            }
        }

        return array(
            'ActorHasMovie' => $ActorHasMovie,
            'form' => $form->createView()
        );
    }

    /**
     * @Route("/new", name="acme_movie_ActorHasMovie_new")
     * @Template()
     */
    function newAction() {
        $ActorHasMovie = new ActorHasMovie();
        $form = $this->createForm(new ActorHasMovieType(), $ActorHasMovie);

        $request = $this->getRequest();
        if ('POST' === $request->getMethod()) {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $ActorHasMovie->save();
                return $this->redirect($this->generateUrl('acme_movie_ActorHasMovie_display',
                  array('id' => $ActorHasMovie->getId())));
            }
        }

        return array(
            'form' => $form->createView()
        );
    }

    /**
     * @Route("/{id}", name="acme_movie_ActorHasMovie_display")
     * @Template()
     */
    function displayAction($id)
    {
        $actorHasMovie = ActorHasMovieQuery::create()->findOneById($id);
        return array(
            'actorHasMovie' => $actorHasMovie
        );
    }

}

