<?php 
namespace Backend\AdminBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="producto")
 * @ORM\Entity()
 */
class Producto
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @ORM\Column(name="imei", type="string", length=15)
     */
    public $imei;

    /**
     * @ORM\Column(name="serial", type="string", length=100, nullable=true)
     */
    public $serialNumber;
    
    /**
     * @ORM\ManyToOne(targetEntity="Articulo", inversedBy="producto")
     * @ORM\JoinColumn(name="articulo_id", referencedColumnName="id")
    */

    protected $articulo;    
       
    /**
     * @ORM\Column(name="trackId", type="string", length=100)
     */
     
    private $trackId;
    
     /**
     * @ORM\ManyToOne(targetEntity="OrdenIngreso", inversedBy="producto")
     * @ORM\JoinColumn(name="orden_id", referencedColumnName="id")
	 */
    
    private $ordenIngreso;
    
    /**
     * @ORM\ManyToOne(targetEntity="Movimiento", inversedBy="producto")
     * @ORM\JoinColumn(name="movimiento_id", referencedColumnName="id")
	 */
    
    private $movimiento;    
    
            
    /**
     * @ORM\Column(name="is_delete", type="boolean" )
     */
     
    private $isDelete;      
     
    /**
     * @ORM\Column(name="is_available", type="boolean" )
     */   
      
    private $isAvailable;
    
    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
        
    private $createdAt;
    
    /**
     * @ORM\Column(name="modified_at", type="datetime", nullable=true)
     */
     
    private $modifiedAt; 

    /**
     * Constructor
     */
    public function __construct()
    {
        
        $this->isDelete=false;
        $this->createdAt = new \DateTime('now');
       
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
     * @return OperadorLogistico
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
     * @return OperadorLogistico
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
     * @return OperadorLogistico
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
     * @return OperadorLogistico
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
     * @return OperadorLogistico
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
     * Set isDelete
     *
     * @param boolean $isDelete
     * @return OperadorLogistico
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
     * Set cuit
     *
     * @param string $cuit
     * @return OperadorLogistico
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

    /**
     * @ORM\PreUpdate()
     * 
     */
     
    public function modifiedUpdate(){
    
      $this->setModifiedAt(new \DateTime('now'));
    }  
    

    /**
     * Set dni
     *
     * @param string $dni
     * @return OperadorLogistico
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
     * Set codigo
     *
     * @param string $codigo
     * @return OperadorLogistico
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    
        return $this;
    }

    /**
     * Get codigo
     *
     * @return string 
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return OperadorLogistico
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
     * Set modifiedAt
     *
     * @param \DateTime $modifiedAt
     * @return OperadorLogistico
     */
    public function setModifiedAt($modifiedAt)
    {
        $this->modifiedAt = $modifiedAt;
    
        return $this;
    }

    /**
     * Get modifiedAt
     *
     * @return \DateTime 
     */
    public function getModifiedAt()
    {
        return $this->modifiedAt;
    }

    /**
     * Set imei
     *
     * @param string $imei
     * @return Producto
     */
    public function setImei($imei)
    {
        $this->imei = $imei;
    
        return $this;
    }

    /**
     * Get imei
     *
     * @return string 
     */
    public function getImei()
    {
        return $this->imei;
    }

    /**
     * Set serialNumber
     *
     * @param string $serialNumber
     * @return Producto
     */
    public function setSerialNumber($serialNumber)
    {
        $this->serialNumber = $serialNumber;
    
        return $this;
    }

    /**
     * Get serialNumber
     *
     * @return string 
     */
    public function getSerialNumber()
    {
        return $this->serialNumber;
    }

    /**
     * Set trackId
     *
     * @param string $trackId
     * @return Producto
     */
    public function setTrackId($trackId)
    {
        $this->trackId = $trackId;
    
        return $this;
    }

    /**
     * Get trackId
     *
     * @return string 
     */
    public function getTrackId()
    {
        return $this->trackId;
    }

    /**
     * Set articulo
     *
     * @param \Backend\AdminBundle\Entity\Articulo $articulo
     * @return Producto
     */
    public function setArticulo(\Backend\AdminBundle\Entity\Articulo $articulo = null)
    {
        $this->articulo = $articulo;
    
        return $this;
    }

    /**
     * Get articulo
     *
     * @return \Backend\AdminBundle\Entity\Articulo 
     */
    public function getArticulo()
    {
        return $this->articulo;
    }

    /**
     * Set ordenIngreso
     *
     * @param \Backend\AdminBundle\Entity\OrdenIngreso $ordenIngreso
     * @return Producto
     */
    public function setOrdenIngreso(\Backend\AdminBundle\Entity\OrdenIngreso $ordenIngreso = null)
    {
        $this->ordenIngreso = $ordenIngreso;
    
        return $this;
    }

    /**
     * Get ordenIngreso
     *
     * @return \Backend\AdminBundle\Entity\OrdenIngreso 
     */
    public function getOrdenIngreso()
    {
        return $this->ordenIngreso;
    }

    /**
     * Set isAvailable
     *
     * @param boolean $isAvailable
     * @return Producto
     */
    public function setIsAvailable($isAvailable)
    {
        $this->isAvailable = $isAvailable;
    
        return $this;
    }

    /**
     * Get isAvailable
     *
     * @return boolean 
     */
    public function getIsAvailable()
    {
        return $this->isAvailable;
    }

    /**
     * Set movimiento
     *
     * @param \Backend\AdminBundle\Entity\Movimiento $movimiento
     * @return Producto
     */
    public function setMovimiento(\Backend\AdminBundle\Entity\Movimiento $movimiento = null)
    {
        $this->movimiento = $movimiento;
    
        return $this;
    }

    /**
     * Get movimiento
     *
     * @return \Backend\AdminBundle\Entity\Movimiento 
     */
    public function getMovimiento()
    {
        return $this->movimiento;
    }
}