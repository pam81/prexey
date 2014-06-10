<?php

namespace Backend\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="area")
 * @ORM\Entity()
 */
class AreaTrabajo
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
     * @ORM\Column(name="observaciones", type="text", nullable=true)
     */
    private $observaciones;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

     /**
     * @ORM\Column(name="modified_at", type="datetime", nullable=true)
     */
    private $modifiedAt;

    /**
     * @ORM\Column(name="is_habilitada", type="boolean" )
     */
    private $isHabilitada;
    
    /**
     * @ORM\ManyToOne(targetEntity="Sucursal", inversedBy="areas")
     * @ORM\JoinColumn(name="sucursal_id", referencedColumnName="id")
     */
    private $sucursal;
    

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->isHabilitada=true;
        $this->createdAt = new \DateTime('now');
       
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
     * Set nombre
     *
     * @param string $nombre
     * @return AreaTrabajo
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
     * @return AreaTrabajo
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
     * Set observaciones
     *
     * @param string $observaciones
     * @return AreaTrabajo
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;
    
        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string 
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return AreaTrabajo
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
     * @return AreaTrabajo
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
     * Set isHabilitada
     *
     * @param boolean $isHabilitada
     * @return AreaTrabajo
     */
    public function setIsHabilitada($isHabilitada)
    {
        $this->isHabilitada = $isHabilitada;
    
        return $this;
    }

    /**
     * Get isHabilitada
     *
     * @return boolean 
     */
    public function getIsHabilitada()
    {
        return $this->isHabilitada;
    }

    /**
     * Set sucursal
     *
     * @param \Backend\AdminBundle\Entity\Sucursal $sucursal
     * @return AreaTrabajo
     */
    public function setSucursal(\Backend\AdminBundle\Entity\Sucursal $sucursal = null)
    {
        $this->sucursal = $sucursal;
    
        return $this;
    }

    /**
     * Get sucursal
     *
     * @return \Backend\AdminBundle\Entity\Sucursal 
     */
    public function getSucursal()
    {
        return $this->sucursal;
    }
}