<?php

namespace Backend\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
           $builder->add('username', 'text');
            $builder->add('name', 'text');
            $builder->add('lastname','text');
            $builder->add('email','email');
           
            
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Backend\UserBundle\Entity\User'
        ));
    }

    public function getName()
    {
        return 'backend_userbundle_profiletype';
    }
}
