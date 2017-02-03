<?php

namespace AppBundle\Form;

use AppBundle\Entity\Artist;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArtistRegitration extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('profileImage', FileType::class, [
                'required' => true,
            ])
            ->add('email', EmailType::class)
            ->add('nakedPassword', RepeatedType::class, [
                'type' => PasswordType::class,

            ])
            ->add('businessName', TextType::class, [
                'empty_data' => null,
                'required' => false,
            ])

            ->add('website', UrlType::class, [
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
            'data_class' => Artist::class,
            'validation_groups' => ['Default', 'registration'],
        ]);
    }

    public function getName()
    {
        return 'app_bundle_artist_regitration';
    }
}
