<?php 
namespace Backend\UserBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Doctrine\ORM\EntityManager;

class UsuarioUniqueValidator extends ConstraintValidator
{
    
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
    
    
   public function validate($object, Constraint $constraint)
    {
       
     
     $user = $this->em->getRepository("BackendUserBundle:User")
                ->findOneBy(array("username"=>$object->getUsername(), "isDelete"=>false));
      
      if ($user != null)
      {
          if ($user->getId() == $object->getId())
             return true; //es el mismo objecto
          
          $this->context->addViolationAt("username",'El nombre de usuario ya esta en uso!');
          return false;     
      }          
      else
        return true;
    
    
    
    }
}