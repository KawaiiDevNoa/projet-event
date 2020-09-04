<?php

namespace App\Form;

use App\Entity\InviteFriend;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class InviteFriendType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email',EmailType::class,[
                'constraints' =>[
                    new NotBlank(['message' => 'Email manquant.']),
                    new Length([
                        'max' => 180,
                        'maxMessage' => 'L\'adresse email ne peut contenir plus de {{limit}} caractères.',
                    
                    ]),
                    new Email(['message' =>'cette adress n\'est pas une adress email valide.'])
                    ]
            ])

            ->add('message',TextareaType::class,[
                'constraints' =>[
                    new Length([
                        'max' => 255,
                        'maxMessage' => 'L\'adresse email ne peut contenir plus de {{limit}} caractères.',
                    
                    ]),
                ]
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => InviteFriend::class,
        ]);
    }
}
