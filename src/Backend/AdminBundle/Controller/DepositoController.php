<?php

namespace Backend\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Backend\AdminBundle\Entity\Deposito;
use Backend\AdminBundle\Form\DepositoType;

/**
 * Deposito controller.
 *
 */
class DepositoController extends Controller
{

     public function generateSQL($search){
     
        $dql="SELECT u FROM BackendAdminBundle:Deposito u left join u.cliente c where u.isDelete=false";
        
        if ( $this->get('security.context')->isGranted($this->container->getParameter('role_deposito')))
            $dql.="  and u.id = ".$this->getUser()->getDeposito()->getId();
            
        if ($search)
           $dql.=" and (u.name like '%$search%' or u.direccion like '%$search%' or c.name like '%$search%')";
        
        $dql.=" order by u.name";
        
        return $dql;
     }

    /**
     * Lists all Deposito entities.
     *
     */
    public function indexAction(Request $request,$search)
    {
  
        
       if ( $this->get('security.context')->isGranted('ROLE_VIEWDEPOSITO')) {
        $em = $this->getDoctrine()->getManager();
        
          $dql=$this->generateSQL($search);
        
       
       
        $query = $em->createQuery($dql);
        
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
        $query,
        $this->get('request')->query->get('page', 1)/*page number*/,
        $this->container->getParameter('max_on_listepage')/*limit per page*/
    );
        
        $deleteForm = $this->createDeleteForm(0);
        return $this->render('BackendAdminBundle:Deposito:index.html.twig', 
        array('pagination' => $pagination,
        'delete_form' => $deleteForm->createView(),
        'search'=>$search
        ));
        
    }
     else
         throw new AccessDeniedException();   
        
    }
    /**
     * Creates a new Deposito entity.
     *
     */
    public function createAction(Request $request)
    {
       
       if ( $this->get('security.context')->isGranted('ROLE_ADDDEPOSITO')) {
        $entity  = new Deposito();
        $form = $this->createForm(new DepositoType(), $entity);
        $form->bind($request);
         
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success' , 'Se ha creado un nuevo depósito.');
            return $this->redirect($this->generateUrl('deposito_edit', array('id' => $entity->getId())));
        }
        
        

        return $this->render('BackendAdminBundle:Deposito:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
           
        ));
      }
      else
       throw new AccessDeniedException();
       
        
    }
    
    /**
    * Creates a form to create a Deposito entity.
    *
    * @param Deposito $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Deposito $entity)
    {
        $form = $this->createForm(new DepositoType(), $entity, array(
            'action' => $this->generateUrl('deposito_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Deposito entity.
     *
     */
    public function newAction()
    {
      
         if ( $this->get('security.context')->isGranted('ROLE_ADDDEPOSITO')) {
        $entity = new Deposito();
        $form   = $this->createForm(new DepositoType(), $entity);

        return $this->render('BackendAdminBundle:Deposito:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
            
        ));
       }
       else
          throw new AccessDeniedException();
        
    }

   

    /**
     * Displays a form to edit an existing Deposito entity.
     *
     */
    public function editAction($id)
    {
        if ( $this->get('security.context')->isGranted('ROLE_MODDEPOSITO')) { 
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendAdminBundle:Deposito')->find($id);

        if (!$entity) {
            
             $this->get('session')->getFlashBag()->add('error' , 'No se ha encontrado el depósito.');
             return $this->redirect($this->generateUrl('deposito'));
        }

        $editForm = $this->createForm(new DepositoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BackendAdminBundle:Deposito:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            
        ));
      }
      else
         throw new AccessDeniedException(); 
    }

    /**
    * Creates a form to edit a Deposito entity.
    *
    * @param Deposito $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Deposito $entity)
    {
        $form = $this->createForm(new DepositoType(), $entity, array(
            'action' => $this->generateUrl('deposito_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Deposito entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        if ( $this->get('security.context')->isGranted('ROLE_MODDEPOSITO')) {  
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendAdminBundle:Deposito')->find($id);

        if (!$entity) {
             $this->get('session')->getFlashBag()->add('error' , 'No se ha encontrado el depósito.');
             return $this->redirect($this->generateUrl('deposito'));
        }

       $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new DepositoType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
             $this->get('session')->getFlashBag()->add('success' , 'Se ha actualizado el depósito.');
            return $this->redirect($this->generateUrl('deposito_edit', array('id' => $id)));
        }

        return $this->render('BackendAdminBundle:Deposito:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            
        ));
      }
      else
         throw new AccessDeniedException();  
    }
    /**
     * Deletes a Deposito entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        if ( $this->get('security.context')->isGranted('ROLE_DELDEPOSITO')) {
        
         
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BackendAdminBundle:Deposito')->find($id);

            if (!$entity) {
                $this->get('session')->getFlashBag()->add('error' , 'No se ha encontrado el depósito.');
             
            }
           else{
           
           if ($entity->getIsSpecial())
           {
              $this->get('session')->getFlashBag()->add('error' , 'No se puede borrar el déposito central.');
           }
           else{
            $entity->setIsDelete(true); //baja lógica
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success' , 'Se ha borrado el depósito.');
            }
            }
        }

        return $this->redirect($this->generateUrl('deposito' ));
      
      }
      else
       throw new AccessDeniedException(); 
    }

    /**
     * Creates a form to delete a Deposito entity by id.
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
     if ( $this->get('security.context')->isGranted('ROLE_VIEWDEPOSITO')) {
         
         $em = $this->getDoctrine()->getManager();

       
        $search=$this->generateSQL($request->query->get("search-query")); 
           
       
        $query = $em->createQuery($search);
        
        $excelService = $this->get('xls.service_xls5');
                         
                            
        $excelService->excelObj->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Cliente')
                    ->setCellValue('B1', 'Nombre')
                    ->setCellValue('C1', 'Dirección')
                    ->setCellValue('D1', 'Observaciones')
                    ->setCellValue('E1', 'lat')
                    ->setCellValue('F1', 'lng')
                    ->setCellValue('G1', 'Es Especial')
                    
                    ;
                    
                    
                  
        
        $resultados=$query->getResult();
        $i=2;
        foreach($resultados as $r)
        {
         
           $excelService->excelObj->setActiveSheetIndex(0)
                         ->setCellValue("A$i",$r->getCliente()->__toString())
                         ->setCellValue("B$i",$r->getName())
                         ->setCellValue("C$i",$r->getDireccion())
                         ->setCellValue("D$i",$r->getObservacion())
                         ->setCellValue("E$i",$r->getLat())
                         ->setCellValue("F$i",$r->getLng())
                         ->setCellValue("G$i",$r->getIsSpecial())
                                                 
                         ;
           
                
                           
          $i++;
        }
                            
        $excelService->excelObj->getActiveSheet()->setTitle('Listado de Depósitos');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $excelService->excelObj->setActiveSheetIndex(0);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        
        
        
        
        $fileName="depositos_".date("Ymd").".xls";
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
