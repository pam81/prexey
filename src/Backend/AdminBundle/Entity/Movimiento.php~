<?php 
namespace Backend\AdminBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="movimiento")
 * @ORM\Entity(repositoryClass="Backend\AdminBundle\Entity\MovimientoRepository")
 * @ORM\HasLifecycleCallbacks() 
 */
class Movimiento
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
     * @ORM\Column(name="destinatario", type="string", length=200, nullable=true)
     */
    private $destinatario;
    
     /**
     * @ORM\Column(name="fecha", type="datetime")
     */
    private $fecha;
   /**
     * @ORM\ManyToOne(targetEntity="TipoMovimiento", inversedBy="movimientos")
     * @ORM\JoinColumn(name="tipomovimiento_id", referencedColumnName="id")
     */
    private $clase;
    /**
     * @ORM\Column(name="tipo", type="string", length=1)
     */
    private $tipo;
     /**
     * @ORM\Column(name="monto", type="decimal", scale=2 )
     */
    private $monto;
    
    /**
     * @ORM\Column(name="saldo_deposito", type="decimal", scale=2, nullable=true )
     */
    private $saldo_deposito;
    
    /**
     * @ORM\ManyToOne(targetEntity="\Backend\UserBundle\Entity\User", inversedBy="movimientos")
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     */
     
    private $usuario;
    
      /**
     * @ORM\ManyToOne(targetEntity="Deposito", inversedBy="movimientos")
     * @ORM\JoinColumn(name="deposito_id", referencedColumnName="id")
     */
     
    private $deposito;
    
    
      /**
     * @ORM\ManyToOne(targetEntity="Deposito", inversedBy="mov_destinos")
     * @ORM\JoinColumn(name="destinoDeposito_id", referencedColumnName="id")
     */
    private $deposito_destino;
    /**
     * @ORM\Column(name="delete_at", type="datetime", nullable=true)
     */
    private $delete_at;
      /**
     * @ORM\ManyToOne(targetEntity="\Backend\UserBundle\Entity\User", inversedBy="delmovimientos")
     * @ORM\JoinColumn(name="delete_by", referencedColumnName="id")
     */
    private $delete_by;
    
    /**
     * @ORM\Column(name="is_delete", type="boolean" )
     */
    private $isDelete;
    
     /**
     * @ORM\Column(name="recibo", type="integer", unique=true )
     *     
     */
    private $recibo;
    
    /**
     * @ORM\ManyToOne(targetEntity="Viaje", inversedBy="movimientos")
     * @ORM\JoinColumn(name="viaje_id", referencedColumnName="id")
     */ 
    private $viaje;
    
    public function __construct()
    {
        
        $this->isDelete=false;
        $this->fecha = new \DateTime('now');
         
    }
    
    
      //solo al dar de alta el update no existe
    /**
     * @ORM\PrePersist()
     * 
     */
    public function updateDeposito()
    {
     
        
        $saldo = $this->deposito->getSaldo();
      if ($this->tipo == "i") //ingresa => Sumar
         $saldo = $saldo + $this->monto;
      else  //egreso => resto
         $saldo = $saldo - $this->monto;
      $this->deposito->setSaldo($saldo);
      $this->setSaldoDeposito($saldo);
    }
    
    
    public function deleteDeposito($deleteBy)
    {
       //baja Logica
       $this->setIsDelete(true);
       $this->setDeleteAt(new \DateTime('now'));
       $this->setDeleteBy($deleteBy);
       $saldo = $this->deposito->getSaldo();
        if ($this->tipo == "i") //el ingreso lo debo quitar
         $saldo = $saldo - $this->monto;
        else // el egreso debo retornarlo
         $saldo = $saldo + $this->monto;
       
       $this->deposito->setSaldo($saldo);
       
       //los movimientos posteriores que existan hay que actualizar el saldo_deposito!!
       
        
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
     * @return Movimiento
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
     * @return Movimiento
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
     * @return Movimiento
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
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set clase
     *
     * @param \Backend\AdminBundle\Entity\TipoMovimiento $clase
     * @return Movimiento
     */
    public function setClase(\Backend\AdminBundle\Entity\TipoMovimiento $clase = null)
    {
        $this->clase = $clase;
    
        return $this;
    }

    /**
     * Get clase
     *
     * @return \Backend\AdminBundle\Entity\TipoMovimiento 
     */
    public function getClase()
    {
        return $this->clase;
    }

    /**
     * Set usuario
     *
     * @param \Backend\UserBundle\Entity\User $usuario
     * @return Movimiento
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
     * Set isDelete
     *
     * @param boolean $isDelete
     * @return Movimiento
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
     * Set monto
     *
     * @param float $monto
     * @return Movimiento
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
     * Set deposito
     *
     * @param \Backend\AdminBundle\Entity\Deposito $deposito
     * @return Movimiento
     */
    public function setDeposito(\Backend\AdminBundle\Entity\Deposito $deposito = null)
    {
        $this->deposito = $deposito;
    
        return $this;
    }

    /**
     * Get deposito
     *
     * @return \Backend\AdminBundle\Entity\Deposito 
     */
    public function getDeposito()
    {
        return $this->deposito;
    }

    /**
     * Set deposito_destino
     *
     * @param \Backend\AdminBundle\Entity\Deposito $depositoDestino
     * @return Movimiento
     */
    public function setDepositoDestino(\Backend\AdminBundle\Entity\Deposito $depositoDestino = null)
    {
        $this->deposito_destino = $depositoDestino;
    
        return $this;
    }

    /**
     * Get deposito_destino
     *
     * @return \Backend\AdminBundle\Entity\Deposito 
     */
    public function getDepositoDestino()
    {
        return $this->deposito_destino;
    }

    /**
     * Set delete_at
     *
     * @param \DateTime $deleteAt
     * @return Movimiento
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
     * Set delete_by
     *
     * @param \Backend\UserBundle\Entity\User $deleteBy
     * @return Movimiento
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
     * @return Movimiento
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
     * Set recibo
     *
     * @param integer $recibo
     * @return Movimiento
     */
    public function setRecibo($recibo)
    {
        $this->recibo = $recibo;
    
        return $this;
    }

    /**
     * Get recibo
     *
     * @return integer 
     */
    public function getRecibo()
    {
        return $this->recibo;
    }

    /**
     * Set saldo_deposito
     *
     * @param float $saldoDeposito
     * @return Movimiento
     */
    public function setSaldoDeposito($saldoDeposito)
    {
        $this->saldo_deposito = $saldoDeposito;
    
        return $this;
    }

    /**
     * Get saldo_deposito
     *
     * @return float 
     */
    public function getSaldoDeposito()
    {
        return $this->saldo_deposito;
    }

    /**
     * Set destinatario
     *
     * @param string $destinatario
     * @return Movimiento
     */
    public function setDestinatario($destinatario)
    {
        $this->destinatario = $destinatario;
    
        return $this;
    }

    /**
     * Get destinatario
     *
     * @return string 
     */
    public function getDestinatario()
    {
        return $this->destinatario;
    }
}