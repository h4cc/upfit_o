<?php

namespace Bpaulin\UpfitBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Controlleur par defaut
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="upfit_home")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/user/", name="user_home")
     * @Template()
     */
    public function userAction()
    {
        $em = $this->getDoctrine()->getManager();

        $members = $em->getRepository('BpaulinUpfitBundle:Member')->findBy(
            array(
                'user'  => $this->getUser(),
            )
        );

        $sessions = $em->getRepository('BpaulinUpfitBundle:Session')->findByUser($this->getUser());

        return array(
            'members' => $members,
            'sessions' => $sessions,
        );
    }
}
