<?php

namespace Bpaulin\UpfitBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/admin")
 */
class UserController extends Controller
{

    /**
     * @Route("/users/list", name="admin_users_list")
     * @Template()
     */
    public function usersListAction()
    {
        return array();
    }
}
