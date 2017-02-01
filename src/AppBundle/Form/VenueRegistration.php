<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VenueRegistration extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('profileImage', FileType::class, [
                'required' => true,
            ])
            ->add('email')
            ->add('businessName', TextType::class, [
                'empty_data' => null,
                'required' => false,
            ])
            ->add('bio', TextType::class, [
                'empty_data' => null,
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => '',
        ]);
    }

    public function getName()
    {
        return 'app_bundle_venue_registration';
    }
}
