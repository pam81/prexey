<?php 
namespace Backend\AdminBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @ORM\Table(name="hoja")
 * @ORM\Entity()
 */
class Hoja
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
  /**
     * @ORM\Column(name="orden", type="integer")
     */
   private $orden;
      /**
     * @ORM\ManyToOne(targetEntity="Cliente", inversedBy="hojas")
     * @ORM\JoinColumn(name="cliente_id", referencedColumnName="id")
     */
   private $cliente;
    /**
     * @ORM\ManyToOne(targetEntity="Deposito", inversedBy="hojas")
     * @ORM\JoinColumn(name="deposito_id", referencedColumnName="id")
     */
   private $deposito;
   /**
     * @ORM\ManyToOne(targetEntity="Deposito", inversedBy="hojas_salida")
     * @ORM\JoinColumn(name="depositosalida_id", referencedColumnName="id")
     */
   private $deposito_salida;
    /**
     * @ORM\Column(name="numero", type="integer", nullable=true)
     */
    private $numero; 
    /**
     * @ORM\ManyToOne(targetEntity="Viaje", inversedBy="destinos")
     * @ORM\JoinColumn(name="viaje_id", referencedColumnName="id")
     */
   private $viaje;
    
    
    public function __construct()
    {
       
    }

   public function __toString()
   {
     return $this->orden;
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
     * Set orden
     *
     * @param integer $orden
     * @return Hoja
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;
    
        return $this;
    }

    /**
     * Get orden
     *
     * @return integer 
     */
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * Set cliente
     *
     * @param \Backend\AdminBundle\Entity\Cliente $cliente
     * @return Hoja
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
     * Set deposito
     *
     * @param \Backend\AdminBundle\Entity\Deposito $deposito
     * @return Hoja
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
     * Set viaje
     *
     * @param \Backend\AdminBundle\Entity\Viaje $viaje
     * @return Hoja
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
     * Set numero
     *
     * @param integer $numero
     * @return Hoja
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    
        return $this;
    }

    /**
     * Get numero
     *
     * @return integer 
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set deposito_salida
     *
     * @param \Backend\AdminBundle\Entity\Deposito $depositoSalida
     * @return Hoja
     */
    public function setDepositoSalida(\Backend\AdminBundle\Entity\Deposito $depositoSalida = null)
    {
        $this->deposito_salida = $depositoSalida;
    
        return $this;
    }

    /**
     * Get deposito_salida
     *
     * @return \Backend\AdminBundle\Entity\Deposito 
     */
    public function getDepositoSalida()
    {
        return $this->deposito_salida;
    }
}