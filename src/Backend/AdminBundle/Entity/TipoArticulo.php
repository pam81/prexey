<?php

namespace Backend\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="tipo_articulo")
 * @ORM\Entity()
 */

class TipoArticulo
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    
    private $id;

    /**
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;
    
      /**
     * @ORM\Column(name="is_valido", type="boolean" )
     */
    private $isValido;
    
     /**
     * @ORM\Column(name="is_delete", type="boolean" )
     */
    private $isDelete;
    /**
     * @ORM\OneToMany(targetEntity="Articulos", mappedBy="tipo")
     */

    protected $articulos;    

     /**
    
    /**
     * Constructor
     */
    public function __construct()
    {
         $this->isDelete=false;
         $this->isValido=true;
         $this->articulos = new ArrayCollection();
             
    }
    
  
}