<?php

namespace App\Form;

use App\Entity\Artiesten;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArtiestenType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Naam')
            ->add('Achternaam')
            ->add('Muziekstijl')
            ->add('Geboortedatum')
            ->add('Beschrijving')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Artiesten::class,
        ]);
    }
}
