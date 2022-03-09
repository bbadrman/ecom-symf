<?php

namespace App\Form;

use App\Entity\Adress;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $user = $options['user'];
        $builder
        ->add('addresse', EntityType::class, [
            'label' => 'choisisez votre adresse de livraison',
            'required' => true,
            'class' => Adress::class,
            'choices' => $user->getAdresses(),
            'multiple' => false,
            'expanded' => true,

        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
           'user'=> array(),
        ]);
    }
}
