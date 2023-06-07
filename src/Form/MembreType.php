<?php

namespace App\Form;

use App\Entity\Membre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class MembreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options,): void
    {
        $builder
            ->add('email',EmailType::class,[
                'label'=> false
            ])
            //->add('roles')
            ->add('password', PasswordType::class,[
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'label'=>false,
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                ])
            ->add('pseudo', TextType::class,[
                'label'=> false
            ])
            ->add('dateNaissance', DateType::class,[
                'widget'=> 'single_text',
                'label'=>false
            ])
            //->add('image')
            //->add('campagnes')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Membre::class,
        ]);
    }
}
