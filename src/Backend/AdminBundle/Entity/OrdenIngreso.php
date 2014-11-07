<?php

namespace Backend\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="orden_ingreso")
 * @ORM\Entity()
 */

class OrdenIngreso
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    
    private $id;
 
     /**
     * @ORM\Column(name="documento", type="string", length=100)
     */
     
    public $documento; 
    
    /**
     * @ORM\Column(name="created_at", type="datetime")
     */    
     
    private $createdAt;
    
     /**
     * @ORM\Column(name="is_delete", type="boolean" )
     */
     
    private $isDelete;
   
   /**
     * @ORM\ManyToOne(targetEntity="TipoOrdenIngreso", inversedBy="ordenesingreso")
     * @ORM\JoinColumn(name="tipo_id", referencedColumnName="id")
    */

    protected $tipo;    
       
    /**
     * @ORM\ManyToOne(targetEntity="Cliente", inversedBy="ordenesIngreso")
     * @ORM\JoinColumn(name="cliente_id", referencedColumnName="id")
    */
    
    protected $cliente;
    
     /**
     * @ORM\ManyToOne(targetEntity="OperadorLogistico", inversedBy="ordenesIngreso")
     * @ORM\JoinColumn(name="operador_id", referencedColumnName="id")
    */
        
    protected $operador;     

	/**
     * @ORM\OneToMany(targetEntity="Producto", mappedBy="orden_ingreso")
     */

    protected $productos;  

	/**
     * @ORM\Column(name="observaciones", type="text", nullable=true)
     */
    
    private $observaciones;
    
    /**
     * Constructor
     */
     
    public function __construct()
    {
         $this->isDelete=false;
         $this->createdAt = new \DateTime('now');   
    }
     

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Orden de Ingreso
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set isDelete
     *
     * @param boolean $isDelete
     * @return Orden de Ingreso
     */
    public function setIsDelete($isDelete)
    {
        $this->isDelete = $isDelete;
    
        return $this;
    }

    /**
     * Get isDelete
     *
     * @return boolean 
     */
    public function getIsDelete()
    {
        return $this->isDelete;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return Articulo
     */
    public function setObservacion($observaciones)
    {
        $this->observaciones = $observaciones;
   
        return $this;
    }

    /**
     * Get observacion
     *
     * @return string 
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set tipo
     *
     * @param \Backend\AdminBundle\Entity\TipoOrdenIngreso $tipo
     * @return OrdenIngreso
     */
    public function setTipo(\Backend\AdminBundle\Entity\TipoOrdenIngreso $tipo = null)
    {
        $this->tipo = $tipo;
    
        return $this;
    }

    /**
     * Get tipo
     *
     * @return \Backend\AdminBundle\Entity\TipoOrdenIngreso 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return OrdenIngreso
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;
    
        return $this;
    }

    /**
     * Set cliente
     *
     * @param \Backend\AdminBundle\Entity\Cliente $cliente
     * @return OrdenIngreso
     */
    public function setCliente(\Backend\AdminBundle\Entity\Cliente $cliente = null)
    {
        $this->cliente = $cliente;
    
        return $this;
    }

    /**
     * Get cliente
     *
     * @return \Backend\AdminBundle\Entity\Cliente 
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Set operador
     *
     * @param \Backend\AdminBundle\Entity\OperadorLogistico $operador
     * @return OrdenIngreso
     */
    public function setOperador(\Backend\AdminBundle\Entity\OperadorLogistico $operador = null)
    {
        $this->operador = $operador;
    
        return $this;
    }

    /**
     * Get operador
     *
     * @return \Backend\AdminBundle\Entity\OperadorLogistico 
     */
    public function getOperador()
    {
        return $this->operador;
    }

    /**
     * Set documento
     *
     * @param string $documento
     * @return OrdenIngreso
     */
    public function setDocumento($documento)
    {
        $this->documento = $documento;
    
        return $this;
    }

    /**
     * Get documento
     *
     * @return string 
     */
    public function getDocumento()
    {
        return $this->documento;
    }

    /**
     * Add productos
     *
     * @param \Backend\AdminBundle\Entity\Producto $productos
     * @return OrdenIngreso
     */
    public function addProducto(\Backend\AdminBundle\Entity\Producto $productos)
    {
        $this->productos[] = $productos;
    
        return $this;
    }

    /**
     * Remove productos
     *
     * @param \Backend\AdminBundle\Entity\Producto $productos
     */
    public function removeProducto(\Backend\AdminBundle\Entity\Producto $productos)
    {
        $this->productos->removeElement($productos);
    }

    /**
     * Get productos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProductos()
    {
        return $this->productos;
    }
}