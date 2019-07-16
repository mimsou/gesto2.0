<?php


namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\GestRole;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;

class loadUser implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $user = (new User())->setUsername('admin')
            ->setEmail('admin@afl.com')
            ->setEmailCanonical('admin@afl.com')
            ->setEnabled(1)
            ->setPlainPassword('admin')
            ->setRoles(array("ROLE_ADMIN"));


        $role = (new GestRole())->setRoleLibelle('ROLE_ADMIN')->addUser($user);

        $manager->persist($user);

        $manager->persist($role);

        $manager->flush();

    }
}