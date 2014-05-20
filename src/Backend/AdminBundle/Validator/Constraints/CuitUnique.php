<?php 
namespace Backend\AdminBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class CuitUnique extends Constraint
{
    public $message = 'Ya existe el CUIT asignado';
    
    public function validatedBy()
    {
        return 'cuit_unique';
    }

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
    
    
}