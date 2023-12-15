<?php

namespace App\Controller;

use App\Entity\StaffSchedule;
use App\Form\StaffScheduleType;
use App\Repository\StaffScheduleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/staffschedule')]
class AdminStaffScheduleController extends AbstractController
{
    #[Route('/', name: 'app_admin_staff_schedule_index', methods: ['GET'])]
    public function index(StaffScheduleRepository $staffScheduleRepository): Response
    {
        return $this->render('admin_staff_schedule/index.html.twig', [
            'staff_schedules' => $staffScheduleRepository->findAll(),
        ]);
    }

  /*  #[Route('/new', name: 'app_admin_staff_schedule_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $staffSchedule = new StaffSchedule();
        $form = $this->createForm(StaffScheduleType::class, $staffSchedule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($staffSchedule);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_staff_schedule_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_staff_schedule/new.html.twig', [
            'staff_schedule' => $staffSchedule,
            'form' => $form,
        ]);
    }  /*/

    #[Route('/{id}', name: 'app_admin_staff_schedule_show', methods: ['GET'])]
    public function show(StaffSchedule $staffSchedule): Response
    {
        return $this->render('admin_staff_schedule/show.html.twig', [
            'staff_schedule' => $staffSchedule,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_staff_schedule_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, StaffSchedule $staffSchedule, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(StaffScheduleType::class, $staffSchedule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_staff_schedule_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_staff_schedule/edit.html.twig', [
            'staff_schedule' => $staffSchedule,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_staff_schedule_delete', methods: ['POST'])]
    public function delete(Request $request, StaffSchedule $staffSchedule, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$staffSchedule->getId(), $request->request->get('_token'))) {
            $entityManager->remove($staffSchedule);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_staff_schedule_index', [], Response::HTTP_SEE_OTHER);
    }
}
