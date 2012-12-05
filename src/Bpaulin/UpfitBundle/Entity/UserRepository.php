<?php

namespace Bpaulin\UpfitBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends EntityRepository
{

    public function ajaxTableGen(array $get, $tableObjectName, $flag = false)
    {
        /* Indexed column (used for fast and accurate table cardinality) */
        $alias = 'a';

        /**
         * Columns definitions
         */
        if (!isset($get['columns']) || empty($get['columns'])) {
            $get['columns'] = array('id');
        }
        $aColumns = array();
        foreach ($get['columns'] as $value) {
            $aColumns[] = $alias .'.'. $value;
        }

        $cb = $this->getEntityManager()
                   ->getRepository($tableObjectName)
                   ->createQueryBuilder($alias)
                   ->select(str_replace(" , ", " ", implode(", ", $aColumns)));

        $cbCount = $this->getEntityManager()
                        ->getRepository($tableObjectName)
                        ->createQueryBuilder($alias)
                        ->select('COUNT (a)')
                        ->setMaxResults(1);

        /*
         * Filtering
         * NOTE this does not match the built-in DataTables filtering which does it
         * word by word on any field. It's possible to do here, but concerned about efficiency
         * on very large tables, and MySQL's regex functionality is very limited
         */
        if ( isset($get['sSearch']) && $get['sSearch'] != '' ) {
            $aLike = array();
            for ($i=0; $i<count($aColumns); $i++) {
                if ( isset($get['bSearchable_'.$i]) && $get['bSearchable_'.$i] == "true" ) {
                    $aLike[] = $cb->expr()->like($aColumns[$i], '\'%'. $get['sSearch'] .'%\'');
                }
            }
            if (count($aLike) > 0) {
                $cb->andWhere(new Expr\Orx($aLike));
                $cbCount->andWhere(new Expr\Orx($aLike));
            } else {
                unset($aLike);
            }
        }

        $result = $cbCount->getQuery()->getResult();
        $countUnfiltered = $result[0][1];
        /*
         * Ordering
         */
        if (isset($get['iSortCol_0'])) {
            for ($i=0; $i<intval($get['iSortingCols']); $i++) {
                if ($get['bSortable_'.intval($get['iSortCol_'.$i])] == "true") {
                    $cb->orderBy($aColumns[(int) $get['iSortCol_'.$i]], $get['sSortDir_'.$i]);
                }
            }
        }

        /*
         * Limiting
         */
        if ( isset($get['iDisplayStart']) && $get['iDisplayLength'] != '-1' ) {
            $cb->setFirstResult((int) $get['iDisplayStart'])
                ->setMaxResults((int) $get['iDisplayLength']);
        }

        /*
         * SQL queries
         * Get data to display
         */
        $query = $cb->getQuery();

        if ($flag) {
            return array($countUnfiltered, $query);
        } else {
            return array($countUnfiltered, $query->getResult());
        }
    }

    /**
     * @param  array $get
     * @param  bool  $flag
     * @return array
     */
    public function ajaxTable(array $get, $flag = false)
    {
        return $this->ajaxTableGen($get, 'BpaulinUpfitBundle:User', $flag);
    }

    /**
     * @return int
     */
    public function getCount()
    {
        $aResultTotal = $this->getEntityManager()
            ->createQuery('SELECT COUNT(a) FROM BpaulinUpfitBundle:User a')
            ->setMaxResults(1)
            ->getResult();

         return $aResultTotal[0][1];
    }
}
