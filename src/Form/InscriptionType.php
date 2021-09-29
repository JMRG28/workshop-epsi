<?php

namespace App\Form;

use App\Entity\Entreprise;
use App\Entity\Type;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('password',PasswordType::class)
            ->add('verificationPassword',PasswordType::class)
            ->add('nom')
            ->add('prenom')
            ->add('imageFile',FileType::class,["required" => false],)
            ->add('entreprise',EntityType::class, [
                "class" => Entreprise::class,
                "choice_label" => 'noment'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
