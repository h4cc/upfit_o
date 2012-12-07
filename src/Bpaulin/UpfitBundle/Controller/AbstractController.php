<?php

namespace Bpaulin\UpfitBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractController extends Controller
{
    protected function abstractAjaxAction(Request $request, $entity, $columns)
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
            $row = $aRow->getArrayForJson();
            $output['aaData'][] = $row;
        }

        unset($rResult);

        return new Response(
            json_encode($output)
        );
    }
}
