<?php 
namespace Backend\AdminBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @ORM\Table(name="costo")
 * @ORM\Entity()
 */
class Costo
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
   /**
     * @ORM\ManyToOne(targetEntity="TipoCosto", inversedBy="costos")
     * @ORM\JoinColumn(name="tipo_id", referencedColumnName="id")
     */
    private $tipo;
    
     /**
     * @ORM\Column(name="fecha", type="datetime")
     */
    private $fecha;
    /**
     * @ORM\Column(name="texto", type="string", length=100, nullable=true)
     */
    private $concepto;
    /**
     * @ORM\Column(name="recibo", type="string", length=100, nullable=true)
     */
    private $recibo;
     /**
     * @ORM\Column(name="monto", type="decimal", scale=2 )
     */
    private $monto;
    /**
     * @ORM\Column(name="is_aprobado", type="boolean" )
     */
    private $isAprobado;
     /**
     * @ORM\Column(name="is_delete", type="boolean" )
     */
    private $isDelete;
      /**
     * @ORM\Column(name="delete_at", type="datetime", nullable=true )
     */
    private $delete_at;
      /**
     * @ORM\ManyToOne(targetEntity="\Backend\UserBundle\Entity\User", inversedBy="delcostos")
     * @ORM\JoinColumn(name="delete_by", referencedColumnName="id")
     */
    private $delete_by;
    
    /**
     * @ORM\ManyToOne(targetEntity="Viaje", inversedBy="costos")
     * @ORM\JoinColumn(name="viaje_id", referencedColumnName="id")
     */
    private $viaje;
    
     /**
     * @ORM\OneToMany(targetEntity="Caja", mappedBy="costo")
     */
    private $cajaempleado;
    
    
    public function __construct()
    {
         $this->isDelete=false;
         $this->isAprobado=false;
         $this->fecha = new \DateTime('now');
         $this->cajaempleado = new ArrayCollection();
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
     * Set concepto
     *
     * @param string $concepto
     * @return Costo
     */
    public function setConcepto($concepto)
    {
        $this->concepto = $concepto;
    
        return $this;
    }

    /**
     * Get concepto
     *
     * @return string 
     */
    public function getConcepto()
    {
        return $this->concepto;
    }

    /**
     * Set recibo
     *
     * @param string $recibo
     * @return Costo
     */
    public function setRecibo($recibo)
    {
        $this->recibo = $recibo;
    
        return $this;
    }

    /**
     * Get recibo
     *
     * @return string 
     */
    public function getRecibo()
    {
        return $this->recibo;
    }

    /**
     * Set monto
     *
     * @param float $monto
     * @return Costo
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
     * Set isAprobado
     *
     * @param boolean $isAprobado
     * @return Costo
     */
    public function setIsAprobado($isAprobado)
    {
        $this->isAprobado = $isAprobado;
    
        return $this;
    }

    /**
     * Get isAprobado
     *
     * @return boolean 
     */
    public function getIsAprobado()
    {
        return $this->isAprobado;
    }

    /**
     * Set isDelete
     *
     * @param boolean $isDelete
     * @return Costo
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
     * Set delete_at
     *
     * @param \DateTime $deleteAt
     * @return Costo
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
     * Set tipo
     *
     * @param \Backend\AdminBundle\Entity\TipoCosto $tipo
     * @return Costo
     */
    public function setTipo(\Backend\AdminBundle\Entity\TipoCosto $tipo = null)
    {
        $this->tipo = $tipo;
    
        return $this;
    }

    /**
     * Get tipo
     *
     * @return \Backend\AdminBundle\Entity\TipoCosto 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set delete_by
     *
     * @param \Backend\UserBundle\Entity\User $deleteBy
     * @return Costo
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
     * @return Costo
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
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Costo
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
     * Add cajaempleado
     *
     * @param \Backend\AdminBundle\Entity\Caja $cajaempleado
     * @return Costo
     */
    public function addCajaempleado(\Backend\AdminBundle\Entity\Caja $cajaempleado)
    {
        $this->cajaempleado[] = $cajaempleado;
    
        return $this;
    }

    /**
     * Remove cajaempleado
     *
     * @param \Backend\AdminBundle\Entity\Caja $cajaempleado
     */
    public function removeCajaempleado(\Backend\AdminBundle\Entity\Caja $cajaempleado)
    {
        $this->cajaempleado->removeElement($cajaempleado);
    }

    /**
     * Get cajaempleado
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCajaempleado()
    {
        return $this->cajaempleado;
    }
}