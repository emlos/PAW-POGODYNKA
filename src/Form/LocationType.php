<?php

namespace App\Form;

use App\Entity\Location;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('city', TextType::class, [
                'label' => 'm-m-m-miasto',
                'required' => false,
                'attr' => [
                    'placeholder' => 'np. idk no. pcim dolny',
                ],
            ])
            ->add('country', ChoiceType::class, [
                'label' => 'kraj',
                'required' => false,
                'placeholder' => 'no tu masz liste',
                'choices' => [
                    'Polska' => 'PL',
                    'Niemcy' => 'DE',
                    'Żabojady' => 'FR',
                    'Hiszpania' => 'ES',
                    'Włochy' => 'IT',
                    '"Wielka Brytania"' => 'GB',
                    '\'MURICA' => 'US',
                ],
            ])
            ->add('latitude', NumberType::class, [
                'label' => 'wszerz geogrewiczny',
                'required' => false,
                'html5' => false,
                'scale' => 7,
                'attr' => [
                    'placeholder' => 'np. 67.676767',
                ],
            ])
            ->add('longitude', NumberType::class, [
                'label' => 'dlug gegrofragiczny',
                'required' => false,
                'html5' => false,
                'scale' => 7,
                'attr' => [
                    'placeholder' => 'np. 76.7676767',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Location::class,
        ]);
    }
}
