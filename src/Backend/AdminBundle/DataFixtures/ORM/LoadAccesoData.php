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
        $tipoDeposito = new Acceso();
        $tipoDeposito->setName('Administrativo');
        $manager->persist($tipoDeposito);
        $manager->flush();
                
        $tipoDeposito2 = new Acceso();
        $tipoDeposito2->setName('Almacenaje');
        $manager->persist($tipoDeposito2);
        $manager->flush();
        

        $tipoDeposito3 = new Acceso();
        $tipoDeposito3->setName('Trabajo');
        $manager->persist($tipoDeposito3);
        $manager->flush();
        
       
        $tipoDeposito4 = new Acceso();
        $tipoDeposito4->setName('Calidad');
        $manager->persist($tipoDeposito4);
        $manager->flush();
        
        
        $tipoDeposito5 = new Acceso();
        $tipoDeposito5->setName('Expedicion');       
        $manager->persist($tipoDeposito5);
        $manager->flush();
        
        
        $tipoDeposito6 = new Acceso();
        $tipoDeposito6->setName('Trafico');
        $manager->persist($tipoDeposito6);
        $manager->flush();
                              
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}
