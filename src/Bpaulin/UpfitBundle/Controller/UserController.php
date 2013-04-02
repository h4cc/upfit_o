<?php

namespace Bpaulin\UpfitBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/admin/user")
 */
class UserController extends AbstractController
{

    /**
     * @Route("/", name="admin_user")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/ajax", name="admin_ajax_users_list")
     * @Template()
     */
    public function usersAjaxAction(Request $request)
    {
        return $this->abstractAjaxAction(
            $request,
            'BpaulinUpfitBundle:User',
            array('id', 'username', 'email', 'gravatarUrl')
        );
    }
}
