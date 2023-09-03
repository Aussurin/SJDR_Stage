<?php

namespace App\Service;

use App\Entity\AvantageInconvenient;
use App\Entity\Clan;
use App\Entity\Discipline;
use App\Entity\FicheVampire;
use App\Entity\Pouvoir;
use App\Entity\Predateur;
use App\Repository\PouvoirRepository;
use App\Repository\PredateurRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use function PHPUnit\Framework\isNull;

class ModifierFicheFormBuilder extends AbstractType
{
    public function __construct(private readonly PredateurRepository $predateurRepository,private PouvoirRepository $pouvoirRepository)
    {
    }

    public function buildVampireForm(FicheVampire $fiche, $builder):FormBuilderInterface{
        $allpredateurs = $this->predateurRepository->findAll();
        $predateurs =array();
        foreach ($allpredateurs as $predateur){
            $predateurs[] = [$predateur->getNom()=>$predateur->getId()];
        }
        $builder
            ->add('nom', TextType::class,[
                'label'=>false,
                'attr'=>[
                    'class'=>'txthead'
                ]
            ])
            ->add('concept', TextType::class,[
                'label'=>false,
                'attr'=>[
                    'class'=>'txthead'
                ]
            ])
            ->add('ambition', TextType::class,[
                'label'=>false,
                'attr'=>[
                    'class'=>'txthead'
                ]
            ])
            ->add('desire', TextType::class,[
                'label'=>false,
                'attr'=>[
                    'class'=>'txthead'
                ]
            ])
            ->add('generation', IntegerType::class,[
                'label'=>false,
                'attr'=>[
                    'class'=>'txthead'
                ]
            ])
            ->add('sire', TextType::class,[
                'label'=>false,
                'attr'=>[
                    'class'=>'txthead'
                ]
            ])
            ->add('humanite', IntegerType::class,[
                'attr'=>[
                    'class'=>'humanitepts',
                    'min'=>0,
                    'max'=>10
                ]
            ])
            ->add('clan', EntityType::class,[
                'class'=>Clan::class,
                'choice_label'=>'nom',
                'label'=>false,
                'attr'=>[
                    'class'=>'txthead'
                ]
            ])
            ->add('predateur',EntityType::class,[
                'class'=>Predateur::class,
                'mapped'=>false,
                'choice_label'=>'nom',
                'label'=>false,
                'attr'=>[
                    'class'=>'txthead'
                ],
                'data' => $fiche->getProgression()->getPredateur()

            ]);

        foreach ($fiche->getProgression()->getAttributs() as $attribut){
            $txtattr = str_replace(array('-'), '_',str_replace(array('é','è','ê'), 'e',$attribut->getAttribut()->getNom()));
            $builder
                ->add($txtattr, RangeType::class,[
                    'label'=>false,
                    'mapped'=>false,
                    'attr'=>[
                        'min'=>0,
                        'class'=>'slider',
                        'max'=>5,
                        'value'=>$attribut->getNiveau(),
                        'oninput'=>"moveDivisor('".$txtattr."')"
                    ]
                ]);
        }
        foreach ($fiche->getProgression()->getSkills() as $skill){
            $txtskill = (str_replace(array(' '), '_',str_replace(array('à','â'), 'a',str_replace(array('é','è','ê'), 'e',$skill->getSkill()->getNom()))));
            $builder
                ->add($txtskill, RangeType::class,[
                    'mapped'=>false,
                    'label'=>false,
                    'attr'=>[
                        'min'=>0,
                        'max'=>5,
                        'value'=>$skill->getNiveau(),
                        'class'=>'slider',
                        'oninput'=>"moveDivisor('".$txtskill."')",
                    ]
                ]);
        }
        $appris = $fiche->getProgression()->getPouvoirPerso()->getPouvoirs();
        $i = 1;
        foreach ($fiche->getProgression()->getPouvoirPerso()->getDiscipline() as $discipline){
            $pouvoirs = $this->pouvoirRepository->findBy(['discipline'=>$discipline]);
            $builder->add('discipline'.$i, EntityType::class,[
                'class'=>Discipline::class,
                'label'=>false,
                'mapped'=>false,
                'required'=>false,
                'data'=>$discipline,
                'choice_label'=>'nom',
            ]);
            $p = 1;
            foreach ($appris as $appri){
                if ($appri->getDiscipline() === $discipline){
                    $builder
                        ->add('pouvoir'.$i.$p, EntityType::class,[
                            'class'=>Pouvoir::class,
                            'label'=>false,
                            'choice_label'=>'nom',
                            'choices'=>$pouvoirs,
                            'required'=>false,
                            'mapped'=>false,
                            'data'=>$appri
                        ]);
                    $p++;
                }
            }
            for ($j=$p; $j<6; $j++){

                $builder
                    ->add('pouvoir'.$i.$j, EntityType::class,[
                        'class'=>Pouvoir::class,
                        'label'=>false,
                        'choice_label'=>'nom',
                        'choices'=>$pouvoirs,
                        'required'=>false,
                        'mapped'=>false,

                    ]);
            }
            $i++;
        }

        for ($j = $i; $j < 7; $j++) {
            $builder
                ->add('discipline' . $j, EntityType::class, [
                    'class' => Discipline::class,
                    'required' => false,
                    'choice_label' => 'nom',
                    'label' => false,
                    'mapped' => false,
                ]);
            for ($p = 1; $p < 6; $p++) {
                $builder
                    ->add('pouvoir' . $j . $p, ChoiceType::class, [
                        'required' => false,
                        'mapped' => false,
                        'label' => false,
                        'attr' => [
                            'style' => 'display: none'
                        ]
                    ]);
            }
        }

        $i=1;
        foreach ($fiche->getProgression()->getPointsCreation() as $creapoint) {
            $builder
                ->add('historique' . $i, EntityType::class, [
                    'class' => AvantageInconvenient::class,
                    'label' => false,
                    'choice_label' => 'nom',
                    'required' => false,
                    'mapped' => false,
                    'group_by' => function ($choice, $key, $value) {
                        return match ($choice->getType()) {
                            -1 => 'Inconvénients',
                            1 => 'Avantage',
                            0 => 'Mix',
                            default => 'Autre',
                        };
                    },
                    'data' => $creapoint->getAvantageInconvenient()
                ])
                ->add('historique' . $i . 'pts', IntegerType::class, [
                    'label' => false,
                    'required' => false,
                    'mapped' => false,
                    'data' => $creapoint->getNiveau(),
                    'attr'=>[
                        'class'=>'histopt'
                    ]
                ]);
            $i++;
        }
        while ($i < 10) {

            $builder->add('historique'.$i, EntityType::class, [
                'class' => AvantageInconvenient::class,
                'choice_label' => 'nom',
                'mapped' => false,
                'label'=>false,
                'required' => false,
                'group_by' => function ($choice, $key, $value) {
                    return match ($choice->getType()) {
                        -1 => 'Inconvénients',
                        1 => 'Avantage',
                        0 => 'Mix',
                        default => 'Autre',
                    };
                },
            ])
            ->add('historique'.$i.'pts', IntegerType::class,[
                'label'=>false,
                'required'=>false,
                'mapped'=>false,
                'attr'=>[
                    'class'=>'histopt'
                ]
            ]);
            $i++;
        }

        $builder
            ->add('experience', IntegerType::class,[
                'label'=>false,
                'attr'=>[
                    'class'=>'txthead'
                ]
            ])
            ->add('description', TextareaType::class,[
                'label'=>false,
                'attr'=>[
                    'class'=>'champ_description',
                ]
            ]);


        return $builder;
    }

}