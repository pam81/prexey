<?php 
namespace Backend\AdminBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Backend\AdminBundle\Validator\Constraints\CodeUnique;
/**
 * @ORM\Table(name="tipomovimiento")
 * @ORM\Entity()
 * @CodeUnique()  
 */
class TipoMovimiento
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\Column(name="code", type="string", length=100)
     */
    private $code;
    
    /**
     * @ORM\Column(name="texto", type="string", length=100)
     */
    private $texto;
   
    /**
     * @ORM\Column(name="is_accesible", type="boolean" )
     */
    private $isAccesible;
   /**
     * @ORM\Column(name="is_delete", type="boolean" )
     */
    private $isDelete;      
      /**
     * @ORM\OneToMany(targetEntity="Movimiento", mappedBy="clase")
     */
     
    private $movimientos; 
    
    public function __construct()
    {
        $this->movimientos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->isAccesible = true;
        $this->isDelete=false;
    }

    public function __toString()
    {
       return $this->code."- ".$this->texto;
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
     * @return TipoMovimiento
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
     * @return TipoMovimiento
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
     * Add movimientos
     *
     * @param \Backend\AdminBundle\Entity\Movimiento $movimientos
     * @return TipoMovimiento
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
     * Set isAccesible
     *
     * @param boolean $isAccesible
     * @return TipoMovimiento
     */
    public function setIsAccesible($isAccesible)
    {
        $this->isAccesible = $isAccesible;
    
        return $this;
    }

    /**
     * Get isAccesible
     *
     * @return boolean 
     */
    public function getIsAccesible()
    {
        return $this->isAccesible;
    }

    /**
     * Set isDelete
     *
     * @param boolean $isDelete
     * @return TipoMovimiento
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