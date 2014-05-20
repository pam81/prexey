<?php 

namespace Backend\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Backend\UserBundle\Entity\Group;

class LoadGroupData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $groupAdmin = new Group();
        $groupAdmin->setName('Administrador de sistemas');
        $groupAdmin->setRole('ROLE_ADMIN');
        $groupAdmin->addAcceso($this->getReference('add-user'));
        $groupAdmin->addAcceso($this->getReference('mod-user'));
        $groupAdmin->addAcceso($this->getReference('del-user'));
        $groupAdmin->addAcceso($this->getReference('view-user'));
        $groupAdmin->addAcceso($this->getReference('seteos'));
        $groupAdmin->addAcceso($this->getReference('add-camion'));
        $groupAdmin->addAcceso($this->getReference('mod-camion'));
        $groupAdmin->addAcceso($this->getReference('del-camion'));
        $groupAdmin->addAcceso($this->getReference('view-camion'));
        $groupAdmin->addAcceso($this->getReference('add-chofer'));
        $groupAdmin->addAcceso($this->getReference('mod-chofer'));
        $groupAdmin->addAcceso($this->getReference('del-chofer'));
        $groupAdmin->addAcceso($this->getReference('view-chofer'));
        $groupAdmin->addAcceso($this->getReference('add-cliente'));
        $groupAdmin->addAcceso($this->getReference('mod-cliente'));
        $groupAdmin->addAcceso($this->getReference('del-cliente'));
        $groupAdmin->addAcceso($this->getReference('view-cliente'));
        $groupAdmin->addAcceso($this->getReference('add-deposito'));
        $groupAdmin->addAcceso($this->getReference('mod-deposito'));
        $groupAdmin->addAcceso($this->getReference('del-deposito'));
        $groupAdmin->addAcceso($this->getReference('view-deposito'));
        $groupAdmin->addAcceso($this->getReference('view-repodtosueldo'));
        $groupAdmin->addAcceso($this->getReference('view-repoeficiencia'));
        $groupAdmin->addAcceso($this->getReference('view-repocashflow'));
        $groupAdmin->addAcceso($this->getReference('view-repocerrado'));
        $groupAdmin->addAcceso($this->getReference('view-repocostos'));
        $groupAdmin->addAcceso($this->getReference('view-repohruta'));
        $groupAdmin->addAcceso($this->getReference('view-repocaja'));
        $groupAdmin->addAcceso($this->getReference('view-caja'));
        $groupAdmin->addAcceso($this->getReference('new-caja'));
        $groupAdmin->addAcceso($this->getReference('del-caja'));
        $groupAdmin->addAcceso($this->getReference('view-viaje'));
        $groupAdmin->addAcceso($this->getReference('add-viaje'));
        $groupAdmin->addAcceso($this->getReference('mod-viaje'));
        $groupAdmin->addAcceso($this->getReference('del-viaje'));
        $groupAdmin->addAcceso($this->getReference('view-tipomovimiento'));
        $groupAdmin->addAcceso($this->getReference('add-tipomovimiento'));
        $groupAdmin->addAcceso($this->getReference('mod-tipomovimiento'));
        $groupAdmin->addAcceso($this->getReference('del-tipomovimiento'));
        $groupAdmin->addAcceso($this->getReference('view-tipocosto'));
        $groupAdmin->addAcceso($this->getReference('add-tipocosto'));
        $groupAdmin->addAcceso($this->getReference('mod-tipocosto'));
        $groupAdmin->addAcceso($this->getReference('del-tipocosto'));
        $groupAdmin->addAcceso($this->getReference('view-tipoviaje'));
        $groupAdmin->addAcceso($this->getReference('add-tipoviaje'));
        $groupAdmin->addAcceso($this->getReference('mod-tipoviaje'));
        $groupAdmin->addAcceso($this->getReference('del-tipoviaje'));
        $groupAdmin->addAcceso($this->getReference('view-empresa'));
        $groupAdmin->addAcceso($this->getReference('add-empresa'));
        $groupAdmin->addAcceso($this->getReference('mod-empresa'));
        $groupAdmin->addAcceso($this->getReference('del-empresa'));
        $groupAdmin->addAcceso($this->getReference('add-cajaempleado'));
        $groupAdmin->addAcceso($this->getReference('mod-cajaempleado'));
        $groupAdmin->addAcceso($this->getReference('del-cajaempleado'));
        $groupAdmin->addAcceso($this->getReference('view-cajaempleado'));
        $manager->persist($groupAdmin);
        $manager->flush();
        $this->addReference('admin-group', $groupAdmin);
        
        $groupAdmin2 = new Group();
        $groupAdmin2->setName('Operario');
        $groupAdmin2->setRole('ROLE_DEPOSITO');
        $groupAdmin2->addAcceso($this->getReference('view-caja'));
        $groupAdmin2->addAcceso($this->getReference('new-caja'));
        $groupAdmin2->addAcceso($this->getReference('view-viaje'));
        $groupAdmin2->addAcceso($this->getReference('add-viaje'));
        $groupAdmin2->addAcceso($this->getReference('mod-viaje'));
        $groupAdmin2->addAcceso($this->getReference('del-viaje'));
        $manager->persist($groupAdmin2);
        $manager->flush();
        $this->addReference('deposito-group', $groupAdmin2);
        
        $groupAdmin3 = new Group();
        $groupAdmin3->setName('Administrador de caja');
        $groupAdmin3->setRole('ROLE_CAJA');
        $groupAdmin3->addAcceso($this->getReference('view-caja'));
        $groupAdmin3->addAcceso($this->getReference('new-caja'));
        $groupAdmin3->addAcceso($this->getReference('del-caja'));
        $manager->persist($groupAdmin3);
        $manager->flush();
        $this->addReference('caja-group', $groupAdmin3);
        
        $groupAdmin4 = new Group();
        $groupAdmin4->setName('Reportes');
        $groupAdmin4->setRole('ROLE_REPORTE');
        $groupAdmin4->addAcceso($this->getReference('view-repodtosueldo'));
        $groupAdmin4->addAcceso($this->getReference('view-repoeficiencia'));
        $groupAdmin4->addAcceso($this->getReference('view-repocashflow'));
        $groupAdmin4->addAcceso($this->getReference('view-repocerrado'));
        $groupAdmin4->addAcceso($this->getReference('view-repocaja'));
        $groupAdmin4->addAcceso($this->getReference('view-repocostos'));
        $groupAdmin4->addAcceso($this->getReference('view-repohruta'));
        $manager->persist($groupAdmin4);
        $manager->flush();
        $this->addReference('reporte-group', $groupAdmin4);
        
        $groupAdmin5 = new Group();
        $groupAdmin5->setName('Visitante');
        $groupAdmin5->setRole('ROLE_VISITOR');
        $manager->persist($groupAdmin5);
        $manager->flush();
        $this->addReference('visitor-group', $groupAdmin5);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2; // the order in which fixtures will be loaded
    }
}
