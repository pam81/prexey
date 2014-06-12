<?php

namespace Backend\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Backend\AdminBundle\Entity\Sucursal;
use Backend\AdminBundle\Form\SucursalType;

/**
 * Sucursal controller.
 *
 */
class SucursalController extends Controller
{

     public function generateSQL($search){
     
        $dql="SELECT u FROM BackendAdminBundle:Sucursal u "; //where u.isDelete=false"  ;
        $search=mb_convert_case($search,MB_CASE_LOWER);
        
       
        if ($search)
          $dql.=" and u.nombre like '%$search%' ";
          
        $dql .=" order by u.nombre"; 
        
        return $dql;
     
     }

    /**
     * Lists all Sucursal entities.
     *
     */
    public function indexAction(Request $request,$search)
    {
       if ( $this->get('security.context')->isGranted('ROLE_VIEWSUCURSAL')) {
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
        return $this->render('BackendAdminBundle:Sucursal:index.html.twig', 
        array('pagination' => $pagination,
        'delete_form' => $deleteForm->createView(),
        'search'=>$search
        ));
        
    }
     else
         throw new AccessDeniedException(); 
    }
    /**
     * Creates a new Sucursal entity.
     *
     */
    public function createAction(Request $request)
    {
        if ( $this->get('security.context')->isGranted('ROLE_ADDSUCURSAL')) {
        $entity  = new Sucursal();
        $form = $this->createForm(new SucursalType(), $entity);
        $form->bind($request);
         
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success' , 'Se ha agregado una nueva sucursal.');
            return $this->redirect($this->generateUrl('sucursal_edit', array('id' => $entity->getId())));
        }
        
        

        return $this->render('BackendAdminBundle:Sucursal:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
           
        ));
      }
      else
       throw new AccessDeniedException();
    }

    /**
    * Creates a form to create a Sucursal entity.
    *
    * @param Sucursal $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Sucursal $entity)
    {
        $form = $this->createForm(new SucursalType(), $entity, array(
            'action' => $this->generateUrl('sucursal_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Sucursal entity.
     *
     */
    public function newAction()
    {
       if ( $this->get('security.context')->isGranted('ROLE_ADDSUCURSAL')) {
        $entity = new Sucursal();
        $form   = $this->createForm(new SucursalType(), $entity);

        return $this->render('BackendAdminBundle:Sucursal:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
            
        ));
       }
       else
          throw new AccessDeniedException();
    }

  
    /**
     * Displays a form to edit an existing Sucursal entity.
     *
     */
    public function editAction($id)
    {
        if ( $this->get('security.context')->isGranted('ROLE_MODSUCURSAL')) { 
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendAdminBundle:Sucursal')->find($id);

        if (!$entity) {
            
             $this->get('session')->getFlashBag()->add('error' , 'No se ha encontrado la sucursal .');
             return $this->redirect($this->generateUrl('sucursal'));
        }

        $editForm = $this->createForm(new SucursalType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BackendAdminBundle:Sucursal:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            
        ));
      }
      else
         throw new AccessDeniedException(); 
    }

    /**
    * Creates a form to edit a Sucursal entity.
    *
    * @param Sucursal $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Sucursal $entity)
    {
        $form = $this->createForm(new SucursalType(), $entity, array(
            'action' => $this->generateUrl('sucursal_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Sucursal entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        if ( $this->get('security.context')->isGranted('ROLE_MODSUCURSAL')) {  
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendAdminBundle:Sucursal')->find($id);

        if (!$entity) {
             $this->get('session')->getFlashBag()->add('error' , 'No se ha encontrado la sucursal.');
             return $this->redirect($this->generateUrl('sucursal'));
        }

       $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new SucursalType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
             $this->get('session')->getFlashBag()->add('success' , 'Se han actualizado los datos de la sucursal.');
            return $this->redirect($this->generateUrl('sucursal_edit', array('id' => $id)));
        }

        return $this->render('BackendAdminBundle:Sucursal:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            
        ));
      }
      else
         throw new AccessDeniedException();  
    }
    /**
     * Deletes a Sucursal entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        if ( $this->get('security.context')->isGranted('ROLE_DELSUCURSAL')) { 
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BackendAdminBundle:Sucursal')->find($id);

            if (!$entity) {
                $this->get('session')->getFlashBag()->add('error' , 'No se ha encontrado la sucursal.');
             
            }
           else{
            
          
            $entity->setIsDelete(true); //baja lógica
            $em->persist($entity);
            $em->flush();
            
           
            
            $this->get('session')->getFlashBag()->add('success' , 'Se han borrado los datos de la sucursal.');
            
            }
        }

        return $this->redirect($this->generateUrl('sucursal'));
      }
      else
       throw new AccessDeniedException(); 
    }

    /**
     * Creates a form to delete a Sucursal entity by id.
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
     if ( $this->get('security.context')->isGranted('ROLE_VIEWSUCURSAL')) {
         
         $em = $this->getDoctrine()->getManager();

       
        $search=$this->generateSQL($request->query->get("search-query")); 
           
       
        $query = $em->createQuery($search);
        
        $excelService = $this->get('xls.service_xls5');
                         
                            
        $excelService->excelObj->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Nombre')
                    ->setCellValue('B1', 'Responsable')
                    ->setCellValue('C1', 'Calle')
                    ->setCellValue('D1', 'Número')
                    ->setCellValue('E1', 'Piso')
                    ->setCellValue('F1', 'Cp')
                    ->setCellValue('G1', 'Teléfono')
                    ->setCellValue('H1', 'Fax')
                    ->setCellValue('I1', 'Email')
                    ;
        
        $resultados=$query->getResult();
        $i=2;
        foreach($resultados as $r)
        {
         
           $excelService->excelObj->setActiveSheetIndex(0)
                         ->setCellValue("A$i",$r->getNombre())
                         ->setCellValue("B$i",$r->getResponsable())
                         ->setCellValue("C$i",$r->getCalle())
                         ->setCellValue("D$i",$r->getNumero())
                         ->setCellValue("E$i",$r->getPiso())
                         ->setCellValue("F$i",$r->getCp())
                         ->setCellValue("G$i",$r->getTelefono())
                         ->setCellValue("H$i",$r->getFax())
                         ->setCellValue("H$i",$r->getEmail())
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
        $excelService->excelObj->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        
        $fileName="sucursales_".date("Ymd").".xls";
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
