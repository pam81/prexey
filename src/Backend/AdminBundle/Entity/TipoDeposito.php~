<?php

namespace Backend\AdminBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="tipo_deposito")
 * @ORM\Entity()
 */
class TipoDeposito
{
    
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */

    private $id;

    /**
     * @ORM\Column(name="nombre", type="string", length=100)
     */
    
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Deposito", mappedBy="tipoDeposito")
     */
    
    protected $depositos;



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
     * @return TipoDeposito
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
     * Constructor
     */
    public function __construct()
    {
        $this->depositos = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add depositos
     *
     * @param \Backend\AdminBundle\Entity\Deposito $depositos
     * @return TipoDeposito
     */
    public function addDeposito(\Backend\AdminBundle\Entity\Deposito $depositos)
    {
        $this->depositos[] = $depositos;
    
        return $this;
    }

    /**
     * Remove depositos
     *
     * @param \Backend\AdminBundle\Entity\Deposito $depositos
     */
    public function removeDeposito(\Backend\AdminBundle\Entity\Deposito $depositos)
    {
        $this->depositos->removeElement($depositos);
    }

    /**
     * Get depositos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDepositos()
    {
        return $this->depositos;
    }
}