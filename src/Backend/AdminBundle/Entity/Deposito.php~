<?php 
namespace Backend\AdminBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @ORM\Table(name="deposito")
 * @ORM\Entity()
 */
class Deposito
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @ORM\Column(name="name", type="string", length=100)
     */
    public $name;

    /**
     * @ORM\Column(name="direccion", type="text")
     */
    private $direccion;
    /**
     * @ORM\Column(name="observacion", type="text", nullable=true)
     */
    private $observacion;
    /**
     * @ORM\Column(name="lat",type="string", length=100, nullable=true)
     */
     private $lat;
     /**
     * @ORM\Column(name="lng", type="string", length=100, nullable=true)
     */
     private $lng; 
    /**
     * @ORM\Column(name="is_delete", type="boolean" )
     */
    private $isDelete;
    /**
     * @ORM\Column(name="is_special", type="boolean" )
     */
    private $isSpecial;
    /**
     * @ORM\Column(name="saldo", type="decimal", scale=2, nullable=true  )
     */
    private $saldo;
   /**
     * @ORM\ManyToOne(targetEntity="Cliente", inversedBy="depositos")
     * @ORM\JoinColumn(name="cliente_id", referencedColumnName="id")
     */
    private $cliente;  


  /**
     * @ORM\OneToMany(targetEntity="\Backend\UserBundle\Entity\User", mappedBy="deposito")
     */
   private $operarios;
   
    /**
     * @ORM\OneToMany(targetEntity="Movimiento", mappedBy="clase")
     */
     
    private $movimientos; 
    
    /**
     * @ORM\OneToMany(targetEntity="Movimiento", mappedBy="deposito_destino")
     */
     
    private $mov_destinos; 
    
    /**
     * @ORM\OneToMany(targetEntity="Hoja", mappedBy="deposito")
     */
     
     private $hojas;
    
    /**
     * @ORM\OneToMany(targetEntity="Hoja", mappedBy="deposito_salida")
     */
     
     private $hojas_salida; 
     
   /**
     * @ORM\OneToMany(targetEntity="Viaje", mappedBy="deposito")
     */
     private $viajes;

  public function __construct()
    {
        
        $this->isDelete=false;
        $this->isSpecial=false;
        $this->saldo=0;
        $this->operarios = new ArrayCollection();
        $this->movimientos = new ArrayCollection();
        $this->mov_destinos = new ArrayCollection();
        $this->hojas = new ArrayCollection();
        $this->hojas_salida = new ArrayCollection();
        $this->viajes = new ArrayCollection();
    }

  public function __toString(){
   
         return $this->name;
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
     * Set name
     *
     * @param string $name
     * @return Deposito
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Deposito
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    
        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set observacion
     *
     * @param string $observacion
     * @return Deposito
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
     * Set isDelete
     *
     * @param boolean $isDelete
     * @return Deposito
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
     * Set cliente
     *
     * @param \Backend\AdminBundle\Entity\Cliente $cliente
     * @return Deposito
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
     * Add operarios
     *
     * @param \Backend\UserBundle\Entity\User $operarios
     * @return Deposito
     */
    public function addOperario(\Backend\UserBundle\Entity\User $operarios)
    {
        $this->operarios[] = $operarios;
    
        return $this;
    }

    /**
     * Remove operarios
     *
     * @param \Backend\UserBundle\Entity\User $operarios
     */
    public function removeOperario(\Backend\UserBundle\Entity\User $operarios)
    {
        $this->operarios->removeElement($operarios);
    }

    /**
     * Get operarios
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOperarios()
    {
        return $this->operarios;
    }

    /**
     * Set isSpecial
     *
     * @param boolean $isSpecial
     * @return Deposito
     */
    public function setIsSpecial($isSpecial)
    {
        $this->isSpecial = $isSpecial;
    
        return $this;
    }

    /**
     * Get isSpecial
     *
     * @return boolean 
     */
    public function getIsSpecial()
    {
        return $this->isSpecial;
    }

    /**
     * Set saldo
     *
     * @param float $saldo
     * @return Deposito
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
     * Add movimientos
     *
     * @param \Backend\AdminBundle\Entity\Movimiento $movimientos
     * @return Deposito
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
     * Add mov_destinos
     *
     * @param \Backend\AdminBundle\Entity\Movimiento $movDestinos
     * @return Deposito
     */
    public function addMovDestino(\Backend\AdminBundle\Entity\Movimiento $movDestinos)
    {
        $this->mov_destinos[] = $movDestinos;
    
        return $this;
    }

    /**
     * Remove mov_destinos
     *
     * @param \Backend\AdminBundle\Entity\Movimiento $movDestinos
     */
    public function removeMovDestino(\Backend\AdminBundle\Entity\Movimiento $movDestinos)
    {
        $this->mov_destinos->removeElement($movDestinos);
    }

    /**
     * Get mov_destinos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMovDestinos()
    {
        return $this->mov_destinos;
    }

    /**
     * Add hojas
     *
     * @param \Backend\AdminBundle\Entity\Hoja $hojas
     * @return Deposito
     */
    public function addHoja(\Backend\AdminBundle\Entity\Hoja $hojas)
    {
        $this->hojas[] = $hojas;
    
        return $this;
    }

    /**
     * Remove hojas
     *
     * @param \Backend\AdminBundle\Entity\Hoja $hojas
     */
    public function removeHoja(\Backend\AdminBundle\Entity\Hoja $hojas)
    {
        $this->hojas->removeElement($hojas);
    }

    /**
     * Get hojas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getHojas()
    {
        return $this->hojas;
    }

    /**
     * Add viajes
     *
     * @param \Backend\AdminBundle\Entity\Viaje $viajes
     * @return Deposito
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
     * Set lat
     *
     * @param string $lat
     * @return Deposito
     */
    public function setLat($lat)
    {
        $this->lat = $lat;
    
        return $this;
    }

    /**
     * Get lat
     *
     * @return string 
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Set lng
     *
     * @param string $lng
     * @return Deposito
     */
    public function setLng($lng)
    {
        $this->lng = $lng;
    
        return $this;
    }

    /**
     * Get lng
     *
     * @return string 
     */
    public function getLng()
    {
        return $this->lng;
    }

    /**
     * Add hojas_salida
     *
     * @param \Backend\AdminBundle\Entity\Hoja $hojasSalida
     * @return Deposito
     */
    public function addHojasSalida(\Backend\AdminBundle\Entity\Hoja $hojasSalida)
    {
        $this->hojas_salida[] = $hojasSalida;
    
        return $this;
    }

    /**
     * Remove hojas_salida
     *
     * @param \Backend\AdminBundle\Entity\Hoja $hojasSalida
     */
    public function removeHojasSalida(\Backend\AdminBundle\Entity\Hoja $hojasSalida)
    {
        $this->hojas_salida->removeElement($hojasSalida);
    }

    /**
     * Get hojas_salida
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getHojasSalida()
    {
        return $this->hojas_salida;
    }
}