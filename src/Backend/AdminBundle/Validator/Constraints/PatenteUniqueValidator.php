<?php 
namespace Backend\AdminBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Doctrine\ORM\EntityManager;

class PatenteUniqueValidator extends ConstraintValidator
{
    
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
    
    
   public function validate($object, Constraint $constraint)
    {
       
     //busco una patente igual y que no este borrada
     $patente = $this->em->getRepository("BackendAdminBundle:Camion")
                ->findOneBy(array("patente"=>$object->getPatente(), "isDelete"=>false));
      
      if ($patente != null)
      {
          if ($patente->getId() == $object->getId())
             return true; //es el mismo objecto
          
          $this->context->addViolationAt("patente",'La patente ya esta en uso!');
          return false;     
      }          
      else
        return true;
    
    
    
    }
}