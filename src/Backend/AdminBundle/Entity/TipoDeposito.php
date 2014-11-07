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
    
    private $nombre;

	 /**
     * @ORM\Column(name="is_delete", type="boolean" )
     */
    private $isDelete;
      
    /**
     * @ORM\ManyToMany(targetEntity="AreaTrabajo", mappedBy="tipo_deposito")
     */
        
    protected $areasTrabajo;

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
        $this->isDelete=false;
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

    /**
     * Set isDelete
     *
     * @param boolean $isDelete
     * @return TipoDeposito
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
     * Set nombre
     *
     * @param string $nombre
     * @return TipoDeposito
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
     * Add areasTrabajo
     *
     * @param \Backend\AdminBundle\Entity\AreaTrabajo $areasTrabajo
     * @return TipoDeposito
     */
    public function addAreasTrabajo(\Backend\AdminBundle\Entity\AreaTrabajo $areasTrabajo)
    {
        $this->areasTrabajo[] = $areasTrabajo;
    
        return $this;
    }

    /**
     * Remove areasTrabajo
     *
     * @param \Backend\AdminBundle\Entity\AreaTrabajo $areasTrabajo
     */
    public function removeAreasTrabajo(\Backend\AdminBundle\Entity\AreaTrabajo $areasTrabajo)
    {
        $this->areasTrabajo->removeElement($areasTrabajo);
    }

    /**
     * Get areasTrabajo
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAreasTrabajo()
    {
        return $this->areasTrabajo;
    }
}