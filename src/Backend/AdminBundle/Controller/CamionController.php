<?php

namespace Backend\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Backend\AdminBundle\Entity\Camion;
use Backend\AdminBundle\Form\CamionType;

/**
 * Camion controller.
 *
 */
class CamionController extends Controller
{


    public function generateSQL($search)
    {
      
       $dql="SELECT u FROM BackendAdminBundle:Camion u where u.isDelete=false";
        if ($search)
           $dql .= " and (u.patente like '%$search%' or u.observacion like '%$search%' or u.marca like '%$search%')";
        $dql .=" order by u.patente";
        
        return $dql; 
    
    }
    /**
     * Lists all Camion entities.
     *
     */
    public function indexAction(Request $request,$search)
    {
        if ( $this->get('security.context')->isGranted('ROLE_VIEWCAMION')) {
        $em = $this->getDoctrine()->getManager();

        
        
        $dql = $this->generateSQL($search);   
        $query = $em->createQuery($dql);
        
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
        $query,
        $this->get('request')->query->get('page', 1)/*page number*/,
        $this->container->getParameter('max_on_listepage')/*limit per page*/
    );
        
        $deleteForm = $this->createDeleteForm(0);
        return $this->render('BackendAdminBundle:Camion:index.html.twig', 
        array('pagination' => $pagination,
        'delete_form' => $deleteForm->createView(),
        'search'=>$search
        ));
        
    }
     else
         throw new AccessDeniedException(); 
    }
    /**
     * Creates a new Camion entity.
     *
     */
    public function createAction(Request $request)
    {
        if ( $this->get('security.context')->isGranted('ROLE_ADDCAMION')) {
        $entity  = new Camion();
        $form = $this->createForm(new CamionType(), $entity);
        $form->bind($request);
         
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success' , 'Se ha agregado un nuevo camión.');
            return $this->redirect($this->generateUrl('camion_edit', array('id' => $entity->getId())));
        }
        
        

        return $this->render('BackendAdminBundle:Camion:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
           
        ));
      }
      else
       throw new AccessDeniedException();
    }

    /**
    * Creates a form to create a Camion entity.
    *
    * @param Camion $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Camion $entity)
    {
        $form = $this->createForm(new CamionType(), $entity, array(
            'action' => $this->generateUrl('camion_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Camion entity.
     *
     */
    public function newAction()
    {
         if ( $this->get('security.context')->isGranted('ROLE_ADDCAMION')) {
        $entity = new Camion();
        $form   = $this->createForm(new CamionType(), $entity);

        return $this->render('BackendAdminBundle:Camion:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
            
        ));
       }
       else
          throw new AccessDeniedException();
    }

   

    /**
     * Displays a form to edit an existing Camion entity.
     *
     */
    public function editAction($id)
    {
        if ( $this->get('security.context')->isGranted('ROLE_MODCAMION')) { 
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendAdminBundle:Camion')->find($id);

        if (!$entity) {
            
             $this->get('session')->getFlashBag()->add('error' , 'No se ha encontrado el camión .');
             return $this->redirect($this->generateUrl('camion'));
        }

        $editForm = $this->createForm(new CamionType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BackendAdminBundle:Camion:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            
        ));
      }
      else
         throw new AccessDeniedException(); 
    }

    /**
    * Creates a form to edit a Camion entity.
    *
    * @param Camion $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Camion $entity)
    {
        $form = $this->createForm(new CamionType(), $entity, array(
            'action' => $this->generateUrl('camion_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Camion entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        if ( $this->get('security.context')->isGranted('ROLE_MODCAMION')) {  
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendAdminBundle:Camion')->find($id);

        if (!$entity) {
             $this->get('session')->getFlashBag()->add('error' , 'No se ha encontrado el camión.');
             return $this->redirect($this->generateUrl('camion'));
        }

       $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new CamionType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
             $this->get('session')->getFlashBag()->add('success' , 'Se han actualizado los datos del camión .');
            return $this->redirect($this->generateUrl('camion_edit', array('id' => $id)));
        }

        return $this->render('BackendAdminBundle:Camion:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            
        ));
      }
      else
         throw new AccessDeniedException();  
    }
    /**
     * Deletes a Camion entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        if ( $this->get('security.context')->isGranted('ROLE_DELCAMION')) { 
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BackendAdminBundle:Camion')->find($id);

            if (!$entity) {
                $this->get('session')->getFlashBag()->add('error' , 'No se ha encontrado el camión.');
             
            }
           else{
            $entity->setIsDelete(true); //baja lógica
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success' , 'Se han borrado los datos del camión.');
            }
        }

        return $this->redirect($this->generateUrl('camion' ));
      }
      else
       throw new AccessDeniedException(); 
    }

    /**
     * Creates a form to delete a Camion entity by id.
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
     if ( $this->get('security.context')->isGranted('ROLE_VIEWCAMION')) {
         
         $em = $this->getDoctrine()->getManager();

       
        $search=$this->generateSQL($request->query->get("search-query")); 
           
       
        $query = $em->createQuery($search);
        
        $excelService = $this->get('xls.service_xls5');
                         
                            
        $excelService->excelObj->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Patente')
                    ->setCellValue('B1', 'Km x Litro')
                    ->setCellValue('C1', 'Tanque')
                    ->setCellValue('D1', 'Detalle')
                    ->setCellValue('E1', 'Observaciones')
                    ->setCellValue('F1', 'Interno')
                    ->setCellValue('G1', 'Empresa')
                    ->setCellValue('H1', 'SENASA')
                    ->setCellValue('I1', 'VTO SENASA')
                    ->setCellValue('J1', 'R.U.T.A.')
                    ->setCellValue('K1', 'VTO R.U.T.A')
                    ->setCellValue('L1', 'Poliza')
                    ->setCellValue('M1', 'VTO Poliza')
                    ->setCellValue('N1', 'VTV')
                     ->setCellValue('O1', 'Eficiencia Ideal')
                    ;
                    
                  
        
        $resultados=$query->getResult();
        $i=2;
        foreach($resultados as $r)
        {
         
           $excelService->excelObj->setActiveSheetIndex(0)
                         ->setCellValue("A$i",$r->getPatente())
                         ->setCellValue("B$i",$r->getKmxLitro())
                         ->setCellValue("C$i",$r->getMaxTanque())
                         ->setCellValue("D$i",$r->getMarca()." - ".$r->getModelo()." - ".$r->getColor())
                         ->setCellValue("E$i",$r->getObservacion())
                         ->setCellValue("F$i",$r->getInterno())
                         ->setCellValue("G$i",$r->getEmpresa()->__toString())
                         ->setCellValue("H$i",$r->getSenasa())
                        
                         ->setCellValue("J$i",$r->getRuta())
                         
                         ->setCellValue("L$i",$r->getSeguro())
                         
                         
                         ->setCellValue("O$i",$r->getEficienciaIdeal())
                         ;
           if ($r->getFechaSenasa())
               $excelService->excelObj->setActiveSheetIndex(0)->setCellValue("I$i",$r->getFechaSenasa()->format("d-m-Y"));                                                   
           if ($r->getFechaRuta())
                $excelService->excelObj->setActiveSheetIndex(0)->setCellValue("K$i",$r->getFechaRuta()->format("d-m-Y"));
           if ($r->getFechaSeguro())     
                 $excelService->excelObj->setActiveSheetIndex(0)->setCellValue("M$i",$r->getFechaSeguro()->format("d-m-Y"));
           if ($r->getFechaVtv())     
                   $excelService->excelObj->setActiveSheetIndex(0)->setCellValue("N$i",$r->getFechaVtv()->format("d-m-Y"));             
          $i++;
        }
                            
        $excelService->excelObj->getActiveSheet()->setTitle('Listado de Camiones');
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
        
        
        
        $fileName="camiones_".date("Ymd").".xls";
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
