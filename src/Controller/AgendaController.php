<?php

namespace App\Controller;

use App\Repository\CalendarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;




class AgendaController extends AbstractController
{
    #[Route('/agenda', name: 'app_agenda')]
      public function index(CalendarRepository $calendarRepository): Response
      {

          $backgroundColor = null;
          $borderColor = null;
          $textColor = null;

          $events = $calendarRepository->findAll();
            //dd($events);



          //dd($events);
          //donne l'evenement avec une date qui est un objet
          //il faut transformer l'objet en string
          //on initalise variable au cas où elle n'a pas encore de valeur
          $rdvs[] = [];


          foreach($events as $event){




                  $rdvs[] = [
                    //  'id' => $event->getId(),
                     'start' => $event->getStart()->format('Y-m-d H:i:s'),
                    'end' => $event->getEnd()->format('Y-m-d H:i:s'),
                      'title' => $event->getTitle(),

                    //  'backgroundColor' => $backgroundColor,
                   //   'borderColor' => $borderColor,
                   //   'textColor' => $textColor,

                  ];


              }





          $data = json_encode($rdvs);
         //dd($data);
          return $this->render('agenda/index.html.twig', [
              'data' => json_encode($rdvs),  // Incluez les données existantes
          ]);
      }

}
