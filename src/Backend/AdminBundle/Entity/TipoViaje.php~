<?php 
namespace Backend\AdminBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Backend\AdminBundle\Validator\Constraints\ViajeCodeUnique;
/**
 * @ORM\Table(name="tipoviaje")
 * @ORM\Entity()
 * @ViajeCodeUnique() 
 */
class TipoViaje          
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;
    /**
     * @ORM\Column(name="code", type="string", length=100)
     */
    private $code;
    
    /**
     * @ORM\Column(name="texto", type="string", length=100)
     */
    public $texto;
   
       /**
     * @ORM\OneToMany(targetEntity="Viaje", mappedBy="tipo_viaje")
     */
     private $viajes;
     
      /**
     * @ORM\Column(name="is_delete", type="boolean" )
     */
    private $isDelete;
    
     public function __construct()
    {
        $this->viajes = new ArrayCollection();
        $this->isDelete=false;
    }

    public function __toString()
    {
       return $this->texto;
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
     * Set code
     *
     * @param string $code
     * @return TipoViaje
     */
    public function setCode($code)
    {
        $this->code = $code;
    
        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set texto
     *
     * @param string $texto
     * @return TipoViaje
     */
    public function setTexto($texto)
    {
        $this->texto = $texto;
    
        return $this;
    }

    /**
     * Get texto
     *
     * @return string 
     */
    public function getTexto()
    {
        return $this->texto;
    }

    /**
     * Add viajes
     *
     * @param \Backend\AdminBundle\Entity\Viaje $viajes
     * @return TipoViaje
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
     * Set isDelete
     *
     * @param boolean $isDelete
     * @return TipoViaje
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
}