<?php

namespace App\Form;

use App\Entity\Cour;
use App\Entity\Question;
use App\Entity\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class UpdateQuestion extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('enonce')
            ->add('difficulte')
            ->add('theme')
            ->add('imageFile',FileType::class,["required" => false],)
            ->add('cour',EntityType::class, [
                "class" => Cour::class,
                "choice_label" => 'intitule'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
        ]);
    }
}
