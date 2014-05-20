<?php 
namespace Backend\AdminBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Doctrine\ORM\EntityManager;

class CodeUniqueValidator extends ConstraintValidator
{
    
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
    
    
   public function validate($object, Constraint $constraint)
    {
       
     //busco una patente igual y que no este borrada
     $code = $this->em->getRepository("BackendAdminBundle:TipoMovimiento")
                ->findOneBy(array("code"=>$object->getCode(), "isDelete"=>false));
      
      if ($code != null)
      {
          if ($code->getId() == $object->getId())
             return true; //es el mismo objecto
          
          $this->context->addViolationAt("code",'El código ya esta en uso!');
          return false;     
      }          
      else
        return true;
    
    
    
    }
}