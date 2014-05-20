<?php 
namespace Backend\UserBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class UsuarioUnique extends Constraint
{
    public $message = 'Ya existe el mismo nombre de usuario';
    
    public function validatedBy()
    {
        return 'usuario_unique';
    }

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
    
    
}