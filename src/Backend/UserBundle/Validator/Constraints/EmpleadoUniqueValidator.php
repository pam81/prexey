<?php 
namespace Backend\UserBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Doctrine\ORM\EntityManager;

class EmpleadoUniqueValidator extends ConstraintValidator
{
    
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
    
    
   public function validate($object, Constraint $constraint)
    {
         
     $user = $this->em->getRepository("BackendUserBundle:User")
                ->findOneBy(array("nroEmpleado"=>$object->getNroEmpleado(), "isDelete"=>false));
     $chofer = $this->em->getRepository("BackendAdminBundle:Chofer")
                ->findOneBy(array("nroEmpleado"=>$object->getNroEmpleado(), "isDelete"=>false));           
      
      //si lo encuentro en alguno de los dos debo verificar
      if ($user != null || $chofer != null)
      {   //Me fijo en la tabla si es la misma entidad
          if ($constraint->groups[1] == "User" && $user)
          {  if ($user->getId() == $object->getId())
               return true; 
          }     
          
          if ($constraint->groups[1] == "Chofer" && $chofer)   
          {  if ($chofer->getId() == $object->getId())
               return true;
          }    
          
             
          $this->context->addViolationAt("nroEmpleado",'El número de empleado ya esta en uso!');
          return false;     
      }          
      else     //no existe puede asignarse
        return true;
    
    
    
    }
}