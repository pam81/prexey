<?php
 
namespace Backend\AdminBundle\Form\EventListener;
 
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Doctrine\ORM\EntityRepository;

use Backend\AdminBundle\Entity\Chofer;
 
class ViajeSubscriber implements EventSubscriberInterface
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
 
    private function addViajeForm($form, $chofer)
    {
        $form->add($this->factory->createNamed('viaje','entity', null, array(
            'class'         => 'BackendAdminBundle:Viaje',
            'empty_value'   => 'Seleccione Viaje',
            'auto_initialize' => false,
            "property"=>"id",
            "required"=>false,
            'query_builder' => function (EntityRepository $repository) use ($chofer) {
                $qb = $repository->createQueryBuilder('viaje')
                    ->innerJoin('viaje.chofer', 'chofer')
                    ->where('viaje.isDelete = :delete')
                    ->setParameter('delete',false);
                if ($chofer instanceof Chofer) {
                    $qb->andWhere('viaje.chofer = :chofer_id')
                    ->setParameter('chofer_id', $chofer);
                } elseif (is_numeric($chofer)) {
                    $qb->andWhere('chofer.id = :chofer_id')
                    ->setParameter('chofer_id', $chofer);
                } else {
                    $qb->andWhere('chofer.name = :chofer_id')
                    ->setParameter('chofer_id', null);
                }
                     
                $qb->orderBy('viaje.id');
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
 
        
        $chofer = ($data->viaje) ? $data->viaje->getChofer() : null ;
        $this->addViajeForm($form, $chofer);
    }
 
    public function preBind(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();
 
        if (null === $data) {
            return;
        }
 
       
        $chofer = array_key_exists('chofer', $data) ? $data['chofer'] : null;
        $this->addViajeForm($form, $chofer);
    }
}
