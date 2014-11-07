<?php

namespace Backend\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="provincia")
 * @ORM\Entity()
 */

class Provincia
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
     * @ORM\OneToMany(targetEntity="Zona", mappedBy="provincia")
     */

    protected $zonas;    

     /**
     * @ORM\OneToMany(targetEntity="Cliente", mappedBy="provincia")
     */
     protected $clientes;

     /**
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->zonas = new ArrayCollection();
        $this->clientes = new ArrayCollection();
             
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
     * @return Provincia
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
     * Add zonas
     *
     * @param \Backend\AdminBundle\Entity\Zona $zonas
     * @return Provincia
     */
    public function addZona(\Backend\AdminBundle\Entity\Zona $zonas)
    {
        $this->zonas[] = $zonas;
    
        return $this;
    }

    /**
     * Remove zonas
     *
     * @param \Backend\AdminBundle\Entity\Zona $zonas
     */
    public function removeZona(\Backend\AdminBundle\Entity\Zona $zonas)
    {
        $this->zonas->removeElement($zonas);
    }

    /**
     * Get zonas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getZonas()
    {
        return $this->zonas;
    }

    /**
     * Add clientes
     *
     * @param \Backend\AdminBundle\Entity\Cliente $clientes
     * @return Provincia
     */
    public function addCliente(\Backend\AdminBundle\Entity\Cliente $clientes)
    {
        $this->clientes[] = $clientes;
    
        return $this;
    }

    /**
     * Remove clientes
     *
     * @param \Backend\AdminBundle\Entity\Cliente $clientes
     */
    public function removeCliente(\Backend\AdminBundle\Entity\Cliente $clientes)
    {
        $this->clientes->removeElement($clientes);
    }

    /**
     * Get clientes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getClientes()
    {
        return $this->clientes;
    }
}