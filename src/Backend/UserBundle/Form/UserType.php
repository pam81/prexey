<?php

namespace Backend\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', 'text');
            $builder->add('name', 'text');
            $builder->add('lastname','text');
            $builder->add('nroEmpleado','text');
            $builder->add('email','email');
           
            $builder->add('password', 'repeated', array(
                        'type' => 'password',
                        'invalid_message' => 'No coincide la contraseña.',
                        'options' => array('attr' => array('class' => 'password-field')),
                        'required' => true,
                        'first_options'  => array('label' => 'Contraseña'),
                        'second_options' => array('label' => 'Repetir contraseña'),
                    ));
            $builder->add('groups','entity',array(
                'class'=>'BackendUserBundle:Group',
                'property'=>'name',
                'multiple'=>true
            ));
            //solo se pueden asignar operarios a depositos 
            // no borrados y no especiales
            $builder->add('deposito','entity',array(
                'class'=>'BackendAdminBundle:Deposito',
                'query_builder' => function(EntityRepository $er) {
                return $er->createQueryBuilder('u')
                        ->where('u.isDelete = :delete')
                        ->andWhere('u.isSpecial = :special')
                         ->setParameter('delete',false)
                         ->setParameter('special',false)
                         ->orderBy('u.name', 'ASC');
            },
                'property'=>'name',
                'multiple'=>false //un solo deposito por operario
            ));
            $builder->add('is_active','checkbox',array(
             'value'=>1,
             'label'=>"Activo",
             'required'=>false
            ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Backend\UserBundle\Entity\User'
        ));
    }

    public function getName()
    {
        return 'backend_userbundle_usertype';
    }
}
