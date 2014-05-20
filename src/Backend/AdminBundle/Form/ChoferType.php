<?php

namespace Backend\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class ChoferType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('lastname')
            ->add('nroEmpleado')
            ->add('dni')
            ->add('observacion')
            ->add('email')
            ->add('celular')
            ->add('radio')
            ->add('telefono')
            ->add('direccion')
            ->add('fecha_registro','date',array(
               'input'  => 'datetime',
               'widget' => 'single_text',
               'format' => 'dd/MM/yyyy',
               'read_only'=>true,
               'required'=>false
            ))
            ->add('cnrt')
            ->add('fecha_cnrt','date',array(
               'input'  => 'datetime',
               'widget' => 'single_text',
               'format' => 'dd/MM/yyyy',
               'read_only'=>true,
               'required'=>false
            ))
            ->add('cnrt_peligrosa')
            ->add('fecha_cnrt_peligrosa','date',array(
               'input'  => 'datetime',
               'widget' => 'single_text',
               'format' => 'dd/MM/yyyy',
               'read_only'=>true,
               'required'=>false
            ))
            ->add('cnrt_curso')
            ->add('fecha_cnrt_curso','date',array(
               'input'  => 'datetime',
               'widget' => 'single_text',
               'format' => 'dd/MM/yyyy',
               'read_only'=>true,
               'required'=>false
            ))
            ->add('libreta_sanitaria')
            ->add('fecha_sanitaria','date',array(
               'input'  => 'datetime',
               'widget' => 'single_text',
               'format' => 'dd/MM/yyyy',
               'read_only'=>true,
               'required'=>false
            ))
            ->add('empresa', 'entity',array(
            'class'=>'BackendAdminBundle:Empresa',
            'query_builder' => function(EntityRepository $er) {
                return $er->createQueryBuilder('u')
                        ->where('u.isDelete = :delete')
                         ->setParameter('delete',false)
                         ->orderBy('u.name', 'ASC');
            },
            
            'multiple'=>false
            
            ) )
            ->add('isPeon',null,array('required'=>false))
            
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Backend\AdminBundle\Entity\Chofer'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'backend_adminbundle_chofer';
    }
}
