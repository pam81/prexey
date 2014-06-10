<?php 
namespace Backend\AdminBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class DniUnique extends Constraint
{
    public $message = 'Ya existe el DNI asignado';
    
    public function validatedBy()
    {
        return 'dni_unique';
    }

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
    
    
}