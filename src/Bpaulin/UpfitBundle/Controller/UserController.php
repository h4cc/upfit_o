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
class UserController extends Controller
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
        return $this->ajaxActionGen(
            $request,
            'BpaulinUpfitBundle:User',
            array('id', 'username', 'email', 'gravatarUrl')
        );
    }

    protected function ajaxActionGen(Request $request, $entity, $columns)
    {
        $get = $request->query->all();
        if (!isset($get['sEcho'])) {
            $get['sEcho']=1;
        }
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
        * you want to insert a non-database field (for example a counter or static image)
        */
        $get['columns'] = &$columns;

        $em = $this->getDoctrine()->getEntityManager();
        $ajaxTable = $em->getRepository($entity)->ajaxTable($get, true);

        $countUnfiltered = $ajaxTable[0];
        $rResult =  $ajaxTable[1]->getResult();

        /* Data set length after filtering */
        $iFilteredTotal = count($rResult);

        /*
         * Output
         */
        $output = array(
            "sEcho" => intval($get['sEcho']),
            "iTotalRecords" => $em->getRepository($entity)->getCount(),
            "iTotalDisplayRecords" => $countUnfiltered,
            "aaData" => array()
        );

        foreach ($rResult as $aRow) {
            $row = array(
                $aRow->getId(),
                $aRow->getUsername(),
                $aRow->getEmail(),
                $aRow->getGravatarurl(),
                );

            $output['aaData'][] = $row;
        }

        unset($rResult);

        return new Response(
            json_encode($output)
        );
    }
}
