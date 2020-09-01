<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\RegistrationFormType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class UserController extends AbstractController
{
 
    /**
     * @Route("/register", name="app_register")
     */
    public function register( Request $request)
    {
     
        $form = $this->createForm(RegistrationFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Récupération des données de formulaire (entité User + mot de passe)
            $user = $form->getData();
            // $password = $form->get('plainPassword')->getData();
            $this->manager->persist($user);
            $this->manager->flush();
            // // Envoi de l'email de confirmation
            // $emailSender->sendAccountConfirmationEmail($user);

            $this->addFlash('success', 'Vous avez bien été inscrit ! Un email de confirmation vous a été envoyé.');
            return $this->redirectToRoute('home');
        }
        return $this->render('user/register.html.twig', [
            'registration_form' => $form->createView(),
        ]);
    }
}