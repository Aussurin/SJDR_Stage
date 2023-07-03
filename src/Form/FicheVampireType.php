<?php

namespace App\Form;

use App\Entity\Clan;
use App\Entity\FicheVampire;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FicheVampireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class,[
                'label'=>false,
            ])
            ->add('concept', TextType::class,[
                'label'=>false,
            ])
            ->add('description', TextareaType::class,[
                'label'=>false
            ])
            ->add('experience', IntegerType::class,[
                'label'=>false,
            ])
            ->add('ambition', TextType::class,[
                'label'=>false
            ])
            ->add('desire', TextType::class,[
                'label'=>false
            ])
            ->add('generation', IntegerType::class,[
                'label'=>false,
            ])
            ->add('sire', TextType::class,[
                'label'=>false
            ])
            ->add('humanite', IntegerType::class,[
                'label'=>false,
            ])
            ->add('clan', EntityType::class,[
                'class'=>Clan::class,
                'choice_label'=>'nom',
                'label'=>false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FicheVampire::class,
        ]);
    }
}
