<?php


namespace App\Form;
use App\Entity\Location;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class LocationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add('country', ChoiceType::class, [
            'choices'  => [
                'France' => 'France',
                'England' => 'England',
                'Spain' => 'Spain',
            ],
        ])
            ->add('postal_code', TextType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('city', TextType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('street', TextType::class, [
                'attr' => ['class' => 'form-control']
            ])
          ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Location::class,
        ]);
    }
}