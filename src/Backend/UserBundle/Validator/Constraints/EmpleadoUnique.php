<?php 
namespace Backend\UserBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class EmpleadoUnique extends Constraint
{
    public $message = 'Ya existe el mismo número de empleado';
    
    public function validatedBy()
    {
        return 'empleado_unique';
    }

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
    
    
}