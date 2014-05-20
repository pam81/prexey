<?php 
namespace Backend\AdminBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Backend\AdminBundle\Validator\Constraints\CuitUnique;
/**
 * @ORM\Table(name="cliente")
 * @ORM\Entity()
 * @CuitUnique()   
 */
class Cliente
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
     * @ORM\Column(name="cuit", type="string", length=100)
     */
    public $cuit;

    /**
     * @ORM\Column(name="direccion", type="text")
     */
    private $direccion;
    /**
     * @ORM\Column(name="observacion", type="text", nullable=true)
     */
    private $observacion;
    
     /**
     * @ORM\Column(name="email", type="string", length=100, nullable=true)
     */
    private $email;
     /**
     * @ORM\Column(name="celular", type="string", length=100, nullable=true)
     */
    private $celular;
    /**
     * @ORM\Column(name="is_directo", type="boolean" )
     */
    private $isDirecto; //indico si es directo o indirecto solo dos posibilidades
    /**
     * @ORM\Column(name="is_delete", type="boolean" )
     */
    private $isDelete;
    
    /**
     * @ORM\Column(name="is_special", type="boolean" )
     */
    private $isSpecial;
    
     /**
     * @ORM\OneToMany(targetEntity="Deposito", mappedBy="cliente")
     */
    private $depositos;

  /**
     * @ORM\OneToMany(targetEntity="Hoja", mappedBy="cliente")
     */
     
     private $hojas;


/**
     * @ORM\OneToMany(targetEntity="Viaje", mappedBy="cliente")
     */
     private $viajes;
    
     

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->depositos = new ArrayCollection();
        $this->isDelete=false;
        $this->isDirecto=true;
        $this->isSpecial=false;
        $this->hojas = new ArrayCollection();
        $this->viajes = new ArrayCollection();
       
    }
    
    public function __toString()
    {
      return mb_convert_case($this->name, MB_CASE_TITLE,"UTF-8");
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
     * @return Cliente
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
        return mb_convert_case($this->name, MB_CASE_TITLE,"UTF-8");
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Cliente
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
     * @return Cliente
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
     * Set email
     *
     * @param string $email
     * @return Cliente
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set celular
     *
     * @param string $celular
     * @return Cliente
     */
    public function setCelular($celular)
    {
        $this->celular = $celular;
    
        return $this;
    }

    /**
     * Get celular
     *
     * @return string 
     */
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * Set isDirecto
     *
     * @param boolean $isDirecto
     * @return Cliente
     */
    public function setIsDirecto($isDirecto)
    {
        $this->isDirecto = $isDirecto;
    
        return $this;
    }

    /**
     * Get isDirecto
     *
     * @return boolean 
     */
    public function getIsDirecto()
    {
        return $this->isDirecto;
    }

    /**
     * Set isDelete
     *
     * @param boolean $isDelete
     * @return Cliente
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
     * Add depositos
     *
     * @param \Backend\AdminBundle\Entity\Deposito $depositos
     * @return Cliente
     */
    public function addDeposito(\Backend\AdminBundle\Entity\Deposito $depositos)
    {
        $this->depositos[] = $depositos;
    
        return $this;
    }

    /**
     * Remove depositos
     *
     * @param \Backend\AdminBundle\Entity\Deposito $depositos
     */
    public function removeDeposito(\Backend\AdminBundle\Entity\Deposito $depositos)
    {
        $this->depositos->removeElement($depositos);
    }

    /**
     * Get depositos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDepositos()
    {
        return $this->depositos;
    }

    /**
     * Add hojas
     *
     * @param \Backend\AdminBundle\Entity\Hoja $hojas
     * @return Cliente
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
     * @return Cliente
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
     * Set isSpecial
     *
     * @param boolean $isSpecial
     * @return Cliente
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
     * Set cuit
     *
     * @param string $cuit
     * @return Cliente
     */
    public function setCuit($cuit)
    {
        $this->cuit = $cuit;
    
        return $this;
    }

    /**
     * Get cuit
     *
     * @return string 
     */
    public function getCuit()
    {
        return $this->cuit;
    }

    
    
}