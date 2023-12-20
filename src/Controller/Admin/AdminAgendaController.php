<?php

namespace App\Controller\Admin;

use App\Repository\CalendarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;




class AdminAgendaController extends AbstractController
{
    #[Route('admin/agenda', name: 'app_admin_agenda')]
      public function index(CalendarRepository $calendarRepository): Response
      {

          $backgroundColor = null;
          $borderColor = null;
          $textColor = null;
          $staff = null;

          $events = $calendarRepository->findAll();
          // dd($events);

         

          //on initalise variable au cas où elle n'a pas encore de valeur
          $rdvs[] = [];

  
              foreach ($events as $event) {

                $staffCollection = $event->getStaffs();
                // dd($staffCollection);
      
      
      
                  $staffNames = [];
                  
                  foreach ($staffCollection as $staff) {
                      $staffNames[] = $staff->getFullName();
                  }
              
                  // Join the staff names into a single string, separated by commas
                  $staffFullName = implode(', ', $staffNames);
                   // dd($staffFullName);

                //avec methode getStock() pour Activitie
                if ($event instanceof \App\Entity\Activitie) {
                    $rdvs[] = [
                        'start' => $event->getStart()->format('Y-m-d H:i:s'),
                        'end' => $event->getEnd()->format('Y-m-d H:i:s'),
                        'stock' => $event->getStock(),
                        'staffs' => $staffFullName,
                        'title' => $event->getTitle(),
                        'backgroundColor' => $event->getCategory()->getCategorySetting()->getBackGroundColor(),
                        'borderColor' => $event->getCategory()->getCategorySetting()->getBorderColor(),
                        'textColor' => $event->getCategory()->getCategorySetting()->getTextColor(),
                    ];

                    //ici on n'appelle pas le stock staffplaning
                } elseif ($event instanceof \App\Entity\StaffSchedule) {
                    $rdvs[] = [
                        'start' => $event->getStart()->format('Y-m-d H:i:s'),
                        'end' => $event->getEnd()->format('Y-m-d H:i:s'),
                        'staffs' => $staffFullName,
                        'title' => $event->getTitle(),
                        'backgroundColor' => $event->getCategory()->getCategorySetting()->getBackGroundColor(),
                        'borderColor' => $event->getCategory()->getCategorySetting()->getBorderColor(),
                        'textColor' => $event->getCategory()->getCategorySetting()->getTextColor(),
                    ];
                }
            }
            

            


          $data = json_encode($rdvs);
          // dd($data);
          return $this->render('admin/admin_agenda/index.html.twig', [
              'data' => json_encode($rdvs),  // Incluez les données existantes
          ]);
      }

}
