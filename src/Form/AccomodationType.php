<?php

namespace App\Form;

use App\Entity\Accomodation;
use App\Entity\Location;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccomodationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',null,["label" => "Nom"])
            ->add('description',null,["label" => "Description"])
            ->add('rooms',null,["label" => "Nombre de pièces"])
            ->add('bedroom',null,["label" => "Nombre de chambres"])
            ->add('floor',null,["label" => "Etage"])
            ->add('state',null,["label" => "Etat"])
            ->add('date_availability',null,["label" => "Date de disponibilité"])
            ->add('street_number',null,["label" => "Numéro de rue"])
            ->add('location',LocationType::class)
            ->add('type',TypeType::class)
            ->add('equipments',null,["label" => "Equipements"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Accomodation::class,
        ]);
    }
}
