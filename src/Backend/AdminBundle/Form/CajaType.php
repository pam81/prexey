<?php

namespace Backend\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Backend\AdminBundle\Form\EventListener\ChoferSubscriber;
use Backend\AdminBundle\Form\EventListener\ViajeSubscriber;
use Doctrine\ORM\EntityRepository;
class CajaType extends AbstractType
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
        $builder
            ->add('motivo')
            ->add('tipo','choice', array(
                  'choices'   => array('d' => 'Descuento', 'r' => 'Reintegro', 'e'=>"Eficiencia"),
                  'required'  => true))
            ->add('monto');
            
        $choferSubscriber = new ChoferSubscriber($builder->getFormFactory());
        $builder->addEventSubscriber($choferSubscriber);
        
        $viajeSubscriber = new ViajeSubscriber($builder->getFormFactory());
        $builder->addEventSubscriber($viajeSubscriber);
          
        
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Backend\AdminBundle\Entity\Caja'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'backend_adminbundle_caja';
    }
}
