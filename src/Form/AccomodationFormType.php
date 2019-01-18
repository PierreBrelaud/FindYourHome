<?php
/**
 * Created by PhpStorm.
 * User: Jupit
 * Date: 17/01/2019
 * Time: 22:44
 */

namespace App\Form;
use App\Entity\Accomodation;
use App\Entity\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AccomodationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name' , TextType::class, [
                'attr' => ['class' => 'form-control'],
                'required' => false
            ])
            ->add('description' , TextType::class, [
                'attr' => ['class' => 'form-control'],
                'required' => false
            ])
            ->add('rooms' , IntegerType::class, [
                'attr' => ['class' => 'form-control'],
                'required' => false
            ])
            ->add('bedroom' , IntegerType::class, [
                'attr' => ['class' => 'form-control'],
                'required' => false
            ])
            ->add('floor' , IntegerType::class, [
                'attr' => ['class' => 'form-control'],
                'required' => false
            ])
            ->add('state' , TextType::class, [
                'attr' => ['class' => 'form-control'],
                'required' => false
            ])
            ->add('date_availability' , DateType::class, [
                'attr' => ['class' => 'input-group date'],
                'html5' => false,
                'widget' => 'choice',
            ])
            ->add('street_number' , IntegerType::class, [
                'attr' => ['class' => 'form-control'],
                'required' => false
            ])


            ->add('type', TypeType::class)

            ->add('location', LocationFormType::class)
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Accomodation::class,
        ]);
    }
}