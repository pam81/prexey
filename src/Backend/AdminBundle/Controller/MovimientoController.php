<?php

namespace Backend\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Backend\AdminBundle\Entity\Movimiento;
use Backend\AdminBundle\Form\MovimientoType;

/**
 * Movimiento controller.
 *
 */
class MovimientoController extends Controller
{

    /**
     * Lists all Movimiento entities.
     *
     */
    public function indexAction(Request $request)
    {   
         if ( $this->get('security.context')->isGranted('ROLE_VIEWCAJA')) {
        $em = $this->getDoctrine()->getManager();
        $search=array("query"=>'',"show_all"=>'');
        
        $dql="SELECT u FROM BackendAdminBundle:Movimiento u JOIN u.deposito d where u.isDelete=false";
        if (!$request->query->get("show_all")){
          $dql .= " and d.isSpecial = 1";
        }else{
           $search["show_all"]=$request->query->get("show_all");
        }  
        
        if ( $this->get('security.context')->isGranted($this->container->getParameter('role_deposito')))
            $dql.="  and d.id = ".$this->getUser()->getDeposito()->getId();
            
         if ($request->query->get("query"))
        {  $search["query"]=$request->query->get("query");
          $fecha=date("Y-m-d",strtotime($search["query"]));
          
          $tipo='';
          if (mb_convert_case($search["query"], MB_CASE_LOWER,"UTF-8") == 'ingreso')
             $tipo='i';
          if (mb_convert_case($search["query"], MB_CASE_LOWER,"UTF-8") == 'egreso')
             $tipo='e';
           $dql .= " and (u.fecha like '%$fecha%' or d.name like '%".$search["query"]."%' or u.monto='".$search["query"]."' or
                           u.tipo ='$tipo' or u.recibo='".$search["query"]."'  )";
         
         }                  
        $dql .=" order by u.recibo desc";   
        $query = $em->createQuery($dql);
        
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
        $query,
        $this->get('request')->query->get('page', 1)/*page number*/,
        $this->container->getParameter('max_on_listepage')/*limit per page*/
    );
        
