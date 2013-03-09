<?php

namespace Bpaulin\UpfitBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Bpaulin\UpfitBundle\Entity\Exercise;

/**
 * Exercise controller.
 *
 * @Route("/exercise")
 */
class ExerciseController extends Controller
{
    /**
     * Lists all Exercise entities.
     *
     * @Route("/", name="exercise")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BpaulinUpfitBundle:Exercise')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Exercise entity.
     *
     * @Route("/{id}", name="exercise_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BpaulinUpfitBundle:Exercise')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Exercise entity.');
        }

        return array(
            'entity'      => $entity,
        );
    }
}
