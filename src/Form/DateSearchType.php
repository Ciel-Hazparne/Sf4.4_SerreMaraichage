<?php

namespace App\Form;

use App\Entity\DateSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DateSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('minDate', DateType::class, [
                'label' => 'Date la plus ancienne'
            ])
            ->add('maxDate', TextType::class, [
                'label' => 'Date la plus recente'
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