<?php

namespace Bpaulin\UpfitBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StageType extends AbstractType
{
    protected $club;

    public function __Construct($club)
    {
        $this->club = $club;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $club = $this->club;
        $builder
            ->add(
                'position',
                'hidden',
                array(
                    'label' => false,
                    'attr' => array(
                        'class' => 'position'
                    )
                )
            )
            ->add(
                'exercise',
                'entity',
                array(
                'class' => 'BpaulinUpfitBundle:Exercise',
                'label' => 'Exercise: ',
                'query_builder' => function(EntityRepository $er) use ($club){
                      return $er->createQueryBuilder('e')
                                ->orderBy('e.name', 'ASC')
                                ->where('e.club= :club')
                                ->setParameter('club', $club);
                      }
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
