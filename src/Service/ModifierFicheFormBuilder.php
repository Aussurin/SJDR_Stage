<?php

namespace App\Service;

use App\Entity\AvantageInconvenient;
use App\Entity\Clan;
use App\Entity\Discipline;
use App\Entity\FicheVampire;
use App\Entity\PointCreation;
use App\Entity\Pouvoir;
use App\Entity\Predateur;
use App\Repository\AvantageInconvenientRepository;
use App\Repository\DisciplineRepository;
use App\Repository\PouvoirPersoRepository;
use App\Repository\PouvoirRepository;
use App\Repository\PredateurRepository;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use function PHPUnit\Framework\isNull;

class ModifierFicheFormBuilder extends AbstractType
{
    public function __construct(private readonly PredateurRepository $predateurRepository,private PouvoirRepository $pouvoirRepository, private PouvoirPersoRepository $pouvoirPersoRepository)
    {
    }

    public function buildVampireForm(FicheVampire $fiche, $builder):FormBuilderInterface{
        $allpredateurs = $this->predateurRepository->findAll();
        $predateurs =array();
        foreach ($allpredateurs as $predateur){
            $predateurs[] = [$predateur->getNom()=>$predateur->getId()];
        }
        $builder
            ->add('nom')
            ->add('concept')
            ->add('ambition')
            ->add('desire')
            ->add('generation')
            ->add('sire')
            ->add('humanite', IntegerType::class,[
                'attr'=>[
                    'min'=>0,
                    'max'=>10
                ]
            ])
            ->add('clan', EntityType::class,[
                'class'=>Clan::class,
                'choice_label'=>'nom'
            ])
            ->add('predateur',EntityType::class,[
                'class'=>Predateur::class,
                'mapped'=>false,
                'choice_label'=>'nom',
                'data' => $fiche->getProgression()->getPredateur()

            ]);

        foreach ($fiche->getProgression()->getAttributs() as $attribut){
            $builder
                ->add(str_replace(array('-'), '_',str_replace(array('é','è','ê'), 'e',$attribut->getAttribut()->getNom())), IntegerType::class,[
                    'label'=>$attribut->getAttribut()->getNom(),
                    'mapped'=>false,
                    'attr'=>[
                        'min'=>0,
                        'max'=>5,
                        'value'=>$attribut->getNiveau()
                    ]
                ]);
        }
        foreach ($fiche->getProgression()->getSkills() as $skill){
            $builder
                ->add((str_replace(array(' '), '_',str_replace(array('à','â'), 'a',str_replace(array('é','è','ê'), 'e',$skill->getSkill()->getNom())))), IntegerType::class,[
                    'label'=>$skill->getSkill()->getNom(),
                    'mapped'=>false,
                    'attr'=>[
                        'min'=>0,
                        'max'=>5,
                        'value'=>$skill->getNiveau()
                    ]
                ]);
        }
        if(!isNull($fiche->getProgression()->getPouvoirPerso())){
            $appris = $fiche->getProgression()->getPouvoirPerso()->getPouvoirs();
            for ($i=1; $i < 7; $i++ ){
                foreach ($fiche->getProgression()->getPouvoirPerso()->getDiscipline() as $discipline){
                    $pouvoirs[] = ['nom'=>''];
                    $pouvoirs[] = $this->pouvoirRepository->findBy(['discipline_id'=>$discipline->getId()]);
                    $builder->add('discipline'.$i, EntityType::class,[
                        'class'=>Discipline::class,
                        'mapped'=>false,
                        'required'=>false,
                        'data'=>$discipline,
                        'choice_label'=>'nom',
                        ]);
                    for ($p=1; $p<6; $p++){

                        foreach ($appris as $appri){
                            if ($appri->getDiscipline() === $discipline){
                                $builder
                                    ->add('pouvoir'.$i.$p, EntityType::class,[
                                        'class'=>Pouvoir::class,
                                        'choice_label'=>'nom',
                                        'choice'=>$pouvoirs,
                                        'required'=>false,
                                        'mapped'=>false,
                                        'data'=>$appri
                                    ]);
                                $p++;
                            }
                        }

                        $builder
                            ->add('pouvoir'.$i.$p, EntityType::class,[
                                'class'=>Pouvoir::class,
                                'choice_label'=>'nom',
                                'choice'=>$pouvoirs,
                                'required'=>false,
                                'mapped'=>false,
                                'attr'=>[
                                    ''
                                ]
                            ]);
                    }

                    $i++;
                }
            }
            $builder
                ->add('discipline'.$i, EntityType::class,[
                    'class'=>Discipline::class,
                    'mapped'=>false,
                ]);
            dd($builder);
        }else{
            for($i=1; $i<7; $i++){
                $builder
                    ->add('discipline'.$i, EntityType::class,[
                        'class'=>Discipline::class,
                        'choice_label'=>'nom',
                        'label'=>false,
                        'mapped'=>false,
                    ]);
                for ($p=1; $p<6; $p++){
                    $builder
                        ->add('pouvoir'.$i.$p, ChoiceType::class,[
                            'choices'=>[
                                ''=>null
                            ],
                            'required'=>false,
                            'mapped'=>false,
                            'label'=>false,
                        ]);
                }
            }
        }

        for ($i=1; $i < 10; $i++ ) {

            foreach ($fiche->getProgression()->getPointsCreation() as $creapoint){
                $builder
                    ->add('historique'.$i, EntityType::class,[
                        'class'=>AvantageInconvenient::class,
                        'label'=>false,
                        'label_name'=>'nom',
                        'mapped'=>false,
                        'data'=>$creapoint->getAvantageInconvenient()
                    ])
                    ->add('historique'.$i.'pts', IntegerType::class,[
                        'label'=>false,
                        'mapped'=>false,
                        'data'=>$creapoint->getNiveau(),
                    ]);
                $i++;
            }
            $builder
                ->add('historique'.$i, EntityType::class,[
                    'class'=>AvantageInconvenient::class,
                    'label_name'=>'nom',
                    'label'=>false,
                    'mapped'=>false,
                    'required'=>false,
                ])
                ->add('historique'.$i.'pts', IntegerType::class,[
                    'label'=>false,
                    'mapped'=>false,
                ]);;

            $builder->add('historique' . $i, EntityType::class, [
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
                'mapped'=>false,
            ]);
        }

        $builder
            ->add('experience')
            ->add('description');


        return $builder;
    }

}