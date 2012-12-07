<?php

namespace Bpaulin\UpfitBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/admin/users")
 */
class UserController extends AbstractController
{

    /**
     * @Route("/list", name="admin_users_list")
     * @Template()
     */
    public function usersListAction()
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
