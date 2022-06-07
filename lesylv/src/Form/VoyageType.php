<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Planete;
use App\Entity\Vehicule;
use App\Entity\Voyage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VoyageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateDepart')
            ->add('dateArrive')
            ->add('nombreVoyageur')
            ->add('cout')
            ->add('idPlanete', EntityType::class, [
                'label' => 'Planète',
                'class' => Planete::class,
                'choice_label' => 'nom',
            ])
            ->add('idVehicule', EntityType::class, [
                'label' => 'Véhicule',
                'class' => Vehicule::class,
                'choice_label' => 'nom',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Voyage::class,
        ]);
    }
}
