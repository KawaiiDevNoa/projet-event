<?php

namespace App\Form;

use App\Entity\Events;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class EditEventFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class,[
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez remplir le champs.']), 
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Le nom doit contenir au moins {{limit}} caractères.',
                        'max' => 30,
                        'maxMessage' => 'Le nom ne peut contenir plus de {{limit}} caractères.',
                    ]),]
            ])



            ->add('description',TextType::class,[
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez ajouter une description à l\'évènement .']), 
                    new Length([
                        'min' => 10,
                        'minMessage' => 'Le description doit contenir au moins {{limit}} caractères.',
                        'max' => 500,
                        'maxMessage' => 'La description ne peut contenir plus de {{limit}} caractères.',
                    ]),]
            ])


            ->add('lieu',TextareaType::class,[
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez remplir le champs.']), 
                   ]
            ])


            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez choisir une date',
                    ]),]
                
                ])
            
            // ->add('photo',FileType::class,[
            //     'constraints'=>[
            //         new NotBlank(['message'=>'Veuillez insérer une image'])
            //     ]
            // ])
           
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Events::class,
        ]);
    }
}
