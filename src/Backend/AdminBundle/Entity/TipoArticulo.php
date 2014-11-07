<?php

namespace Backend\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="tipo_articulo")
 * @ORM\Entity()
 */

class TipoArticulo
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
     * @ORM\Column(name="is_valido", type="boolean" )
     */
    private $isValido;
    
     /**
     * @ORM\Column(name="is_delete", type="boolean" )
     */
    private $isDelete;
    /**
     * @ORM\OneToMany(targetEntity="Articulo", mappedBy="tipo")
     */

    protected $articulos;    

     /**
    
    /**
     * Constructor
     */
    public function __construct()
    {
         $this->isDelete=false;
         $this->isValido=true;
         $this->articulos = new ArrayCollection();
             
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
     * @return TipoArticulo
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
     * Set isValido
     *
     * @param boolean $isValido
     * @return TipoArticulo
     */
    public function setIsValido($isValido)
    {
        $this->isValido = $isValido;
    
        return $this;
    }

    /**
     * Get isValido
     *
     * @return boolean 
     */
    public function getIsValido()
    {
        return $this->isValido;
    }

    /**
     * Set isDelete
     *
     * @param boolean $isDelete
     * @return TipoArticulo
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
     * Add articulos
     *
     * @param \Backend\AdminBundle\Entity\Articulos $articulos
     * @return TipoArticulo
     */
    public function addArticulo(\Backend\AdminBundle\Entity\Articulos $articulos)
    {
        $this->articulos[] = $articulos;
    
        return $this;
    }

    /**
     * Remove articulos
     *
     * @param \Backend\AdminBundle\Entity\Articulos $articulos
     */
    public function removeArticulo(\Backend\AdminBundle\Entity\Articulos $articulos)
    {
        $this->articulos->removeElement($articulos);
    }

    /**
     * Get articulos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArticulos()
    {
        return $this->articulos;
    }
}