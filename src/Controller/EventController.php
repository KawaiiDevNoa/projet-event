<?php

namespace App\Controller;

use App\Entity\Events;
use App\Form\EventFormType;
use App\Repository\EventsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    /**
     * Crer un évènement
     * @Route("/event", name="app_event")
     */
    public function index(Request $request,EntityManagerInterface $entityManager)
    {
       
        $form = $this->createForm(EventFormType::class);
        $form->handleRequest($request);
          
        if ($form->isSubmitted() && $form->isValid()) {
            
            $event = $form->getData();
            //définir la méthode setAuteur (relation entre la tab user)
            $event->setAuteur($this->getUser());
            $entityManager->persist($event);
            $entityManager->flush();
            

            $this->addFlash('success', 'Votre évènement à été enregistré avec succès!');
            return $this->redirectToRoute('home');
        }
        return $this->render('event/create-event.html.twig', [
            'registration_form' => $form->createView(),
        ]);
    }

      // modifier un évènement
      
    /**
     * Crer un évènement
     * @Route("/edit-my-event/{id}", name="app_edit_my_event")
     */

    public function editEvent(Events $events , Request $request,EntityManagerInterface $entityManager)
    {
        
        $form = $this->createForm(EventFormType::class,$events);
        $form->handleRequest($request);
          
        if ($form->isSubmitted() && $form->isValid()) {
            
              $entityManager->flush();
            

            $this->addFlash('success', 'votre évènement à été modifier avec succès!');
            return $this->redirectToRoute('home');
        }
        return $this->render('event/edit-my-event.html.twig', [
            'registration_form' => $form->createView(),
        ]);
    }


   


    //
    /**
     * supprimer un évènement
     * @Route("/event-delete/{id}", name="delete")
     */
    public function eventsDelete(Events $events,EntityManagerInterface $entityManager,Request $request)
    {
         // recupération du jeton csrf
         $token = $request->get('token');
         
         // le csrf est un fonction et on lui donne un argument qu'on réutilisera dans le href
         if($this->isCsrfTokenValid("event-delete",$token)){

            //supression

            $entityManager->remove($events);
            $entityManager->flush();

           $this->addFlash('info', 'Votre évènement a été supprimé.');

          
         }
         return $this->redirectToRoute("app_event_list");
    }


    /**
     * Consultation des évènements
     * @Route("/my-events-list", name="app_event_list")
     */

    public function eventList(EventsRepository $repository)
    {
        $myEvents = $repository->findAll();
        return $this->render('event/my-events-list.html.twig', [
            // events est une variable contenant un tableau et recupère tt ce qui se trouve dans $myevents
            'events' => $myEvents,
        ]);
    }

     /**
     * 1/Participation aux  évènements
     * @Route("/my-participation/{id}", name="app_participation")
     */

     public function participation(Events $events, EntityManagerInterface $entityManager,Request $request)
     {
           // recupération du jeton csrf
         $token = $request->get('token');
         
         // le csrf est un fonction et on lui donne un argument qu'on réutilisera dans le href
         if($this->isCsrfTokenValid("event-participate",$token)){

            //ajout
            //getuser c'est l'utilisateur connecté et donc on passe par lui pour recup la methode souhaité dans ce cas comme la methode est absente dans event
            $this->getUser()->addParticipation($events);
            $entityManager->flush();

           $this->addFlash('info', 'Bravo!! Vous participez à un évènement.');

         }
         return $this->redirectToRoute("app_event_participation");
        
       
    }
     /**
     * 2/Mes participation
     * @Route("/my-events-participation", name="app_event_participation")
     */

     public function eventsParticipation()
     {
        
        return $this->render('event/my-events-participation.html.twig', [
                'allEvents' =>$this->getUser()->getParticipation() ,
             ]); 
     }

      // ma page mes participations
     // return $this->render('event/my-events-participation.html.twig', [
        //     'allEvents' => $repository->findAll(),
        // ]);
     
}
