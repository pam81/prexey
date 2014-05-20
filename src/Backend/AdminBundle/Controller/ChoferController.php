<?php

namespace Backend\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Backend\AdminBundle\Entity\Chofer;
use Backend\AdminBundle\Form\ChoferType;

/**
 * Chofer controller.
 *
 */
class ChoferController extends Controller
{

      public function generateSQL($search){
        $dql="SELECT u FROM BackendAdminBundle:Chofer u where u.isDelete=false";
        
        if ($search)
          $dql.=" and (u.name like '%$search%' or u.lastname like '%$search%' 
                   or u.nroEmpleado like '%$search%' or u.dni like '%$search%')";
        $dql.=" order by u.lastname, u.name";
        return $dql;
      
      }

    /**
     * Lists all Chofer entities.
     *
     */
    public function indexAction(Request $request,$search)
    {
         if ( $this->get('security.context')->isGranted('ROLE_VIEWCHOFER')) {
        $em = $this->getDoctrine()->getManager();

       /* $dql="SELECT u FROM BackendAdminBundle:Chofer u where u.isDelete=false";
        
        if ($search)
          $dql.=" and (u.name like '%$search%' or u.lastname like '%$search%' 
                   or u.nroEmpleado like '%$search%' or u.dni like '%$search%')";
        $dql.=" order by u.lastname, u.name";*/
        
        $dql=$this->generateSQL($search);
                   
        $query = $em->createQuery($dql);
        
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
        $query,
        $this->get('request')->query->get('page', 1)/*page number*/,
        $this->container->getParameter('max_on_listepage')/*limit per page*/
    );
        
        $deleteForm = $this->createDeleteForm(0);
        return $this->render('BackendAdminBundle:Chofer:index.html.twig', 
        array('pagination' => $pagination,
        'delete_form' => $deleteForm->createView(),
        'search'=>$search
        
        ));
        
    }
     else
         throw new AccessDeniedException();  
    }
    /**
     * Creates a new Chofer entity.
     *
     */
    public function createAction(Request $request)
    {
        if ( $this->get('security.context')->isGranted('ROLE_ADDCHOFER')) {
        $entity  = new Chofer();
        $form = $this->createForm(new ChoferType(), $entity);
        $form->bind($request);
         
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success' , 'Se ha agregado un nuevo chofer.');
            return $this->redirect($this->generateUrl('chofer_edit', array('id' => $entity->getId())));
        }
        
        

        return $this->render('BackendAdminBundle:Chofer:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
           
        ));
      }
      else
       throw new AccessDeniedException();
    }

    /**
    * Creates a form to create a Chofer entity.
    *
    * @param Chofer $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Chofer $entity)
    {
        $form = $this->createForm(new ChoferType(), $entity, array(
            'action' => $this->generateUrl('chofer_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Chofer entity.
     *
     */
    public function newAction()
    {
        if ( $this->get('security.context')->isGranted('ROLE_ADDCHOFER')) {
        $entity = new Chofer();
        $form   = $this->createForm(new ChoferType(), $entity);

        return $this->render('BackendAdminBundle:Chofer:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
            
        ));
       }
       else
          throw new AccessDeniedException();
    }

    
    /**
     * Displays a form to edit an existing Chofer entity.
     *
     */
    public function editAction($id)
    {
        if ( $this->get('security.context')->isGranted('ROLE_MODCHOFER')) { 
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendAdminBundle:Chofer')->find($id);

        if (!$entity) {
            
             $this->get('session')->getFlashBag()->add('error' , 'No se ha encontrado el chofer .');
             return $this->redirect($this->generateUrl('chofer'));
        }

        $editForm = $this->createForm(new ChoferType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BackendAdminBundle:Chofer:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            
        ));
      }
      else
         throw new AccessDeniedException(); 
    }

    /**
    * Creates a form to edit a Chofer entity.
    *
    * @param Chofer $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Chofer $entity)
    {
        $form = $this->createForm(new ChoferType(), $entity, array(
            'action' => $this->generateUrl('chofer_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Chofer entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        if ( $this->get('security.context')->isGranted('ROLE_MODCHOFER')) {  
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendAdminBundle:Chofer')->find($id);

        if (!$entity) {
             $this->get('session')->getFlashBag()->add('error' , 'No se ha encontrado el chofer.');
             return $this->redirect($this->generateUrl('chofer'));
        }

       $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ChoferType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
             $this->get('session')->getFlashBag()->add('success' , 'Se han actualizado los datos del chofer .');
            return $this->redirect($this->generateUrl('chofer_edit', array('id' => $id)));
        }

        return $this->render('BackendAdminBundle:Chofer:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            
        ));
      }
      else
         throw new AccessDeniedException();  
    }
    /**
     * Deletes a Chofer entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        if ( $this->get('security.context')->isGranted('ROLE_DELCHOFER')) { 
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BackendAdminBundle:Chofer')->find($id);

            if (!$entity) {
                $this->get('session')->getFlashBag()->add('error' , 'No se ha encontrado el chofer.');
             
            }
           else{
            $entity->setIsDelete(true); //baja lógica
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success' , 'Se han borrado los datos del chofer.');
            }
        }

        return $this->redirect($this->generateUrl('chofer' ));
      }
      else
       throw new AccessDeniedException(); 
    }

    /**
     * Creates a form to delete a Chofer entity by id.
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
     if ( $this->get('security.context')->isGranted('ROLE_VIEWCHOFER')) {
         
         $em = $this->getDoctrine()->getManager();

       
        $search=$this->generateSQL($request->query->get("search-query")); 
           
       
        $query = $em->createQuery($search);
        
        $excelService = $this->get('xls.service_xls5');
                         
                            
        $excelService->excelObj->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Nombre')
                    ->setCellValue('B1', 'Nro Empleado')
                    ->setCellValue('C1', 'DNI')
                    ->setCellValue('D1', 'Observaciones')
                    ->setCellValue('E1', 'Email')
                    ->setCellValue('F1', 'Celular')
                    ->setCellValue('G1', 'Radio')
                    ->setCellValue('H1', 'Teléfono')
                    ->setCellValue('I1', 'Dirección')
                    ->setCellValue('J1', 'Es peon')
                    ->setCellValue('K1', 'Empresa')
                    ->setCellValue('L1', 'Vto Registro')
                    ->setCellValue('M1', 'CNRT')
                    ->setCellValue('N1', 'FECHA CNRT')
                    ->setCellValue('O1', 'CNRT CURSO')
                    ->setCellValue('P1', 'FECHA CNRT CURSO')
                    ->setCellValue('Q1', 'CNRT PELIGROSA')
                    ->setCellValue('R1', 'FECHA CNRT PELIGROSA')
                    ->setCellValue('S1', 'LIBRETA SANITARIA')
                    ->setCellValue('T1', 'FECHA L. SANITARIA')
                    ;
                    
                    
                  
        
        $resultados=$query->getResult();
        $i=2;
        foreach($resultados as $r)
        {
         
           $excelService->excelObj->setActiveSheetIndex(0)
                         ->setCellValue("A$i",$r->getLastname().", ".$r->getName())
                         ->setCellValue("B$i",$r->getNroEmpleado())
                         ->setCellValue("C$i",$r->getDni())
                         ->setCellValue("D$i",$r->getObservacion())
                         ->setCellValue("E$i",$r->getEmail())
                         ->setCellValue("F$i",$r->getCelular())
                         ->setCellValue("G$i",$r->getRadio())
                         ->setCellValue("H$i",$r->getTelefono())
                         ->setCellValue("I$i",$r->getDireccion())
                         ->setCellValue("J$i",$r->getIsPeon())
                         ->setCellValue("K$i",$r->getEmpresa()->__toString())
                         
                         ->setCellValue("M$i",$r->getCnrt())
                         
                         ->setCellValue("O$i",$r->getCnrtCurso())
                         
                         ->setCellValue("Q$i",$r->getCnrtPeligrosa())
                         
                         ->setCellValue("S$i",$r->getLibretaSanitaria())
                        
                         ;
           if ($r->getFechaRegistro())
                 $excelService->excelObj->setActiveSheetIndex(0)->setCellValue("L$i",$r->getFechaRegistro()->format("d-m-Y"));
                
           if ($r->getFechaCnrt())
                 $excelService->excelObj->setActiveSheetIndex(0)->setCellValue("N$i",$r->getFechaCnrt()->format("d-m-Y"));
           if ($r->getFechaCnrtCurso())
                 $excelService->excelObj->setActiveSheetIndex(0)->setCellValue("P$i",$r->getFechaCnrtCurso()->format("d-m-Y"));
           if ($r->getFechaCnrtPeligrosa())   
                 $excelService->excelObj->setActiveSheetIndex(0)->setCellValue("R$i",$r->getFechaCnrtPeligrosa()->format("d-m-Y"));
          if ($r->getFechaSanitaria())
                  $excelService->excelObj->setActiveSheetIndex(0)->setCellValue("T$i",$r->getFechaSanitaria()->format("d-m-Y"));
                
                           
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
        
        
        
        
        $fileName="choferes_".date("Ymd").".xls";
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
