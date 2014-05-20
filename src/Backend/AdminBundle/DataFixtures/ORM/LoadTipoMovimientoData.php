<?php 
namespace Backend\AdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Backend\AdminBundle\Entity\TipoMovimiento;

class LoadTipoMovimientoData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
        $tmovimientoAdmin = new TipoMovimiento();
        $tmovimientoAdmin->setCode('MOV1');
        $tmovimientoAdmin->setTexto("Envio de dinero");
        $tmovimientoAdmin->setIsAccesible(true);
        $manager->persist($tmovimientoAdmin);
        $manager->flush();
        $this->addReference('mov1-tipo', $tmovimientoAdmin);
        
        $tmovimientoAdmin1 = new TipoMovimiento();
        $tmovimientoAdmin1->setCode('MOV2');
        $tmovimientoAdmin1->setTexto("Ajuste Manual");
         $tmovimientoAdmin1->setIsAccesible(true);
        $manager->persist($tmovimientoAdmin1);
        $manager->flush();
        $this->addReference('mov2-tipo', $tmovimientoAdmin1);
        
        $tmovimientoAdmin2 = new TipoMovimiento();
        $tmovimientoAdmin2->setCode('MOV3');
        $tmovimientoAdmin2->setTexto("Asignación dinero a viaje");
        $tmovimientoAdmin2->setIsAccesible(false);
        $manager->persist($tmovimientoAdmin2);
        $manager->flush();
        $this->addReference('mov3-tipo', $tmovimientoAdmin2);
        
        $tmovimientoAdmin3 = new TipoMovimiento();
        $tmovimientoAdmin3->setCode('MOV4');
        $tmovimientoAdmin3->setTexto("Rendición Viaje");
        $tmovimientoAdmin3->setIsAccesible(false);
        $manager->persist($tmovimientoAdmin3);
        $manager->flush();
        $this->addReference('mov4-tipo', $tmovimientoAdmin3);
        
        
    }
    
    public function getOrder()
    {
        return 5; // the order in which fixtures will be loaded
    }
    
}
