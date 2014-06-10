<?php 
namespace Backend\AdminBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class CodeUnique extends Constraint
{
    public $message = 'Ya existe el código asignado al cliente';
    
    public function validatedBy()
    {
        return 'code_unique';
    }

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
    
    
}