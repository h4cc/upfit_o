<?php

namespace Bpaulin\UpfitBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Bpaulin\UpfitBundle\Entity\User;

class LoadUsersData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        for ($idUser=0; $idUser < 100; $idUser++) {
            $user = new User();

            $user->setUsername("user$idUser");
            $user->setPlainPassword("user$idUser");
            $user->setEmail("user$idUser@upfit.com");

            $manager->persist($user);
        }
        $manager->flush();
    }
}