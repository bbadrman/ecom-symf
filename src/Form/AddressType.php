<?php

namespace App\Form;

use App\Entity\Adress;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
            'label' => 'Quelle nom souhaitez-vous donner a votre address',
            'constraints' => new Length(['min' => 2, 'max' => 20]),
            'attr' => [
                'placeholder' => 'Nomez votre addresse'
            ]
        ])
            ->add( 'firstname', TextType::class, [
            'label' => 'Votre prenom',
            'constraints' => new Length(['min' => 2, 'max' => 20]),
            'attr' => [
                'placeholder' => 'Entrer votre prenom'
            ]
        ])
            ->add( 'lastname', TextType::class, [
            'label' => 'Votre nom',
            'constraints' => new Length(['min' => 2, 'max' => 20]),
            'attr' => [
                'placeholder' => 'Entrer votre nom'
            ]
        ])
            ->add( 'company', TextType::class, [
            'label' => 'Votre societe',
            'constraints' => new Length(['min' => 2, 'max' => 20]),
            'attr' => [
                'placeholder' => '(facultatif) Entez votre societe'
            ]
        ])
            ->add('address', TextType::class, [
            'label' => 'votre address',
            'constraints' => new Length(['min' => 2, 'max' => 20]),
            'attr' => [
                'placeholder' => '27 ,rue tijanier hay wahda kom'
            ]
        ])
            ->add('postal', TextType::class, [
            'label' => 'Quelle votre code postale',
            'constraints' => new Length(['min' => 2, 'max' => 20]),
            'attr' => [
                'placeholder' => 'Entrez votre code potale'
            ]
        ])
            ->add( 'city', TextType::class, [
            'label' => 'Votre ville',
            'constraints' => new Length(['min' => 2, 'max' => 20]),
            'attr' => [
                'placeholder' => 'Entrez votre ville'
            ]
        ])
            ->add( 'country', CountryType::class, [
            'label' => 'Pays',
            'constraints' => new Length(['min' => 2, 'max' => 20]),
            'attr' => [
                'placeholder' => 'Votre pays'
            ]
        ])
            ->add( 'phone', TelType::class, [
            'label' => 'Votre télephone',
            'constraints' => new Length(['min' => 2, 'max' => 20]),
            'attr' => [
                'placeholder' => 'Votre télephone'
            ]
        ])
            ->add('submit', SubmitType::class,[
                'label' =>'Valider',
                'attr'=>['class' => 'btn-block btn btn-info']
            

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adress::class,
        ]);
    }
}
