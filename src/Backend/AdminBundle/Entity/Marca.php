<?php 
namespace Backend\AdminBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="marca")
 * @ORM\Entity()
 */
class Marca
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
     * @ORM\Column(name="is_delete", type="boolean" )
     */
    private $isDelete;
    /**
     * @ORM\OneToMany(targetEntity="Modelo", mappedBy="marca")
     */
    public $modelos;
    
    public function __construct()
    {
        $this->isDelete=false;
        $this->modelos =  new ArrayCollection();
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
     * @return Marca
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
     * Set isDelete
     *
     * @param boolean $isDelete
     * @return Marca
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
     * Add modelos
     *
     * @param \Backend\AdminBundle\Entity\Modelo $modelos
     * @return Marca
     */
    public function addModelo(\Backend\AdminBundle\Entity\Modelo $modelos)
    {
        $this->modelos[] = $modelos;
    
        return $this;
    }

    /**
     * Remove modelos
     *
     * @param \Backend\AdminBundle\Entity\Modelo $modelos
     */
    public function removeModelo(\Backend\AdminBundle\Entity\Modelo $modelos)
    {
        $this->modelos->removeElement($modelos);
    }

    /**
     * Get modelos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getModelos()
    {
        return $this->modelos;
    }
}