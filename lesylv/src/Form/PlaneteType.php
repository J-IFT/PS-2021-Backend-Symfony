<?php

namespace App\Form;

use App\Entity\Planete;
use App\Entity\Galaxie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlaneteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('distance')
            ->add('type')
            ->add('idGalaxie', EntityType::class, [
                'label' => 'Galaxie',
                'class' => Galaxie::class,
                'choice_label' => 'nom',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Planete::class,
        ]);
    }
}
