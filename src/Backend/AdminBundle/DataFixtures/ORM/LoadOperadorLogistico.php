<?php 
namespace Backend\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Backend\AdminBundle\Entity\OperadorLogistico;

class LoadOperadorLogistico extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{

/**
     * @var ContainerInterface
     */
    private $container;

 public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $operadorLog = new OperadorLogistico();
        $operadorLog->setName('operadorPrueba');
        $operadorLog->setDireccion("Luna 418");
        $operadorLog->setEmail('operador@operador.com');
        $operadorLog->setCodigo("op32");
        $operadorLog->setIsDelete(false);
        $operadorLog->setCreatedAt(new \DateTime('now'));
        
        $manager->flush();
        $this->addReference('operador-prueba', $operadorLog);
    }
    
    public function getOrder()
    {
        return 7; // the order in which fixtures will be loaded
    }
    
}
