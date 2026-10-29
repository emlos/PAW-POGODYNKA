<?php

namespace App\Form;

use App\Entity\Location;
use App\Entity\Measurement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MeasurementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('location', EntityType::class, [
                'class' => Location::class,
                'label' => 'Lokum',
                'required' => false,
                'placeholder' => 'masz wybierz',
                'choice_label' => static function (Location $location): string {
                    return sprintf('%s (%s)', $location->getCity(), $location->getCountry());
                },
            ])
            ->add('date', DateType::class, [
                'label' => 'Data...',
                'required' => false,
                'widget' => 'single_text',
                'html5' => false,
                'input' => 'datetime',
            ])
            ->add('celsius', NumberType::class, [
                'label' => 'La Temperatura',
                'required' => false,
                'html5' => false,
                'scale' => 0,
                'attr' => [
                    'placeholder' => 'np. 67',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Measurement::class,
        ]);
    }
}
