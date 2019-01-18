<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class UpdateUserProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('username' , TextType::class, [
            'attr' => ['class' => 'form-control'],
            'required' => false
        ])
        ->add('password', PasswordType::class, [
            // instead of being set onto the object directly,
            // this is read and encoded in the controller
            'mapped' => false,
            'required' => false,
            'attr' => ['class' => 'form-control'],
        ])
        ->add('firstname', TextType::class, [
            'attr' => ['class' => 'form-control'],
            'required' => false
        ])
        ->add('lastname', TextType::class, [
            'attr' => ['class' => 'form-control'],
            'required' => false
        ])
        ->add('mail', TextType::class, [
            'attr' => ['class' => 'form-control'],
            'required' => false
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
        ->add('picture' , FileType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
