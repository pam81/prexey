<?php

namespace Backend\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GroupType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('role')
            ->add('accesos','entity',array(
                'class'=>'BackendUserBundle:Acceso',
                'property'=>'name',
                'multiple'=>true,
                'expanded'=>true,
                'attr'   =>  array(
                             'class'   => 'c4'),
            ))
          /*  ->add('accesos','collection', array(
    // each item in the array will be an "email" field
    'type'   => 'entity',
    // these options are passed to each "email" type
    'options'  => array(
        'required'  => false,
        'attr'      => array('class' => 'BackendUserBundle:Acceso')
    ),)
    )*/
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Backend\UserBundle\Entity\Group'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'backend_userbundle_group';
    }
}
