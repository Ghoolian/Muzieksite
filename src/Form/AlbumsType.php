<?php

namespace App\Form;

use App\Entity\Albums;
use App\Entity\Artiesten;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AlbumsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Naam')
            ->add('artiestenID', EntityType::class, [
                'class' => Artiesten::class,
                'choice_label' => function(Artiesten $artiesten) {
                    return $artiesten->getNaam();
            }])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Albums::class,
        ]);
    }
}
