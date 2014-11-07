<?php

namespace Backend\AdminBundle\Form;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ClienteType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('direccion')
            ->add('cuit')
            ->add('dni')
            ->add('observacion')
            ->add('email')
            ->add('celular')
            ->add('codigo')
             ->add('provincia', 'entity',array(
            'class'=>'BackendAdminBundle:Provincia',
            'query_builder' => function(EntityRepository $er) {
                return $er->createQueryBuilder("u")
                         ->select("u")
                         ->orderBy('u.name', 'ASC');
                      
            }))
            
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Backend\AdminBundle\Entity\Cliente'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'backend_adminbundle_cliente';
    }
}
