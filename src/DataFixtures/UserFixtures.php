<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $User = new User();
        $User->setUsername('Username1');
        $User->setPassword('Password1');
        $User->setRoles('User');
        $manager->persist($User);

        //voegt meer Users toe

        $manager->flush();
    }
}
