<?php

namespace Backend\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Backend\AdminBundle\Entity\Caja;
use Backend\AdminBundle\Form\CajaType;

/**
 * Caja controller.
 *
 */
class CajaController extends Controller
{

    public function generateSQL(Request $request){
      
      $search=array("date_desde"=>'',"date_hasta"=>'',"chofer"=>'',"viaje"=>'',"monto"=>'');
   
        
        $dql="SELECT u FROM BackendAdminBundle:Caja u JOIN u.chofer c LEFT JOIN u.viaje v where u.isDelete=false ";
    
        if (!$request->query->get("clear-filter")){           
           if ($request->query->get("chofer"))
          {  $search["chofer"]=$request->query->get("chofer");
             $dql .= " and  c.name like '%".$search["chofer"]."%' or c.lastname like '%".$search["chofer"]." %' ";
           }
         
         if ($request->query->get("date_desde") && $request->query->get("date_hasta"))
        {    $search["date_desde"]= date("Y-m-d",strtotime($request->query->get("date_desde")));
             $search["date_hasta"]= date("Y-m-d",strtotime($request->query->get("date_hasta")));
            $dql .= " and (u.fecha between '".$search["date_desde"]."' and '".$search["date_hasta"]."' )"; 
        }
        elseif ($request->query->get("date_desde"))
           {
             $search["date_desde"]= date("Y-m-d",strtotime($request->query->get("date_desde")));
             $dql .=" and u.fecha >= '".$search["date_desde"]."' "; 
           }
        elseif ($request->query->get("date_hasta"))
        {
             $search["date_hasta"]= date("Y-m-d",strtotime($request->query->get("date_hasta")));
             $dql .=" and u.fecha <= '".$search["date_hasta"]."' ";
        }
        
         if ($request->query->get("monto"))
         {
           $search["monto"]=$request->query->get("monto");
            $dql .= " and u.monto=".$search["monto"];
         }
         
           if ($request->query->get("viaje"))
         {
           $search["viaje"]=$request->query->get("viaje");
            $dql .= " and v.id=".$search["viaje"];
         }
         }                  
        $dql .=" order by u.fecha desc";
        $search["dql"]=$dql;
        
        return $search;
                    
    }
    
    
    /**
     * Lists all Caja entities.
     *
     */
    public function indexAction(Request $request)
    {   
         if ( $this->get('security.context')->isGranted('ROLE_CAJAEMPLEADO')) {
        $em = $this->getDoctrine()->getManager();
        $search= $this->generateSQL($request);
           
        $query = $em->createQuery($search["dql"]);
        
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
        $query,
        $this->get('request')->query->get('page', 1)/*page number*/,
        $this->container->getParameter('max_on_listepage')/*limit per page*/
    );
        
        $deleteForm = $this->createDeleteForm(0);
        return $this->render('BackendAdminBundle:Caja:index.html.twig', 
        array('pagination' => $pagination,
        'delete_form' => $deleteForm->createView(),
        'search'=>$search
        ));
        
    }
     else
         throw new AccessDeniedException();
    }
    /**
     * Creates a new Caja entity.
     *
     */
    public function createAction(Request $request)
    {
        if ( $this->get('security.context')->isGranted('ROLE_ADDCAJAEMPLEADO')) {
        $entity  = new Caja();
        $entity->setUsuario($this->getUser());
        $form = $this->createForm(new CajaType($this->get('security.context')), $entity);
        $form->bind($request);
         
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success' , 'Se ha agregado un nuevo movimiento.');
            return $this->redirect($this->generateUrl('caja_empleado'));
        }

        return $this->render('BackendAdminBundle:Caja:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
           
        ));
      }
      else
       throw new AccessDeniedException();
    }

    /**
    * Creates a form to create a Caja entity.
    *
    * @param Caja $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Caja $entity)
    {
        $form = $this->createForm(new CajaType(), $entity, array(
            'action' => $this->generateUrl('caja_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Caja entity.
     *
     */
    public function newAction()
    {
         if ( $this->get('security.context')->isGranted('ROLE_ADDCAJAEMPLEADO')) {
        $entity = new Caja();
        $entity->setUsuario($this->getUser());
        $form   = $this->createForm(new CajaType($this->get('security.context')), $entity);

        return $this->render('BackendAdminBundle:Caja:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
            
        ));
       }
       else
          throw new AccessDeniedException();
    }

     /**
     * Displays a form to create a new Caja entity.
     *
     */
    public function newPopupAction($id)
    {
         if ( $this->get('security.context')->isGranted('ROLE_ADDCAJAEMPLEADO')) {
        $em = $this->getDoctrine()->getManager();
        $viaje = $em->getRepository('BackendAdminBundle:Viaje')->find($id);
        
        $entity = new Caja();
        $entity->setViaje($viaje);
        $entity->setChofer($viaje->getChofer());
        $entity->setTipo("r");
        $entity->setUsuario($this->getUser());
        $form   = $this->createForm(new CajaType($this->get('security.context')), $entity);

        return $this->render('BackendAdminBundle:Caja:newpopup.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
            
        ));
       }
       else
          throw new AccessDeniedException();
    }
    
    public function createPopupAction(Request $request)
    {
        if ( $this->get('security.context')->isGranted('ROLE_ADDCAJAEMPLEADO')) {
        $entity  = new Caja();
        $entity->setUsuario($this->getUser());
        $form = $this->createForm(new CajaType($this->get('security.context')), $entity);
        $form->bind($request);
         
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success' , 'Se ha agregado un nuevo movimiento.');
            return $this->redirect($this->generateUrl('blank'));
        }

        return $this->render('BackendAdminBundle:Caja:newpopup.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
           
        ));
      }
      else
       throw new AccessDeniedException();
    }
    /**
    
    /**
     * Displays a form to edit an existing Caja entity.
     *
     */
    public function editAction($id)
    {
        if ( $this->get('security.context')->isGranted('ROLE_MODCAJAEMPLEADO')) { 
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendAdminBundle:Caja')->find($id);

        if (!$entity) {
            
             $this->get('session')->getFlashBag()->add('error' , 'No se ha encontrado el movimiento indicado .');
             return $this->redirect($this->generateUrl('caja_empleado'));
        }

        $editForm = $this->createForm(new CajaType($this->get('security.context')), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BackendAdminBundle:Caja:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            
        ));
      }
      else
         throw new AccessDeniedException(); 
    }

    /**
    * Creates a form to edit a Caja entity.
    *
    * @param Caja $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Caja $entity)
    {
        $form = $this->createForm(new CajaType(), $entity, array(
            'action' => $this->generateUrl('caja_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Caja entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        if ( $this->get('security.context')->isGranted('ROLE_MODCAJAEMPLEADO')) {  
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendAdminBundle:Caja')->find($id);

        if (!$entity) {
             $this->get('session')->getFlashBag()->add('error' , 'No se ha encontrado el movimiento indicado.');
             return $this->redirect($this->generateUrl('caja_empleado'));
        }

       $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new CajaType($this->get('security.context')), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
             $this->get('session')->getFlashBag()->add('success' , 'Se han actualizado los datos del movimiento .');
            return $this->redirect($this->generateUrl('caja_edit', array('id' => $id)));
        }

        return $this->render('BackendAdminBundle:Caja:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            
        ));
      }
      else
         throw new AccessDeniedException();
    }
    /**
     * Deletes a Caja entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        if ( $this->get('security.context')->isGranted('ROLE_DELCAJAEMPLEADO')) { 
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BackendAdminBundle:Caja')->find($id);

            if (!$entity) {
                $this->get('session')->getFlashBag()->add('error' , 'No se ha encontrado el movimiento indicado.');
             
            }
           else{
            // volver atras el movimiento del saldo
            
            $entity->deleteDeposito($this->getUser()); //baja lógica
            $em->persist($entity);
            $em->flush();
            $em->getRepository('BackendAdminBundle:Caja')->updateSaldoMovimiento($entity);
            $this->get('session')->getFlashBag()->add('success' , 'Se han borrado los datos del movimiento.');
            }
        }

        return $this->redirect($this->generateUrl('caja_empleado' ));
      }
      else
       throw new AccessDeniedException();
    }

    /**
     * Creates a form to delete a Caja entity by id.
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
    
     public function exportarAction(Request $request)
    {
     if ( $this->get('security.context')->isGranted('ROLE_CAJAEMPLEADO')) {
         
         $em = $this->getDoctrine()->getManager();

       
        $search=$this->generateSQL($request); 
           
       
        $query = $em->createQuery($search["dql"]);
        
        $excelService = $this->get('xls.service_xls5');
                         
                            
        $excelService->excelObj->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Fecha')
                    ->setCellValue('B1', 'Chofer')
                    ->setCellValue('C1', 'Viaje')
                    ->setCellValue('D1', 'Tipo')
                    ->setCellValue('E1', 'Monto')
                    ->setCellValue('F1', 'Motivo')
                    ;
                    
                  
        
        $resultados=$query->getResult();
        $i=2;
        foreach($resultados as $r)
        {
         
           $excelService->excelObj->setActiveSheetIndex(0)
                         ->setCellValue("A$i",$r->getFecha()->format("d-m-Y"))
                         ->setCellValue("B$i",$r->getChofer()->__toString())
                         ->setCellValue("C$i",$r->getViaje()->getId())
                         ->setCellValue("D$i",$r->getTipoName())
                         ->setCellValue("E$i",$r->getMonto())
                         ->setCellValue("F$i",$r->getMotivo())
                         ;
          $i++;
        }
                            
        $excelService->excelObj->getActiveSheet()->setTitle('Listado de Caja Empleado');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $excelService->excelObj->setActiveSheetIndex(0);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        
        $fileName="cajaempleado_".date("Ymd").".xls";
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
     
     public function descontarAction(Request $request){
       $resultado=array("message"=>'');
       try{
       $em = $this->getDoctrine()->getManager();
       $viaje = $em->getRepository('BackendAdminBundle:Viaje')->find($request->get("id"));
       $monto=$request->get("nafta")*$request->get("extra");
       $descuento = new Caja();
       $descuento->setTipo("e"); //descuento por eficiencia
       $descuento->setMonto($monto);
       $descuento->setViaje($viaje);
       $descuento->setUsuario($this->getUser());
       $descuento->setChofer($viaje->getChofer());
       $descuento->setMotivo("Supero Eficiencia Ideal: Litros extras:".$request->get("extra")."  - Combustible:".$request->get("nafta"));
       $em->persist($descuento);
       $em->flush();
       $resultado["message"]="Se agrego el descuento";
       }
       catch(\Exception $e){
          $resultado["message"]="Error No se pudo crear el descuento";
       }
       $response = new Response(json_encode($resultado));
      
      $response->headers->set('Content-Type', 'application/json');

      return $response;
     }
     
    
}
