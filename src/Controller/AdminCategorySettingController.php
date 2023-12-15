<?php

namespace App\Controller;

use App\Entity\ActivitieCategorySettings;
use App\Entity\CategorySettings;
use App\Entity\Category;
use App\Form\CategorySettingsType;
use App\Repository\CategoryRepository;
use App\Repository\CategorySettingsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class AdminCategorySettingController extends AbstractController
{
    #[Route('/categorysetting', name: 'app_admin_category_setting_index', methods: ['GET'])]
    public function index(CategorySettingsRepository $categorySettingsRepository): Response
    {
        return $this->render('admin_category_setting/index.html.twig', [
            'category_settings' => $categorySettingsRepository->findAll(),
        ]);
    }

    #[Route('/categorysettingChoose', name: 'app_admin_formChooseCategory')]
    public function chooseCategoryForm(CategorySettingsRepository $categorySettingsRepository): Response
    {
        $categoriesSettings = $categorySettingsRepository->findAll();
        return $this->render('admin_category_setting/chooseCategorySetting.html.twig', [
            'categoriesSettings' => $categoriesSettings,
        ]);
    }



    #[Route('/categorysettingnew/{typeCategorySettings}', name: 'app_admin_category_setting_new', methods: ['GET', 'POST'])]
    public function new( Request $request,CategorySettingsRepository $categorySettingsRepository,
      EntityManagerInterface $entityManager, string $typeCategorySettings): Response
    {
        $categoriesSettings = $categorySettingsRepository->findAll();


        $category  = new ("App\\Entity\\".$typeCategorySettings)();


        $form = $this->createForm("App\\Form\\".$typeCategorySettings."Type", $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($category);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_category_setting_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_category_setting/new.html.twig', [
            'category' => $category,
            'form' => $form,
            'categoriesSettings' => $categoriesSettings,


        ]);
    }

  /*   #[Route('/new', name: 'app_admin_category_setting_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $categorySetting = new CategorySettings();
        $form = $this->createForm(CategorySettingsType::class, $categorySetting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($categorySetting);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_category_setting_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_category_setting/new.html.twig', [
            'category_setting' => $categorySetting,
            'form' => $form,
        ]);
    } */
    #[Route('/categorysetting/{id}', name: 'app_admin_category_setting_show', methods: ['GET'])]
    public function show(CategorySettings $categorySetting): Response
    {
        return $this->render('admin_category_setting/show.html.twig', [
            'category_setting' => $categorySetting,
        ]);
    }

    #[Route('/categorysetting/{id}/edit', name: 'app_admin_category_setting_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CategorySettings $categorySetting, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CategorySettingsType::class, $categorySetting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_category_setting_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_category_setting/edit.html.twig', [
            'category_setting' => $categorySetting,
            'form' => $form,
        ]);
    }

    #[Route('/categorysetting/{id}', name: 'app_admin_category_setting_delete', methods: ['POST'])]
    public function delete(Request $request, CategorySettings $categorySetting, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categorySetting->getId(), $request->request->get('_token'))) {
            $entityManager->remove($categorySetting);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_category_setting_index', [], Response::HTTP_SEE_OTHER);
    }
}
