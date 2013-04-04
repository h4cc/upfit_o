<?php

namespace Bpaulin\UpfitBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Bpaulin\UpfitBundle\Form\DataTransformer\EmailToUserTransformer;

class MemberType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $entityManager = $options['em'];
        $transformer = new EmailToUserTransformer($entityManager);

        // add a normal text field, but add your transformer to it
        $builder->add(
            $builder->create('user', 'email')
                ->addModelTransformer($transformer)
        )
            ->add('admin')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bpaulin\UpfitBundle\Entity\Member',
        ));

        $resolver->setRequired(array(
            'em',
        ));

        $resolver->setAllowedTypes(array(
            'em' => 'Doctrine\Common\Persistence\ObjectManager',
        ));
    }

    public function getName()
    {
        return 'bpaulin_upfitbundle_membertype';
    }
}
