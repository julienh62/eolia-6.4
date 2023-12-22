<?php

namespace App\Controller;

use App\Entity\ScheduleStaffSettings;
use App\Entity\StaffScheduleSettings;
use App\Form\ScheduleStaffSettingsType;
use App\Form\StaffScheduleSettingsType;
use App\Repository\ActivitieRepository;
use App\Repository\ScheduleStaffRepository;
use App\Repository\ActivitieSettingsRepository;
use App\Repository\StaffScheduleRepository;
use App\Repository\StaffScheduleSettingsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class ScheduleStaffSettingController extends AbstractController
{
    #[Route('/ScheduleStaffSetting', name: 'app_admin_ScheduleStaff_setting')]
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
    #[Route('/ScheduleStaffSettingNew', name: 'app_admin_scheduleStaffs_setting_new', methods: ['GET', 'POST'])]
    public function new(Request $request, StaffScheduleSettingsRepository $staffScheduleSettingsRepository): Response
    {
        $staffScheduleSettings = new StaffScheduleSettings();
        $form = $this->createForm(StaffScheduleSettingsType::class, $staffScheduleSettings);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $staffScheduleSettingsRepository->save($staffScheduleSettings, true);

            return $this->redirectToRoute('app_admin_ScheduleStaff_setting', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_activitie_setting/new.html.twig', [
            'scheduleStaffSettings' => $staffScheduleSettings,
            'form' => $form,
        ]);
    }


}
