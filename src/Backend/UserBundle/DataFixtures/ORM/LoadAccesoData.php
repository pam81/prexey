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
        $accesoAdmin13->setName('Borrar Sucursal');
        $accesoAdmin13->setAcceso('ROLE_DELSUCURSAL');
        $manager->persist($accesoAdmin13);
        $manager->flush();
        $this->addReference('del-sucursal', $accesoAdmin13);
        
        $accesoAdmin14 = new Acceso();
        $accesoAdmin14->setName('Nueva Marca');
        $accesoAdmin14->setAcceso('ROLE_ADDMARCA');
        $manager->persist($accesoAdmin14);
        $manager->flush();
        $this->addReference('add-marca', $accesoAdmin14);
        
        $accesoAdmin15 = new Acceso();
        $accesoAdmin15->setName('Listar Marcas');
        $accesoAdmin15->setAcceso('ROLE_VIEWMARCA');
        $manager->persist($accesoAdmin15);
        $manager->flush();
        $this->addReference('view-marca', $accesoAdmin15);
        
        $accesoAdmin16 = new Acceso();
        $accesoAdmin16->setName('Modificar Marca');
        $accesoAdmin16->setAcceso('ROLE_MODMARCA');
        $manager->persist($accesoAdmin16);
        $manager->flush();
        $this->addReference('mod-marca', $accesoAdmin16);
        
        $accesoAdmin17 = new Acceso();
        $accesoAdmin17->setName('Borrar Marca');
        $accesoAdmin17->setAcceso('ROLE_DELMARCA');
        $manager->persist($accesoAdmin17);
        $manager->flush();
        $this->addReference('del-marca', $accesoAdmin17);
        
        $accesoAdmin18 = new Acceso();
        $accesoAdmin18->setName('Nuevo Modelo');
        $accesoAdmin18->setAcceso('ROLE_ADDMODELO');
        $manager->persist($accesoAdmin18);
        $manager->flush();
        $this->addReference('add-modelo', $accesoAdmin18);
        
        $accesoAdmin19 = new Acceso();
        $accesoAdmin19->setName('Listar Modelos');
        $accesoAdmin19->setAcceso('ROLE_VIEWMODELO');
        $manager->persist($accesoAdmin19);
        $manager->flush();
        $this->addReference('view-modelo', $accesoAdmin19);
        
        $accesoAdmin20 = new Acceso();
        $accesoAdmin20->setName('Modificar Modelo');
        $accesoAdmin20->setAcceso('ROLE_MODMODELO');
        $manager->persist($accesoAdmin20);
        $manager->flush();
        $this->addReference('mod-modelo', $accesoAdmin20);
        
        $accesoAdmin21 = new Acceso();
        $accesoAdmin21->setName('Borrar Modelo');
        $accesoAdmin21->setAcceso('ROLE_DELMODELO');
        $manager->persist($accesoAdmin21);
        $manager->flush();
        $this->addReference('del-modelo', $accesoAdmin21);
        
        $accesoAdmin22= new Acceso();
        $accesoAdmin22->setName('Nuevo Sintoma');
        $accesoAdmin22->setAcceso('ROLE_ADDSINTOMA');
        $manager->persist($accesoAdmin22);
        $manager->flush();
        $this->addReference('add-sintoma', $accesoAdmin22);
        
        $accesoAdmin23 = new Acceso();
        $accesoAdmin23->setName('Listar Sintomas');
        $accesoAdmin23->setAcceso('ROLE_VIEWSINTOMA');
        $manager->persist($accesoAdmin23);
        $manager->flush();
        $this->addReference('view-sintoma', $accesoAdmin23);
        
        $accesoAdmin24 = new Acceso();
        $accesoAdmin24->setName('Modificar Sintoma');
        $accesoAdmin24->setAcceso('ROLE_MODSINTOMA');
        $manager->persist($accesoAdmin24);
        $manager->flush();
        $this->addReference('mod-sintoma', $accesoAdmin24);
        
        $accesoAdmin25 = new Acceso();
        $accesoAdmin25->setName('Borrar Sintoma');
        $accesoAdmin25->setAcceso('ROLE_DELSINTOMA');
        $manager->persist($accesoAdmin25);
        $manager->flush();
        $this->addReference('del-sintoma', $accesoAdmin25);
        
        $accesoAdmin26= new Acceso();
        $accesoAdmin26->setName('Nueva Provincia');
        $accesoAdmin26->setAcceso('ROLE_ADDPROVINCIA');
        $manager->persist($accesoAdmin26);
        $manager->flush();
        $this->addReference('add-provincia', $accesoAdmin26);
        
        $accesoAdmin27 = new Acceso();
        $accesoAdmin27->setName('Listar Provincias');
        $accesoAdmin27->setAcceso('ROLE_VIEWPROVINCIA');
        $manager->persist($accesoAdmin27);
        $manager->flush();
        $this->addReference('view-provincia', $accesoAdmin27);
        
        $accesoAdmin28 = new Acceso();
        $accesoAdmin28->setName('Modificar Provincia');
        $accesoAdmin28->setAcceso('ROLE_MODPROVINCIA');
        $manager->persist($accesoAdmin28);
        $manager->flush();
        $this->addReference('mod-provincia', $accesoAdmin28);
        
        $accesoAdmin29 = new Acceso();
        $accesoAdmin29->setName('Borrar Provincia');
        $accesoAdmin29->setAcceso('ROLE_DELPROVINCIA');
        $manager->persist($accesoAdmin29);
        $manager->flush();
        $this->addReference('del-provincia', $accesoAdmin29);
        
        $accesoAdmin30= new Acceso();
        $accesoAdmin30->setName('Nueva Zona');
        $accesoAdmin30->setAcceso('ROLE_ADDZONA');
        $manager->persist($accesoAdmin30);
        $manager->flush();
        $this->addReference('add-zona', $accesoAdmin30);
        
        $accesoAdmin31 = new Acceso();
        $accesoAdmin31->setName('Listar Zonas');
        $accesoAdmin31->setAcceso('ROLE_VIEWZONA');
        $manager->persist($accesoAdmin31);
        $manager->flush();
        $this->addReference('view-zona', $accesoAdmin31);
        
        $accesoAdmin32 = new Acceso();
        $accesoAdmin32->setName('Modificar Zona');
        $accesoAdmin32->setAcceso('ROLE_MODZONA');
        $manager->persist($accesoAdmin32);
        $manager->flush();
        $this->addReference('mod-zona', $accesoAdmin32);
        
        $accesoAdmin33 = new Acceso();
        $accesoAdmin33->setName('Borrar Zona');
        $accesoAdmin33->setAcceso('ROLE_DELZONA');
        $manager->persist($accesoAdmin33);
        $manager->flush();
        $this->addReference('del-zona', $accesoAdmin33);
        
        $accesoAdmin34= new Acceso();
        $accesoAdmin34->setName('Nuevo Artículo');
        $accesoAdmin34->setAcceso('ROLE_ADDARTICULO');
        $manager->persist($accesoAdmin34);
        $manager->flush();
        $this->addReference('add-articulo', $accesoAdmin34);
        
        $accesoAdmin35 = new Acceso();
        $accesoAdmin35->setName('Listar Artículos');
        $accesoAdmin35->setAcceso('ROLE_VIEWARTICULO');
        $manager->persist($accesoAdmin35);
        $manager->flush();
        $this->addReference('view-articulo', $accesoAdmin35);
        
        $accesoAdmin36 = new Acceso();
        $accesoAdmin36->setName('Modificar Artículo');
        $accesoAdmin36->setAcceso('ROLE_MODARTICULO');
        $manager->persist($accesoAdmin36);
        $manager->flush();
        $this->addReference('mod-articulo', $accesoAdmin36);
        
        $accesoAdmin37 = new Acceso();
        $accesoAdmin37->setName('Borrar Artículo');
        $accesoAdmin37->setAcceso('ROLE_DELARTICULO');
        $manager->persist($accesoAdmin37);
        $manager->flush();
        $this->addReference('del-articulo', $accesoAdmin37);
        
        $accesoAdmin38= new Acceso();
        $accesoAdmin38->setName('Nuevo Tipo Artículo');
        $accesoAdmin38->setAcceso('ROLE_ADDTIPOARTICULO');
        $manager->persist($accesoAdmin38);
        $manager->flush();
        $this->addReference('add-tipo-articulo', $accesoAdmin38);
        
        $accesoAdmin39 = new Acceso();
        $accesoAdmin39->setName('Listar Tipo Artículos');
        $accesoAdmin39->setAcceso('ROLE_VIEWTIPOARTICULO');
        $manager->persist($accesoAdmin39);
        $manager->flush();
        $this->addReference('view-tipo-articulo', $accesoAdmin39);
        
        $accesoAdmin40 = new Acceso();
        $accesoAdmin40->setName('Modificar Tipo Artículo');
        $accesoAdmin40->setAcceso('ROLE_MODTIPOARTICULO');
        $manager->persist($accesoAdmin40);
        $manager->flush();
        $this->addReference('mod-tipo-articulo', $accesoAdmin40);
        
        $accesoAdmin41 = new Acceso();
        $accesoAdmin41->setName('Borrar Tipo Artículo');
        $accesoAdmin41->setAcceso('ROLE_DELTIPOARTICULO');
        $manager->persist($accesoAdmin41);
        $manager->flush();
        $this->addReference('del-tipo-articulo', $accesoAdmin41);
        
		$accesoAdmin42= new Acceso();
        $accesoAdmin42->setName('Nuevo Tipo Orden Ingreso');
        $accesoAdmin42->setAcceso('ROLE_ADDTIPOORDENING');
        $manager->persist($accesoAdmin42);
        $manager->flush();
        $this->addReference('add-tipo-orden-ingreso', $accesoAdmin42);
        
        $accesoAdmin43 = new Acceso();
        $accesoAdmin43->setName('Listar Tipo Ordenes Ingreso');
        $accesoAdmin43->setAcceso('ROLE_VIEWTIPOORDENING');
        $manager->persist($accesoAdmin43);
        $manager->flush();
        $this->addReference('view-tipo-orden-ingreso', $accesoAdmin43);
        
        $accesoAdmin44 = new Acceso();
        $accesoAdmin44->setName('Modificar Tipo Orden Ingreso');
        $accesoAdmin44->setAcceso('ROLE_MODTIPOORDENING');
        $manager->persist($accesoAdmin44);
        $manager->flush();
        $this->addReference('mod-tipo-orden-ingreso', $accesoAdmin44);
        
        $accesoAdmin45 = new Acceso();
        $accesoAdmin45->setName('Borrar Tipo Orden Ingreso');
        $accesoAdmin45->setAcceso('ROLE_DELTIPOORDENING');
        $manager->persist($accesoAdmin45);
        $manager->flush();
        $this->addReference('del-tipo-orden-ingreso', $accesoAdmin45);        
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}
