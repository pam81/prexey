<?php

namespace Backend\AdminBundle\Form;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ModeloType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('nameManufacture')
            ->add('variante')
            ->add('marca', 'entity',array(
            'class'=>'BackendAdminBundle:Marca',
            'query_builder' => function(EntityRepository $er) {
                return $er->createQueryBuilder("u")
                         ->select("u")
                         ->where('u.isDelete = :delete')
                         ->setParameter('delete',false)
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
            'data_class' => 'Backend\AdminBundle\Entity\Modelo'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'backend_adminbundle_modelo';
    }
}
