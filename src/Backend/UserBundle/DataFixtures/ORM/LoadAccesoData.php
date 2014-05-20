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
        $accesoAdmin6->setName('Nuevo Camión');
        $accesoAdmin6->setAcceso('ROLE_ADDCAMION');
        $manager->persist($accesoAdmin6);
        $manager->flush();
        $this->addReference('add-camion', $accesoAdmin6);
        
        $accesoAdmin7 = new Acceso();
        $accesoAdmin7->setName('Modificar Camión');
        $accesoAdmin7->setAcceso('ROLE_MODCAMION');
        $manager->persist($accesoAdmin7);
        $manager->flush();
        $this->addReference('mod-camion', $accesoAdmin7);

        $accesoAdmin8 = new Acceso();
        $accesoAdmin8->setName('Borrar Camión');
        $accesoAdmin8->setAcceso('ROLE_DELCAMION');
        $manager->persist($accesoAdmin8);
        $manager->flush();
        $this->addReference('del-camion', $accesoAdmin8);
       
        $accesoAdmin9 = new Acceso();
        $accesoAdmin9->setName('Listar Camiones');
        $accesoAdmin9->setAcceso('ROLE_VIEWCAMION');
        $manager->persist($accesoAdmin9);
        $manager->flush();
        $this->addReference('view-camion', $accesoAdmin9);
        
        $accesoAdmin10 = new Acceso();
        $accesoAdmin10->setName('Nuevo Chofer');
        $accesoAdmin10->setAcceso('ROLE_ADDCHOFER');
        $manager->persist($accesoAdmin10);
        $manager->flush();
        $this->addReference('add-chofer', $accesoAdmin10);
        
        $accesoAdmin11 = new Acceso();
        $accesoAdmin11->setName('Modificar Chofer');
        $accesoAdmin11->setAcceso('ROLE_MODCHOFER');
        $manager->persist($accesoAdmin11);
        $manager->flush();
        $this->addReference('mod-chofer', $accesoAdmin11);

        $accesoAdmin12 = new Acceso();
        $accesoAdmin12->setName('Borrar Chofer');
        $accesoAdmin12->setAcceso('ROLE_DELCHOFER');
        $manager->persist($accesoAdmin12);
        $manager->flush();
        $this->addReference('del-chofer', $accesoAdmin12);
       
        $accesoAdmin13 = new Acceso();
        $accesoAdmin13->setName('Listar Choferes');
        $accesoAdmin13->setAcceso('ROLE_VIEWCHOFER');
        $manager->persist($accesoAdmin13);
        $manager->flush();
        $this->addReference('view-chofer', $accesoAdmin13);
        
        $accesoAdmin14 = new Acceso();
        $accesoAdmin14->setName('Nuevo Cliente');
        $accesoAdmin14->setAcceso('ROLE_ADDCLIENTE');
        $manager->persist($accesoAdmin14);
        $manager->flush();
        $this->addReference('add-cliente', $accesoAdmin14);
        
        $accesoAdmin15 = new Acceso();
        $accesoAdmin15->setName('Modificar Cliente');
        $accesoAdmin15->setAcceso('ROLE_MODCLIENTE');
        $manager->persist($accesoAdmin15);
        $manager->flush();
        $this->addReference('mod-cliente', $accesoAdmin15);

        $accesoAdmin16 = new Acceso();
        $accesoAdmin16->setName('Borrar Cliente');
        $accesoAdmin16->setAcceso('ROLE_DELCLIENTE');
        $manager->persist($accesoAdmin16);
        $manager->flush();
        $this->addReference('del-cliente', $accesoAdmin16);
       
        $accesoAdmin17 = new Acceso();
        $accesoAdmin17->setName('Listar Clientes');
        $accesoAdmin17->setAcceso('ROLE_VIEWCLIENTE');
        $manager->persist($accesoAdmin17);
        $manager->flush();
        $this->addReference('view-cliente', $accesoAdmin17);
        
        $accesoAdmin18 = new Acceso();
        $accesoAdmin18->setName('Nuevo Depósito');
        $accesoAdmin18->setAcceso('ROLE_ADDDEPOSITO');
        $manager->persist($accesoAdmin18);
        $manager->flush();
        $this->addReference('add-deposito', $accesoAdmin18);
        
        $accesoAdmin19 = new Acceso();
        $accesoAdmin19->setName('Modificar Depósito');
        $accesoAdmin19->setAcceso('ROLE_MODDEPOSITO');
        $manager->persist($accesoAdmin19);
        $manager->flush();
        $this->addReference('mod-deposito', $accesoAdmin19);

        $accesoAdmin20 = new Acceso();
        $accesoAdmin20->setName('Borrar Depósito');
        $accesoAdmin20->setAcceso('ROLE_DELDEPOSITO');
        $manager->persist($accesoAdmin20);
        $manager->flush();
        $this->addReference('del-deposito', $accesoAdmin20);
       
        $accesoAdmin21 = new Acceso();
        $accesoAdmin21->setName('Listar Depósitos');
        $accesoAdmin21->setAcceso('ROLE_VIEWDEPOSITO');
        $manager->persist($accesoAdmin21);
        $manager->flush();
        $this->addReference('view-deposito', $accesoAdmin21);
        
        $accesoAdmin22 = new Acceso();
        $accesoAdmin22->setName('Reporte Descuento de Sueldos');
        $accesoAdmin22->setAcceso('ROLE_REPODTOSUELDO');
        $manager->persist($accesoAdmin22);
        $manager->flush();
        $this->addReference('view-repodtosueldo', $accesoAdmin22);
        
        $accesoAdmin23 = new Acceso();
        $accesoAdmin23->setName('Reporte de Eficiencia');
        $accesoAdmin23->setAcceso('ROLE_REPOEFICIENCIA');
        $manager->persist($accesoAdmin23);
        $manager->flush();
        $this->addReference('view-repoeficiencia', $accesoAdmin23);
        
        $accesoAdmin24 = new Acceso();
        $accesoAdmin24->setName('Reporte Cashflow');
        $accesoAdmin24->setAcceso('ROLE_REPOCASHFLOW');
        $manager->persist($accesoAdmin24);
        $manager->flush();
        $this->addReference('view-repocashflow', $accesoAdmin24);
        
        $accesoAdmin25 = new Acceso();
        $accesoAdmin25->setName('Reporte Viajes Cerrados');
        $accesoAdmin25->setAcceso('ROLE_REPOCERRADO');
        $manager->persist($accesoAdmin25);
        $manager->flush();
        $this->addReference('view-repocerrado', $accesoAdmin25);
        
        $accesoAdmin26 = new Acceso();
        $accesoAdmin26->setName('Reporte Caja');
        $accesoAdmin26->setAcceso('ROLE_REPOCAJA');
        $manager->persist($accesoAdmin26);
        $manager->flush();
        $this->addReference('view-repocaja', $accesoAdmin26);
        
        $accesoAdmin27 = new Acceso();
        $accesoAdmin27->setName('Listado mov. caja');
        $accesoAdmin27->setAcceso('ROLE_VIEWCAJA');
        $manager->persist($accesoAdmin27);
        $manager->flush();
        $this->addReference('view-caja', $accesoAdmin27);
        
        $accesoAdmin28 = new Acceso();
        $accesoAdmin28->setName('Nuevo mov. caja');
        $accesoAdmin28->setAcceso('ROLE_ADDCAJA');
        $manager->persist($accesoAdmin28);
        $manager->flush();
        $this->addReference('new-caja', $accesoAdmin28);
        
        $accesoAdmin29 = new Acceso();
        $accesoAdmin29->setName('Borrar mov. caja');
        $accesoAdmin29->setAcceso('ROLE_DELCAJA');
        $manager->persist($accesoAdmin29);
        $manager->flush();
        $this->addReference('del-caja', $accesoAdmin29);
        
        $accesoAdmin30 = new Acceso();
        $accesoAdmin30->setName('Listado de Viajes');
        $accesoAdmin30->setAcceso('ROLE_VIEWVIAJE');
        $manager->persist($accesoAdmin30);
        $manager->flush();
        $this->addReference('view-viaje', $accesoAdmin30);
        
        $accesoAdmin31 = new Acceso();
        $accesoAdmin31->setName('Nuevo Viaje');
        $accesoAdmin31->setAcceso('ROLE_ADDVIAJE');
        $manager->persist($accesoAdmin31);
        $manager->flush();
        $this->addReference('add-viaje', $accesoAdmin31);
        
        $accesoAdmin32 = new Acceso();
        $accesoAdmin32->setName('Modificar Viaje');
        $accesoAdmin32->setAcceso('ROLE_MODVIAJE');
        $manager->persist($accesoAdmin32);
        $manager->flush();
        $this->addReference('mod-viaje', $accesoAdmin32);
        
        $accesoAdmin33 = new Acceso();
        $accesoAdmin33->setName('Borrar Viaje');
        $accesoAdmin33->setAcceso('ROLE_DELVIAJE');
        $manager->persist($accesoAdmin33);
        $manager->flush();
        $this->addReference('del-viaje', $accesoAdmin33);
        
        
        $accesoAdmin34 = new Acceso();
        $accesoAdmin34->setName('Listado Tipo Movimiento');
        $accesoAdmin34->setAcceso('ROLE_VIEWTIPOMOVIMIENTO');
        $manager->persist($accesoAdmin34);
        $manager->flush();
        $this->addReference('view-tipomovimiento', $accesoAdmin34);
        
        $accesoAdmin35 = new Acceso();
        $accesoAdmin35->setName('Nuevo Tipo Movimiento');
        $accesoAdmin35->setAcceso('ROLE_ADDTIPOMOVIMIENTO');
        $manager->persist($accesoAdmin35);
        $manager->flush();
        $this->addReference('add-tipomovimiento', $accesoAdmin35);
        
        $accesoAdmin36 = new Acceso();
        $accesoAdmin36->setName('Modificar Tipo Movimiento');
        $accesoAdmin36->setAcceso('ROLE_MODTIPOMOVIMIENTO');
        $manager->persist($accesoAdmin36);
        $manager->flush();
        $this->addReference('mod-tipomovimiento', $accesoAdmin36);
        
        $accesoAdmin37 = new Acceso();
        $accesoAdmin37->setName('Borrar Tipo Movimiento');
        $accesoAdmin37->setAcceso('ROLE_DELTIPOMOVIMIENTO');
        $manager->persist($accesoAdmin37);
        $manager->flush();
        $this->addReference('del-tipomovimiento', $accesoAdmin37);
        
        $accesoAdmin38 = new Acceso();
        $accesoAdmin38->setName('Listado Tipo Viaje');
        $accesoAdmin38->setAcceso('ROLE_VIEWTIPOVIAJE');
        $manager->persist($accesoAdmin38);
        $manager->flush();
        $this->addReference('view-tipoviaje', $accesoAdmin38);
        
        $accesoAdmin39 = new Acceso();
        $accesoAdmin39->setName('Nuevo Tipo Viaje');
        $accesoAdmin39->setAcceso('ROLE_ADDTIPOVIAJE');
        $manager->persist($accesoAdmin39);
        $manager->flush();
        $this->addReference('add-tipoviaje', $accesoAdmin39);
        
        $accesoAdmin40 = new Acceso();
        $accesoAdmin40->setName('Modificar Tipo Viaje');
        $accesoAdmin40->setAcceso('ROLE_MODTIPOVIAJE');
        $manager->persist($accesoAdmin40);
        $manager->flush();
        $this->addReference('mod-tipoviaje', $accesoAdmin40);
        
        $accesoAdmin41 = new Acceso();
        $accesoAdmin41->setName('Borrar Tipo Viaje');
        $accesoAdmin41->setAcceso('ROLE_DELTIPOVIAJE');
        $manager->persist($accesoAdmin41);
        $manager->flush();
        $this->addReference('del-tipoviaje', $accesoAdmin41);
        
        $accesoAdmin42 = new Acceso();
        $accesoAdmin42->setName('Listado Empresas');
        $accesoAdmin42->setAcceso('ROLE_VIEWEMPRESA');
        $manager->persist($accesoAdmin42);
        $manager->flush();
        $this->addReference('view-empresa', $accesoAdmin42);
        
        $accesoAdmin43 = new Acceso();
        $accesoAdmin43->setName('Nueva Empresa');
        $accesoAdmin43->setAcceso('ROLE_ADDEMPRESA');
        $manager->persist($accesoAdmin43);
        $manager->flush();
        $this->addReference('add-empresa', $accesoAdmin43);
        
        $accesoAdmin44 = new Acceso();
        $accesoAdmin44->setName('Modificar Empresa');
        $accesoAdmin44->setAcceso('ROLE_MODEMPRESA');
        $manager->persist($accesoAdmin44);
        $manager->flush();
        $this->addReference('mod-empresa', $accesoAdmin44);
        
        $accesoAdmin45 = new Acceso();
        $accesoAdmin45->setName('Borrar Empresa');
        $accesoAdmin45->setAcceso('ROLE_DELEMPRESA');
        $manager->persist($accesoAdmin45);
        $manager->flush();
        $this->addReference('del-empresa', $accesoAdmin45);
        
        $accesoAdmin46 = new Acceso();
        $accesoAdmin46->setName('Listado Tipo costo');
        $accesoAdmin46->setAcceso('ROLE_VIEWTIPOCOSTO');
        $manager->persist($accesoAdmin46);
        $manager->flush();
        $this->addReference('view-tipocosto', $accesoAdmin46);
        
        $accesoAdmin47 = new Acceso();
        $accesoAdmin47->setName('Nuevo Tipo Costo');
        $accesoAdmin47->setAcceso('ROLE_ADDTIPOCOSTO');
        $manager->persist($accesoAdmin47);
        $manager->flush();
        $this->addReference('add-tipocosto', $accesoAdmin47);
        
        $accesoAdmin48 = new Acceso();
        $accesoAdmin48->setName('Modificar Tipo Costo');
        $accesoAdmin48->setAcceso('ROLE_MODTIPOCOSTO');
        $manager->persist($accesoAdmin48);
        $manager->flush();
        $this->addReference('mod-tipocosto', $accesoAdmin48);
        
        $accesoAdmin49 = new Acceso();
        $accesoAdmin49->setName('Borrar Tipo Costo');
        $accesoAdmin49->setAcceso('ROLE_DELTIPOCOSTO');
        $manager->persist($accesoAdmin49);
        $manager->flush();
        $this->addReference('del-tipocosto', $accesoAdmin49);
        
        $accesoAdmin50 = new Acceso();
        $accesoAdmin50->setName('Reporte Costos');
        $accesoAdmin50->setAcceso('ROLE_REPOCOSTOS');
        $manager->persist($accesoAdmin50);
        $manager->flush();
        $this->addReference('view-repocostos', $accesoAdmin50);
        
        $accesoAdmin51 = new Acceso();
        $accesoAdmin51->setName('Reporte Hoja de Ruta');
        $accesoAdmin51->setAcceso('ROLE_REPOHRUTA');
        $manager->persist($accesoAdmin51);
        $manager->flush();
        $this->addReference('view-repohruta', $accesoAdmin51);
        
        $accesoAdmin52 = new Acceso();
        $accesoAdmin52->setName('Caja empleado');
        $accesoAdmin52->setAcceso('ROLE_CAJAEMPLEADO');
        $manager->persist($accesoAdmin52);
        $manager->flush();
        $this->addReference('view-cajaempleado', $accesoAdmin52);
        
        $accesoAdmin53 = new Acceso();
        $accesoAdmin53->setName('Nuevo Mov Caja Empleado');
        $accesoAdmin53->setAcceso('ROLE_ADDCAJAEMPLEADO');
        $manager->persist($accesoAdmin53);
        $manager->flush();
        $this->addReference('add-cajaempleado', $accesoAdmin53);
        
        $accesoAdmin54 = new Acceso();
        $accesoAdmin54->setName('Modificar Mov Caja Empleado');
        $accesoAdmin54->setAcceso('ROLE_MODCAJAEMPLEADO');
        $manager->persist($accesoAdmin54);
        $manager->flush();
        $this->addReference('mod-cajaempleado', $accesoAdmin54);
        
        $accesoAdmin55 = new Acceso();                                                               
        $accesoAdmin55->setName('Borrar Mov Caja Empleado');
        $accesoAdmin55->setAcceso('ROLE_DELCAJAEMPLEADO');
        $manager->persist($accesoAdmin55);
        $manager->flush();
        $this->addReference('del-cajaempleado', $accesoAdmin55);
        
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}
