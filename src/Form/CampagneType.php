<?php

namespace App\Form;

use App\Entity\Campagne;
use App\Entity\Membre;
use App\Repository\MembreRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CampagneType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
       /* foreach ($membres as $membre){
            $pseudo = $membre->getPseudo();
            $choix[] = [$pseudo=>$pseudo];
        }*/
        $builder
            ->add('nom', TextType::class,[
                'label'=>false,
            ])
            ->add('description', TextType::class,[
                'label'=>false,
            ])
            ->add('joueurs', ChoiceType::class,[
                'label'=> false,
                'multiple'=> true,
                'required'=>false,
                'mapped'=> false,
                'choices'=>[],

            ])
            //->add('maitreDeJeu')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Campagne::class,
        ]);
    }
}
