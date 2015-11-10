<?php

namespace AccommodationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AccommodationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add(
                'type',
                'choice',
                [
                    'choices' => [
                        1 => 'Hotel',
                        2 => 'Guesthouse'
                    ]
                ]
            )
            ->add('address')
            ->add('addressDetail')
            ->add('description')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AccommodationBundle\Entity\Accommodation'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'accommodationbundle_accommodation';
    }
}
