<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use AppBundle\Entity\UserRole;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class UserFixtures extends Fixture implements ContainerAwareInterface
{
    private $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $encoder = $this->container->get('security.password_encoder');
        foreach (User::ALLOWED_ROLES as $role) {
            for ($i = 0; $i < 10; $i++) {
                $client = new User();
                $roles = [$role];
                if ($role !== 'ROLE_USER') {
                    $roles[] = 'ROLE_USER';
                }
                $client->setRoles($roles);
                $client->setName($this->faker->name());
                $client->setEmail($this->faker->email());
                $client->setPassword($encoder->encodePassword($client, '123456'));
                $client->setCreatedAt(new DateTimeImmutable());
                $manager->persist($client);
            }
        }
        $manager->flush();
    }

}