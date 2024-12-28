<?php

namespace App\Repository;

use App\Entity\DateSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchByDateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('minDate', TextType::class, [
                'label' => 'date + ancienne'
            ])
            ->add('maxDate', TextType::class, [
                'label' => 'date + recente'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DateSearch::class,
        ]);
    }
}