<?php 
namespace Backend\AdminBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
//use Backend\AdminBundle\Validator\Constraints\PendienteChoferUnique;
//use Backend\AdminBundle\Validator\Constraints\PendienteCamionUnique;
/**
 * @ORM\Table(name="viaje")
 * @ORM\Entity()
 *   
 */
class Viaje
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Cliente", inversedBy="viajes")
     * @ORM\JoinColumn(name="cliente_id", referencedColumnName="id")
     */
    private $cliente;
    /**
     * @ORM\ManyToOne(targetEntity="\Backend\UserBundle\Entity\User", inversedBy="viajes")
     * @ORM\JoinColumn(name="operario_id", referencedColumnName="id", nullable=true)
     */
    private $operario;
    /**
     * @ORM\ManyToOne(targetEntity="\Backend\UserBundle\Entity\User", inversedBy="create_viajes")
     * @ORM\JoinColumn(name="created_by", referencedColumnName="id")
     */
     private $created_by;
    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $created_at;
    /**
     * @ORM\Column(name="delete_at", type="datetime", nullable=true)
     */
    private $delete_at;
    
    /**
     * @ORM\ManyToOne(targetEntity="\Backend\UserBundle\Entity\User", inversedBy="delviajes")
     * @ORM\JoinColumn(name="delete_by", referencedColumnName="id", nullable=true)
     */
     private $delete_by;
     
     /**
     * @ORM\Column(name="is_delete", type="boolean" )
     */
    private $isDelete;
    
     /**
     * @ORM\Column(name="has_exception", type="boolean" )
     */
    private $hasException;
    
    /**
     * @ORM\ManyToOne(targetEntity="Camion", inversedBy="viajes")
     * @ORM\JoinColumn(name="camion_id", referencedColumnName="id")
     */
    private $camion;
    /**
     * @ORM\ManyToOne(targetEntity="Camion", inversedBy="acoplado_viajes")
     * @ORM\JoinColumn(name="acoplado_id", referencedColumnName="id", nullable=true)
     */
    private $acoplado;
    
    /**
     * @ORM\ManyToOne(targetEntity="Chofer", inversedBy="viajes")
     * @ORM\JoinColumn(name="chofer_id", referencedColumnName="id")
     */
    private $chofer;
    
     /**
     * @ORM\ManyToOne(targetEntity="Chofer", inversedBy="acompania_viajes")
     * @ORM\JoinColumn(name="acompaniante_id", referencedColumnName="id")
     */
    private $acompaniante;
     /**
     * @ORM\ManyToOne(targetEntity="Deposito", inversedBy="viajes")
     * @ORM\JoinColumn(name="deposito_id", referencedColumnName="id")
     */
    private $deposito;
    /**
     * @ORM\ManyToOne(targetEntity="Estado", inversedBy="viajes")
     * @ORM\JoinColumn(name="estado_id", referencedColumnName="id")
     */
    private $estado;
    /**
     * @ORM\Column(name="km_camion", type="integer", nullable=true)
     */
    private $km_camion;
    /**
     * @ORM\Column(name="efectivo", type="decimal", scale=2 , nullable=true)
     */
    private $efectivo;
    /**
     * @ORM\Column(name="fecha_salida", type="date",  nullable=true)
     */
    private $fecha_salida;
    /**
     * @ORM\Column(name="hora_salida", type="time",  nullable=true)
     */
    private $hora_salida;
    /**
     * @ORM\Column(name="fecha_regreso", type="date", nullable=true)
     */
    private $fecha_regreso;
    /**
     * @ORM\Column(name="hora_regreso", type="time", nullable=true)
     */
    private $hora_regreso;
    /**
     * @ORM\Column(name="incorpora_dinero", type="decimal", scale=2 , nullable=true)
     */
    private $incorpora_dinero;
     /**
     * @ORM\Column(name="observacion", type="text", nullable=true)
     */
    private $observacion;
     /**
     * @ORM\Column(name="km_retorno", type="integer", nullable=true)
     */
    private $km_retorno;
    /**
     * @ORM\Column(name="efectivo_retornado", type="decimal", scale=2 , nullable=true)
     */
    private $efectivo_retornado;
    /**
     * @ORM\Column(name="efectivo_regreso", type="decimal", scale=2 , nullable=true)
     */
    private $efectivo_regreso;
    
    /**
     * @ORM\Column(name="efectivo_reintegro", type="decimal", scale=2 , nullable=true)
     */
    private $efectivo_reintegro;
    
    /**
     * @ORM\Column(name="efectivo_caja", type="decimal", scale=2 , nullable=true)
     */
    private $efectivo_caja;
    
     /**
     * @ORM\Column(name="saldo", type="decimal", scale=2 , nullable=true)
     */
    private $saldo;
  
   /**
     * @ORM\OneToMany(targetEntity="Hoja", mappedBy="viaje")
     */
     
     private $destinos;
    
     /**
     * @ORM\Column(name="consumido", type="decimal", scale=3, nullable=true)
     */
     private $consumido;
     
     /**
     * @ORM\Column(name="eficiencia", type="decimal", scale=2 , nullable=true)
     */
    private $eficiencia;
     
     
    /**
     * @ORM\OneToMany(targetEntity="Costo", mappedBy="viaje")
     */
    private $costos;
    
    
    /**
     * @ORM\OneToMany(targetEntity="Movimiento", mappedBy="viaje")
     */
    private $movimientos;
    
     /**
     * @ORM\OneToMany(targetEntity="Caja", mappedBy="viaje")
     */
    private $cajaempleado;
    
    /**
     * @ORM\ManyToOne(targetEntity="TipoViaje", inversedBy="viajes")
     * @ORM\JoinColumn(name="tipoviaje_id", referencedColumnName="id")
     */
    private $tipo_viaje;
    
    
    public function __construct()
    {
       $this->costos = new ArrayCollection();
       $this->destinos = new ArrayCollection();
       $this->movimientos = new ArrayCollection();
       $this->cajaempleado = new ArrayCollection();
       $this->created_at = new \DateTime('now');
       $this->fecha_salida = new \DateTime('today');
       $this->hora_salida = new \DateTime('now');
       $this->fecha_regreso = new \DateTime('today');
       $this->saldo = 0;
       $this->isDelete=false;
       $this->hasException=false;
         
    }

    public function __toString()
    {
      return "Viaje Nº".$this->id;
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
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Viaje
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    
        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set delete_at
     *
     * @param \DateTime $deleteAt
     * @return Viaje
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
     * @return Viaje
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
     * Set km_camion
     *
     * @param integer $kmCamion
     * @return Viaje
     */
    public function setKmCamion($kmCamion)
    {
        $this->km_camion = $kmCamion;
    
        return $this;
    }

    /**
     * Get km_camion
     *
     * @return integer 
     */
    public function getKmCamion()
    {
        return $this->km_camion;
    }

    /**
     * Set efectivo
     *
     * @param float $efectivo
     * @return Viaje
     */
    public function setEfectivo($efectivo)
    {
        $this->efectivo = $efectivo;
    
        return $this;
    }

    /**
     * Get efectivo
     *
     * @return float 
     */
    public function getEfectivo()
    {
        return $this->efectivo;
    }

    /**
     * Set fecha_salida
     *
     * @param \DateTime $fechaSalida
     * @return Viaje
     */
    public function setFechaSalida($fechaSalida)
    {
        $this->fecha_salida = $fechaSalida;
    
        return $this;
    }

    /**
     * Get fecha_salida
     *
     * @return \DateTime 
     */
    public function getFechaSalida()
    {
        return $this->fecha_salida;
    }

    /**
     * Set hora_salida
     *
     * @param \DateTime $horaSalida
     * @return Viaje
     */
    public function setHoraSalida($horaSalida)
    {
        $this->hora_salida = $horaSalida;
    
        return $this;
    }

    /**
     * Get hora_salida
     *
     * @return \DateTime 
     */
    public function getHoraSalida()
    {
        return $this->hora_salida;
    }

    /**
     * Set fecha_regreso
     *
     * @param \DateTime $fechaRegreso
     * @return Viaje
     */
    public function setFechaRegreso($fechaRegreso)
    {
        $this->fecha_regreso = $fechaRegreso;
    
        return $this;
    }

    /**
     * Get fecha_regreso
     *
     * @return \DateTime 
     */
    public function getFechaRegreso()
    {
        return $this->fecha_regreso;
    }

    /**
     * Set hora_regreso
     *
     * @param \DateTime $horaRegreso
     * @return Viaje
     */
    public function setHoraRegreso($horaRegreso)
    {
        $this->hora_regreso = $horaRegreso;
    
        return $this;
    }

    /**
     * Get hora_regreso
     *
     * @return \DateTime 
     */
    public function getHoraRegreso()
    {
        return $this->hora_regreso;
    }

    /**
     * Set incorpora_dinero
     *
     * @param float $incorporaDinero
     * @return Viaje
     */
    public function setIncorporaDinero($incorporaDinero)
    {
        $this->incorpora_dinero = $incorporaDinero;
    
        return $this;
    }

    /**
     * Get incorpora_dinero
     *
     * @return float 
     */
    public function getIncorporaDinero()
    {
        return $this->incorpora_dinero;
    }

    /**
     * Set observacion
     *
     * @param string $observacion
     * @return Viaje
     */
    public function setObservacion($observacion)
    {
        $this->observacion = $observacion;
    
        return $this;
    }

    /**
     * Get observacion
     *
     * @return string 
     */
    public function getObservacion()
    {
        return $this->observacion;
    }

    /**
     * Set km_retorno
     *
     * @param integer $kmRetorno
     * @return Viaje
     */
    public function setKmRetorno($kmRetorno)
    {
        $this->km_retorno = $kmRetorno;
    
        return $this;
    }

    /**
     * Get km_retorno
     *
     * @return integer 
     */
    public function getKmRetorno()
    {
        return $this->km_retorno;
    }

    /**
     * Set efectivo_retornado
     *
     * @param float $efectivoRetornado
     * @return Viaje
     */
    public function setEfectivoRetornado($efectivoRetornado)
    {
        $this->efectivo_retornado = $efectivoRetornado;
    
        return $this;
    }

    /**
     * Get efectivo_retornado
     *
     * @return float 
     */
    public function getEfectivoRetornado()
    {
        return $this->efectivo_retornado;
    }

    /**
     * Set efectivo_regreso
     *
     * @param float $efectivoRegreso
     * @return Viaje
     */
    public function setEfectivoRegreso($efectivoRegreso)
    {
        $this->efectivo_regreso = $efectivoRegreso;
    
        return $this;
    }

    /**
     * Get efectivo_regreso
     *
     * @return float 
     */
    public function getEfectivoRegreso()
    {
        return $this->efectivo_regreso;
    }

    /**
     * Set cliente
     *
     * @param \Backend\AdminBundle\Entity\Cliente $cliente
     * @return Viaje
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
     * Set operario
     *
     * @param \Backend\UserBundle\Entity\User $operario
     * @return Viaje
     */
    public function setOperario(\Backend\UserBundle\Entity\User $operario = null)
    {
        $this->operario = $operario;
    
        return $this;
    }

    /**
     * Get operario
     *
     * @return \Backend\UserBundle\Entity\User 
     */
    public function getOperario()
    {
        return $this->operario;
    }

    /**
     * Set created_by
     *
     * @param \Backend\UserBundle\Entity\User $createdBy
     * @return Viaje
     */
    public function setCreatedBy(\Backend\UserBundle\Entity\User $createdBy = null)
    {
        $this->created_by = $createdBy;
    
        return $this;
    }

    /**
     * Get created_by
     *
     * @return \Backend\UserBundle\Entity\User 
     */
    public function getCreatedBy()
    {
        return $this->created_by;
    }

    /**
     * Set delete_by
     *
     * @param \Backend\UserBundle\Entity\User $deleteBy
     * @return Viaje
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
     * Set camion
     *
     * @param \Backend\AdminBundle\Entity\Camion $camion
     * @return Viaje
     */
    public function setCamion(\Backend\AdminBundle\Entity\Camion $camion = null)
    {
        $this->camion = $camion;
    
        return $this;
    }

    /**
     * Get camion
     *
     * @return \Backend\AdminBundle\Entity\Camion 
     */
    public function getCamion()
    {
        return $this->camion;
    }

    /**
     * Set chofer
     *
     * @param \Backend\AdminBundle\Entity\Chofer $chofer
     * @return Viaje
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

    /**
     * Set deposito
     *
     * @param \Backend\AdminBundle\Entity\Deposito $deposito
     * @return Viaje
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
     * Set estado
     *
     * @param \Backend\AdminBundle\Entity\Estado $estado
     * @return Viaje
     */
    public function setEstado(\Backend\AdminBundle\Entity\Estado $estado = null)
    {
        $this->estado = $estado;
    
        return $this;
    }

    /**
     * Get estado
     *
     * @return \Backend\AdminBundle\Entity\Estado 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Add destinos
     *
     * @param \Backend\AdminBundle\Entity\Hoja $destinos
     * @return Viaje
     */
    public function addDestino(\Backend\AdminBundle\Entity\Hoja $destinos)
    {
        $this->destinos[] = $destinos;
    
        return $this;
    }

    /**
     * Remove destinos
     *
     * @param \Backend\AdminBundle\Entity\Hoja $destinos
     */
    public function removeDestino(\Backend\AdminBundle\Entity\Hoja $destinos)
    {
        $this->destinos->removeElement($destinos);
    }

    /**
     * Get destinos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDestinos()
    {
        return $this->destinos;
    }

    /**
     * Add costos
     *
     * @param \Backend\AdminBundle\Entity\Costo $costos
     * @return Viaje
     */
    public function addCosto(\Backend\AdminBundle\Entity\Costo $costos)
    {
        $this->costos[] = $costos;
    
        return $this;
    }

    /**
     * Remove costos
     *
     * @param \Backend\AdminBundle\Entity\Costo $costos
     */
    public function removeCosto(\Backend\AdminBundle\Entity\Costo $costos)
    {
        $this->costos->removeElement($costos);
    }

    /**
     * Get costos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCostos()
    {
        return $this->costos;
    }

    /**
     * Add movimientos
     *
     * @param \Backend\AdminBundle\Entity\Movimiento $movimientos
     * @return Viaje
     */
    public function addMovimiento(\Backend\AdminBundle\Entity\Movimiento $movimientos)
    {
        $this->movimientos[] = $movimientos;
    
        return $this;
    }

    /**
     * Remove movimientos
     *
     * @param \Backend\AdminBundle\Entity\Movimiento $movimientos
     */
    public function removeMovimiento(\Backend\AdminBundle\Entity\Movimiento $movimientos)
    {
        $this->movimientos->removeElement($movimientos);
    }

    /**
     * Get movimientos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMovimientos()
    {
        return $this->movimientos;
    }

    /**
     * Set consumido
     *
     * @param float $consumido
     * @return Viaje
     */
    public function setConsumido($consumido)
    {
        $this->consumido = $consumido;
    
        return $this;
    }

    /**
     * Get consumido
     *
     * @return float 
     */
    public function getConsumido()
    {
        return $this->consumido;
    }

    /**
     * Set eficiencia
     *
     * @param float $eficiencia
     * @return Viaje
     */
    public function setEficiencia($eficiencia)
    {
        $this->eficiencia = $eficiencia;
    
        return $this;
    }

    /**
     * Get eficiencia
     *
     * @return float 
     */
    public function getEficiencia()
    {
        return $this->eficiencia;
    }

    /**
     * Set efectivo_reintegro
     *
     * @param float $efectivoReintegro
     * @return Viaje
     */
    public function setEfectivoReintegro($efectivoReintegro)
    {
        $this->efectivo_reintegro = $efectivoReintegro;
    
        return $this;
    }

    /**
     * Get efectivo_reintegro
     *
     * @return float 
     */
    public function getEfectivoReintegro()
    {
        return $this->efectivo_reintegro;
    }

    /**
     * Set saldo
     *
     * @param float $saldo
     * @return Viaje
     */
    public function setSaldo($saldo)
    {
        $this->saldo = $saldo;
    
        return $this;
    }

    /**
     * Get saldo
     *
     * @return float 
     */
    public function getSaldo()
    {
        return $this->saldo;
    }

    

    /**
     * Set tipo_viaje
     *
     * @param \Backend\AdminBundle\Entity\TipoViaje $tipoViaje
     * @return Viaje
     */
    public function setTipoViaje(\Backend\AdminBundle\Entity\TipoViaje $tipoViaje = null)
    {
        $this->tipo_viaje = $tipoViaje;
    
        return $this;
    }

    /**
     * Get tipo_viaje
     *
     * @return \Backend\AdminBundle\Entity\TipoViaje 
     */
    public function getTipoViaje()
    {
        return $this->tipo_viaje;
    }

    /**
     * Set acompaniante
     *
     * @param \Backend\AdminBundle\Entity\Chofer $acompaniante
     * @return Viaje
     */
    public function setAcompaniante(\Backend\AdminBundle\Entity\Chofer $acompaniante = null)
    {
        $this->acompaniante = $acompaniante;
    
        return $this;
    }

    /**
     * Get acompaniante
     *
     * @return \Backend\AdminBundle\Entity\Chofer 
     */
    public function getAcompaniante()
    {
        return $this->acompaniante;
    }

    /**
     * Set acoplado
     *
     * @param \Backend\AdminBundle\Entity\Camion $acoplado
     * @return Viaje
     */
    public function setAcoplado(\Backend\AdminBundle\Entity\Camion $acoplado = null)
    {
        $this->acoplado = $acoplado;
    
        return $this;
    }

    /**
     * Get acoplado
     *
     * @return \Backend\AdminBundle\Entity\Camion 
     */
    public function getAcoplado()
    {
        return $this->acoplado;
    }

    /**
     * Set hasException
     *
     * @param boolean $hasException
     * @return Viaje
     */
    public function setHasException($hasException)
    {
        $this->hasException = $hasException;
    
        return $this;
    }

    /**
     * Get hasException
     *
     * @return boolean 
     */
    public function getHasException()
    {
        return $this->hasException;
    }


    /**
     * Add cajaempleado
     *
     * @param \Backend\AdminBundle\Entity\Caja $cajaempleado
     * @return Viaje
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

    /**
     * Set efectivo_caja
     *
     * @param float $efectivoCaja
     * @return Viaje
     */
    public function setEfectivoCaja($efectivoCaja)
    {
        $this->efectivo_caja = $efectivoCaja;
    
        return $this;
    }

    /**
     * Get efectivo_caja
     *
     * @return float 
     */
    public function getEfectivoCaja()
    {
        return $this->efectivo_caja;
    }
}