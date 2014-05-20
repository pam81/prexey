<?php 
namespace Backend\AdminBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class PendienteChoferUnique extends Constraint
{
    public $message = 'Ya existe un viaje pendiente para el chofer';
    
    public function validatedBy()
    {
        return 'pendiente_chofer_unique';
    }

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
    
    
}