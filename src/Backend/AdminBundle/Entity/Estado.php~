<?php 
namespace Backend\AdminBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @ORM\Table(name="estado")
 * @ORM\Entity()
 */
class Estado
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
     * @ORM\OneToMany(targetEntity="Viaje", mappedBy="estado")
     */
     private $viajes;
    
    public function __construct()
    {
        $this->viajes = new ArrayCollection();
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
     * @return Estado
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
     * @return Estado
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
     * @return Estado
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
}