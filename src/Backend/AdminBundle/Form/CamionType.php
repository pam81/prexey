<?php

namespace Backend\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class CamionType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('patente')
            ->add('kmxlitro')
            ->add('maxTanque')
            ->add('observacion')
            ->add('marca')
            ->add('modelo')
            ->add('color')
            ->add('interno')
            ->add('senasa')
            ->add('fecha_senasa','date',array(
               'input'  => 'datetime',
               'widget' => 'single_text',
               'format' => 'dd/MM/yyyy',
               'read_only'=>true,
               'required'=>false
            ))
            ->add('ruta')
            ->add('fecha_ruta','date',array(
               'input'  => 'datetime',
               'widget' => 'single_text',
               'format' => 'dd/MM/yyyy',
               'read_only'=>true,
               'required'=>false
            ))
            
            ->add('fecha_vtv','date',array(
               'input'  => 'datetime',
               'widget' => 'single_text',
               'format' => 'dd/MM/yyyy',
               'read_only'=>true,
               'required'=>false
            ))
            ->add('seguro')
            ->add('fecha_seguro','date',array(
               'input'  => 'datetime',
               'widget' => 'single_text',
               'format' => 'dd/MM/yyyy',
               'read_only'=>true,
               'required'=>false
            ))
            ->add('eficiencia_ideal',null,array('required'=>true))
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
            
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Backend\AdminBundle\Entity\Camion'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'backend_adminbundle_camion';
    }
}
