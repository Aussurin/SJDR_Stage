<?php

namespace App\Form;

use App\Entity\Clan;
use App\Entity\FicheVampire;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FicheVampireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('concept')
            ->add('description')
            ->add('experience')
            ->add('ambition')
            ->add('desire')
            ->add('generation')
            ->add('sire')
            ->add('humanite')
            ->add('clan', EntityType::class,[
                'class'=>Clan::class,
                'choice_label'=>'nom'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FicheVampire::class,
        ]);
    }
}
