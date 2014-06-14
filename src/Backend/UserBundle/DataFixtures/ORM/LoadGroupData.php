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
        $groupAdmin->addAcceso($this->getReference('add-cliente'));
        $groupAdmin->addAcceso($this->getReference('mod-cliente'));
        $groupAdmin->addAcceso($this->getReference('del-cliente'));
        $groupAdmin->addAcceso($this->getReference('view-cliente'));
        $groupAdmin->addAcceso($this->getReference('add-sucursal'));
        $groupAdmin->addAcceso($this->getReference('mod-sucursal'));
        $groupAdmin->addAcceso($this->getReference('del-sucursal'));
        $groupAdmin->addAcceso($this->getReference('view-sucursal'));
        $manager->persist($groupAdmin);
        $manager->flush();
        $this->addReference('admin-group', $groupAdmin);
        
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
