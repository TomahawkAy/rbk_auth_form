<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function index(AuthenticationUtils $utils): Response
    {
        $errorMessage = $utils->getLastAuthenticationError();
        $lastUsername = $utils->getLastUsername();
        return $this->render('login/index.html.twig', [
            'error' => $errorMessage,
            'last_username'=>$lastUsername
        ]);
    }
}
