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
        
        $accesoAdmin6 = new Acceso();
        $accesoAdmin6->setName('Nuevo Cliente');
        $accesoAdmin6->setAcceso('ROLE_ADDCLIENTE');
        $manager->persist($accesoAdmin6);
        $manager->flush();
        $this->addReference('add-cliente', $accesoAdmin6);
        
        $accesoAdmin7 = new Acceso();
        $accesoAdmin7->setName('Listar Clientes');
        $accesoAdmin7->setAcceso('ROLE_VIEWCLIENTE');
        $manager->persist($accesoAdmin7);
        $manager->flush();
        $this->addReference('view-cliente', $accesoAdmin7);
        
        $accesoAdmin8 = new Acceso();
        $accesoAdmin8->setName('Modificar Clientes');
        $accesoAdmin8->setAcceso('ROLE_MODCLIENTE');
        $manager->persist($accesoAdmin8);
        $manager->flush();
        $this->addReference('mod-cliente', $accesoAdmin8);
        
        $accesoAdmin9 = new Acceso();
        $accesoAdmin9->setName('Borrar Clientes');
        $accesoAdmin9->setAcceso('ROLE_DELCLIENTE');
        $manager->persist($accesoAdmin9);
        $manager->flush();
        $this->addReference('del-cliente', $accesoAdmin9);
        
        $accesoAdmin10 = new Acceso();
        $accesoAdmin10->setName('Nueva Sucursal');
        $accesoAdmin10->setAcceso('ROLE_ADDSUCURSAL');
        $manager->persist($accesoAdmin10);
        $manager->flush();
        $this->addReference('add-sucursal', $accesoAdmin10);
        
        $accesoAdmin11 = new Acceso();
        $accesoAdmin11->setName('Listar Sucursales');
        $accesoAdmin11->setAcceso('ROLE_VIEWSUCURSAL');
        $manager->persist($accesoAdmin11);
        $manager->flush();
        $this->addReference('view-sucursal', $accesoAdmin11);
        
        $accesoAdmin12 = new Acceso();
        $accesoAdmin12->setName('Modificar Sucursal');
        $accesoAdmin12->setAcceso('ROLE_MODSUCURSAL');
        $manager->persist($accesoAdmin12);
        $manager->flush();
        $this->addReference('mod-sucursal', $accesoAdmin12);
        
        $accesoAdmin13 = new Acceso();
        $accesoAdmin13->setName('Borrar Sucursl');
        $accesoAdmin13->setAcceso('ROLE_DELSUCURSAL');
        $manager->persist($accesoAdmin13);
        $manager->flush();
        $this->addReference('del-sucursal', $accesoAdmin13);
        
        
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}
