<?php

namespace AppBundle\Service;

use AppBundle\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class ChatService
{
    private $userRepository;

    public function __construct(
        EntityManagerInterface $entityManager
    )
    {
        $this->userRepository = $entityManager->getRepository('AppBundle:User');
    }

    public function getAvailableOperators(): array
    {
        return $this->userRepository->findOperators();
    }

}