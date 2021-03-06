<?php // autogenerated on DATE by SurvosCrudBundle:Generator:Controller.php.twig
# /usr/sites/sf/survos-standard/src/Acme/MovieBundle/Controller/ProducerController.php


namespace Acme\MovieBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\PropelAdapter;

use Acme\MovieBundle\Model\ProducerQuery;
use Acme\MovieBundle\Model\Producer;
use Acme\MovieBundle\Form\Type\ProducerType;

/**
 * @Route("/Producer")
*/
class ProducerController extends Controller
{

    /**
     * @Route("/", name="acme_movie_Producer_index")
     * @Template("AcmeMovieBundle:Producer:browse.html.twig")
     */
    public function indexAction()
    {
    $query = ProducerQuery::create();
		$adapter = new PropelAdapter($query);
		$request = $this->getRequest();
    $q = $request->query->get('q', '');
    if ($q) {
      $query->filterByTitle("%$q%"); // ->_or()->filterByCity("%$q%"); ??
    }
		$page = $request->query->get('page', 1);

    $pagerfanta = new Pagerfanta($adapter);
    $pagerfanta->setMaxPerPage(20); // 10 by Producer
    $pagerfanta->setCurrentPage($page);
 	  return array(
    	  	'pager' => $pagerfanta,
    	  	'Producers' => $pagerfanta->getCurrentPageResults() );
    }

    /**
     * @Route("/edit/{id}", requirements={"id" = "\d+"}, name="acme_movie_Producer_edit")
     * @Template()
     */
    function editAction(Producer $Producer) {
        $form = $this->createForm(new ProducerType(), $Producer);

        $request = $this->getRequest();
        if ('POST' === $request->getMethod()) {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $Producer->save();
                return $this->redirect($this->generateUrl('acme_movie_Producer_display',
                  array('id' => $Producer->getId())));
            }
        }

        return array(
            'Producer' => $Producer,
            'form' => $form->createView()
        );
    }

    /**
     * @Route("/new", name="acme_movie_Producer_new")
     * @Template()
     */
    function newAction() {
        $Producer = new Producer();
        $form = $this->createForm(new ProducerType(), $Producer);

        $request = $this->getRequest();
        if ('POST' === $request->getMethod()) {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $Producer->save();
                return $this->redirect($this->generateUrl('acme_movie_Producer_display',
                  array('id' => $Producer->getId())));
            }
        }

        return array(
            'form' => $form->createView()
        );
    }

    /**
     * @Route("/{id}", name="acme_movie_Producer_display")
     * @Template()
     */
    function displayAction($id)
    {
        $producer = ProducerQuery::create()->findOneById($id);
        return array(
            'producer' => $producer
        );
    }

}

