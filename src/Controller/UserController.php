<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\EditFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserController extends AbstractController
{
    private $manager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->manager = $entityManager;
    }
 
    /**
     * Enregistrement d'un formulaire
     * @Route("/register", name="app_register")
     * 
     */
    public function register( Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $post= new User();
        $post->setPseudo('Indiquer un pseudo');
        $post->setEmail('example@outlook.fr');
        $post->setPassword('votre mot de passe');
       
       
        $form = $this->createForm(RegistrationFormType::class,$post);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            // Récupération des données de formulaire (entité User + mot de passe)
            $user = $form->getData();
            $password = $form->get('plainPassword')->getData();

            $user
            ->setPassword($passwordEncoder->encodePassword($user, $password))
            ->renewToken()
        ;
            $this->manager->persist($user);
            $this->manager->flush();
            

            $this->addFlash('success', 'Vous avez bien été inscrit !');
            return $this->redirectToRoute('home');
        }
        return $this->render('user/register.html.twig', [
            'registration_form' => $form->createView(),
        ]);
    }

    

    /**
     * Modification du formulaire
     * @Route("/profil-edit", name="app_profil_edit")
    
     */
    public function updateLogin( Request $request)

    {
         $modif= $this->getUser();
         $form = $this->createForm(EditFormType::class,$modif);
         
                      
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            // Récupération des données de formulaire (entité User + mot de passe)
         
            $form->getData();
           
            $this->manager->flush();
            

            $this->addFlash('success', 'Modification réussit !');
            return $this->redirectToRoute('home');
        }
        return $this->render('user/profil-edit.html.twig', [
            'registration_form' => $form->createView(),
        
        ]);
    }

}