<?php 
namespace Backend\AdminBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Backend\AdminBundle\Validator\Constraints\CuitEmpresaUnique;
/**
 * @ORM\Table(name="empresa")
 * @ORM\Entity()
 * @CuitEmpresaUnique()   
 */
class Empresa
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
     * @ORM\OneToMany(targetEntity="Chofer", mappedBy="empresa")
     */
     private $choferes;
    /**
     * @ORM\OneToMany(targetEntity="Camion", mappedBy="empresa")
     */ 
     private $camiones;
     
     /**
     * @ORM\Column(name="is_delete", type="boolean" )
     */
    private $isDelete;
     
     /**
     * Constructor
     */
    public function __construct()
    {
        
        $this->isDelete=false;
        $this->choferes = new ArrayCollection();
        $this->camiones = new ArrayCollection();
    }
    
     public function __toString()
    {
      return mb_convert_case($this->name." ".$this->cuit, MB_CASE_TITLE,"UTF-8");
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
     * @return Empresa
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
     * Set cuit
     *
     * @param string $cuit
     * @return Empresa
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
     * Set isDelete
     *
     * @param boolean $isDelete
     * @return Empresa
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
     * Add choferes
     *
     * @param \Backend\AdminBundle\Entity\Chofer $choferes
     * @return Empresa
     */
    public function addChofere(\Backend\AdminBundle\Entity\Chofer $choferes)
    {
        $this->choferes[] = $choferes;
    
        return $this;
    }

    /**
     * Remove choferes
     *
     * @param \Backend\AdminBundle\Entity\Chofer $choferes
     */
    public function removeChofere(\Backend\AdminBundle\Entity\Chofer $choferes)
    {
        $this->choferes->removeElement($choferes);
    }

    /**
     * Get choferes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChoferes()
    {
        return $this->choferes;
    }

    /**
     * Add camiones
     *
     * @param \Backend\AdminBundle\Entity\Camion $camiones
     * @return Empresa
     */
    public function addCamione(\Backend\AdminBundle\Entity\Camion $camiones)
    {
        $this->camiones[] = $camiones;
    
        return $this;
    }

    /**
     * Remove camiones
     *
     * @param \Backend\AdminBundle\Entity\Camion $camiones
     */
    public function removeCamione(\Backend\AdminBundle\Entity\Camion $camiones)
    {
        $this->camiones->removeElement($camiones);
    }

    /**
     * Get camiones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCamiones()
    {
        return $this->camiones;
    }
}