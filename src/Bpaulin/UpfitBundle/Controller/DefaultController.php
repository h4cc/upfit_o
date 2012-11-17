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
     * @return array
     * 
     * @Route("/hello")
     * @Template()
     */
    public function indexAction()
    {
        return array('name' => 'bruno');
    }
}
