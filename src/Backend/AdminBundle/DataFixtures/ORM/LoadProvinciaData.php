<?php 

namespace Backend\AdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Backend\AdminBundle\Entity\Provincia;

class LoadProvinciaData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $provincia = new Provincia();
        $provincia->setName('Buenos Aires');
        $manager->persist($provincia);
        $manager->flush();
        $this->addReference('provincia-bsas', $provincia);
        
        
        $provincia1 = new Provincia();
        $provincia1->setName('Catamarca');
        $manager->persist($provincia1);
        $manager->flush();
        $this->addReference('provincia-catamarca', $provincia1);
        
        $provincia2 = new Provincia();
        $provincia2->setName('Chaco');
        $manager->persist($provincia2);
        $manager->flush();
        $this->addReference('provincia-chaco', $provincia2);
        
        $provincia3 = new Provincia();
        $provincia3->setName('Chubut');
        $manager->persist($provincia3);
        $manager->flush();
        $this->addReference('provincia-chubut', $provincia3);
        
        $provincia4 = new Provincia();
        $provincia4->setName('Córdoba');
        $manager->persist($provincia4);
        $manager->flush();
        $this->addReference('provincia-cordoba', $provincia4);
        
        $provincia5 = new Provincia();
        $provincia5->setName('Corrientes');
        $manager->persist($provincia5);
        $manager->flush();
        $this->addReference('provincia-corrientes', $provincia5);
        
        $provincia6 = new Provincia();
        $provincia6->setName('Capital Federal');
        $manager->persist($provincia6);
        $manager->flush();
        $this->addReference('provincia-capfed', $provincia6);
        
        $provincia7 = new Provincia();
        $provincia7->setName('Entre Ríos');
        $manager->persist($provincia7);
        $manager->flush();
        $this->addReference('provincia-entrerios', $provincia7);
        
        $provincia8 = new Provincia();
        $provincia8->setName('Formosa');
        $manager->persist($provincia8);
        $manager->flush();
        $this->addReference('provincia-formosa', $provincia8);
        
        $provincia9 = new Provincia();
        $provincia9->setName('Jujuy');
        $manager->persist($provincia9);
        $manager->flush();
        $this->addReference('provincia-jujuy', $provincia9);
        
        $provincia10 = new Provincia();
        $provincia10->setName('La Pampa');
        $manager->persist($provincia10);
        $manager->flush();
        $this->addReference('provincia-pampa', $provincia10);
        
        $provincia11 = new Provincia();
        $provincia11->setName('La Rioja');
        $manager->persist($provincia11);
        $manager->flush();
        $this->addReference('provincia-rioja', $provincia11);
        
        $provincia12 = new Provincia();
        $provincia12->setName('Mendoza');
        $manager->persist($provincia12);
        $manager->flush();
        $this->addReference('provincia-mendoza', $provincia12);
        
        $provincia13 = new Provincia();
        $provincia13->setName('Misiones');
        $manager->persist($provincia13);
        $manager->flush();
        $this->addReference('provincia-misiones', $provincia13);
        
        $provincia14 = new Provincia();
        $provincia14->setName('Neuquén');
        $manager->persist($provincia14);
        $manager->flush();
        $this->addReference('provincia-neuquen', $provincia14);
        
        $provincia15 = new Provincia();
        $provincia15->setName('Río Negro');
        $manager->persist($provincia15);
        $manager->flush();
        $this->addReference('provincia-rionegro', $provincia15);
        
        $provincia16 = new Provincia();
        $provincia16->setName('Salta');
        $manager->persist($provincia16);
        $manager->flush();
        $this->addReference('provincia-salta', $provincia16);
        
        $provincia17 = new Provincia();
        $provincia17->setName('San Juan');
        $manager->persist($provincia17);
        $manager->flush();
        $this->addReference('provincia-sanjuan', $provincia17);
        
        $provincia18 = new Provincia();
        $provincia18->setName('San Luis');
        $manager->persist($provincia18);
        $manager->flush();
        $this->addReference('provincia-sanluis', $provincia18);
        
        $provincia19 = new Provincia();
        $provincia19->setName('Santa Cruz');
        $manager->persist($provincia19);
        $manager->flush();
        $this->addReference('provincia-santacruz', $provincia19);
        
        $provincia20 = new Provincia();
        $provincia20->setName('Santa Fe');
        $manager->persist($provincia20);
        $manager->flush();
        $this->addReference('provincia-santafe', $provincia20);
        
        $provincia21 = new Provincia();
        $provincia21->setName('Santiago del Estero');
        $manager->persist($provincia21);
        $manager->flush();
        $this->addReference('provincia-santiago', $provincia21);
        
             
        $provincia22 = new Provincia();
        $provincia22->setName('Tierra del Fuego');
        $manager->persist($provincia22);
        $manager->flush();
        $this->addReference('provincia-tierra', $provincia22);
        
             
        $provincia23 = new Provincia();
        $provincia23->setName('Tucumán');
        $manager->persist($provincia23);
        $manager->flush();
        $this->addReference('provincia-tucuman', $provincia23);
        
        
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 6; // the order in which fixtures will be loaded
    }
}


