<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


  class LoginController extends AbstractController
  {
      #[Route('/login', name: 'app_login')]
      public function index(AuthenticationUtils $authenticationUtils): Response
      {
          // If user is already authenticated, redirect to a specific route (e.g., homepage)
            if ($this->getUser()) {
                   return $this->redirectToRoute('app_agenda');
               }
         // dd($this->getUser());

          // get the login error if there is one
          $error = $authenticationUtils->getLastAuthenticationError();

          // last username entered by the user
          $lastUsername = $authenticationUtils->getLastUsername();

          return $this->render('login/index.html.twig', [
              'controller_name' => 'LoginController',
              'last_username' => $lastUsername,
              'error'         => $error,
          ]);
      }

    }

    
     