<?php 
namespace Backend\AdminBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ViajeCodeUnique extends Constraint
{
    public $message = 'Ya existe el código asignado';
    
    public function validatedBy()
    {
        return 'viaje_code_unique';
    }

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
    
    
}