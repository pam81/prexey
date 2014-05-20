<?php
 
namespace Backend\AdminBundle\Form\EventListener;
 
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Doctrine\ORM\EntityRepository;

 
class ChoferSubscriber implements EventSubscriberInterface
{
    private $factory;
 
    public function __construct(FormFactoryInterface $factory)
    {
        $this->factory = $factory;
    }
 
    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::PRE_BIND     => 'preBind'
        );
    }
 
    private function addChoferForm($form, $chofer)
    {
        $form->add($this->factory->createNamed('chofer', 'entity', $chofer, array(
            'class'         => 'BackendAdminBundle:Chofer',
            'auto_initialize' => false,
            'empty_value'   => 'Seleccione chofer',
            'query_builder' => function (EntityRepository $repository) {
                $qb = $repository->createQueryBuilder('chofer')
                                  ->where('chofer.isDelete = :delete')
                                  ->setParameter('delete',false)
                                  ->orderBy('chofer.lastname');
                return $qb;
            }
        )));
    }
 
    public function preSetData(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();
 
        if (null === $data) {
            return;
        }
 
        $pais = ($data->viaje) ? $data->getViaje()->getChofer() : null ;
        $this->addChoferForm($form, $pais);
    }
 
    public function preBind(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();
 
        if (null === $data) {
            return;
        }
 
        $chofer = array_key_exists('chofer', $data) ? $data['chofer'] : null;
        $this->addChoferForm($form, $chofer);
    }
}
