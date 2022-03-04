<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class,[
                'disabled' => true,
                'label' => 'Mon Adresse email',
            ])
            
            ->add( 'firstname', TextType::class, [
            'disabled' => true,
            'label' => 'Mon Prenom',
        ])
            ->add( 'lastname', TextType::class, [
            'disabled' => true,
            'label' => 'Mon Nom',
        ])
        ->add('old_password', PasswordType::class, [
            'label' => 'Mon Passe accuel',
            'mapped' => false,
            'attr' => [
                'placeholder' => 'Veuilliez saisir votre mon de passe acctuel '
            ]
        ])
        ->add('new_password', RepeatedType::class, [
            'type' =>  PasswordType::class,
            'mapped' => false,
            'invalid_message' => 'le mot de passe et la confirmation doivent etre identique ',
            'label' => 'Mon nouveau mot de passe',
            'constraints' => new Length(['min' => 2, 'max' => 20]),
            'required' => true,
            'first_options' => [
                'label' => "Mon nouveau mot de pass",
                'attr' => ['placeholder' => 'Merci de saisir votre nouveau mot de passe'],
            ],
            'second_options' => [
                'label' => "Confirmer Votre  nouveau mot de pass",
                'attr' => ['placeholder' => 'Merci de confirmer votre nouveau mot de passe'],
            ],

        ])
        ->add('submit', SubmitType::class, [
            'label' => "Metre à jour",

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
