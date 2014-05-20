<?php 
namespace Backend\AdminBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Backend\AdminBundle\Validator\Constraints\PatenteUnique;

/**
 * @ORM\Table(name="camion")
 * @ORM\Entity()
 * @PatenteUnique() 
 */
class Camion
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="patente", type="string", length=100)
     */
    private $patente;

    /**
     * @ORM\Column(name="kmxlitro", type="string", length=100, nullable=true)
     */
    private $kmxlitro;
    
    /**
     * @ORM\Column(name="maxTanque", type="string", length=100)
     */
    private $maxTanque;
    
    /**
     * @ORM\Column(name="observacion", type="text", nullable=true)
     */
    private $observacion;
     /**
     * @ORM\Column(name="marca", type="string", length=100, nullable=true)
     */
    private $marca;
     /**
     * @ORM\Column(name="modelo", type="string", length=100, nullable=true)
     */
    private $modelo;
     /**
     * @ORM\Column(name="color", type="string", length=100, nullable=true)
     */
    private $color;
    /**
     * @ORM\Column(name="is_delete", type="boolean" )
     */
    private $isDelete;

   /**
     * @ORM\OneToMany(targetEntity="Viaje", mappedBy="camion")
     */
     private $viajes;
     
      /**
     * @ORM\OneToMany(targetEntity="Viaje", mappedBy="acoplado")
     */
     private $acoplado_viajes;
     /**
     * @ORM\Column(name="interno", type="string", length=100, nullable=true)
     */
     private $interno;
    /**
     * @ORM\Column(name="senasa", type="string", length=100, nullable=true)
     */ 
     private $senasa;
     /**
     * @ORM\Column(name="fecha_senasa", type="date", nullable=true)
     */
     private $fecha_senasa;
     /**
     * @ORM\Column(name="ruta", type="string", length=100, nullable=true)
     */
     private $ruta;
     /**
     * @ORM\Column(name="fecha_ruta", type="date", nullable=true)
     */
     private $fecha_ruta;
     
     /**
     * @ORM\Column(name="fecha_vtv", type="date", nullable=true)
     */
     private $fecha_vtv;
    /**
     * @ORM\Column(name="seguro", type="string", length=100, nullable=true)
     */ 
     private $seguro;
     /**
     * @ORM\Column(name="fecha_seguro", type="date", nullable=true)
     */
     private $fecha_seguro;
     /**
     * @ORM\Column(name="eficiencia_ideal", type="decimal", scale=2 )
     */
     private $eficiencia_ideal;
     
     /**
     * @ORM\ManyToOne(targetEntity="Empresa", inversedBy="camiones")
     * @ORM\JoinColumn(name="empresa_id", referencedColumnName="id")
     */
    private $empresa;
     
     
    public function __construct()
    {
        $this->viajes = new ArrayCollection();
        $this->isDelete=false;
    }
    
    public function __toString()
    {
       return $this->patente;
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
     * Set patente
     *
     * @param string $patente
     * @return Camion
     */
    public function setPatente($patente)
    {
        $this->patente = $patente;
    
        return $this;
    }

    /**
     * Get patente
     *
     * @return string 
     */
    public function getPatente()
    {
        return $this->patente;
    }

    /**
     * Set kmxlitro
     *
     * @param string $kmxlitro
     * @return Camion
     */
    public function setKmxlitro($kmxlitro)
    {
        $this->kmxlitro = $kmxlitro;
    
        return $this;
    }

    /**
     * Get kmxlitro
     *
     * @return string 
     */
    public function getKmxlitro()
    {
        return $this->kmxlitro;
    }

    /**
     * Set maxTanque
     *
     * @param string $maxTanque
     * @return Camion
     */
    public function setMaxTanque($maxTanque)
    {
        $this->maxTanque = $maxTanque;
    
        return $this;
    }

    /**
     * Get maxTanque
     *
     * @return string 
     */
    public function getMaxTanque()
    {
        return $this->maxTanque;
    }

    /**
     * Set observacion
     *
     * @param string $observacion
     * @return Camion
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
     * Set marca
     *
     * @param string $marca
     * @return Camion
     */
    public function setMarca($marca)
    {
        $this->marca = $marca;
    
        return $this;
    }

    /**
     * Get marca
     *
     * @return string 
     */
    public function getMarca()
    {
        return $this->marca;
    }

    /**
     * Set modelo
     *
     * @param string $modelo
     * @return Camion
     */
    public function setModelo($modelo)
    {
        $this->modelo = $modelo;
    
        return $this;
    }

    /**
     * Get modelo
     *
     * @return string 
     */
    public function getModelo()
    {
        return $this->modelo;
    }

    /**
     * Set color
     *
     * @param string $color
     * @return Camion
     */
    public function setColor($color)
    {
        $this->color = $color;
    
        return $this;
    }

    /**
     * Get color
     *
     * @return string 
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set isDelete
     *
     * @param boolean $isDelete
     * @return Camion
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
     * Add viajes
     *
     * @param \Backend\AdminBundle\Entity\Viaje $viajes
     * @return Camion
     */
    public function addViaje(\Backend\AdminBundle\Entity\Viaje $viajes)
    {
        $this->viajes[] = $viajes;
    
        return $this;
    }

    /**
     * Remove viajes
     *
     * @param \Backend\AdminBundle\Entity\Viaje $viajes
     */
    public function removeViaje(\Backend\AdminBundle\Entity\Viaje $viajes)
    {
        $this->viajes->removeElement($viajes);
    }

    /**
     * Get viajes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getViajes()
    {
        return $this->viajes;
    }

    /**
     * Set interno
     *
     * @param string $interno
     * @return Camion
     */
    public function setInterno($interno)
    {
        $this->interno = $interno;
    
        return $this;
    }

    /**
     * Get interno
     *
     * @return string 
     */
    public function getInterno()
    {
        return $this->interno;
    }

    /**
     * Set senasa
     *
     * @param string $senasa
     * @return Camion
     */
    public function setSenasa($senasa)
    {
        $this->senasa = $senasa;
    
        return $this;
    }

    /**
     * Get senasa
     *
     * @return string 
     */
    public function getSenasa()
    {
        return $this->senasa;
    }

    /**
     * Set fecha_senasa
     *
     * @param \DateTime $fechaSenasa
     * @return Camion
     */
    public function setFechaSenasa($fechaSenasa)
    {
        $this->fecha_senasa = $fechaSenasa;
    
        return $this;
    }

    /**
     * Get fecha_senasa
     *
     * @return \DateTime 
     */
    public function getFechaSenasa()
    {
        return $this->fecha_senasa;
    }

    /**
     * Set ruta
     *
     * @param string $ruta
     * @return Camion
     */
    public function setRuta($ruta)
    {
        $this->ruta = $ruta;
    
        return $this;
    }

    /**
     * Get ruta
     *
     * @return string 
     */
    public function getRuta()
    {
        return $this->ruta;
    }

    /**
     * Set fecha_ruta
     *
     * @param \DateTime $fechaRuta
     * @return Camion
     */
    public function setFechaRuta($fechaRuta)
    {
        $this->fecha_ruta = $fechaRuta;
    
        return $this;
    }

    /**
     * Get fecha_ruta
     *
     * @return \DateTime 
     */
    public function getFechaRuta()
    {
        return $this->fecha_ruta;
    }

   

    /**
     * Set fecha_vtv
     *
     * @param \DateTime $fechaVtv
     * @return Camion
     */
    public function setFechaVtv($fechaVtv)
    {
        $this->fecha_vtv = $fechaVtv;
    
        return $this;
    }

    /**
     * Get fecha_vtv
     *
     * @return \DateTime 
     */
    public function getFechaVtv()
    {
        return $this->fecha_vtv;
    }

    /**
     * Set seguro
     *
     * @param string $seguro
     * @return Camion
     */
    public function setSeguro($seguro)
    {
        $this->seguro = $seguro;
    
        return $this;
    }

    /**
     * Get seguro
     *
     * @return string 
     */
    public function getSeguro()
    {
        return $this->seguro;
    }

    /**
     * Set fecha_seguro
     *
     * @param \DateTime $fechaSeguro
     * @return Camion
     */
    public function setFechaSeguro($fechaSeguro)
    {
        $this->fecha_seguro = $fechaSeguro;
    
        return $this;
    }

    /**
     * Get fecha_seguro
     *
     * @return \DateTime 
     */
    public function getFechaSeguro()
    {
        return $this->fecha_seguro;
    }

    /**
     * Set eficiencia_ideal
     *
     * @param float $eficienciaIdeal
     * @return Camion
     */
    public function setEficienciaIdeal($eficienciaIdeal)
    {
        $this->eficiencia_ideal = $eficienciaIdeal;
    
        return $this;
    }

    /**
     * Get eficiencia_ideal
     *
     * @return float 
     */
    public function getEficienciaIdeal()
    {
        return $this->eficiencia_ideal;
    }

    

    /**
     * Set empresa
     *
     * @param \Backend\AdminBundle\Entity\Empresa $empresa
     * @return Camion
     */
    public function setEmpresa(\Backend\AdminBundle\Entity\Empresa $empresa = null)
    {
        $this->empresa = $empresa;
    
        return $this;
    }

    /**
     * Get empresa
     *
     * @return \Backend\AdminBundle\Entity\Empresa 
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * Add acoplado_viajes
     *
     * @param \Backend\AdminBundle\Entity\Viaje $acopladoViajes
     * @return Camion
     */
    public function addAcopladoViaje(\Backend\AdminBundle\Entity\Viaje $acopladoViajes)
    {
        $this->acoplado_viajes[] = $acopladoViajes;
    
        return $this;
    }

    /**
     * Remove acoplado_viajes
     *
     * @param \Backend\AdminBundle\Entity\Viaje $acopladoViajes
     */
    public function removeAcopladoViaje(\Backend\AdminBundle\Entity\Viaje $acopladoViajes)
    {
        $this->acoplado_viajes->removeElement($acopladoViajes);
    }

    /**
     * Get acoplado_viajes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAcopladoViajes()
    {
        return $this->acoplado_viajes;
    }
}