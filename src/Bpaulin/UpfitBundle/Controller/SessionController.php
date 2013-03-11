<?php

namespace Bpaulin\UpfitBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Bpaulin\UpfitBundle\Entity\Session;

/**
 * Session controller.
 *
 * @Route("/user/session")
 */
class SessionController extends Controller
{
    /**
     * Commencer une session
     *
     * @Route("/new", name="user_session_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BpaulinUpfitBundle:Session')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Lists all Session entities.
     *
     * @Route("/", name="session")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BpaulinUpfitBundle:Session')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Session entity.
     *
     * @Route("/{id}", name="session_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BpaulinUpfitBundle:Session')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Session entity.');
        }

        return array(
            'entity'      => $entity,
        );
    }
}
