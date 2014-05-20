<?php
namespace Backend\AdminBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Table(name="caja")
 * @ORM\Entity()
 *  
 */
class Caja
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

   /**
     * @ORM\Column(name="motivo", type="text", nullable=true)
     */
    private $motivo;
    
    
     /**
     * @ORM\Column(name="fecha", type="datetime")
     */
    private $fecha;
  
    /**
     * @ORM\Column(name="tipo", type="string", length=1)
     */
    private $tipo;
     /**
     * @ORM\Column(name="monto", type="decimal", scale=2 )
     */
    private $monto;
    
   
    
    /**
     * @ORM\ManyToOne(targetEntity="\Backend\UserBundle\Entity\User", inversedBy="cajaempleados")
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     */
     
    private $usuario;
    
      
    /**
     * @ORM\Column(name="delete_at", type="datetime", nullable=true)
     */
    private $delete_at;
      /**
     * @ORM\ManyToOne(targetEntity="\Backend\UserBundle\Entity\User", inversedBy="delcajaempleados")
     * @ORM\JoinColumn(name="delete_by", referencedColumnName="id")
     */
    private $delete_by;
    
    /**
     * @ORM\Column(name="is_delete", type="boolean" )
     */
    private $isDelete;
    
    
    
    /**
     * @ORM\ManyToOne(targetEntity="Viaje", inversedBy="cajaempleado")
     * @ORM\JoinColumn(name="viaje_id", referencedColumnName="id")
     */ 
    public $viaje;
    
     /**
     * @ORM\ManyToOne(targetEntity="Chofer", inversedBy="cajaempleado")
     * @ORM\JoinColumn(name="chofer_id", referencedColumnName="id")
     */
    public $chofer;
    
     /**
     * @ORM\ManyToOne(targetEntity="Costo", inversedBy="cajaempleado")
     * @ORM\JoinColumn(name="costo_id", referencedColumnName="id")
     */
    private $costo;
    
    public function __construct()
    {
        
        $this->isDelete=false;
        $this->fecha = new \DateTime('now');
         
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
     * Set motivo
     *
     * @param string $motivo
     * @return Caja
     */
    public function setMotivo($motivo)
    {
        $this->motivo = $motivo;
    
        return $this;
    }

    /**
     * Get motivo
     *
     * @return string 
     */
    public function getMotivo()
    {
        return $this->motivo;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Caja
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    
        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     * @return Caja
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    
        return $this;
    }

    /**
     * Get tipo
     *
     * @return string 
     */
    
    public function getTipoText(){
        if ($this->tipo == "e"){
          $tipo="Descuento"; 
        }
        if ($this->tipo == "d")
        {
          $tipo="Descuento";
        }
        if ($this->tipo == "r"){
          $tipo="Reintegro";
         }
         if ($this->tipo == "t"){
          $tipo="Reintegro";
         }
        return $tipo;

    }
    
    public function getTipo()
    {
        return $this->tipo;        
            
    }

    /**
     * Set monto
     *
     * @param float $monto
     * @return Caja
     */
    public function setMonto($monto)
    {
        $this->monto = $monto;
    
        return $this;
    }

    /**
     * Get monto
     *
     * @return float 
     */
    public function getMonto()
    {
        return $this->monto;
    }

    /**
     * Set delete_at
     *
     * @param \DateTime $deleteAt
     * @return Caja
     */
    public function setDeleteAt($deleteAt)
    {
        $this->delete_at = $deleteAt;
    
        return $this;
    }

    /**
     * Get delete_at
     *
     * @return \DateTime 
     */
    public function getDeleteAt()
    {
        return $this->delete_at;
    }

    /**
     * Set isDelete
     *
     * @param boolean $isDelete
     * @return Caja
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
     * Set usuario
     *
     * @param \Backend\UserBundle\Entity\User $usuario
     * @return Caja
     */
    public function setUsuario(\Backend\UserBundle\Entity\User $usuario = null)
    {
        $this->usuario = $usuario;
    
        return $this;
    }

    /**
     * Get usuario
     *
     * @return \Backend\UserBundle\Entity\User 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set delete_by
     *
     * @param \Backend\UserBundle\Entity\User $deleteBy
     * @return Caja
     */
    public function setDeleteBy(\Backend\UserBundle\Entity\User $deleteBy = null)
    {
        $this->delete_by = $deleteBy;
    
        return $this;
    }

    /**
     * Get delete_by
     *
     * @return \Backend\UserBundle\Entity\User 
     */
    public function getDeleteBy()
    {
        return $this->delete_by;
    }

    /**
     * Set viaje
     *
     * @param \Backend\AdminBundle\Entity\Viaje $viaje
     * @return Caja
     */
    public function setViaje(\Backend\AdminBundle\Entity\Viaje $viaje = null)
    {
        $this->viaje = $viaje;
    
        return $this;
    }

    /**
     * Get viaje
     *
     * @return \Backend\AdminBundle\Entity\Viaje 
     */
    public function getViaje()
    {
        return $this->viaje;
    }

    /**
     * Set chofer
     *
     * @param \Backend\AdminBundle\Entity\Chofer $chofer
     * @return Caja
     */
    public function setChofer(\Backend\AdminBundle\Entity\Chofer $chofer = null)
    {
        $this->chofer = $chofer;
    
        return $this;
    }

    /**
     * Get chofer
     *
     * @return \Backend\AdminBundle\Entity\Chofer 
     */
    public function getChofer()
    {
        return $this->chofer;
    }
    
    public function getTipoName(){
        if ($this->tipo == "r")
         return "reintegro";
        else
         return "descuento";
        
    }
    
    

    /**
     * Set costo
     *
     * @param \Backend\AdminBundle\Entity\Costo $costo
     * @return Caja
     */
    public function setCosto(\Backend\AdminBundle\Entity\Costo $costo = null)
    {
        $this->costo = $costo;
    
        return $this;
    }

    /**
     * Get costo
     *
     * @return \Backend\AdminBundle\Entity\Costo 
     */
    public function getCosto()
    {
        return $this->costo;
    }
    
    
}