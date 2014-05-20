<?php

namespace Backend\AdminBundle\Form;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\SecurityContext;
class ViajeType extends AbstractType
{
     protected $security;
     //protected $db;
    public function __construct($security) //(SecurityContext $security,\Doctrine\ORM\EntityManager $db)
    {
        $this->security = $security;
       // $this->db = $db;
    }
    
    
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $security=$this->security; 
   
        $builder
          
           ->add('tipo_viaje', 'entity',array(
            'class'=>'BackendAdminBundle:TipoViaje',
            'query_builder' => function(EntityRepository $er) {
                return $er->createQueryBuilder("u")
                         ->select("u")
                         ->where('u.isDelete = :delete')
                         ->setParameter('delete',false)
                         ->orderBy('u.texto', 'ASC');
                      
            },
            'property'=>'texto',
            'multiple'=>false,
            "error_bubbling"=>true,
            "required"=>true
            ) )
            ->add('km_camion',null,array("error_bubbling"=>true))
            ->add('efectivo',null,array("error_bubbling"=>true))
            ->add('fecha_salida','date',array(
               'input'  => 'datetime',
               'widget' => 'single_text',
               'format' => 'dd/MM/yyyy',
               'read_only'=>true,
               "error_bubbling"=>true
            ))
            ->add('hora_salida','time',array(
                'widget' => 'single_text',
                'read_only'=>true,
                "error_bubbling"=>true
            ))
            ->add('fecha_regreso','date',array(
               'input'  => 'datetime',
               'widget' => 'single_text',
               'format' => 'dd/MM/yyyy',
               'read_only'=>true,
               "error_bubbling"=>true
            ))
            ->add('hora_regreso','time',array(
                'widget' => 'single_text',
                'read_only'=>true,
                "error_bubbling"=>true 
            ))
            ->add('incorpora_dinero',null,array("required"=>false, "error_bubbling"=>true))
            ->add('observacion',null,array("error_bubbling"=>true))
            ->add('cliente', 'entity',array(
            'class'=>'BackendAdminBundle:Cliente',
            'query_builder' => function(EntityRepository $er) {
                return $er->createQueryBuilder('u')
                        ->where('u.isDelete = :delete')
                         ->setParameter('delete',false)
                         ->orderBy('u.name', 'ASC');
            },
            'property'=>'name',
            'multiple'=>false,
            "error_bubbling"=>true
            ) )
            ->add('camion', 'entity',array(
            'class'=>'BackendAdminBundle:Camion',
            'query_builder' => function(EntityRepository $er) {
                return $er->createQueryBuilder('u')
                         ->where('u.isDelete = :delete')
                         ->setParameter('delete',false)
                         ->orderBy('u.patente', 'ASC');
            },
            'property'=>'patente',
            'multiple'=>false,
            "error_bubbling"=>true
            ) )
            ->add('acoplado', 'entity',array(
            'class'=>'BackendAdminBundle:Camion',
            'query_builder' => function(EntityRepository $er) {
                return $er->createQueryBuilder('u')
                        ->where('u.isDelete = :delete')
                         ->setParameter('delete',false)
                         ->orderBy('u.patente', 'ASC');
            },
            'property'=>'patente',
            'multiple'=>false,
            "error_bubbling"=>true,
            "empty_value"=>'',
            "required"=>false
            ) )
            ->add('chofer', 'entity',array(
            'class'=>'BackendAdminBundle:Chofer',
            'query_builder' => function(EntityRepository $er) {
                return $er->createQueryBuilder('u')
                        ->where('u.isDelete = :delete')
                         ->setParameter('delete',false)
                         ->orderBy('u.lastname', 'ASC');
            },
            
            'multiple'=>false,
            "error_bubbling"=>true
            ) )
            ->add('acompaniante', 'entity',array(
            'class'=>'BackendAdminBundle:Chofer',
            'query_builder' => function(EntityRepository $er) {
                return $er->createQueryBuilder('u')
                        ->where('u.isDelete = :delete')
                         ->setParameter('delete',false)
                         ->orderBy('u.lastname', 'ASC');
            },
            
            'multiple'=>false,
            "error_bubbling"=>true,
            "empty_value"=>'',
            "required"=>false
            ) )
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
            "error_bubbling"=>true
            ) )
          
            
        ;
        
      
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Backend\AdminBundle\Entity\Viaje',
            
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'backend_adminbundle_viaje';
    }
}
