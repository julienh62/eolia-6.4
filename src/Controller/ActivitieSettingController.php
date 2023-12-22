<?php

namespace App\Controller;

use App\Entity\ActivitieSettings;
use App\Form\ActivitieSettingsType;
use App\Repository\ActivitieRepository;
use App\Repository\ActivitieSettingsRepository;
use App\Repository\StaffScheduleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class ActivitieSettingController extends AbstractController
{
    #[Route('/activitieSetting', name: 'app_admin_activitie_setting')]
    public function index(ActivitieSettingsRepository $activitieSettingsRepository, StaffScheduleRepository $staffScheduleRepository): Response
    {
        $activities = $activitieSettingsRepository->findAll();
        $scheduleStaffs = $staffScheduleRepository->findAll();

        return $this->render('admin_activitie_setting/index.html.twig', [
            'activities' => $activities,
            'scheduleStaffs' => $scheduleStaffs,
        ]);
    }
    #[Route('/activitiesettingChoose', name: 'app_admin_formChooseActivitie')]
    public function chooseActivitieForm(ActivitieRepository $activitieRepository,StaffScheduleRepository $staffScheduleRepository, ActivitieSettingsRepository $activitieSettingsRepository): Response
    {
        $activitiesSettings = $activitieSettingsRepository->findAll();
        $scheduleStaffs = $staffScheduleRepository->findAll();
        $activities = $activitieRepository->findAll();
            //dd($activities);
        return $this->render('admin_activitie_setting/chooseActivitieSetting.html.twig', [
            'activitiesSettings' => $activitiesSettings,
            'activities' => $activities,
            'scheduleStaffs' => $scheduleStaffs,
        ]);
    }
    #[Route('/activitieSettingNew', name: 'app_admin_activitie_setting_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ActivitieSettingsRepository $activitieSettingsRepository): Response
    {
        $activitieSettings = new ActivitieSettings();
        $form = $this->createForm(ActivitieSettingsType::class, $activitieSettings);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $activitieSettingsRepository->save($activitieSettings, true);

            return $this->redirectToRoute('app_admin_activitie_setting', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_activitie_setting/new.html.twig', [
            'activitieSettings' => $activitieSettings,
            'form' => $form,
        ]);
    }


}
