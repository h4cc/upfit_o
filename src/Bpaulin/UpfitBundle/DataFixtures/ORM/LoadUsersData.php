<?php

namespace Bpaulin\UpfitBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Bpaulin\UpfitBundle\Entity\User;
use Bpaulin\UpfitBundle\Entity\Social;
use Bpaulin\UpfitBundle\Entity\UserSocial;

class LoadUsersData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $users = array();
        for ($idUser=1; $idUser < 10; $idUser++) {
            $user = new User();

            $user->setUsername("user$idUser");
            $user->setPlainPassword("user$idUser");
            $user->setEmail("user$idUser@upfit.com");
            $user->setEnabled(true);

            $manager->persist($user);
            $users[$idUser] = $user;
        }

        $admin = new User();
        $admin->setUsername("admin");
        $admin->setPlainPassword("admin");
        $admin->setEmail("bpupfit@gmail.com");
        $admin->setEnabled(true);
        $admin->addRole('ROLE_ADMIN');

        $manager->persist($admin);

        $social = new Social();
        $social->setName('social1')
                ->setCreatedDate(new \DateTime('now'));

        $manager->persist($social);

        $userSocial = new UserSocial();
        $userSocial->setUser($users[1])
                    ->setSocial($social)
                    ->setInvitedDate(new \DateTime('now'))
                    ->setGroupName('social1 by user1')
                    ->setStatus(2);
        $manager->persist($userSocial);

        $userSocial = new UserSocial();
        $userSocial->setUser($users[2])
                    ->setSocial($social)
                    ->setInvitedDate(new \DateTime('now'))
                    ->setGroupName('social1 by user2')
                    ->setStatus(1);
        $manager->persist($userSocial);

        $userSocial = new UserSocial();
        $userSocial->setUser($users[3])
                    ->setSocial($social)
                    ->setInvitedDate(new \DateTime('now'))
                    ->setGroupName('social1 by user3')
                    ->setStatus(0);
        $manager->persist($userSocial);

        $userSocial = new UserSocial();
        $userSocial->setUser($users[4])
                    ->setSocial($social)
                    ->setInvitedDate(new \DateTime('now'))
                    ->setGroupName('social1 by user4')
                    ->setStatus(-1);
        $manager->persist($userSocial);

        $manager->flush();
    }
}
