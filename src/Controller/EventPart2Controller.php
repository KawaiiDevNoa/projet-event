<?php

namespace App\Controller;

use App\Entity\Events;
use App\Form\InviteFriendType;
use App\Repository\EventsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EventPart2Controller extends AbstractController
{
    /**
     * Récupérer les élément de l'entité Events et sur la même page mettre un formulaire 
     * le parametre Events (entité ) s'occucupe de tout
     * @Route("/consult-event/{id}", name="consult_event")
     */
    public function consultEvent(Request $request, EntityManagerInterface $entityManager,Events $events)
    {
        
        $form = $this->createForm(InviteFriendType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Récupération des données de formulaire (entité User + mot de passe)
            $user = $form->getData();
          
            $entityManager->persist($user);
            $entityManager->flush();
            

            $this->addFlash('success', 'Vous venez d\'inviter un ami !');
            return $this->redirectToRoute('consult_event');
        }
       
        return $this->render('event_part2/consult-event.html.twig', [
            'registration_form' => $form->createView(),
            'event'=> $events,

        ]);
        
    }
   
}
