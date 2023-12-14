<?php

namespace App\Controller;

use App\Entity\ActivitieCategorySettings;
use App\Form\ActivitieCategorySettingsType;
use App\Repository\ActivitieCategorySettingsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/activitiecategorysettings')]
class AdminActivitieCategorySettingsController extends AbstractController
{
    #[Route('/', name: 'app_admin_activitie_category_settings_index', methods: ['GET'])]
    public function index(ActivitieCategorySettingsRepository $activitieCategorySettingsRepository): Response
    {
        return $this->render('admin_activitie_category_settings/index.html.twig', [
            'activitie_category_settings' => $activitieCategorySettingsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_activitie_category_settings_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $activitieCategorySetting = new ActivitieCategorySettings();
        $form = $this->createForm(ActivitieCategorySettingsType::class, $activitieCategorySetting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($activitieCategorySetting);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_activitie_category_settings_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_activitie_category_settings/new.html.twig', [
            'activitie_category_setting' => $activitieCategorySetting,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_activitie_category_settings_show', methods: ['GET'])]
    public function show(ActivitieCategorySettings $activitieCategorySetting): Response
    {
        return $this->render('admin_activitie_category_settings/show.html.twig', [
            'activitie_category_setting' => $activitieCategorySetting,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_activitie_category_settings_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ActivitieCategorySettings $activitieCategorySetting, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ActivitieCategorySettingsType::class, $activitieCategorySetting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_activitie_category_settings_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_activitie_category_settings/edit.html.twig', [
            'activitie_category_setting' => $activitieCategorySetting,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_activitie_category_settings_delete', methods: ['POST'])]
    public function delete(Request $request, ActivitieCategorySettings $activitieCategorySetting, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$activitieCategorySetting->getId(), $request->request->get('_token'))) {
            $entityManager->remove($activitieCategorySetting);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_activitie_category_settings_index', [], Response::HTTP_SEE_OTHER);
    }
}
