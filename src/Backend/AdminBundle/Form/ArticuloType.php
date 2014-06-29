<?php

namespace Backend\AdminBundle\Form;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ArticuloType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tipo', 'entity',array(
            'class'=>'BackendAdminBundle:TipoArticulo',
            'query_builder' => function(EntityRepository $er) {
                return $er->createQueryBuilder("u")
                         ->select("u")
                         ->orderBy('u.name', 'ASC');
                      
            }))
             ->add('isDisponible','checkbox', array(
                  'required'  => false))
            ->add('descripcion')
            ->add('observacion');
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Backend\AdminBundle\Entity\Articulo'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'backend_adminbundle_articulo';
    }
}
