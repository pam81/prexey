<?php

namespace Backend\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Backend\AdminBundle\Entity\Viaje;
use Backend\AdminBundle\Entity\Hoja;
use Backend\AdminBundle\Form\ViajeType;
use Backend\AdminBundle\Form\RendirType;
use Backend\AdminBundle\Entity\Movimiento;
use Backend\AdminBundle\Entity\Costo;
use Backend\AdminBundle\Entity\Caja;

/**
 * Viaje controller.
 *
 */
class ViajeController extends Controller
{

     public function generateSQL(Request $request)
    {
        $dql="SELECT u FROM BackendAdminBundle:Viaje u JOIN u.camion c JOIN u.deposito d 
              JOIN u.chofer h JOIN u.estado e
              where u.isDelete=false";
        $search=array("query"=>'',"anulado"=>'',"excepcion"=>'');
        if ($request->query->get("query"))
         {  $search["query"]=$request->query->get("query");
            $dql .= " and (c.patente like '%".$search["query"]."%' or d.name like '%".$search["query"]."%' 
            or h.lastname like '%".$search["query"]."%' or h.name like '%".$search["query"]."%'
            or  e.texto like '%".$search["query"]."%'
            )";
         }
        if (!$request->query->get("anulado")){
            
            $dql .=" and e.code != 'ANULADO' ";
        }else{
            $search["anulado"]=$request->query->get("anulado");
        } 
        if ($request->query->get("excepcion")){
            $search["excepcion"]=$request->query->get("excepcion");
            $dql .=" and u.hasException = '1' ";
        } 
        
           
        if ( $this->get('security.context')->isGranted($this->container->getParameter('role_deposito')))
            $dql.="  and d.id = ".$this->getUser()->getDeposito()->getId();
               
