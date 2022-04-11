<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Validator\Constraints\Length;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
             ->add('firstname', TextType::class,[
                 'label' => 'Votre Prénom',
                 'constraints' => new Length(['min'=>2, 'max' => 20 ]),
                 'attr' => [
                     'placeholder' => 'Merci de saisir votre prénom'
                 ]
             ])
             -> add('lastname', TextType:: class, [
            'label' => 'Votre Nom',
            'constraints' => new Length(['min'=>2, 'max' => 20 ]),
            'attr' => [
                'placeholder' => 'Merci de saisir votre nom'
            ]
        ])
             ->add( 'email', EmailType::class, [
            'label' => 'Votre email',
            'constraints' => new Length(['min'=>2, 'max' => 60 ]),
            'attr' => [
                'placeholder' => 'Merci de saisir votre adresse email'
            ]
        ])
             ->add( 'password', RepeatedType::class, [
                 'type'=>  PasswordType::class,
                 'invalid_message' => 'le mot de passe et la confirmation doivent etre identique ',
                 'label' => 'Votre mot de passe',
                 'constraints' => new Length(['min'=>2, 'max' => 20 ]),
                 'required' => true,
                 'first_options' => ['label' => "Mot de pass",
                                     'attr' => ['placeholder' => 'Merci de saisir votre mot de passe'],],
                 'second_options' => ['label' => "Confirmer Votre Mot de pass",
                                     'attr' => ['placeholder' => 'Merci de confirmer votre mot de passe'],
            ],
            
        ])
           
            ->add('submit', SubmitType::class, [
                'label' => "S'inscrire",
                
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
