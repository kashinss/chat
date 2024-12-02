<?php

namespace AppBundle\Controller;

use AppBundle\Repository\UserRepository;
use AppBundle\Service\ChatService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bridge\Twig\TwigEngine;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ChatController extends Controller
{
    private $chatService;
    private $templating;

    public function __construct(
        ChatService $chatService,
        TwigEngine $templating
    )
    {
        $this->chatService = $chatService;
        $this->templating = $templating;
    }

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request): Response
    {
      return $this->redirectToRoute('app_login');
    }

    /**
     * @Route("/operator-chat", name="app_operator_chat")
     */
    public function operatorChatAction(Request $request): Response
    {
        return new Response('21342134');
    }

    /**
     * @Route("/chat", name="app_chat")
     */
    public function chatAction(Request $request): Response
    {
        $operators = $this->chatService->getAvailableOperators();
        return new Response($this->templating->render('chat/index.html.twig', [
            'operators' => $operators,
        ]));
    }
}
