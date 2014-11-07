<?php

namespace Backend\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class AreaTrabajoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
            $builder->add('nombre');
            $builder->add('responsable');
            $builder->add('observaciones');
            $builder->add('sucursal','entity',array(
                'class'=>'BackendAdminBundle:Sucursal',
                'property'=>'nombre',
            ));
            
            $builder->add('depositos','entity',array(
                'class'=>'BackendAdminBundle:TipoDeposito',
                'property'=>'nombre',
                'multiple'=>true,
                'expanded'=>true,
                'attr'   =>  array(
                             'class'   => 'c4'),
            ));                 
            
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Backend\AdminBundle\Entity\AreaTrabajo'
        ));
    }

    public function getName()
    {
        return 'backend_adminbundle_areaTrabajo';
    }
}
