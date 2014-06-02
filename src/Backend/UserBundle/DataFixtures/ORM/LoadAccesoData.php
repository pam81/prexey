<?php 

namespace Backend\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Backend\UserBundle\Entity\Acceso;

class LoadAccesoData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $accesoAdmin = new Acceso();
        $accesoAdmin->setName('Nuevo Usuario');
        $accesoAdmin->setAcceso('ROLE_ADDUSER');
        $manager->persist($accesoAdmin);
        $manager->flush();
        $this->addReference('add-user', $accesoAdmin);
        
        $accesoAdmin2 = new Acceso();
        $accesoAdmin2->setName('Modificar Usuario');
        $accesoAdmin2->setAcceso('ROLE_MODUSER');
        $manager->persist($accesoAdmin2);
        $manager->flush();
        $this->addReference('mod-user', $accesoAdmin2);

        $accesoAdmin3 = new Acceso();
        $accesoAdmin3->setName('Borrar Usuario');
        $accesoAdmin3->setAcceso('ROLE_DELUSER');
        $manager->persist($accesoAdmin3);
        $manager->flush();
        $this->addReference('del-user', $accesoAdmin3);
       
        $accesoAdmin4 = new Acceso();
        $accesoAdmin4->setName('Listar Usuarios');
        $accesoAdmin4->setAcceso('ROLE_VIEWUSER');
        $manager->persist($accesoAdmin4);
        $manager->flush();
        $this->addReference('view-user', $accesoAdmin4);
        
        $accesoAdmin5 = new Acceso();
        $accesoAdmin5->setName('Seteos de parámetros');
        $accesoAdmin5->setAcceso('ROLE_SETEO');
        $manager->persist($accesoAdmin5);
        $manager->flush();
        $this->addReference('seteos', $accesoAdmin5);
        
        
        
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}