        $deleteForm = $this->createDeleteForm(0);
        return $this->render('BackendAdminBundle:Movimiento:index.html.twig', 
        array('pagination' => $pagination,
        'delete_form' => $deleteForm->createView(),
        'search'=>$search
        ));
        
    }
     else
         throw new AccessDeniedException();
    }
    
    public function getSaldoCentralAction()
    {
      $em = $this->getDoctrine()->getManager();
      $deposito=$em->getRepository("BackendAdminBundle:Deposito")->findOneByIsSpecial(1);
      $saldo=0;
      if ($deposito)
        $saldo=$deposito->getSaldo(); 
      return $this->render('BackendAdminBundle:Movimiento:saldo_central.html.twig', 
        array('saldo' => $saldo
        ));
      
    }
    
    /**
     * Creates a new Movimiento entity.
     *
     */
    public function createAction(Request $request)
    {
        if ( $this->get('security.context')->isGranted('ROLE_ADDCAJA')) {
        $entity  = new Movimiento();
        $entity->setUsuario($this->getUser());
        $form = $this->createForm(new MovimientoType($this->get('security.context')), $entity);
        $form->bind($request);
         
        if ($form->isValid()) {
           $em = $this->getDoctrine()->getManager();
            if ($entity->getClase()->getCode() == "MOV1")
            {
               $entity->setTipo("e");
             }
            $entity->setRecibo($em->getRepository("BackendAdminBundle:Movimiento")->getNextRecibo());
            $em->persist($entity);
            $em->flush();
             // si es MOV1 => hacer otro movimiento en el deposito destino
            if ($entity->getClase()->getCode() == "MOV1")
            {
               
               $entity2= new Movimiento();
               $entity2->setDeposito($entity->getDepositoDestino());
               $entity2->setRecibo($em->getRepository("BackendAdminBundle:Movimiento")->getNextRecibo());
               $entity2->setMonto($entity->getMonto());
               $entity2->setClase($entity->getClase());
               $entity2->setTipo("i");
               $entity2->setUsuario($this->getUser());
               $entity2->setMotivo($entity->getMotivo());
               $em->persist($entity2);
               $em->flush();
            }
            
            
            $this->get('session')->getFlashBag()->add('success' , 'Se ha agregado un nuevo movimiento.');
            return $this->redirect($this->generateUrl('caja'));
        }
        
        

        return $this->render('BackendAdminBundle:Movimiento:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
           
        ));
      }
      else
       throw new AccessDeniedException();
    }

    /**
    * Creates a form to create a Movimiento entity.
    *
    * @param Movimiento $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Movimiento $entity)
    {
        $form = $this->createForm(new MovimientoType(), $entity, array(
            'action' => $this->generateUrl('movimiento_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Movimiento entity.
     *
     */
    public function newAction()
    {
         if ( $this->get('security.context')->isGranted('ROLE_ADDCAJA')) {
        $entity = new Movimiento();
        $entity->setUsuario($this->getUser());
        $form   = $this->createForm(new MovimientoType($this->get('security.context')), $entity);

        return $this->render('BackendAdminBundle:Movimiento:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
            
        ));
       }
       else
          throw new AccessDeniedException();
    }

    

    /**
     * Displays a form to edit an existing Movimiento entity.
     *
     */
  /*  public function editAction($id)
    {
        if ( $this->get('security.context')->isGranted('ROLE_MODCAJA')) { 
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendAdminBundle:Movimiento')->find($id);

        if (!$entity) {
            
             $this->get('session')->getFlashBag()->add('error' , 'No se ha encontrado el movimiento indicado.');
             return $this->redirect($this->generateUrl('caja'));
        }

        $editForm = $this->createForm(new MovimientoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BackendAdminBundle:Movimiento:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            
        ));
      }
      else
         throw new AccessDeniedException(); 
    }*/

    /**
    * Creates a form to edit a Movimiento entity.
    *
    * @param Movimiento $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
   /* private function createEditForm(Movimiento $entity)
    {
        $form = $this->createForm(new MovimientoType(), $entity, array(
            'action' => $this->generateUrl('movimiento_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }*/
    /**
     * Edits an existing Movimiento entity.
     *
     */
  /*  public function updateAction(Request $request, $id)
    {
        if ( $this->get('security.context')->isGranted('ROLE_MODCAJA')) {  
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendAdminBundle:Movimiento')->find($id);

        if (!$entity) {
             $this->get('session')->getFlashBag()->add('error' , 'No se ha encontrado el movimiento indicado.');
             return $this->redirect($this->generateUrl('caja'));
        }

       $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new MovimientoType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
             $this->get('session')->getFlashBag()->add('success' , 'Se han actualizado los datos del movimiento .');
            return $this->redirect($this->generateUrl('movimiento_edit', array('id' => $id)));
        }

        return $this->render('BackendAdminBundle:Movimiento:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            
        ));
      }
      else
         throw new AccessDeniedException(); 
    }*/
    /**
     * Deletes a Movimiento entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        if ( $this->get('security.context')->isGranted('ROLE_DELCAJA')) { 
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BackendAdminBundle:Movimiento')->find($id);

            if (!$entity) {
                $this->get('session')->getFlashBag()->add('error' , 'No se ha encontrado el movimiento indicado.');
             
            }
           else{
            // volver atras el movimiento del saldo
            
            $entity->deleteDeposito($this->getUser()); //baja lógica
            $em->persist($entity);
            $em->flush();
            $em->getRepository('BackendAdminBundle:Movimiento')->updateSaldoMovimiento($entity);
            $this->get('session')->getFlashBag()->add('success' , 'Se han borrado los datos del movimiento.');
            }
        }

        return $this->redirect($this->generateUrl('caja' ));
      }
      else
       throw new AccessDeniedException();
    }

    /**
     * Creates a form to delete a Movimiento entity by id.
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
    
    public function printReciboAction(Request $request, $id)
    {
      $em = $this->getDoctrine()->getManager();
      $entity = $em->getRepository('BackendAdminBundle:Movimiento')->find($id);

      if (!$entity) {
          $this->get('session')->getFlashBag()->add('error' , 'No se ha encontrado el movimiento indicado.');
          return $this->redirect($this->generateUrl('caja' ));
      }
      else{
        require_once($this->get('kernel')->getRootDir().'/config/dompdf_config.inc.php');

        $dompdf = new \DOMPDF();
        $html= $this->renderView('BackendAdminBundle:Movimiento:recibo.html.twig',
          array('entity'=>$entity)
        );
        $dompdf->load_html($html);
        $dompdf->render();
        $fileName="recibo_".$id.".pdf";
        $response= new Response($dompdf->output(), 200, array(
        	'Content-Type' => 'application/pdf; charset=utf-8'
        ));
        $response->headers->set('Content-Disposition', 'attachment; filename='.$fileName);
        return $response;
      }
    }
    
}
