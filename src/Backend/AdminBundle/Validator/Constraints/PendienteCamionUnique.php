<?php 
namespace Backend\AdminBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class PendienteCamionUnique extends Constraint
{
    public $message = 'Ya existe un viaje pendiente para el camión';
    
    public function validatedBy()
    {
        return 'pendiente_camion_unique';
    }

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
    
    
}