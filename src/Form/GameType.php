<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Console;
use App\Entity\Game;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('desccription')
            ->add('image', FileType::class, array(
                    'mapped' => false,
                )
            )
            ->add('image2', FileType::class, array(
                    'mapped' => false,
                )
            )
            ->add('console' , EntityType::class ,
                array(
                    'class' => Console::class ,
                    'expanded'=>true,
                    'multiple'=>true,
                )

            )
            ->add('company')
            ->add('date' , DateType::class )
            ->add('trailer')
            ->add('categorie', EntityType::class ,
                array(
                    'class' => Categorie::class ,
                    'expanded'=>true,
                    'multiple'=>false,
                )
            )
            ->add('text1')
            ->add('text2')
            ->add('text3')
            ->add('text4')
            ->add('titre1')
            ->add('titre2')
            ->add('titre3')
            ->add('titre4')
            ->add('mode', ChoiceType::class,
                array('choices' => [
                    'single' => 'single',
                    'multiplayer' => 'multiplayer',
                    'single & multiplayer' => 'single & multiplayer'
                ]
                )
            )
            ->add('engine')
            ->add('license')
            ->add('Submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}