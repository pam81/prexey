<?php 
namespace Backend\AdminBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Backend\UserBundle\Validator\Constraints\EmpleadoUnique;

/**
 * @ORM\Table(name="chofer")
 * @ORM\Entity()
 * @EmpleadoUnique()  
 */
class Chofer
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(name="lastname", type="string", length=100)
     */
    private $lastname;
    
    /**
     * @ORM\Column(name="nroEmpleado", type="integer")
     */
    private $nroEmpleado;
     /**
     * @ORM\Column(name="dni", type="string", length=100, nullable=true)
     */
    private $dni;
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
     * @ORM\Column(name="radio", type="string", length=100, nullable=true)
     */
    private $radio;
     /**
     * @ORM\Column(name="telefono", type="string", length=100, nullable=true)
     */
    private $telefono;
    /**
     * @ORM\Column(name="direccion", type="text", nullable=true)
     */
    private $direccion; 
    /**
     * @ORM\Column(name="is_delete", type="boolean" )
     */
    private $isDelete;
    
    /**
     * @ORM\Column(name="is_peon", type="boolean" )
     */
    private $isPeon;
    
/**
     * @ORM\OneToMany(targetEntity="Viaje", mappedBy="chofer")
     */
     private $viajes;
     
     /**
     * @ORM\OneToMany(targetEntity="Viaje", mappedBy="acompaniante")
     */
     private $acompania_viajes;

    /**
     * @ORM\Column(name="fecha_registro", type="date", nullable=true)
     */
     
     private $fecha_registro;
     /**
     * @ORM\Column(name="cnrt", type="string", length=100, nullable=true)
     */
     private $cnrt;
     /**
     * @ORM\Column(name="fecha_cnrt", type="date", nullable=true)
     */
     
     private $fecha_cnrt;
     
     
     /**
     * @ORM\Column(name="cnrt_curso", type="string", length=100, nullable=true)
     */
     private $cnrt_curso;
     /**
     * @ORM\Column(name="fecha_cnrt_curso", type="date", nullable=true)
     */
     
     private $fecha_cnrt_curso;
     
     /**
     * @ORM\Column(name="cnrt_peligrosa", type="string", length=100, nullable=true)
     */
     private $cnrt_peligrosa;
     /**
     * @ORM\Column(name="fecha_cnrt_peligrosa", type="date", nullable=true)
     */
     
     private $fecha_cnrt_peligrosa;
      /**
     * @ORM\Column(name="libreta_sanitaria", type="string", length=100, nullable=true)
     */
     private $libreta_sanitaria;
     /**
     * @ORM\Column(name="fecha_sanitaria", type="date", nullable=true)
     */
     
     private $fecha_sanitaria;
     
     
      /**
     * @ORM\ManyToOne(targetEntity="Empresa", inversedBy="choferes")
     * @ORM\JoinColumn(name="empresa_id", referencedColumnName="id")
     */
    private $empresa;
    /**
     * @ORM\OneToMany(targetEntity="Caja", mappedBy="chofer")
     */
    private $cajaempleado; 

    public function __construct()
    {
        
        $this->isDelete=false;
         $this->isPeon=false;
        $this->viajes = new ArrayCollection();
        $this->cajaempleado = new ArrayCollection();
        $this->acompania_viajes = new ArrayCollection();
    }
    
    public function __toString()
    {
       return mb_convert_case($this->lastname.", ".$this->name,MB_CASE_TITLE,"UTF-8");
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
     * @return Chofer
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
        return mb_convert_case($this->name,MB_CASE_TITLE,"UTF-8");
    }

   

    

    /**
     * Set nroEmpleado
     *
     * @param string $nroEmpleado
     * @return Chofer
     */
    public function setNroEmpleado($nroEmpleado)
    {
        $this->nroEmpleado = $nroEmpleado;
    
        return $this;
    }

    /**
     * Get nroEmpleado
     *
     * @return string 
     */
    public function getNroEmpleado()
    {
        return $this->nroEmpleado;
    }

    /**
     * Set dni
     *
     * @param string $dni
     * @return Chofer
     */
    public function setDni($dni)
    {
        $this->dni = $dni;
    
        return $this;
    }

    /**
     * Get dni
     *
     * @return string 
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set observacion
     *
     * @param string $observacion
     * @return Chofer
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
     * @return Chofer
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
     * @return Chofer
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
     * Set radio
     *
     * @param string $radio
     * @return Chofer
     */
    public function setRadio($radio)
    {
        $this->radio = $radio;
    
        return $this;
    }

    /**
     * Get radio
     *
     * @return string 
     */
    public function getRadio()
    {
        return $this->radio;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return Chofer
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    
        return $this;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set dirección
     *
     * @param string $dirección
     * @return Chofer
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    
        return $this;
    }

    /**
     * Get dirección
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set isDelete
     *
     * @param boolean $isDelete
     * @return Chofer
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
     * Set lastname
     *
     * @param string $lastname
     * @return Chofer
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    
        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return mb_convert_case($this->lastname,MB_CASE_TITLE,"UTF-8");
    }

    /**
     * Add viajes
     *
     * @param \Backend\AdminBundle\Entity\Viaje $viajes
     * @return Chofer
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
     * Set fecha_registro
     *
     * @param \DateTime $fechaRegistro
     * @return Chofer
     */
    public function setFechaRegistro($fechaRegistro)
    {
        $this->fecha_registro = $fechaRegistro;
    
        return $this;
    }

    /**
     * Get fecha_registro
     *
     * @return \DateTime 
     */
    public function getFechaRegistro()
    {
        return $this->fecha_registro;
    }

    /**
     * Set cnrt
     *
     * @param string $cnrt
     * @return Chofer
     */
    public function setCnrt($cnrt)
    {
        $this->cnrt = $cnrt;
    
        return $this;
    }

    /**
     * Get cnrt
     *
     * @return string 
     */
    public function getCnrt()
    {
        return $this->cnrt;
    }

    /**
     * Set cnrt_peligrosa
     *
     * @param string $cnrtPeligrosa
     * @return Chofer
     */
    public function setCnrtPeligrosa($cnrtPeligrosa)
    {
        $this->cnrt_peligrosa = $cnrtPeligrosa;
    
        return $this;
    }

    /**
     * Get cnrt_peligrosa
     *
     * @return string 
     */
    public function getCnrtPeligrosa()
    {
        return $this->cnrt_peligrosa;
    }

    /**
     * Set libreta_sanitaria
     *
     * @param string $libretaSanitaria
     * @return Chofer
     */
    public function setLibretaSanitaria($libretaSanitaria)
    {
        $this->libreta_sanitaria = $libretaSanitaria;
    
        return $this;
    }

    /**
     * Get libreta_sanitaria
     *
     * @return string 
     */
    public function getLibretaSanitaria()
    {
        return $this->libreta_sanitaria;
    }

    /**
     * Set fecha_cnrt
     *
     * @param \DateTime $fechaCnrt
     * @return Chofer
     */
    public function setFechaCnrt($fechaCnrt)
    {
        $this->fecha_cnrt = $fechaCnrt;
    
        return $this;
    }

    /**
     * Get fecha_cnrt
     *
     * @return \DateTime 
     */
    public function getFechaCnrt()
    {
        return $this->fecha_cnrt;
    }

    /**
     * Set fecha_cnrt_peligrosa
     *
     * @param \DateTime $fechaCnrtPeligrosa
     * @return Chofer
     */
    public function setFechaCnrtPeligrosa($fechaCnrtPeligrosa)
    {
        $this->fecha_cnrt_peligrosa = $fechaCnrtPeligrosa;
    
        return $this;
    }

    /**
     * Get fecha_cnrt_peligrosa
     *
     * @return \DateTime 
     */
    public function getFechaCnrtPeligrosa()
    {
        return $this->fecha_cnrt_peligrosa;
    }

    /**
     * Set fecha_sanitaria
     *
     * @param \DateTime $fechaSanitaria
     * @return Chofer
     */
    public function setFechaSanitaria($fechaSanitaria)
    {
        $this->fecha_sanitaria = $fechaSanitaria;
    
        return $this;
    }

    /**
     * Get fecha_sanitaria
     *
     * @return \DateTime 
     */
    public function getFechaSanitaria()
    {
        return $this->fecha_sanitaria;
    }

    

    /**
     * Set cnrt_curso
     *
     * @param string $cnrtCurso
     * @return Chofer
     */
    public function setCnrtCurso($cnrtCurso)
    {
        $this->cnrt_curso = $cnrtCurso;
    
        return $this;
    }

    /**
     * Get cnrt_curso
     *
     * @return string 
     */
    public function getCnrtCurso()
    {
        return $this->cnrt_curso;
    }

    /**
     * Set fecha_cnrt_curso
     *
     * @param \DateTime $fechaCnrtCurso
     * @return Chofer
     */
    public function setFechaCnrtCurso($fechaCnrtCurso)
    {
        $this->fecha_cnrt_curso = $fechaCnrtCurso;
    
        return $this;
    }

    /**
     * Get fecha_cnrt_curso
     *
     * @return \DateTime 
     */
    public function getFechaCnrtCurso()
    {
        return $this->fecha_cnrt_curso;
    }

    

    /**
     * Set isPeon
     *
     * @param boolean $isPeon
     * @return Chofer
     */
    public function setIsPeon($isPeon)
    {
        $this->isPeon = $isPeon;
    
        return $this;
    }

    /**
     * Get isPeon
     *
     * @return boolean 
     */
    public function getIsPeon()
    {
        return $this->isPeon;
    }

    /**
     * Set empresa
     *
     * @param \Backend\AdminBundle\Entity\Empresa $empresa
     * @return Chofer
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
     * Add acompania_viajes
     *
     * @param \Backend\AdminBundle\Entity\Viaje $acompaniaViajes
     * @return Chofer
     */
    public function addAcompaniaViaje(\Backend\AdminBundle\Entity\Viaje $acompaniaViajes)
    {
        $this->acompania_viajes[] = $acompaniaViajes;
    
        return $this;
    }

    /**
     * Remove acompania_viajes
     *
     * @param \Backend\AdminBundle\Entity\Viaje $acompaniaViajes
     */
    public function removeAcompaniaViaje(\Backend\AdminBundle\Entity\Viaje $acompaniaViajes)
    {
        $this->acompania_viajes->removeElement($acompaniaViajes);
    }

    /**
     * Get acompania_viajes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAcompaniaViajes()
    {
        return $this->acompania_viajes;
    }

  

    /**
     * Add cajaempleado
     *
     * @param \Backend\AdminBundle\Entity\Caja $cajaempleado
     * @return Chofer
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