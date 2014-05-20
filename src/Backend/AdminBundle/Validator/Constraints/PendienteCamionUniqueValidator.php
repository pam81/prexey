<?php 
namespace Backend\AdminBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Doctrine\ORM\EntityManager;

class PendienteCamionUniqueValidator extends ConstraintValidator
{
    
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
    
    
   public function validate($object, Constraint $constraint)
    {
       
     //busco un viaje pendiente para el chofer y que no este borrado
     
     $estado = $this->em->getRepository('BackendAdminBundle:Estado')->findOneByCode("PENDIENTE");
     
    
    $pendiente=null;
    
     $query = $this->em
        ->createQuery('
            SELECT v FROM BackendAdminBundle:Viaje v
            JOIN v.camion c
            WHERE v.isDelete = :delete
            and c.id = :camion_id
            and v.estado = :estado_id
            '
        )->setParameter('delete', false)
        ->setParameter('camion_id',$object->getCamion()->getId())
        ->setParameter('estado_id',$estado->getId());

    try {
        $pendiente=$query->getSingleResult();
    } catch (\Doctrine\ORM\NoResultException $e) {
        $pendiente=null;
    }
      
      if ($pendiente != null)
      {
          if ($pendiente->getId() == $object->getId())
             return true; //es el mismo objecto
          
          $this->context->addViolationAt("camion",'El Camión tiene un viaje previo pendiente!');
          return false;     
      }          
      else
        return true;
    
    
    
    }
}