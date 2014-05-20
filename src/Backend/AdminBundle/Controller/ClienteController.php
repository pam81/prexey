<?php

namespace Backend\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Backend\AdminBundle\Entity\Cliente;
use Backend\AdminBundle\Form\ClienteType;

/**
 * Cliente controller.
 *
 */
class ClienteController extends Controller
{

     public function generateSQL($search){
     
         $dql="SELECT u FROM BackendAdminBundle:Cliente u where u.isDelete=false"  ;
        $search=mb_convert_case($search,MB_CASE_LOWER);
        
        if ($search == 'directo' || $search == 'indirecto')
        {  
          if ($search == 'directo')
           $dql.=" and u.isDirecto = true ";
          else 
           $dql.=" and u.isDirecto = false ";
        } 
        else
        {
        if ($search)
          $dql.=" and u.name like '%$search%' ";
        }  
        $dql .=" order by u.name"; 
        
        return $dql;
     
     }

    /**
     * Lists all Cliente entities.
     *
     */
    public function indexAction(Request $request,$search)
    {
       if ( $this->get('security.context')->isGranted('ROLE_VIEWCLIENTE')) {
        $em = $this->getDoctrine()->getManager();

        /*$dql="SELECT u FROM BackendAdminBundle:Cliente u where u.isDelete=false"  ;
        $search=mb_convert_case($search,MB_CASE_LOWER);
        
        if ($search == 'directo' || $search == 'indirecto')
        {  
          if ($search == 'directo')
           $dql.=" and u.isDirecto = true ";
          else 
           $dql.=" and u.isDirecto = false ";
        } 
        else
        {
        if ($search)
          $dql.=" and u.name like '%$search%' ";
        }  
        $dql .=" order by u.name";   */
        
        $dql=$this->generateSQL($search);
        $query = $em->createQuery($dql);
        
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
        $query,
        $this->get('request')->query->get('page', 1)/*page number*/,
        $this->container->getParameter('max_on_listepage')/*limit per page*/
    );
        
        $deleteForm = $this->createDeleteForm(0);
        return $this->render('BackendAdminBundle:Cliente:index.html.twig', 
        array('pagination' => $pagination,
        'delete_form' => $deleteForm->createView(),
        'search'=>$search
        ));
        
    }
     else
         throw new AccessDeniedException(); 
    }
    /**
     * Creates a new Cliente entity.
     *
     */
    public function createAction(Request $request)
    {
        if ( $this->get('security.context')->isGranted('ROLE_ADDCLIENTE')) {
        $entity  = new Cliente();
        $form = $this->createForm(new ClienteType(), $entity);
        $form->bind($request);
         
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success' , 'Se ha agregado un nuevo cliente.');
            return $this->redirect($this->generateUrl('cliente_edit', array('id' => $entity->getId())));
        }
        
        

        return $this->render('BackendAdminBundle:Cliente:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
           
        ));
      }
      else
       throw new AccessDeniedException();
    }

    /**
    * Creates a form to create a Cliente entity.
    *
    * @param Cliente $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Cliente $entity)
    {
        $form = $this->createForm(new ClienteType(), $entity, array(
            'action' => $this->generateUrl('cliente_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Cliente entity.
     *
     */
    public function newAction()
    {
       if ( $this->get('security.context')->isGranted('ROLE_ADDCLIENTE')) {
        $entity = new Cliente();
        $form   = $this->createForm(new ClienteType(), $entity);

        return $this->render('BackendAdminBundle:Cliente:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
            
        ));
       }
       else
          throw new AccessDeniedException();
    }

  
    /**
     * Displays a form to edit an existing Cliente entity.
     *
     */
    public function editAction($id)
    {
        if ( $this->get('security.context')->isGranted('ROLE_MODCLIENTE')) { 
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendAdminBundle:Cliente')->find($id);

        if (!$entity) {
            
             $this->get('session')->getFlashBag()->add('error' , 'No se ha encontrado el cliente .');
             return $this->redirect($this->generateUrl('cliente'));
        }

        $editForm = $this->createForm(new ClienteType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BackendAdminBundle:Cliente:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            
        ));
      }
      else
         throw new AccessDeniedException(); 
    }

    /**
    * Creates a form to edit a Cliente entity.
    *
    * @param Cliente $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Cliente $entity)
    {
        $form = $this->createForm(new ClienteType(), $entity, array(
            'action' => $this->generateUrl('cliente_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Cliente entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        if ( $this->get('security.context')->isGranted('ROLE_MODCLIENTE')) {  
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendAdminBundle:Cliente')->find($id);

        if (!$entity) {
             $this->get('session')->getFlashBag()->add('error' , 'No se ha encontrado el cliente.');
             return $this->redirect($this->generateUrl('cliente'));
        }

       $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ClienteType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
             $this->get('session')->getFlashBag()->add('success' , 'Se han actualizado los datos del cliente .');
            return $this->redirect($this->generateUrl('cliente_edit', array('id' => $id)));
        }

        return $this->render('BackendAdminBundle:Cliente:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            
        ));
      }
      else
         throw new AccessDeniedException();  
    }
    /**
     * Deletes a Cliente entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        if ( $this->get('security.context')->isGranted('ROLE_DELCLIENTE')) { 
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BackendAdminBundle:Cliente')->find($id);

            if (!$entity) {
                $this->get('session')->getFlashBag()->add('error' , 'No se ha encontrado el cliente.');
             
            }
           else{
            
            if ($entity->getIsSpecial())
           {
              $this->get('session')->getFlashBag()->add('error' , 'No se puede borrar el cliente logiteck.');
           }
           else{ 
            $entity->setIsDelete(true); //baja lógica
            $em->persist($entity);
            $em->flush();
            
            //deshabilito todos los depositos del cliente
            $depositos=$entity->getDepositos();
            foreach($depositos as $d)
            {
              $d->setIsDelete(true);
              $em->persist($d);
              $em->flush();
            }
            
            $this->get('session')->getFlashBag()->add('success' , 'Se han borrado los datos del  cliente.');
            }
            }
        }

        return $this->redirect($this->generateUrl('cliente' ));
      }
      else
       throw new AccessDeniedException(); 
    }

    /**
     * Creates a form to delete a Cliente entity by id.
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
     if ( $this->get('security.context')->isGranted('ROLE_VIEWCLIENTE')) {
         
         $em = $this->getDoctrine()->getManager();

       
        $search=$this->generateSQL($request->query->get("search-query")); 
           
       
        $query = $em->createQuery($search);
        
        $excelService = $this->get('xls.service_xls5');
                         
                            
        $excelService->excelObj->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Nombre')
                    ->setCellValue('B1', 'CUIT')
                    ->setCellValue('C1', 'Dirección')
                    ->setCellValue('D1', 'Observaciones')
                    ->setCellValue('E1', 'Email')
                    ->setCellValue('F1', 'Celular')
                    ->setCellValue('G1', 'Es directo')
                    
                    
                    ;
                    
                    
                  
        
        $resultados=$query->getResult();
        $i=2;
        foreach($resultados as $r)
        {
         
           $excelService->excelObj->setActiveSheetIndex(0)
                         ->setCellValue("A$i",$r->getName())
                         ->setCellValue("B$i",$r->getCuit())
                         ->setCellValue("C$i",$r->getDireccion())
                         ->setCellValue("D$i",$r->getObservacion())
                         ->setCellValue("E$i",$r->getEmail())
                         ->setCellValue("F$i",$r->getCelular())
                         ->setCellValue("G$i",$r->getIsdirecto())
                        
                         ;
                
                           
          $i++;
        }
                            
        $excelService->excelObj->getActiveSheet()->setTitle('Listado de Choferes');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $excelService->excelObj->setActiveSheetIndex(0);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        
        
        
        
        
        $fileName="clientes_".date("Ymd").".xls";
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
