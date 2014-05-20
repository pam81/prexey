<?php 
namespace Backend\AdminBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Backend\AdminBundle\Validator\Constraints\CostoCodeUnique;
/**
 * @ORM\Table(name="tipocosto")
 * @ORM\Entity(repositoryClass="Backend\AdminBundle\Entity\TipoCostoRepository")
 * @CostoCodeUnique()  
 */
class TipoCosto
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
     * @ORM\Column(name="is_delete", type="boolean" )
     */
    private $isDelete;   
    
     /**
     * @ORM\Column(name="is_cc", type="boolean", nullable=true )
     */
    private $isCc;   
   
       /**
     * @ORM\OneToMany(targetEntity="Costo", mappedBy="tipo")
     */
     private $costos;
    
    
    public function __construct()
    {
        $this->costos = new ArrayCollection();
        $this->isDelete=false;
        $this->isCc=false;
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
     * @return TipoCosto
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
     * @return TipoCosto
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
     * Add costos
     *
     * @param \Backend\AdminBundle\Entity\Costos $costos
     * @return TipoCosto
     */
    public function addCosto(\Backend\AdminBundle\Entity\Costo $costos)
    {
        $this->costos[] = $costos;
    
        return $this;
    }

    /**
     * Remove costos
     *
     * @param \Backend\AdminBundle\Entity\Costos $costos
     */
    public function removeCosto(\Backend\AdminBundle\Entity\Costo $costos)
    {
        $this->costos->removeElement($costos);
    }

    /**
     * Get costos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCostos()
    {
        return $this->costos;
    }

    /**
     * Set isDelete
     *
     * @param boolean $isDelete
     * @return TipoCosto
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
     * Set isCC
     *
     * @param boolean $isCC
     * @return TipoCosto
     */
    public function setIsCc($isCc)
    {
        $this->isCc = $isCc;
    
        return $this;
    }

    /**
     * Get isCC
     *
     * @return boolean 
     */
    public function getIsCc()
    {
        return $this->isCc;
    }
}