        $dql .=" order by u.fecha_salida desc"; 
        $search["dql"]=$dql;
        return $search;
    
    }

    /**
     * Lists all Viaje entities.
     *
     */
    public function indexAction(Request $request)
    {
         if ( $this->get('security.context')->isGranted('ROLE_VIEWVIAJE')) {
        $em = $this->getDoctrine()->getManager();

        $search = $this->generateSQL($request);  
        $query = $em->createQuery($search["dql"]);
       
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
        $query,
        $this->get('request')->query->get('page', 1)/*page number*/,
        $this->container->getParameter('max_on_listepage')/*limit per page*/
    );
        
        $deleteForm = $this->createDeleteForm(0);
        return $this->render('BackendAdminBundle:Viaje:index.html.twig', 
        array('pagination' => $pagination,
        'delete_form' => $deleteForm->createView(),
        'search'=>$search
        ));
        
    }
     else
         throw new AccessDeniedException();
    }
   

    /**
    * Creates a form to create a Viaje entity.
    *
    * @param Viaje $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Viaje $entity)
    {
        $form = $this->createForm(new ViajeType(), $entity, array(
            'action' => $this->generateUrl('viaje_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }


    public function validate(Request $request,$entity){
       $valido=true;
        $em = $this->getDoctrine()->getManager();
       
       $form   = $this->createForm(new ViajeType($this->get('security.context')), $entity);
        
     
       $form->bind($request);
       
       $retorna=array("resultado"=>1,"message"=>'');
       $action=$request->request->get("action");
       $code="BORRADOR";
       if ($entity->getEstado())
         $code=$entity->getEstado()->getCode();
         
      if ($action == 'confirmar' && $code != 'RENDIDO'){
            $estado = $em->getRepository('BackendAdminBundle:Estado')->findOneByCode("PENDIENTE");
            $valido=$this->validatePendienteChofer($entity,$estado->getId());
            if (!$valido)
             { 
               $retorna["resultado"]=0;
               $retorna["message"]= "El chofer tiene un viaje PENDIENTE.";
             }  
            else
            {
              $valido=$this->validatePendienteCamion($entity,$estado->getId());
              if (!$valido)
               {  $retorna["resultado"]=0;
                  $retorna["message"]="El camión tiene un viaje PENDIENTE.";
               }
            } 
         
         }
       
       if ( $valido && !$form->isValid() )
       {    $retorna["resultado"]=0;
            $retorna["message"]="Error en el formulario.Verifique los datos ingresados.";
            $retorna["form"]= $form->getErrors();
          
       }
       return $retorna;
    
    }

    public function validateViajeAction(Request $request,$id){
      $em = $this->getDoctrine()->getManager();
      $entity = $em->getRepository('BackendAdminBundle:Viaje')->find($id);
      if (!$entity)
        $entity=new Viaje();
        
      $retorna=$this->validate($request,$entity); 
           
      $response = new Response(json_encode($retorna));
      
      $response->headers->set('Content-Type', 'application/json');

      return $response;     
    
    }

    /**
     * Displays a form to create a new Viaje entity.
     *
     */
    public function newAction(Request $request)
    {  
      if ( $this->get('security.context')->isGranted('ROLE_ADDVIAJE')) {
        $entity = new Viaje();
        $em = $this->getDoctrine()->getManager();
        $estado = $em->getRepository('BackendAdminBundle:Estado')->findOneByCode("BORRADOR");
        
        //el estado por default es BORRADOR
        $entity->setEstado($estado);
        //seteo el horario de llegada a la noche
        $horario_regreso = $em->getRepository('BackendUserBundle:Seteo')->findOneByName("llegada");
       
        if ($horario_regreso)
        { $hora=new \DateTime();
          $l=explode(":",$horario_regreso->getValue());
          $hora->setTime($l[0],$l[1]);
          $entity->setHoraRegreso($hora);
        }
        //seteo quien crea el viaje
        $entity->setCreatedBy($this->getUser());
        //solo si el usuario es un operario lo ingreso
        if (  $this->get('security.context')->isGranted($this->container->getParameter("role_deposito")) )
        {
          $entity->setOperario($this->getUser());
        }
        
        $form   =  $this->createForm(new ViajeType($this->get('security.context')), $entity);
        
        if ($request->getMethod() == 'POST')
       {
          
          try{
          
         
         $action=$request->request->get("action");
        
          
         $valido=false;
         $retorna=$this->validate($request,$entity);
         if ($retorna["resultado"]==1)
           $valido=true;
           
         $form->bind($request);
        
          if ($valido && $form->isValid()) {
          
          //CONFIRMAR => Cambia estado a PENDIENTE y hace movimientos de caja
          if ($action == 'confirmar')
          {
             $estado = $em->getRepository('BackendAdminBundle:Estado')->findOneByCode("PENDIENTE");
             $entity->setEstado($estado);
             $em->persist($entity);
             $em->flush();
             //egreso por el efectivo y por incorporación de dinero
             $this->crearEgreso($entity);
             
          }
          //ANULAR => Cambia estado por ANULADO no deshace movimientos de caja
          //porque al dar de alta recien no viene de un estado pendiente
          if ($action == 'anular')
          {
          $estado = $em->getRepository('BackendAdminBundle:Estado')->findOneByCode("ANULADO");
          $entity->setEstado($estado);
          }
           //BORRADOR => guarda todo solamente
          $em->persist($entity);
          $em->flush();
          //guardar hoja de ruta si hay cargada
          foreach($_POST as $k=>$v)
          {  //solo hay para agregar nuevos ya que es nuevo el viaje
             if (preg_match('/orden[0-9]*/',$k))
             {  
               $separa=split("orden",$k);
               $nro=$separa[1];
               $hoja= new Hoja();
               $hoja->setOrden($v);
               $hoja->setNumero($request->request->get("nro".$nro));
               $c=$em->getRepository('BackendAdminBundle:Cliente')->find($request->request->get("cl".$nro));
               $hoja->setCliente($c);
               $d=$em->getRepository('BackendAdminBundle:Deposito')->find($request->request->get("dp".$nro));
               $hoja->setDeposito($d);
               $ds=$em->getRepository('BackendAdminBundle:Deposito')->find($request->request->get("ds".$nro));
               $hoja->setDepositoSalida($ds);
               $hoja->setViaje($entity);
                $em->persist($hoja);
                $em->flush();  
             }
          }
            
            
            $this->get('session')->getFlashBag()->add('success' , ' Se ha creado un nuevo viaje.');
            return $this->redirect($this->generateUrl('viaje_edit', array('id' => $entity->getId())));
        }
        }
        catch(\Exception $e)
        {
         $this->get('session')->getFlashBag()->add('error' , ' No se ha podido crear el viaje.');
        } 
       }
           
        return $this->render('BackendAdminBundle:Viaje:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
           
            
        ));
       }
       else
          throw new AccessDeniedException();
    }

    public function validatePendienteChofer($entity, $estado_id)
    {   //quitar validacion para el admin
       if ( $this->get('security.context')->isGranted($this->container->getParameter('role_admin'))) 
          return true;
        
        $query = $this->getDoctrine()->getManager()->createQuery('Select v from BackendAdminBundle:Viaje v
           join v.chofer c
          where v.isDelete = :delete 
          and c.id = :chofer_id
          and v.estado = :estado_id
        ')
         ->setParameter("delete",false)
         ->setParameter("chofer_id",$entity->getChofer()->getId())
         ->setParameter("estado_id",$estado_id);
        
      $pendiente=$query->getOneOrNullResult();   
       if ($pendiente)
       { 
         if ($pendiente->getId() == $entity->getId())
           return true;
         else
           return false;
        } 
       else
         return true; 
    
    }
    
    public function validatePendienteCamion($entity, $estado_id)
    {    //quitar validacion para el admin
        if ( $this->get('security.context')->isGranted($this->container->getParameter('role_admin'))) 
          return true;
          
        $query = $this->getDoctrine()->getManager()->createQuery('Select v from BackendAdminBundle:Viaje v
           join v.camion c
          where v.isDelete = :delete 
          and c.id = :camion_id
          and v.estado = :estado_id
        ')
         ->setParameter("delete",false)
         ->setParameter("camion_id",$entity->getCamion()->getId())
         ->setParameter("estado_id",$estado_id);
        
      $pendiente=$query->getOneOrNullResult();   
       if ($pendiente)
       { if ($pendiente->getId() == $entity->getId())
           return true;
         else
         return false;
       }  
       else
         return true; 
    
    }

    public function getClientesAction(Request $request)
    {
      
      $clientes = $this->getDoctrine()->getRepository('BackendAdminBundle:Cliente')->findByIsDelete("false");
      
      $response = new Response(json_encode($clientes));
      
      $response->headers->set('Content-Type', 'application/json');

      return $response;
    }
    
     public function getHojaRutaAction(Request $request, $id)
    {
      
      $query =  $this->getDoctrine()->getManager()->createQuery("Select u from BackendAdminBundle:Hoja u 
         where u.viaje = $id  order by u.orden
      ");
      $resultado = $query->getResult();
      $destinos=array();
      foreach( $resultado as $r )
      {  $destino=array();
         $destino["id"]=$r->getId();
         $destino["orden"]=$r->getOrden();
         $destino["cliente"]=$r->getCliente()->getId();
         $destino["numero"]=$r->getNumero();
         $destino["deposito"]=$r->getDeposito()->getId();
         $destino["salida"]=$r->getDepositoSalida()->getId();
         $destinos[]= $destino;
      }
      $response = new Response(json_encode($destinos));
      
      $response->headers->set('Content-Type', 'application/json');

      return $response;
    }
    
    public function getDepositosAction(Request $request)
    {
     $cliente_id=$request->request->get("cliente");
     $depositos = $this->getDoctrine()->getRepository('BackendAdminBundle:Deposito')->findBy(array("cliente"=>$cliente_id,"isDelete"=>false));
     $response = new Response(json_encode($depositos));
      
      $response->headers->set('Content-Type', 'application/json');

      return $response;
    }
    
      public function getViajeAction(Request $request)
    {
     $id=$request->get("id");
     
     $viaje = $this->getDoctrine()->getRepository('BackendAdminBundle:Viaje')->find($id);
     $eficiencia_viaje = $viaje->getEficiencia();
     $ideal = $viaje->getCamion()->getEficienciaIdeal();
     $desvio =  $this->getDoctrine()->getRepository('BackendUserBundle:Seteo')->findOneByName("desvio"); 
     $limite = $ideal + (($ideal * $desvio->getValue()) / 100);
     $resultado=array();  //diferencia de eficiencia * km totales me da litros extras 
     $resultado["extra"]=($eficiencia_viaje - $limite) * ( $viaje->getKmRetorno() - $viaje->getKmCamion());
     $response = new Response(json_encode($resultado));
      
      $response->headers->set('Content-Type', 'application/json');

      return $response;
    }
    
     public function getViajeChoferAction(Request $request)
    {
     $chofer_id=$request->request->get("chofer");
     $viajes = $this->getDoctrine()->getRepository('BackendAdminBundle:Viaje')->findBy(array("chofer"=>$chofer_id,"isDelete"=>false));
     
      $resultado=array();
     foreach($viajes as $v){
          $resultado[]["id"]=$v->getId();
     
     }
     $response = new Response(json_encode($resultado));
      
      $response->headers->set('Content-Type', 'application/json');

      return $response;
    }
    
    public function getDepositosSalidaAction(Request $request)
    {
   
     $resultados = $this->getDoctrine()->getRepository('BackendAdminBundle:Deposito')->findBy(array("isDelete"=>false));
      $depositos = array();
     foreach($resultados as $r){
       $deposito = array();
       $deposito["id"]=$r->getId();
       $deposito["name"]=$r->getName();
       $deposito["cliente"]=$r->getCliente()->getId();
       $depositos[]=$deposito;
     }
     $response = new Response(json_encode($depositos));
      
      $response->headers->set('Content-Type', 'application/json');

      return $response;
    }
    //creo movimientos de caja del viaje
    //por efectivo e incorporacion de dinero
    public function crearEgreso($viaje)
    {
      $em = $this->getDoctrine()->getManager();
      $clase=$em->getRepository('BackendAdminBundle:TipoMovimiento')->findOneByCode("MOV3");
     
      $mov=new Movimiento();
      $mov->setMonto($viaje->getEfectivo());
      $mov->setRecibo($em->getRepository("BackendAdminBundle:Movimiento")->getNextRecibo());
      $mov->setMotivo("Efectivo asignado a viaje Nro: ".$viaje->getId());
      $mov->setClase($clase);
      $mov->setTipo("e");
      $mov->setUsuario($this->getUser());
      $mov->setDeposito($viaje->getDeposito());
      $mov->setViaje($viaje);
      $em->persist($mov);
      $em->flush();
      $incorpora=$viaje->getIncorporaDinero();
      if ($incorpora != 0){
        $mov=new Movimiento();
        $mov->setMonto($incorpora);
        $mov->setRecibo($em->getRepository("BackendAdminBundle:Movimiento")->getNextRecibo());
        $mov->setMotivo("Incorporación de Dinero a Viaje Nro: ".$viaje->getId());
        $mov->setClase($clase);
        $mov->setTipo("e");
        $mov->setUsuario($this->getUser());
        $mov->setDeposito($viaje->getDeposito());
        $mov->setViaje($viaje);
        $em->persist($mov);
        $em->flush();
      }
    }
    //actualizo los movimientos de caja
    //haciendo un egreso o ingreso segun si subio o baja el monto asignado al viaje
    public function updateMovCaja($viaje)
    {
      $em = $this->getDoctrine()->getManager();
      $movimientos =$viaje->getMovimientos();
      $total_viaje=0;
      foreach($movimientos as $m)
      {
        if (!$m->getIsDelete() ) {
          if ($m->getTipo() == "e")
             $total_viaje += $m->getMonto();
          else
               $total_viaje -= $m->getMonto(); 
        }
      }
      $total_update=$viaje->getEfectivo()+$viaje->getIncorporaDinero();
      $diferencia=$total_update - $total_viaje;
      if ($diferencia != 0){
      $em = $this->getDoctrine()->getManager();
      $clase=$em->getRepository('BackendAdminBundle:TipoMovimiento')->findOneByCode("MOV3");
      $tipo="i";
      if ($diferencia > 0) //egresa del deposito
          $tipo="e";
      
                
      $mov=new Movimiento();
        $mov->setMonto(abs($diferencia));
        $mov->setMotivo("Modificar Asignación de Dinero a Viaje Nro: ".$viaje->getId());
        $mov->setRecibo($em->getRepository("BackendAdminBundle:Movimiento")->getNextRecibo());
        $mov->setClase($clase);
        $mov->setTipo($tipo);
        $mov->setUsuario($this->getUser());
        $mov->setDeposito($viaje->getDeposito());
        $mov->setViaje($viaje);
        $em->persist($mov);
        $em->flush();
     }   
    
    }
    //borro logicamente movimientos del viaje
    public function anularMovCaja($viaje)
    {
      $em = $this->getDoctrine()->getManager();
       $movimientos =$viaje->getMovimientos(); //obtengo todos los movimientos
       foreach($movimientos as $m)
       {  //solo si el movimiento no esta previamente dado de baja
          if (!$m->getIsDelete() ) 
          {  $m->deleteDeposito($this->getUser()); //baja lógica
            $em->persist($m);
            $em->flush();
            $em->getRepository('BackendAdminBundle:Movimiento')->updateSaldoMovimiento($m);
          }  
       }
     
      
    }

     public function anularMovCajaEmpleado($viaje)
    {
      $em = $this->getDoctrine()->getManager();
       $movimientos =$viaje->getCajaempleado(); //obtengo todos los movimientos
       foreach($movimientos as $m)
       {  //solo si el movimiento no esta previamente dado de baja
          if (!$m->getIsDelete() ) 
          { $m->setIsDelete(true); //baja lógica
            $m->setDeleteBy($this->getUser());
            $m->setDeleteAt(new \DateTime('now'));
            $em->persist($m);
            $em->flush();
          
          }  
       }
     
      
    }
  

   public function updateAction(Request $request,$id)
   {
    if ( $this->get('security.context')->isGranted('ROLE_MODVIAJE')) { 
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendAdminBundle:Viaje')->find($id);

        if (!$entity) {
            
             $this->get('session')->getFlashBag()->add('error' , 'No se ha encontrado el viaje.');
             return $this->redirect($this->generateUrl('viaje'));
        }

        $editForm = $this->createForm(new ViajeType($this->get('security.context')), $entity);
        
       
        
          if ($request->getMethod() == 'POST')
          {
       
          
          try{
          $action=$request->request->get("action");
          
         $valido=false;
         $retorna=$this->validate($request,$entity);
         if ($retorna["resultado"]==1)
           $valido=true;
           
         $editForm->bind($request);


              if ($valido && $editForm->isValid()) {
              
              //BORRADOR => guardar los datos solamente
              //CONFIRMAR => pasar estado a PENDIENTE hacer/actualizar movimientos caja
              
               
          
              if ($action == 'confirmar')
              {
                 //si ya fue RENDIDO no debe volver a estado PENDIENTE
                 $code=$entity->getEstado()->getCode();
                 if ($code != "RENDIDO"){
                   $estado = $em->getRepository('BackendAdminBundle:Estado')->findOneByCode("PENDIENTE");
                   $entity->setEstado($estado);
                 }
                 $em->persist($entity);
                 $em->flush();
                 $this->updateMovCaja($entity);
                 
              }
              //ANULAR => pasar a ANULADO y deshacer movimientos caja
              if ($action == 'anular')
              {
              $estado = $em->getRepository('BackendAdminBundle:Estado')->findOneByCode("ANULADO");
              $entity->setEstado($estado);
              $em->persist($entity);
              $em->flush();
              $this->anularMovCaja($entity);
              
              }
          
          //actualizar hoja de ruta
          
          
          $this->actualizarHojaRuta($request,$entity);
          
                  $em->persist($entity);
                  $em->flush();
                   $this->get('session')->getFlashBag()->add('success' , 'Se ha actualizado el viaje.');
               return $this->redirect($this->generateUrl('viaje_edit', array('id' => $id)));      
            } 
            }  
            catch(\Exception $e)
            {
            $this->get('session')->getFlashBag()->add('error' , 'No se ha  podido actualizar el viaje.');
            }   
              
        }                             
        
        return $this->render('BackendAdminBundle:Viaje:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            
        ));
      }
      else
         throw new AccessDeniedException(); 
    
    }
   
   /**
     * Displays a form to edit an existing Viaje entity.
     *
     */
    public function editAction(Request $request,$id)
    {
        if ( $this->get('security.context')->isGranted('ROLE_MODVIAJE')) { 
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendAdminBundle:Viaje')->find($id);

        if (!$entity) {
            
             $this->get('session')->getFlashBag()->add('error' , 'No se ha encontrado el viaje.');
             return $this->redirect($this->generateUrl('viaje'));
        }

        $editForm = $this->createForm(new ViajeType($this->get('security.context')), $entity);
        
        
        return $this->render('BackendAdminBundle:Viaje:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            
        ));
      }
      else
         throw new AccessDeniedException(); 
    }

  public function actualizarHojaRuta($request,$viaje)
  {
     $em = $this->getDoctrine()->getManager();
     $borrar=explode(",",$request->request->get("del_tr"));
          foreach($borrar as $v){
          
          //Debo verificar que exista el id  
           if ($v != ''){
              $hoja=$em->getRepository('BackendAdminBundle:Hoja')->find($v);
              if ($hoja) 
              { $em->remove($hoja);
                $em->flush();
              }  
            }  
          }
          $variables =$request->request->all();


          foreach($variables as $k=>$v)
          {  //es uno que hay que agregar
             if (preg_match('/orden[0-9]*/',$k))
             {  
               $separa=explode("orden",$k);
               $nro=$separa[1];
               if ($request->request->get("hoja".$nro)){ //modifico
                $hoja=$em->getRepository('BackendAdminBundle:Hoja')->find($request->request->get("hoja".$nro));  
                }
               else //agrego nueva hoja
               $hoja= new Hoja();
               
               $hoja->setOrden($v);
               $c=$em->getRepository('BackendAdminBundle:Cliente')->find($request->request->get("cl".$nro));
               $hoja->setCliente($c);
               $hoja->setNumero($request->request->get("nro".$nro));
               $d=$em->getRepository('BackendAdminBundle:Deposito')->find($request->request->get("dp".$nro));
               $hoja->setDeposito($d);
               $ds=$em->getRepository('BackendAdminBundle:Deposito')->find($request->request->get("ds".$nro));
               $hoja->setDepositoSalida($ds);
               $hoja->setViaje($viaje);
                $em->persist($hoja);
                $em->flush();  
             }
          }
  
  }

public function actualizarCostos($request,$viaje)
  {        
     $em = $this->getDoctrine()->getManager();
     $borrar=explode(",",$request->request->get("del_tc"));
          foreach($borrar as $v){
          
          //Debo verificar que exista el id  
           if ($v != ''){
              $costo=$em->getRepository('BackendAdminBundle:Costo')->find($v);
              if ($costo) 
              { 
                 $resultado=$em->getRepository('BackendAdminBundle:Caja')->findByCosto($costo->getId());
              
                if (isset($resultado[0]))
                  $em->remove($resultado[0]); //LO BORRO O PONGO COMO BORRADO
                  
                $em->remove($costo);
                $em->flush(); //TODO hay que borrar el descuento si se borra el costo? Porque no hay link
                
              }  
            }  
          }
          $variables =$request->request->all();


          foreach($variables as $k=>$v)
          {  //es uno que hay que agregar
             if (preg_match('/tipo[0-9]*/',$k))
             {    
               $separa=explode("tipo",$k);
               $nro=$separa[1];
               if ($request->request->get("costo".$nro)){ //modifico
                $costo=$em->getRepository('BackendAdminBundle:Costo')->find($request->request->get("costo".$nro));  
                }
               else //agrego nuevo costo
               $costo= new Costo();
               
               $t=$em->getRepository('BackendAdminBundle:TipoCosto')->find($request->request->get("tipo".$nro)); 
               $costo->setTipo($t);
               $costo->setRecibo($request->request->get("recibo".$nro));
               $costo->setConcepto($request->request->get("concepto".$nro));
               $costo->setMonto($request->request->get("monto".$nro));
               $costo->setViaje($viaje);
               if ($request->request->get("aprobado".$nro))
                 $costo->setIsAprobado(true);
               else{   
                $costo->setIsAprobado(false);
               
               }
              
               $em->persist($costo);
               $em->flush();
               if (!$costo->getIsAprobado()){
                  $this->generateDescuento($costo);
               } 
             }
          }
  
  }

  public function generateDescuento($costo){
     $em = $this->getDoctrine()->getManager();
     //Verifico si existe o tengo que crear uno nuevo
      
         
           
    $resultado=$em->getRepository('BackendAdminBundle:Caja')->findByCosto($costo->getId());
    $descuento=0;    
     if (!isset($resultado[0])){
        $descuento = new Caja();
       
     }else{
      $descuento = $resultado[0];
     }
     $descuento->setTipo("d");
     $descuento->setViaje($costo->getViaje());
     $descuento->setMonto($costo->getMonto());
     $descuento->setChofer($costo->getViaje()->getChofer());
     $descuento->setMotivo("Costo No Aprobado ".$costo->getTipo()->getTexto());
     $descuento->setCosto($costo);
     $descuento->setUsuario($this->getUser());
     $em->persist($descuento);
     $em->flush();
  
  }
  
  public function generateReintegroCaja($viaje){
     $em = $this->getDoctrine()->getManager();
     //Verifico si existe o tengo que crear uno nuevo
           
    $resultado=$em->getRepository('BackendAdminBundle:Caja')->findBy(array("viaje"=>$viaje->getId(),"tipo"=>"t"));
    $reintegro=0;    
     if (!isset($resultado[0])){
        $reintegro = new Caja();
       
     }else{
      $reintegro = $resultado[0];
     }
     $reintegro->setTipo("t");
     $reintegro->setViaje($viaje);
     $reintegro->setMonto($viaje->getEfectivoCaja());
     $reintegro->setChofer($viaje->getChofer());
     $reintegro->setMotivo("Reintegro automático por viaje nº".$viaje->getId());
     $reintegro->setUsuario($this->getUser());
     
     $em->persist($reintegro);
     $em->flush();
  
  }

    /**
    * Creates a form to edit a Viaje entity.
    *
    * @param Viaje $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Viaje $entity)
    {
        $form = $this->createForm(new ViajeType(), $entity, array(
            'action' => $this->generateUrl('viaje_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
   
    /**
     * Deletes a Viaje entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        if ( $this->get('security.context')->isGranted('ROLE_DELVIAJE')) { 
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BackendAdminBundle:Viaje')->find($id);

            if (!$entity) {
                $this->get('session')->getFlashBag()->add('error' , 'No se ha encontrado el viaje.');
             
            }
           else{
            $entity->setIsDelete(true); //baja lógica
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success' , 'Se ha borrado el viaje.');
            }
        }

        return $this->redirect($this->generateUrl('viaje' ));
      }
      else
       throw new AccessDeniedException(); 
    }

    /**
     * Creates a form to delete a Viaje entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
         return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    
    

    
    public function validateRendirAction(Request $request,$id)
    {
      $em = $this->getDoctrine()->getManager();
      $entity = $em->getRepository('BackendAdminBundle:Viaje')->find($id); 
      $editForm = $this->createForm(new RendirType(), $entity);
      $editForm->bind($request);
      $retorna=array("resultado"=>1,"message"=>'');
      
      if (!$editForm->isValid()) {
        $retorna["resultado"]=0;
        $retorna["message"]="Error en el formulario. Verifique los datos ingresados.";
       
        $errors=array();
        foreach ($editForm->getErrors() as $key => $error) {
           
            $p=$error->getMessageParameters();
            
           
            $errors[] = $error->getMessage();
        }  
         
         
        $retorna["errores"]=$errors; 
      }
     
      $response = new Response(json_encode($retorna));
      
      $response->headers->set('Content-Type', 'application/json');

      return $response; 
      
    
    }
    
    public function rendirAction(Request $request,$id)
    {
    
     if ( $this->get('security.context')->isGranted('ROLE_MODVIAJE')) {
       $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendAdminBundle:Viaje')->find($id);

        if (!$entity) {
            
             $this->get('session')->getFlashBag()->add('error' , 'No se ha encontrado el viaje.');
             return $this->redirect($this->generateUrl('viaje'));
        }

        $editForm = $this->createForm(new RendirType(), $entity);
       
        $tipos = $this->getDoctrine()->getRepository('BackendAdminBundle:TipoCosto')->findAll();
       
      return $this->render('BackendAdminBundle:Viaje:rendir.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
          
           'tipos'=>$tipos,
          
            
        ));
     }
     else
         throw new AccessDeniedException(); 
    
    }
    
    public function saveRendirAction(Request $request,$id)
    {
      if ( $this->get('security.context')->isGranted('ROLE_MODVIAJE')) {
       $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendAdminBundle:Viaje')->find($id);

        if (!$entity) {
            
             $this->get('session')->getFlashBag()->add('error' , 'No se ha encontrado el viaje.');
             return $this->redirect($this->generateUrl('viaje'));
        }

        $editForm = $this->createForm(new RendirType(), $entity);
        $editForm->bind($request);
       
        $tipos = $this->getDoctrine()->getRepository('BackendAdminBundle:TipoCosto')->findAll();
        

         if ($editForm->isValid()) {
         try{
           $action=$request->request->get("action");
           if ($action == 'anular')
              {
              $estado = $em->getRepository('BackendAdminBundle:Estado')->findOneByCode("ANULADO");
              $entity->setEstado($estado);
              $em->persist($entity);
              $em->flush();
              $this->anularMovCaja($entity);
              $this->anularMovCajaEmpleado($entity);
              $this->get('session')->getFlashBag()->add('success' , 'Se ha anulado la rendición del viaje .');
              return $this->redirect($this->generateUrl('viaje'));
              }
            else{
           
               //lo paso a rendido
                $estado = $em->getRepository('BackendAdminBundle:Estado')->findOneByCode("RENDIDO");
                $entity->setEstado($estado);
                //calculo eficiencia del viaje
                $eficiencia=   $entity->getConsumido() / ($entity->getKmRetorno() - $entity->getKmCamion());
                $entity->setEficiencia($eficiencia);
                $em->persist($entity);
                $em->flush();
                //debo generar/actualizar movimientos de ingreso
                $this->ingresoRendido($entity);
                //debo guardar hoja de ruta 
                $this->actualizarHojaRuta($request,$entity);
                //debo guardar datos de costos
                $this->actualizarCostos($request,$entity);
                if ($entity->getEfectivoCaja())
                //registrar reintegro automatico
                { $this->generateReintegroCaja($entity); }
                $this->get('session')->getFlashBag()->add('success' , 'Se han actualizado los datos de rendición del viaje .');
                return $this->redirect($this->generateUrl('viaje_rendir', array('id' => $id)));
            }
            
         }
         catch(\Exception $e )
         {
           $this->get('session')->getFlashBag()->add('error' , 'No se han actualizado los datos de rendición del viaje .');
         } 
         }
      
      return $this->render('BackendAdminBundle:Viaje:rendir.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
           
            'tipos'=>$tipos,
           
        ));
       }
       else
         throw new AccessDeniedException(); 
    }
    
    
    public function ingresoRendido($viaje)
    { 
    //actualizar los movimientos 
     $em = $this->getDoctrine()->getManager();
      $clase=$em->getRepository('BackendAdminBundle:TipoMovimiento')->findOneByCode("MOV4");
     $movimientos=$viaje->getMovimientos();
     $total_rendido=0;
     $hay_movimiento=false;
     foreach($movimientos as $m)
     {   //si no esta borrado y es mov4 x rendicion
        if (!$m->getIsDelete() && $m->getClase()->getCode() == "MOV4")
        {
          //$total_rendido +=$m->getMonto();
           if ($m->getTipo() == "e")
             $total_rendido -= $m->getMonto();
          else
               $total_rendido += $m->getMonto(); 
          $hay_movimiento=true;
        }
     }
     if (!$hay_movimiento){ //no hay movimiento registrado previamente
      //si no hay efectivo retornado no creo el movimiento
      if ($viaje->getEfectivoRetornado() != 0)
      {
        $mov=new Movimiento();
        $mov->setMonto($viaje->getEfectivoRetornado());
        $mov->setRecibo($em->getRepository("BackendAdminBundle:Movimiento")->getNextRecibo());
        $mov->setMotivo("Efectivo retornado por viaje Nro: ".$viaje->getId());
        $mov->setClase($clase);
        $mov->setTipo("i");
        $mov->setUsuario($this->getUser());
        $mov->setDeposito($viaje->getDeposito());
        $mov->setViaje($viaje);
        $em->persist($mov);
        $em->flush();
      }
      $regreso=$viaje->getEfectivoRegreso();
      if ($regreso != 0){   //si no recibe efectivo por el viaje regreso no hay movimiento
      $mov=new Movimiento();
      $mov->setMonto($viaje->getEfectivoRegreso());
      $mov->setRecibo($em->getRepository("BackendAdminBundle:Movimiento")->getNextRecibo());
      $mov->setMotivo("Efectivo por regreso viaje Nro: ".$viaje->getId());
      $mov->setClase($clase);
      $mov->setTipo("i");
      $mov->setUsuario($this->getUser());
      $mov->setDeposito($viaje->getDeposito());
      $mov->setViaje($viaje);
      $em->persist($mov);
      $em->flush();
     } 
     if ($viaje->getEfectivoReintegro() != 0) //si se le entrega efectivo x reintegro
     {
      $mov=new Movimiento();
      $mov->setMonto($viaje->getEfectivoReintegro());
      $mov->setRecibo($em->getRepository("BackendAdminBundle:Movimiento")->getNextRecibo());
      $mov->setMotivo("Efectivo por reintegro viaje Nro: ".$viaje->getId());
      $mov->setClase($clase);
      $mov->setTipo("e");
      $mov->setUsuario($this->getUser());
      $mov->setDeposito($viaje->getDeposito());
      $mov->setViaje($viaje);
      $em->persist($mov);
      $em->flush(); 
     
     
     }
    } 
    else{
      $total= $viaje->getEfectivoRetornado() + $viaje->getEfectivoRegreso() - $viaje->getEfectivoReintegro();
      $diferencia=$total - $total_rendido;
      if ($diferencia != 0){
      
      $tipo="i";
      
      if ($diferencia < 0) //egresa del deposito
          $tipo="e";
         
      $mov=new Movimiento();
      $mov->setMonto(abs($diferencia));
      $mov->setRecibo($em->getRepository("BackendAdminBundle:Movimiento")->getNextRecibo());
      $mov->setMotivo("Modificacion Efectivo rendido viaje Nro: ".$viaje->getId());
      $mov->setClase($clase);
      $mov->setTipo($tipo);
      $mov->setUsuario($this->getUser());
      $mov->setDeposito($viaje->getDeposito());
      $mov->setViaje($viaje);
      $em->persist($mov);
      $em->flush();    
          
      }
    
    }
    
    
    }
      
      public function getTipoCostosAction(Request $request)
    {
      
      
      
      $tipos = $this->getDoctrine()->getRepository('BackendAdminBundle:TipoCosto')->findAll();
      
      
      $response = new Response(json_encode($tipos));
      
      $response->headers->set('Content-Type', 'application/json');

      return $response;
    }
    
    
    public function getPendientesAction(Request $request, $search)
    {
     if ( $this->get('security.context')->isGranted('ROLE_VIEWVIAJE')) {
        $em = $this->getDoctrine()->getManager();
         //busco los viajes cuyo estado es pendiente
        $dql="SELECT u FROM BackendAdminBundle:Viaje u JOIN u.estado e  
        JOIN u.camion c JOIN u.deposito d JOIN u.chofer h 
        where u.isDelete=false and e.code='PENDIENTE' ";
      if ($search)
           $dql .= " and (c.patente like '%$search%' or d.name like '%$search%' 
            or h.lastname like '%$search%' or h.name like '%$search%'
            
            )";
      
       if ( $this->get('security.context')->isGranted($this->container->getParameter('role_deposito')))
            $dql.="  and d.id = ".$this->getUser()->getDeposito()->getId();
      
        $dql .=" order by u.fecha_salida desc";   
        $query = $em->createQuery($dql);
        
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
        $query,
        $this->get('request')->query->get('page', 1)/*page number*/,
        $this->container->getParameter('max_on_listepage')/*limit per page*/
    );
        
        
        return $this->render('BackendAdminBundle:Viaje:panel.html.twig', 
        array('pagination' => $pagination,
              'search'=>$search
        ));
        
    }
     else
         throw new AccessDeniedException();
    
    }
    
   public function printViajeAction(Request $request, $id)
   {
    $em = $this->getDoctrine()->getManager();
      $entity = $em->getRepository('BackendAdminBundle:Viaje')->find($id);

      if (!$entity) {
          $this->get('session')->getFlashBag()->add('error' , 'No se ha encontrado el viaje indicado.');
          return $this->redirect($this->generateUrl('viaje' ));
      }
      else{
        require_once($this->get('kernel')->getRootDir().'/config/dompdf_config.inc.php');

        $dompdf = new \DOMPDF();
        $html= $this->renderView('BackendAdminBundle:Viaje:recibo_viaje.html.twig',
          array('entity'=>$entity)
        );
        $dompdf->load_html($html);
        $dompdf->render();
        $fileName="recibo_viaje_".$id.".pdf";
        $response= new Response($dompdf->output(), 200, array(
        	'Content-Type' => 'application/pdf; charset=utf-8'
        ));
        $response->headers->set('Content-Disposition', 'attachment;filename='.$fileName);
        return $response;
      }
   
   }
   
   public function printRendicionAction(Request $request , $id)
   {
      $em = $this->getDoctrine()->getManager();
      $entity = $em->getRepository('BackendAdminBundle:Viaje')->find($id);

      if (!$entity) {
          $this->get('session')->getFlashBag()->add('error' , 'No se ha encontrado el viaje indicado.');
          return $this->redirect($this->generateUrl('viaje' ));
      }
      else{
        require_once($this->get('kernel')->getRootDir().'/config/dompdf_config.inc.php');

        $dompdf = new \DOMPDF();
        $html= $this->renderView('BackendAdminBundle:Viaje:recibo_rendicion.html.twig',
          array('entity'=>$entity)
        );
        $dompdf->load_html($html);
        $dompdf->render();
        $fileName="recibo_rendicion_".$id.".pdf";
        $response= new Response($dompdf->output(), 200, array(
        	'Content-Type' => 'application/pdf; charset=utf-8'
        ));
        $response->headers->set('Content-Disposition', 'attachment;filename='.$fileName);
        return $response;    
        
      /*  return $this->render('BackendAdminBundle:Viaje:recibo_rendicion.html.twig', 
       array('entity'=>$entity)
              
        );*/ 
      }
   } 
    
    
     public function exportarAction(Request $request)
    {
     if ( $this->get('security.context')->isGranted('ROLE_VIEWVIAJE')) {
         
         $em = $this->getDoctrine()->getManager();

       
        $search=$this->generateSQL($request); 
           
       
        $query = $em->createQuery($search["dql"]);
        
        $excelService = $this->get('xls.service_xls5');
                         
                            
        $excelService->excelObj->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Cliente')
                    ->setCellValue('B1', 'Chofer')
                    ->setCellValue('C1', 'Acompañante')
                    ->setCellValue('D1', 'Camión')
                    ->setCellValue('E1', 'Acoplado')
                    ->setCellValue('F1', 'Depósito')
                    ->setCellValue('G1', 'Estado')
                    ->setCellValue('H1', 'Tipo Viaje')
                    ->setCellValue('I1', 'Km camión')
                    ->setCellValue('J1', 'Fecha salida')
                    ->setCellValue('K1', 'Hora salida')
                    ->setCellValue('L1', 'Fecha regreso')
                    ->setCellValue('M1', 'Hora regreso')
                    ->setCellValue('N1', 'Efectivo')
                    ->setCellValue('O1', 'Incorporación dinero')
                    ->setCellValue('P1', 'Observación')
                    ->setCellValue('Q1', 'Km retorno')
                    ->setCellValue('R1', 'Efectivo retornado')
                    ->setCellValue('S1', 'Efectivo reintegro')
                    ->setCellValue('T1', 'Efectivo regreso')
                    ->setCellValue('U1', 'Consumido')
                    ->setCellValue('V1', 'Eficiencia')
                    ->setCellValue('W1', 'Nº')
                    ;
                    
                  
        
        $resultados=$query->getResult();
        $i=2;
        foreach($resultados as $r)
        {
         
           $excelService->excelObj->setActiveSheetIndex(0)
                         ->setCellValue("A$i",$r->getCliente()->__toString())
                         ->setCellValue("B$i",$r->getChofer()->__toString())
                         
                         ->setCellValue("D$i",$r->getCamion()->__toString())
                         
                         ->setCellValue("F$i",$r->getDeposito()->__toString())
                         ->setCellValue("G$i",$r->getEstado()->__toString())
                         ->setCellValue("H$i",$r->getTipoViaje()->__toString())
                         ->setCellValue("I$i",$r->getKmCamion())
                         
                         ->setCellValue("N$i",$r->getEfectivo())
                         ->setCellValue("O$i",$r->getIncorporaDinero())
                         ->setCellValue("P$i",$r->getObservacion())
                         ->setCellValue("Q$i",$r->getKmRetorno())
                         ->setCellValue("R$i",$r->getEfectivoRetornado())
                         ->setCellValue("S$i",$r->getEfectivoReintegro())
                         ->setCellValue("T$i",$r->getEfectivoRegreso())
                         ->setCellValue("U$i",$r->getConsumido())
                         ->setCellValue("V$i",$r->getEficiencia())
                         ->setCellValue("W$i",$r->getId())
                         ;
           if ($r->getAcompaniante())
               $excelService->excelObj->setActiveSheetIndex(0)->setCellValue("C$i",$r->getAcompaniante()->__toString());
           if ($r->getAcoplado())
                $excelService->excelObj->setActiveSheetIndex(0)->setCellValue("E$i",$r->getAcoplado()->__toString());
           if ($r->getFechaSalida())
               $excelService->excelObj->setActiveSheetIndex(0)->setCellValue("J$i",$r->getFechaSalida()->format("d-m-Y"));                                                   
           if ($r->getHoraSalida())
                $excelService->excelObj->setActiveSheetIndex(0)->setCellValue("K$i",$r->getHoraSalida()->format("H:i"));
           if ($r->getFechaRegreso())     
                 $excelService->excelObj->setActiveSheetIndex(0)->setCellValue("L$i",$r->getFechaRegreso()->format("d-m-Y"));
           if ($r->getHoraRegreso())     
                   $excelService->excelObj->setActiveSheetIndex(0)->setCellValue("M$i",$r->getHoraRegreso()->format("H:i"));             
          $i++;
        }
                            
        $excelService->excelObj->getActiveSheet()->setTitle('Listado de Viajes');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $excelService->excelObj->setActiveSheetIndex(0);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('T')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('U')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('V')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('W')->setAutoSize(true);
        
        
        
        $fileName="viajes_".date("Ymd").".xls";
        //create the response
        $response = $excelService->getResponse();
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        //$response->headers->set('Content-Disposition', 'filename='.$fileName);
        echo header("Content-Disposition: attachment; filename=$fileName");
        // If you are using a https connection, you have to set those two headers and use sendHeaders() for compatibility with IE <9
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');
        $response->sendHeaders();
        return $response; 
        
        
        }
        else{
           throw new AccessDeniedException(); 
        }
     }
    

    
}
