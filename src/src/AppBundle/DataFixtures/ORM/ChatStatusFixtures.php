<?php


use AppBundle\Entity\ChatStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ChatStatusFixtures extends Fixture
{
    const CHAT_STATUSES = [
        'opened',
        'closed',
        'solved',
        'not-solved'
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::CHAT_STATUSES as $status) {
            $chatStatus = new ChatStatus();
            $chatStatus->setName($status);
            $manager->persist($chatStatus);
        }

        $manager->flush();
    }

}