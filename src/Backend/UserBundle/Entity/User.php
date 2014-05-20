<?php

namespace Backend\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\Common\Collections\ArrayCollection;
use Backend\UserBundle\Validator\Constraints\UsuarioUnique;
use Backend\UserBundle\Validator\Constraints\EmailUnique;
use Backend\UserBundle\Validator\Constraints\EmpleadoUnique;

/**
 * Backend\UserBundle\Entity\User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="Backend\UserBundle\Entity\UserRepository")
 * @ORM\HasLifecycleCallbacks 
 * @UsuarioUnique()
 * @EmailUnique()  
 * @EmpleadoUnique()   
 */
class User implements AdvancedUserInterface, \Serializable {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $salt;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $password;
    
    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $codigo;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $email;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column(name="is_delete", type="boolean" )
     */
    private $isDelete;

    /**
     * @ORM\Column(name="name", type="string",length=100, nullable=true)
     */
    private $name;
    /**
     * @ORM\Column(name="lastname", type="string", length=100, nullable=true)
     */
    private $lastname;
    
   /**
     * @ORM\Column(name="nroempleado", type="integer", nullable=true)
     */
    private $nroEmpleado;
    /**
     * @ORM\ManyToMany(targetEntity="Group", inversedBy="users")
     *
     */
    private $groups;
    
    
   /**
     * @ORM\ManyToOne(targetEntity="\Backend\AdminBundle\Entity\Deposito", inversedBy="operarios")
     * @ORM\JoinColumn(name="deposito_id", referencedColumnName="id")
     */
    private $deposito;
    
  /**
     * @ORM\OneToMany(targetEntity="\Backend\AdminBundle\Entity\Movimiento", mappedBy="usuario")
     */
    private $movimientos; 
    
    /**
     * @ORM\OneToMany(targetEntity="\Backend\AdminBundle\Entity\Movimiento", mappedBy="delete_by")
     */
    private $delmovimientos; 
    
       /**
     * @ORM\OneToMany(targetEntity="\Backend\AdminBundle\Entity\Costo", mappedBy="delete_by")
     */
     
     private $delcostos;
     
        /**
     * @ORM\OneToMany(targetEntity="\Backend\AdminBundle\Entity\Viaje", mappedBy="delete_by")
     */
     
     private $delviajes;
     
     /**
     * @ORM\OneToMany(targetEntity="\Backend\AdminBundle\Entity\Viaje", mappedBy="operario")
     */
     
     private $viajes;
     
     /**
     * @ORM\OneToMany(targetEntity="\Backend\AdminBundle\Entity\Caja", mappedBy="usuario")
     */
     private $cajaempleados;
     
     /**
     * @ORM\OneToMany(targetEntity="\Backend\AdminBundle\Entity\Caja", mappedBy="delete_by")
     */
     private $delcajaempleados;
     
       /**
     * @ORM\OneToMany(targetEntity="\Backend\AdminBundle\Entity\Viaje", mappedBy="created_by")
     */
     private $create_viajes;
       
    public function __construct() {
        $this->isActive = true;
        $this->isDelete = false;
        $this->salt = md5(uniqid(null, true));
       
        $this->movimientos = new ArrayCollection();
        $this->delmovimientos = new ArrayCollection();
        $this->cajaempleados = new ArrayCollection();
        $this->delcajaempleados = new ArrayCollection();
        $this->delcostos = new ArrayCollection();
        $this->groups =  new ArrayCollection();
        $this->viajes =  new ArrayCollection();
        $this->create_viajes =  new ArrayCollection();
        $this->delviajes =  new ArrayCollection();
    }

   public function __toString(){
   
         return $this->username;
   }

    /**
     * @inheritDoc
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * @inheritDoc
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * @inheritDoc
     */
    public function getSalt() {
        return $this->salt;
    }

