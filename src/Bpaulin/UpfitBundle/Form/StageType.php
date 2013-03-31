<?php

namespace Bpaulin\UpfitBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'position',
                null,
                array(
                    'label' => false,
                    'attr' => array(
                        'class' => 'position'
                    )
                )
            )
            ->add(
                'exercise',
                null,
                array(
                    'label' => 'Exercise: '
                )
            )
            ->add(
                'number',
                null,
                array(
                    'label' => ' ->',
                    'attr' => array(
                        'class' => 'span1'
                    )
                )
            )
            ->add(
                'repetition',
                null,
                array(
                    'label' => ' sets of ',
                    'attr' => array(
                        'class' => 'span1'
                    )
                )
            );
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
            'data_class' => 'Bpaulin\UpfitBundle\Entity\Stage'
            )
        );
    }

    public function getName()
    {
        return 'bpaulin_upfitbundle_stagetype';
    }
}
