<?php

namespace App\Form;

use App\Entity\Accomodation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccomodationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('rooms')
            ->add('bedroom')
            ->add('floor')
            ->add('state')
            ->add('date_availability')
            ->add('street_number')
            ->add('user')
            ->add('location')
            ->add('type')
            ->add('user_favorites')
            ->add('equipments')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Accomodation::class,
        ]);
    }
}
