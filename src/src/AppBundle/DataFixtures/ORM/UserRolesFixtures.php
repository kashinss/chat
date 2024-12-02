<?php


use AppBundle\Entity\UserRole;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class UserRolesFixtures extends Fixture
{
    const CLIENT_ROLES = [
        'client',
        'operator'
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::CLIENT_ROLES as $role) {
            $clientRole = new UserRole();
            $clientRole->setName($role);
            $manager->persist($clientRole);
        }

        $manager->flush();
    }

}