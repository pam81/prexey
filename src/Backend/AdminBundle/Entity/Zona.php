<?php

namespace Backend\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="zona")
 * @ORM\Entity()
 */

class Zona
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
     * @ORM\ManyToOne(targetEntity="Provincia", inversedBy="zonas")
     * @ORM\JoinColumn(name="provincia_id", referencedColumnName="id")
     */

    protected $provincia;    

     /**
     * @ORM\OneToMany(targetEntity="Cliente", mappedBy="zona")
     */
     protected $clientes;
   

     public function __construct()
    {
        
        $this->clientes = new ArrayCollection();
             
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
     * @return Zona
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
     * Set provincia
     *
     * @param \Backend\AdminBundle\Entity\Provincia $provincia
     * @return Zona
     */
    public function setProvincia(\Backend\AdminBundle\Entity\Provincia $provincia = null)
    {
        $this->provincia = $provincia;
    
        return $this;
    }

    /**
     * Get provincia
     *
     * @return \Backend\AdminBundle\Entity\Provincia 
     */
    public function getProvincia()
    {
        return $this->provincia;
    }

    /**
     * Add clientes
     *
     * @param \Backend\AdminBundle\Entity\Cliente $clientes
     * @return Zona
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