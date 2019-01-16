<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username' , TextType::class, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('password', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('firstname', TextType::class, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('lastname', TextType::class, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('mail', TextType::class, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('phone_fixed', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'required' => false
            ])
            ->add('phone_mobile', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'required' => false
            ])
            ->add('about', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'required' => false
            ])

        ;
        // TODO Ajouter champ image + text area pour about


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