    /**
     * @inheritDoc
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * @inheritDoc
     */
    public function getRoles() {
       // return $this->groups->toArray();
        
        
       $grupos=$this->groups;
       $roles=array();
       foreach($grupos as $g)
       {
         foreach($g->getAccesos() as $a)
            $roles[]=$a->getAcceso();
            
         $roles[]=$g->getRole();
       } 
       
       return $roles;
        
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials() {
        
    }

    /**
     * @see \Serializable::serialize()
     */
    public function serialize() {
        return serialize(array(
            $this->id,
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized) {
        list (
                $this->id,
                ) = unserialize($serialized);
    }

    public function isAccountNonExpired() {
        return !$this->isDelete;
    }

    public function isAccountNonLocked() {
        return true;
    }

    public function isCredentialsNonExpired() {
        return true;
    }

    public function isEnabled() {
        return $this->isActive;
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
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;
    
        return $this;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    
        return $this;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
       
       if (null === $password)  {
           return; 
       }
       global $kernel;
        if($kernel instanceOf \AppCache) $kernel = $kernel->getKernel();
        
         $factory = $kernel->getContainer()->get('security.encoder_factory');
         $encoder = $factory->getEncoder($this);
         //todo: obtener el encoder en security para usar lo mismo   
        $this->password = $encoder->encodePassword($password, $this->getSalt());
        //$this->password = sha1($password);
    
        return $this;
    }
    
    public function comparePassword($passToCompare)
    {
     global $kernel;
        if($kernel instanceOf \AppCache) $kernel = $kernel->getKernel();
        
         $factory = $kernel->getContainer()->get('security.encoder_factory');
         $encoder = $factory->getEncoder($this);
         //todo: obtener el encoder en security para usar lo mismo   
        $toCompare = $encoder->encodePassword($passToCompare, $this->getSalt());
        if ($this->getPassword() == $toCompare)
           return true;
        else
          return false;
           
    
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    
        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Add groups
     *
     * @param \Backend\UserBundle\Entity\Group $groups
     * @return User
     */
    public function addGroup(\Backend\UserBundle\Entity\Group $groups)
    {
        $this->groups[] = $groups;

        return $this;
    }

    /**
     * Remove groups
     *
     * @param \ITWB\UserBundle\Entity\Group $groups
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

    /**
     * Set name
     *
     * @param string $name
     * @return User
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
     * Set lastname
     *
     * @param string $lastname
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

  

   

    /**
     * Set codigo
     *
     * @param string $codigo
     * @return User
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    
        return $this;
    }

    /**
     * Get codigo
     *
     * @return string 
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set isDelete
     *
     * @param boolean $isDelete
     * @return User
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
     * Set nroEmpleado
     *
     * @param string $nroEmpleado
     * @return User
     */
    public function setNroEmpleado($nroEmpleado)
    {
        $this->nroEmpleado = $nroEmpleado;
    
        return $this;
    }

    /**
     * Get nroEmpleado
     *
     * @return string 
     */
    public function getNroEmpleado()
    {
        return $this->nroEmpleado;
    }

   

    /**
     * Add movimientos
     *
     * @param \Backend\AdminBundle\Entity\Movimiento $movimientos
     * @return User
     */
    public function addMovimiento(\Backend\AdminBundle\Entity\Movimiento $movimientos)
    {
        $this->movimientos[] = $movimientos;
    
        return $this;
    }

    /**
     * Remove movimientos
     *
     * @param \Backend\AdminBundle\Entity\Movimiento $movimientos
     */
    public function removeMovimiento(\Backend\AdminBundle\Entity\Movimiento $movimientos)
    {
        $this->movimientos->removeElement($movimientos);
    }

    /**
     * Get movimientos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMovimientos()
    {
        return $this->movimientos;
    }

    /**
     * Add delmovimientos
     *
     * @param \Backend\AdminBundle\Entity\Movimiento $delmovimientos
     * @return User
     */
    public function addDelmovimiento(\Backend\AdminBundle\Entity\Movimiento $delmovimientos)
    {
        $this->delmovimientos[] = $delmovimientos;
    
        return $this;
    }

    /**
     * Remove delmovimientos
     *
     * @param \Backend\AdminBundle\Entity\Movimiento $delmovimientos
     */
    public function removeDelmovimiento(\Backend\AdminBundle\Entity\Movimiento $delmovimientos)
    {
        $this->delmovimientos->removeElement($delmovimientos);
    }

    /**
     * Get delmovimientos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDelmovimientos()
    {
        return $this->delmovimientos;
    }

    /**
     * Add delcostos
     *
     * @param \Backend\AdminBundle\Entity\Costos $delcostos
     * @return User
     */
    public function addDelcosto(\Backend\AdminBundle\Entity\Costo $delcostos)
    {
        $this->delcostos[] = $delcostos;
    
        return $this;
    }

    /**
     * Remove delcostos
     *
     * @param \Backend\AdminBundle\Entity\Costos $delcostos
     */
    public function removeDelcosto(\Backend\AdminBundle\Entity\Costo $delcostos)
    {
        $this->delcostos->removeElement($delcostos);
    }

    /**
     * Get delcostos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDelcostos()
    {
        return $this->delcostos;
    }

    /**
     * Add delviajes
     *
     * @param \Backend\AdminBundle\Entity\Viaje $delviajes
     * @return User
     */
    public function addDelviaje(\Backend\AdminBundle\Entity\Viaje $delviajes)
    {
        $this->delviajes[] = $delviajes;
    
        return $this;
    }

    /**
     * Remove delviajes
     *
     * @param \Backend\AdminBundle\Entity\Viaje $delviajes
     */
    public function removeDelviaje(\Backend\AdminBundle\Entity\Viaje $delviajes)
    {
        $this->delviajes->removeElement($delviajes);
    }

    /**
     * Get delviajes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDelviajes()
    {
        return $this->delviajes;
    }

    /**
     * Add viajes
     *
     * @param \Backend\AdminBundle\Entity\Viaje $viajes
     * @return User
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

    /**
     * Add create_viajes
     *
     * @param \Backend\AdminBundle\Entity\Viaje $createViajes
     * @return User
     */
    public function addCreateViaje(\Backend\AdminBundle\Entity\Viaje $createViajes)
    {
        $this->create_viajes[] = $createViajes;
    
        return $this;
    }

    /**
     * Remove create_viajes
     *
     * @param \Backend\AdminBundle\Entity\Viaje $createViajes
     */
    public function removeCreateViaje(\Backend\AdminBundle\Entity\Viaje $createViajes)
    {
        $this->create_viajes->removeElement($createViajes);
    }

    /**
     * Get create_viajes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCreateViajes()
    {
        return $this->create_viajes;
    }

   

    /**
     * Set deposito
     *
     * @param \Backend\AdminBundle\Entity\Deposito $deposito
     * @return User
     */
    public function setDeposito(\Backend\AdminBundle\Entity\Deposito $deposito = null)
    {
        $this->deposito = $deposito;
    
        return $this;
    }

    /**
     * Get deposito
     *
     * @return \Backend\AdminBundle\Entity\Deposito 
     */
    public function getDeposito()
    {
        return $this->deposito;
    }

   

    /**
     * Add cajaempleados
     *
     * @param \Backend\AdminBundle\Entity\Caja $cajaempleados
     * @return User
     */
    public function addCajaempleado(\Backend\AdminBundle\Entity\Caja $cajaempleados)
    {
        $this->cajaempleados[] = $cajaempleados;
    
        return $this;
    }

    /**
     * Remove cajaempleados
     *
     * @param \Backend\AdminBundle\Entity\Caja $cajaempleados
     */
    public function removeCajaempleado(\Backend\AdminBundle\Entity\Caja $cajaempleados)
    {
        $this->cajaempleados->removeElement($cajaempleados);
    }

    /**
     * Get cajaempleados
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCajaempleados()
    {
        return $this->cajaempleados;
    }

    /**
     * Add delcajaempleados
     *
     * @param \Backend\AdminBundle\Entity\Caja $delcajaempleados
     * @return User
     */
    public function addDelcajaempleado(\Backend\AdminBundle\Entity\Caja $delcajaempleados)
    {
        $this->delcajaempleados[] = $delcajaempleados;
    
        return $this;
    }

    /**
     * Remove delcajaempleados
     *
     * @param \Backend\AdminBundle\Entity\Caja $delcajaempleados
     */
    public function removeDelcajaempleado(\Backend\AdminBundle\Entity\Caja $delcajaempleados)
    {
        $this->delcajaempleados->removeElement($delcajaempleados);
    }

    /**
     * Get delcajaempleados
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDelcajaempleados()
    {
        return $this->delcajaempleados;
    }
}