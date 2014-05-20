<?php 
namespace Backend\AdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Backend\AdminBundle\Entity\TipoViaje;

class LoadTipoViajeData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
        $tipoviaje = new TipoViaje();
        $tipoviaje->setCode('TV1');
        $tipoviaje->setTexto("Lejana");
        $manager->persist($tipoviaje);
        $manager->flush();
        $this->addReference('lejana-tviaje', $tipoviaje);
        
        $tipoviaje2 = new TipoViaje();
        $tipoviaje2->setCode('TV2');
        $tipoviaje2->setTexto("Local");
        $manager->persist($tipoviaje2);
        $manager->flush();
        $this->addReference('local-tviaje', $tipoviaje2);
        
        $tipoviaje3 = new TipoViaje();
        $tipoviaje3->setCode('TV3');
        $tipoviaje3->setTexto("Ruta de frío");
        $manager->persist($tipoviaje3);
        $manager->flush();
        $this->addReference('rutafrio-tviaje', $tipoviaje3);
        
        $tipoviaje4 = new TipoViaje();
        $tipoviaje4->setCode('TV4');
        $tipoviaje4->setTexto("Ruta de Verdura");
        $manager->persist($tipoviaje4);
        $manager->flush();
        $this->addReference('rutaverdura-tviaje', $tipoviaje4);
        
        $tipoviaje5 = new TipoViaje();
        $tipoviaje5->setCode('TV5');
        $tipoviaje5->setTexto("Crossdoking");
        $manager->persist($tipoviaje5);
        $manager->flush();
        $this->addReference('crossdoking-tviaje', $tipoviaje5);
        
        $tipoviaje6 = new TipoViaje();
        $tipoviaje6->setCode('TV6');
        $tipoviaje6->setTexto("Parking");
        $manager->persist($tipoviaje6);
        $manager->flush();
        $this->addReference('parking-tviaje', $tipoviaje6);
        
        $tipoviaje7 = new TipoViaje();
        $tipoviaje7->setCode('TV7');
        $tipoviaje7->setTexto("Cesión");
        $manager->persist($tipoviaje7);
        $manager->flush();
        $this->addReference('cesion-tviaje', $tipoviaje7);
        
        
    }
    
    public function getOrder()
    {
        return 9; // the order in which fixtures will be loaded
    }
    
}
