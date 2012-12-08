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
        for ($idUser=0; $idUser < 33; $idUser++) {
            $user = new User();

            $user->setUsername("user$idUser");
            $user->setPlainPassword("user$idUser");
            $user->setEmail("user$idUser@upfit.com");
            $user->setEnabled(true);

            $manager->persist($user);
        }

        $user = new User();
        $user->setUsername("admin");
        $user->setPlainPassword("admin");
        $user->setEmail("bpupfit@gmail.com");
        $user->setEnabled(true);
        $user->addRole('ROLE_ADMIN');

        $manager->persist($user);

        $manager->flush();
    }
}
