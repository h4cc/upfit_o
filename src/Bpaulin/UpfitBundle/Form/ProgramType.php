<?php

namespace Bpaulin\UpfitBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProgramType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $idClub = $options['data']->getClub();
        $builder
            ->add('name')
            ->add(
                'stages',
                'collection',
                array(
                    'type'         => new StageType($idClub),
                    'allow_add'    => true,
                    'allow_delete' => true,
                    'by_reference' => false
                )
            );
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'Bpaulin\UpfitBundle\Entity\Program'
            )
        );
    }

    public function getName()
    {
        return 'bpaulin_upfitbundle_programtype';
    }
}
