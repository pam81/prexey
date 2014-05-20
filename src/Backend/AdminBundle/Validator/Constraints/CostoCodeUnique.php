<?php 
namespace Backend\AdminBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class CostoCodeUnique extends Constraint
{
    public $message = 'Ya existe el código asignado';
    
    public function validatedBy()
    {
        return 'costo_code_unique';
    }

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
    
    
}