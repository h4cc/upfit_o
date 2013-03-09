<?php

namespace Bpaulin\UpfitBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Bpaulin\UpfitBundle\Entity\Workout;

/**
 * Workout controller.
 *
 * @Route("/workout")
 */
class WorkoutController extends Controller
{
    /**
     * Lists all Workout entities.
     *
     * @Route("/", name="workout")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BpaulinUpfitBundle:Workout')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Workout entity.
     *
     * @Route("/{id}", name="workout_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BpaulinUpfitBundle:Workout')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Workout entity.');
        }

        return array(
            'entity'      => $entity,
        );
    }
}
