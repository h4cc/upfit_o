<?php

namespace Bpaulin\UpfitBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/user/session")
 */
class SessionController extends Controller
{
    /**
     * @Route("/", name="user_session")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
}
