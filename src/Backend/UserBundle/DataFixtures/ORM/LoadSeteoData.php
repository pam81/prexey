<?php 

namespace Backend\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Backend\UserBundle\Entity\Seteo;

class LoadSeteoData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $seteoAdmin = new Seteo();
        $seteoAdmin->setName('email');
        $seteoAdmin->setValue('info@prueba.com');

        $manager->persist($seteoAdmin);
        $manager->flush();
        $this->addReference('email', $seteoAdmin);
        
        $seteoAdmin2 = new Seteo();
        $seteoAdmin2->setName('empresa');
        $seteoAdmin2->setValue('logiteck');

        $manager->persist($seteoAdmin2);
        $manager->flush();
        $this->addReference('empresa', $seteoAdmin2);
        
        $seteoAdmin3 = new Seteo();
        $seteoAdmin3->setName('desvio');
        $seteoAdmin3->setValue('5');

        $manager->persist($seteoAdmin3);
        $manager->flush();
        $this->addReference('desvio', $seteoAdmin3);
        
        $seteoAdmin4 = new Seteo();
        $seteoAdmin4->setName('llegada');
        $seteoAdmin4->setValue('23:59');

        $manager->persist($seteoAdmin4);
        $manager->flush();
        $this->addReference('llegada', $seteoAdmin4);
        
        
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 4; // the order in which fixtures will be loaded
    }
}
