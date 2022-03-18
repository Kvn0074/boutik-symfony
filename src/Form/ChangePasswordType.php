<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'disabled' => true,
                'label' => 'mail'
            ])
            ->add('firstname', TextType::class, [
                'disabled' => true,
                'label' => 'Prenom'
            ])
            ->add('lastname', TextType::class, [
                'disabled' => true,
                'label' => 'nom'
            ])
            ->add('old_password', PasswordType::class,[
                'label' => 'ancien mot de passe',
                'mapped' => false,
                'attr' => [
                    'placeholder' => 'entrez votre ancien mot de passe'
                ]
            ])

            ->add('new_password', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => false,
                'invalid_message' => 'les mots de passes doivent être identique' ,
                'label' => 'votre nouveau mot de passe',
                'required' => true,
                'first_options' => [
                    'label' => 'Nouveau mot de passe',
                    'attr' => [
                        'placeholder' => 'Nouveau mot de passe'
                    ]
                ],
                'second_options' => [
                    'label' => 'Confirmation nouveau mot de passe',
                    'attr' => [
                        'placeholder' => 'confirmation nouveau mot de passe'
                    ]
                ],

            ])

            ->add('submit', SubmitType::class, [
                'label' => "enregistrer modifications"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
