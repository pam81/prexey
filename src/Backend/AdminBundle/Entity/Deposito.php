<?php

namespace Backend\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="deposito")
 * @ORM\Entity() 
 */
class Deposito
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

    private $nombre;

    /**
     * @ORM\Column(name="responsable", type="string", length=100)
     */
    
    private $responsable;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    
    private $createdAt;

    /**
     * @ORM\Column(name="modified_at", type="datetime")
     */
    
    private $modifiedAt;

     /**
     * @ORM\ManyToOne(targetEntity="TipoDeposito", inversedBy="depositos")
     * @ORM\JoinColumn(name="tipodeposito_id", referencedColumnName="id")
     */
    private $tipoDeposito;
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
     * Set nombre
     *
     * @param string $nombre
     * @return Deposito
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set responsable
     *
     * @param string $responsable
     * @return Deposito
     */
    public function setResponsable($responsable)
    {
        $this->responsable = $responsable;
    
        return $this;
    }

    /**
     * Get responsable
     *
     * @return string 
     */
    public function getResponsable()
    {
        return $this->responsable;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Deposito
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
     * @return Deposito
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
     * Set tipoDeposito
     *
     * @param \Backend\AdminBundle\Entity\TipoDeposito $tipoDeposito
     * @return Deposito
     */
    public function setTipoDeposito(\Backend\AdminBundle\Entity\TipoDeposito $tipoDeposito = null)
    {
        $this->tipoDeposito = $tipoDeposito;
    
        return $this;
    }

    /**
     * Get tipoDeposito
     *
     * @return \Backend\AdminBundle\Entity\TipoDeposito 
     */
    public function getTipoDeposito()
    {
        return $this->tipoDeposito;
    }
}