<?php 
namespace Backend\AdminBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class PatenteUnique extends Constraint
{
    public $message = 'Ya existe un camión con la patente "%string%"';
    
    public function validatedBy()
    {
        return 'patente_unique';
    }

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
    
    
}