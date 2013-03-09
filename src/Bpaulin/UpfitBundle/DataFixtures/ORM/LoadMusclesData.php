<?php

namespace Bpaulin\UpfitBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Bpaulin\UpfitBundle\Entity\Muscle;

class LoadMusclesData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $muscle = new Muscle();
        $muscle->setName('Dos/Epaules');
        $manager->persist($muscle);

        $muscle = new Muscle();
        $muscle->setName('Pectoraux/Biceps');
        $manager->persist($muscle);

        $muscle = new Muscle();
        $muscle->setName('Cuisses/Fessiers');
        $manager->persist($muscle);

        $muscle = new Muscle();
        $muscle->setName('Abdos');
        $manager->persist($muscle);

        $manager->flush();
    }
}
