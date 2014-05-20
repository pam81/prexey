<?php

namespace Backend\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
class MovimientoType extends AbstractType
{
     
     protected $security;
    
    public function __construct($security)
    {
        $this->security = $security;
    }
     
     
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
         $security=$this->security;  
        $builder
            ->add('motivo')
            ->add('destinatario')
            ->add('tipo','choice', array(
                  'choices'   => array('e' => 'Egreso', 'i' => 'Ingreso'),
                  'required'  => true,))
            ->add('clase', 'entity',array(
            'class'=>'BackendAdminBundle:TipoMovimiento',
            'query_builder' => function(EntityRepository $er) {
                return $er->createQueryBuilder('u')
                        ->where('u.isAccesible = :accesible')
                        ->andWhere('u.isDelete = :delete')
                         ->setParameter('accesible',true)
                         ->setParameter('delete',false)
                         ->orderBy('u.code');
                         
            },
            
            'multiple'=>false,
            
            
            ) )
            
            ->add('monto',null,array(
                    'required'=>true,
                    'invalid_message' => "El monto no tiene formato válido",
                    
                     ))
            ->add('deposito', 'entity',array(
            'class'=>'BackendAdminBundle:Deposito',
            'query_builder' => function(EntityRepository $er) use($security){
                
               if ($security->isGranted('ROLE_DEPOSITO'))
               {
                 $usuario=$security->getToken()->getUser()->getId();
                 return $er->createQueryBuilder('u')
                        ->join("u.operarios ","s") 
                        ->where('u.isDelete = :delete')
                        ->andWhere('s.id = :user')
                         ->setParameter('delete',false)
                         ->setParameter("user",$usuario)
                         ->orderBy('u.name', 'ASC');
               }
               else 
                return $er->createQueryBuilder('u')
                        ->where('u.isDelete = :delete')
                         ->setParameter('delete',false)
                         ->orderBy('u.name', 'ASC');
                         
                         
            },
            'property'=>'name',
            'multiple'=>false,
            'empty_value'=>false
            ))  
            ->add('deposito_destino', 'entity',array(
            'class'=>'BackendAdminBundle:Deposito',
            'query_builder' => function(EntityRepository $er) {
                return $er->createQueryBuilder('u')
                        ->where('u.isDelete = :delete')
                         ->setParameter('delete',false)
                         ->orderBy('u.name', 'ASC');
            },
            'property'=>'name',
            'multiple'=>false
            
            
            ))      
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Backend\AdminBundle\Entity\Movimiento'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'backend_adminbundle_movimiento';
    }
}
