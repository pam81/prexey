<?php
 
namespace Backend\UserBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="accesos")
 * @ORM\Entity()
 */
class Acceso 
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", length=200)
     */
    private $name;

    /**
     * @ORM\Column(name="acceso", type="string", length=100)
     */
    private $acceso;
     
     /**
     * @ORM\ManyToMany(targetEntity="Group", mappedBy="accesos")
     */
   
    protected $groups;
    
    
     public function __construct() {
	
	        $this->groups = new ArrayCollection();
    }

    public function __toString()
    {
       return $this->name;
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
     * @return Acceso
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
     * Set acceso
     *
     * @param string $acceso
     * @return Acceso
     */
    public function setAcceso($acceso)
    {
        $this->acceso = $acceso;
    
        return $this;
    }

    /**
     * Get acceso
     *
     * @return string 
     */
    public function getAcceso()
    {
        return $this->acceso;
    }

    /**
     * Add groups
     *
     * @param \Backend\UserBundle\Entity\Group $groups
     * @return Acceso
     */
    public function addGroup(\Backend\UserBundle\Entity\Group $groups)
    {
        $this->groups[] = $groups;
    
        return $this;
    }

    /**
     * Remove groups
     *
     * @param \Backend\UserBundle\Entity\Group $groups
     */
    public function removeGroup(\Backend\UserBundle\Entity\Group $groups)
    {
        $this->groups->removeElement($groups);
    }

    /**
     * Get groups
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGroups()
    {
        return $this->groups;
    }
}