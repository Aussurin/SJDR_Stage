<?php

namespace App\Form;

use App\Entity\Campagne;
use App\Entity\Membre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModifCampagneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class,[
                'label'=>false,
            ])
            ->add('description', TextareaType::class,[
                'label'=>false
            ])
            /*->add('random', TextType::class,[
                'disabled'=>true,
                'label'=>false,
            ])*/
            ->add('seance', DateTimeType::class,[
                'widget'=>'single_text',
                'label'=>false,
                'required'=>false,
            ])
            ->add('joueurs', EntityType::class,[
                'multiple'=>true,
                'class'=>Membre::class,
                'choice_label'=>'pseudo',
                'disabled'=>true,
                'label'=>false,
            ])
            ->add('maitreDeJeu', EntityType::class,[
                'class'=>Membre::class,
                'choice_label'=>'pseudo',
                'disabled'=>true,
                'label'=>false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Campagne::class,
        ]);
    }
}
