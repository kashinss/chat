<?php

namespace AppBundle\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

class CustomLoginSuccessHandler implements AuthenticationSuccessHandlerInterface
{
    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token): RedirectResponse
    {
        $roles = $token->getRoles();
        $roles = array_map(function ($role) {
            return $role->getRole();
        }, $roles);

        if (in_array('ROLE_OPERATOR', $roles)) {
            return new RedirectResponse($this->router->generate('app_operator_chat'));
        }

        return new RedirectResponse($this->router->generate('app_chat'));
    }
}