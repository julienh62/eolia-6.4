<?php

// src/Controller/SecurityController.php
namespace App\Controller;

use App\Form\ResetPasswordFormType;
use App\Form\ResetPasswordRequestFormType;
use App\Repository\UserRepository;
use App\Service\SendMailService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

class SecurityController extends AbstractController
{
    #[Route('/logout', name: 'app_logout', methods: ['GET'])]
    public function logout(): never
    {
        // controller can be blank: it will never be called!
        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }

    #[Route(path: '/forgot-mdp', name: 'forgotten_password')]
    public function forgottenPassword(
        Request $request,
        UserRepository $userRepository,
        TokenGeneratorInterface $tokenGeneratorInterface,
        EntityManagerInterface $entityManager,
        SendMailService $mail
    ): response
    {
        $form = $this->createForm(ResetPasswordRequestFormType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            //on va chercher user par son email
            $user = $userRepository->findOneByEmail($form->get('email')->getData());
//         //on vérifie si on a un utilisateur
            if($user){
                //on genere token de reinitialisation
                $token = $tokenGeneratorInterface->generateToken();
                $user->setResetToken($token);
                $entityManager->persist($user);
                $entityManager->flush();

                //on genere un lien de reinitialisation
                $url = $this->generateUrl('reset_pass', ['token' => $token], UrlGeneratorInterface::ABSOLUTE_URL);
                //  dd($url);


                //onn crée les donnees du mail
                $context = compact('url', 'user');
                //dd($context);
                //envoi du mail
                $mail->send(
                    'admin@eoliacharavoile.fr',
                    $user->getEmail(),
                    'réinitialisation mot de passe',
                    'password_reset',
                    $context

                );

                // dd($mail);

                $this->addFlash('success', 'un lien de réinitialisation vient de vous être envoyé');
                return $this->redirectToRoute('app_consultez-vos-mails');
            }

            $this->addFlash('warning', 'Un problème est survenu, identifiant ou mdp incorrect');
            return $this->redirectToRoute('app_login');


        }

        return $this->render('security/reset_password_request.html.twig', [
            'requestPassForm' => $form->createView()


        ]);
    }


    #[Route('/consultez-vos-mails', name: 'app_consultez-vos-mails')]
    public function index()
    {

        return $this->render('emails/consultezmail.html.twig');
    }

    #[Route(path: '/forgot-mdp/{token}', name: 'reset_pass')]
    public function resetPass(
        string $token,
        Request $request,
        UserRepository $userRepository,
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $passwordHasher
    ): Response
    {
        // On vérifie si on a ce token dans la base
        $user = $userRepository->findOneByResetToken($token);
        //   dd($user);
        if($user){
            $form = $this->createForm(ResetPasswordFormType::class);

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                // On efface le token
                $user->setResetToken('');
                $user->setPassword(
                    $passwordHasher->hashPassword(
                        $user,
                        $form->get('password')->getData()
                    )
                );
                $entityManager->persist($user);
                $entityManager->flush();

                $this->addFlash('success', 'Mot de passe changé avec succès');
                return $this->redirectToRoute('app_login');
            }

            return $this->render('security/reset_password.html.twig', [
                'passForm' => $form->createView()
            ]);
        }
        $this->addFlash('danger', 'Jeton invalide');
        return $this->redirectToRoute('app_login');
    }

}