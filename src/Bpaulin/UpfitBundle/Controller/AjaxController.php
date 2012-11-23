<?php

namespace Bpaulin\UpfitBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/ajax")
 */
class AjaxController extends Controller
{

    /**
     * @Route("/admin/users/list", name="admin_ajax_users_list")
     * @Template()
     */
    public function usersListAction(Request $request)
    {
        $get = $request->query->all();
        if (!isset($get['sEcho'])) {
            $get['sEcho']=1;
        }
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
        * you want to insert a non-database field (for example a counter or static image)
        */
        $columns = array('id', 'username', 'email');
        $get['columns'] = &$columns;

        $em = $this->getDoctrine()->getEntityManager();
        $rResult = $em->getRepository('BpaulinUpfitBundle:User')->ajaxTable($get, true)->getArrayResult();

        /* Data set length after filtering */
        $iFilteredTotal = count($rResult);

        /*
         * Output
         */
        $output = array(
            "sEcho" => intval($get['sEcho']),
            "iTotalRecords" => $em->getRepository('BpaulinUpfitBundle:User')->getCount(),
            "iTotalDisplayRecords" => $iFilteredTotal,
            "aaData" => array()
        );

        foreach ($rResult as $aRow) {
            $row = array();
            for ($i=0; $i<count($columns); $i++) {
                if ($columns[$i] == "email") {
                    /* Special output formatting for 'version' column */
                    $row[] = $aRow[ $columns[$i] ];
                    $row[] = md5(strtolower(trim($aRow[ $columns[$i] ])));
                } elseif ($columns[$i] != ' ') {
                    /* General output */
                    $row[] = $aRow[ $columns[$i] ];
                }
            }
            $output['aaData'][] = $row;
        }

        unset($rResult);

        return new Response(
            json_encode($output)
        );
    }
}
