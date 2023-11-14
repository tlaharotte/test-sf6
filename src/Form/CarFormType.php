<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\Brand;
use App\Repository\BrandRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CarFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {


        $builder
            ->add('name', options: [
                'label' => 'Nom'
            ])
            ->add('year', options: [
                'label' => 'Année'
            ])
            ->add('fuel', options: [
                'label' => 'Carburant'
            ])
            ->add('color', options: [
                'label' => 'Couleur'
            ])
            ->add('placesNumber', options: [
                'label' => 'Nombre de places'
            ])
            ->add('status', options: [
                'label' => 'Disponible ?'
            ])
            ->add('brand', EntityType::class, options: [
                'class' => Brand::class,
                'choice_label' => 'name',
                'label' => 'Marque'
            ])
            ->add('updatedAt', options: [
                'label' => false,
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'yyyy-MM-dd HH:mm:ss',
                'attr' => [
                    'value' => date('Y-m-d H:i:s'),
                    'style' => 'display: none'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}