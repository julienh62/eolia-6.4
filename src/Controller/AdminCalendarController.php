<?php

namespace App\Controller;

use App\Entity\Activitie;
use App\Entity\Calendar;
use App\Entity\StaffSchedule;
use App\Form\CalendarType;
use App\Repository\ActivitieRepository;
use App\Repository\CalendarRepository;
use App\Repository\StaffScheduleRepository;
use App\Service\Formatdate;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class AdminCalendarController extends AbstractController
{

    #[Route('/calendarshow', name: 'app_admin_calendar_index', methods: ['GET'])]
    public function index(CalendarRepository $calendarRepository, ActivitieRepository $activitieRepository,
      Formatdate $formatdateService , StaffScheduleRepository $staffScheduleRepository): Response
    {
        $calendars = $calendarRepository->findAll();
     //   $activities = $activitieRepository->findAll();
     //   $staffSchedules = $staffScheduleRepository->findAll();

        setlocale(LC_TIME, 'fr_FR');

    /*    // Formate les dates avec le service Formatdate
        foreach ($activities as $activitie) {
            $activitie->formattedStartDate = $formatdate->formatCustomDate($activitie->getStart());
            $activitie->formattedEndDate = $formatdate->formatCustomDate($activitie->getEnd());
        }
        // Formate les dates avec le service Formatdate
        foreach ($staffSchedules as $staffSchedule) {
            $staffSchedule->formattedStartDate = $formatdate->formatCustomDate($staffSchedule->getStart());
            $staffSchedule->formattedEndDate = $formatdate->formatCustomDate($staffSchedule->getEnd());
        }  */
        // Formate les dates avec le service Formatdate
        foreach ($calendars as $calendar) {
            $calendar->formattedStartDate = $formatdateService->formatCustomDate($calendar->getStart());
            $calendar->formattedEndDate = $formatdateService->formatCustomDate($calendar->getEnd());
        }

        return $this->render('admin_calendar/index.html.twig', [
          //  'staffSchedules' => $staffSchedules,
            //'activities' => $activities,
                'calendars' => $calendars
        ]);
    }

    #[Route('/createCalendarChoose', name: 'app_admin_formChooseCalendar')]
    public function chooseLocationForm(): Response
    {
        return $this->render('admin_calendar/chooseCalendar.html.twig');
    }



    #[Route('/new/{typeCalendar}', name: 'app_admin_calendar_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, string $typeCalendar): Response
    {

        $calendar = new ("App\\Entity\\" . $typeCalendar)();


            $form = $this->createForm("App\\Form\\" . $typeCalendar . "Type", $calendar);
            //   $form = $this->createForm(ActivitieType::class, $activitie);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager->persist($calendar);
                $entityManager->flush();

                return $this->redirectToRoute('app_admin_calendar_index', [], Response::HTTP_SEE_OTHER);
            }

            return $this->render('admin_calendar/new.html.twig', [
                'calendar' => $calendar,
                'form' => $form,
            ]);
        }


    #[Route('/{id}', name: 'app_admin_calendar_show', methods: ['GET'])]
    public function show(Calendar $calendar): Response
    {
        return $this->render('admin_calendar/show.html.twig', [
            'calendar' => $calendar,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_calendar_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Calendar $calendar, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CalendarType::class, $calendar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_calendar_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_calendar/edit.html.twig', [
            'calendar' => $calendar,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_calendar_delete', methods: ['POST'])]
    public function delete(Request $request, Calendar $calendar, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$calendar->getId(), $request->request->get('_token'))) {
            $entityManager->remove($calendar);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_calendar_index', [], Response::HTTP_SEE_OTHER);
    }
}
