<?php

namespace Backend\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="articulo")
 * @ORM\Entity()
 */

class Articulo
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    
    private $id;
 
    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;
    
     /**
     * @ORM\Column(name="is_delete", type="boolean" )
     */
    private $isDelete;
    
    /**
     * @ORM\Column(name="is_disponible", type="boolean" )
     */
    private $isDisponible;
   /**
     * @ORM\ManyToOne(targetEntity="TipoArticulo", inversedBy="articulos")
     * @ORM\JoinColumn(name="tipo_id", referencedColumnName="id")
     */

    protected $tipo;    

     /**
     * @ORM\Column(name="descripcion", type="text", nullable=true)
     */
    private $descripcion;
    
     /**
     * @ORM\Column(name="observacion", type="text", nullable=true)
     */
    private $observacion;


     /**
    
    /**
     * Constructor
     */
    public function __construct()
    {
         $this->isDelete=false;
         $this->isValido=true;
         $this->createdAt = new \DateTime('now');   
    }
    
  
}