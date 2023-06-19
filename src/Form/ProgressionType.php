<?php

namespace App\Form;

use App\Entity\Attribut;
use App\Entity\Pouvoir;
use App\Entity\Predateur;
use App\Entity\Progression;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProgressionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pouvoirs', EntityType::class,[
                'class'=>Pouvoir::class,
                'choice_label'=>'nom'
            ])
            ->add('predateur',EntityType::class,[
                'class'=>Predateur::class,
                'choice_label'=>'nom',
            ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Progression::class,
        ]);
    }
}
