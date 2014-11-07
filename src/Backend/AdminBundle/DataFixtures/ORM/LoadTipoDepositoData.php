<?php 

namespace Backend\AdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Backend\AdminBundle\Entity\TipoDeposito;

class LoadTipoDepositoData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $tipoDeposito = new TipoDeposito();
        $tipoDeposito->setNombre('Administrativo');
        $manager->persist($tipoDeposito);
        $manager->flush();
        $this->addReference('td-administrativo', $tipoDeposito);
                
        $tipoDeposito2 = new TipoDeposito();
        $tipoDeposito2->setNombre('Almacenaje');
        $manager->persist($tipoDeposito2);
        $manager->flush();
        $this->addReference('td-almacenaje', $tipoDeposito2);

        $tipoDeposito3 = new TipoDeposito();
        $tipoDeposito3->setNombre('Trabajo');
        $manager->persist($tipoDeposito3);
        $manager->flush();
        $this->addReference('td-trabajo', $tipoDeposito3);
       
        $tipoDeposito4 = new TipoDeposito();
        $tipoDeposito4->setNombre('Calidad');
        $manager->persist($tipoDeposito4);
        $manager->flush();
        $this->addReference('td-calidad', $tipoDeposito4);
        
        $tipoDeposito5 = new TipoDeposito();
        $tipoDeposito5->setNombre('Expedicion');       
        $manager->persist($tipoDeposito5);
        $manager->flush();
        $this->addReference('td-expedicion', $tipoDeposito5);
        
        
        $tipoDeposito6 = new TipoDeposito();
        $tipoDeposito6->setNombre('Trafico');
        $manager->persist($tipoDeposito6);
        $manager->flush();
        $this->addReference('td-trafico', $tipoDeposito6);
                              
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 5; // the order in which fixtures will be loaded
    }
}
