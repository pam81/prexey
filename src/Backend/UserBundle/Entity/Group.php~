<?php
 
namespace Backend\UserBundle\Entity;

use Symfony\Component\Security\Core\Role\Role;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="groups")
 * @ORM\Entity()
 */
class Group extends Role
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", length=30)
     */
    private $name;

    /**
     * @ORM\Column(name="role", type="string", length=20, unique=true)
     */
    private $role;

    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="groups")
     */
    private $users;
    
    /**
     * @ORM\ManyToMany(targetEntity="Acceso", inversedBy="groups")
     */
    protected $accesos;
    

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->accesos = new ArrayCollection();
    }

    public function __toString(){
   
         return $this->name;
   }

    /**
     * @see RoleInterface
     */
    public function getRole()
    {
        return $this->role;
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
     * @return Group
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
     * Set role
     *
     * @param string $role
     * @return Group
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Add users
     *
     * @param \Backend\UserBundle\Entity\User $users
     * @return Group
     */
    public function addUser(\Backend\UserBundle\Entity\User $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \Backend\UserBundle\Entity\User $users
     */
    public function removeUser(\Backend\UserBundle\Entity\User $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Add accesos
     *
     * @param \Backend\UserBundle\Entity\Acceso $accesos
     * @return Group
     */
    public function addAcceso(\Backend\UserBundle\Entity\Acceso $accesos)
    {
        $this->accesos[] = $accesos;
    
        return $this;
    }

    /**
     * Remove accesos
     *
     * @param \Backend\UserBundle\Entity\Acceso $accesos
     */
    public function removeAcceso(\Backend\UserBundle\Entity\Acceso $accesos)
    {
        $this->accesos->removeElement($accesos);
    }

    /**
     * Get accesos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAccesos()
    {
        return $this->accesos;
    }
}