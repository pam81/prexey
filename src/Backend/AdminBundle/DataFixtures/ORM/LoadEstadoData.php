<?php 
namespace Backend\AdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Backend\AdminBundle\Entity\Estado;

class LoadEstadoData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
        $estado = new Estado();
        $estado->setCode('PENDIENTE');
        $estado->setTexto("Pendiente");
        $manager->persist($estado);
        $manager->flush();
        $this->addReference('pendiente-estado', $estado);
        
        $estado1 = new Estado();
        $estado1->setCode('RENDIDO');
        $estado1->setTexto("Rendido");
        $manager->persist($estado1);
        $manager->flush();
        $this->addReference('rendido-estado', $estado1);
        
        $estado2 = new Estado();
        $estado2->setCode('BORRADOR');
        $estado2->setTexto("Borrador");
        $manager->persist($estado2);
        $manager->flush();
        $this->addReference('borrador-estado', $estado2);
        
        $estado3 = new Estado();
        $estado3->setCode('ANULADO');
        $estado3->setTexto("Anulado");
        $manager->persist($estado3);
        $manager->flush();
        $this->addReference('anulado-estado', $estado3);
        
        $estado4 = new Estado();
        $estado4->setCode('CERRADO');
        $estado4->setTexto("Cerrado");
        $manager->persist($estado4);
        $manager->flush();
        $this->addReference('cerrado-estado', $estado4);
        
        
    }
    
    public function getOrder()
    {
        return 6; // the order in which fixtures will be loaded
    }
    
}
