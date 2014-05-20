<?php

namespace Backend\AdminBundle\Form;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RendirType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           
           ->add('km_camion', 'text',array(
             'disabled'=>true,
             'required'=>false,
           ))
            ->add('efectivo','text',array(
             'disabled'=>true
           ))
            ->add('fecha_salida','date',array(
               'input'  => 'datetime',
               'widget' => 'single_text',
               'format' => 'dd/MM/yyyy',
               'disabled'=> true
            ))
            ->add('hora_salida','time',array(
                'widget' => 'single_text',
                'disabled'=> true 
            ))
            ->add('fecha_regreso','date',array(
               'input'  => 'datetime',
               'widget' => 'single_text',
               'format' => 'dd/MM/yyyy',
               'disabled'=> true
            ))
            ->add('hora_regreso','time',array(
                'widget' => 'single_text', 
                'disabled'=> true
            ))
            ->add('incorpora_dinero', 'text', array(
                   'disabled'=> true,
                   'required'=> false,
            ))
            
           
          ->add('has_exception','checkbox',array("error_bubbling"=>true,"required"=>false,))
          ->add('observacion',null,array("error_bubbling"=>true))
          ->add('km_retorno',null,array("error_bubbling"=>true))
          ->add('efectivo_retornado',null,array("error_bubbling"=>true))
          ->add('efectivo_regreso',null,array("error_bubbling"=>true))
          ->add('efectivo_reintegro',null,array("error_bubbling"=>true))
          ->add('efectivo_caja',null,array("error_bubbling"=>true))
          ->add('saldo',null,array('read_only'=> true,"error_bubbling"=>true))
          ->add('consumido',null,array("required"=>true,"error_bubbling"=>true))
            
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Backend\AdminBundle\Entity\Viaje',
            'validation_groups' => array('rendicion')
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'backend_adminbundle_rendir';
    }
}
