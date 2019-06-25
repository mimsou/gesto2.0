<?php


namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;

class LoadUser implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $user = (new User())->setUsername('admin')
            ->setEmail('admin@afl.com')
            ->setEmailCanonical('admin@afl.com')
            ->setEnabled(1)
            ->setPlainPassword('admin')
            ->setRoles(array("ROLE_ADMIN"));

        $manager->persist($user);
        $manager->flush();
    }
}