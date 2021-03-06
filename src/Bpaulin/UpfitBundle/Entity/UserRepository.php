<?php

namespace Bpaulin\UpfitBundle\Entity;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends AbstractRepository
{
    /**
     * @param  array $get
     * @param  bool  $flag
     * @return array
     */
    public function ajaxTable(array $get, $flag = false)
    {
        return $this->abstractAjaxTable($get, 'BpaulinUpfitBundle:User', $flag);
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
