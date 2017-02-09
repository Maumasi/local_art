<?php

namespace AppBundle\Form;

use AppBundle\Entity\State;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MarketSearch extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('city', TextType::class, [
                'empty_data' => null,
                'required' => false,
            ])
            ->add('state', EntityType::class, [
                'class' => State::class,
                'choice_label' => 'stateAbbr',
                'placeholder' => 'Select a state',
            ])
            ->add('zipCode', TextType::class, [
                'empty_data' => null,
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getName()
    {
        return 'app_bundle_area_search';
    }
}
