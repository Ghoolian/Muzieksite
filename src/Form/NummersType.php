<?php

namespace App\Form;

use App\Entity\Nummers;
use App\Entity\Albums;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class NummersType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Naam')
            ->add('Jaar')
            ->add('albumID', EntityType::class, [
                'class' => Albums::class,
                'choice_label' => function(Albums $albums) {
                    return $albums->getNaam();
                }
            ]);
                // Voor succesvol toevoegen van nieuw nummer
                //, EntityType::class, [
                //'class' => Albums::class
                //]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Nummers::class,
        ]);
    }
}
