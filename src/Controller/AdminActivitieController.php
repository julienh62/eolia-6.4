<?php

namespace App\Controller;

use App\Entity\Activitie;
use App\Form\Activitie1Type;
use App\Repository\ActivitieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/activitie')]
class AdminActivitieController extends AbstractController
{
    #[Route('/', name: 'app_admin_activitie_index', methods: ['GET'])]
    public function index(ActivitieRepository $activitieRepository): Response
    {
        return $this->render('admin_activitie/index.html.twig', [
            'activities' => $activitieRepository->findAll(),
        ]);
    }

 /*   #[Route('/new', name: 'app_admin_activitie_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $activitie = new Activitie();
        $form = $this->createForm(Activitie1Type::class, $activitie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($activitie);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_activitie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_activitie/new.html.twig', [
            'activitie' => $activitie,
            'form' => $form,
        ]);
    }*/

    #[Route('/{id}', name: 'app_admin_activitie_show', methods: ['GET'])]
    public function show(Activitie $activitie): Response
    {
        return $this->render('admin_activitie/show.html.twig', [
            'activitie' => $activitie,
        ]);
    }

   /* #[Route('/{id}/edit', name: 'app_admin_activitie_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Activitie $activitie, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Activitie1Type::class, $activitie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_activitie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_activitie/edit.html.twig', [
            'activitie' => $activitie,
            'form' => $form,
        ]);
    }  */

    #[Route('/{id}', name: 'app_admin_activitie_delete', methods: ['POST'])]
    public function delete(Request $request, Activitie $activitie, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$activitie->getId(), $request->request->get('_token'))) {
            $entityManager->remove($activitie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_activitie_index', [], Response::HTTP_SEE_OTHER);
    }
}
