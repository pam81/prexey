<?php 
namespace Backend\AdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Backend\AdminBundle\Entity\TipoCosto;

class LoadTipoCostoData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
        $costo = new TipoCosto();
        $costo->setCode('CT1');
        $costo->setTexto("Combustible en ruta");
        $manager->persist($costo);
        $manager->flush();
        $this->addReference('combustible-tcosto', $costo);
        
        $costo4 = new TipoCosto();
        $costo4->setCode('CT2');
        $costo4->setTexto("Combustible CC");
        $costo4->setIsCc(true);
        $manager->persist($costo4);
        $manager->flush();
        $this->addReference('combustiblecc-tcosto', $costo4); 
        
       
        
        $costo3 = new TipoCosto();
        $costo3->setCode('CT3');
        $costo3->setTexto("Comida");
        $manager->persist($costo3);
        $manager->flush();
        $this->addReference('comida-tcosto', $costo3);
        
         $costo2 = new TipoCosto();
        $costo2->setCode('CT4');
        $costo2->setTexto("Hotel");
        $manager->persist($costo2);
        $manager->flush();
        $this->addReference('hotel-tcosto', $costo2);
        
        $costo1 = new TipoCosto();
        $costo1->setCode('CT5');
        $costo1->setTexto("Otro");
        $manager->persist($costo1);
        $manager->flush();
        $this->addReference('otro-tcosto', $costo1);
        
        
       
        
    }
    
    public function getOrder()
    {
        return 7; // the order in which fixtures will be loaded
    }
    
}
