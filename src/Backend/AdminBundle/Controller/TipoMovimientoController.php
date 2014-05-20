<?php

namespace Backend\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Backend\AdminBundle\Entity\TipoMovimiento;
use Backend\AdminBundle\Form\TipoMovimientoType;

/**
 * TipoMovimiento controller.
 *
 */
class TipoMovimientoController extends Controller
{

    /**
     * Lists all TipoMovimiento entities.
     *
     */
    public function indexAction(Request $request,$search)
    {
         if ( $this->get('security.context')->isGranted('ROLE_VIEWTIPOMOVIMIENTO')) {
        $em = $this->getDoctrine()->getManager();

        $dql="SELECT u FROM BackendAdminBundle:TipoMovimiento u where u.isDelete=false";
        
        if ($search)
          $dql.=" and (u.code like '%$search%' or u.texto like '%$search%') ";
          
        $dql.=" order by u.code, u.texto";
                   
        $query = $em->createQuery($dql);
        
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
        $query,
        $this->get('request')->query->get('page', 1)/*page number*/,
        $this->container->getParameter('max_on_listepage')/*limit per page*/
    );
        
        $deleteForm = $this->createDeleteForm(0);
        return $this->render('BackendAdminBundle:TipoMovimiento:index.html.twig', 
        array('pagination' => $pagination,
        'delete_form' => $deleteForm->createView(),
        'search'=>$search
        
        ));
        
    }
     else
         throw new AccessDeniedException();  
    }
    /**
     * Creates a new TipoMovimiento entity.
     *
     */
    public function createAction(Request $request)
    {
        if ( $this->get('security.context')->isGranted('ROLE_ADDTIPOMOVIMIENTO')) {
        $entity  = new TipoMovimiento();
        $form = $this->createForm(new TipoMovimientoType(), $entity);
        $form->bind($request);
         
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success' , 'Se ha agregado un nuevo tipo de movimiento de caja.');
            return $this->redirect($this->generateUrl('tipomovimiento_edit', array('id' => $entity->getId())));
        }
        
        

        return $this->render('BackendAdminBundle:TipoMovimiento:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
           
        ));
      }
      else
       throw new AccessDeniedException();
    }

    /**
    * Creates a form to create a TipoMovimiento entity.
    *
    * @param TipoMovimiento $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(TipoMovimiento $entity)
    {
        $form = $this->createForm(new TipoMovimientoType(), $entity, array(
            'action' => $this->generateUrl('tipomovimiento_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new TipoMovimiento entity.
     *
     */
    public function newAction()
    {
        if ( $this->get('security.context')->isGranted('ROLE_ADDTIPOMOVIMIENTO')) {
        $entity = new TipoMovimiento();
        $form   = $this->createForm(new TipoMovimientoType(), $entity);

        return $this->render('BackendAdminBundle:TipoMovimiento:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
            
        ));
       }
       else
          throw new AccessDeniedException();
    }

   

    /**
     * Displays a form to edit an existing TipoMovimiento entity.
     *
     */
    public function editAction($id)
    {
         if ( $this->get('security.context')->isGranted('ROLE_MODTIPOMOVIMIENTO')) { 
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendAdminBundle:TipoMovimiento')->find($id);

        if (!$entity) {
            
             $this->get('session')->getFlashBag()->add('error' , 'No se ha encontrado el tipo de movimiento de caja .');
             return $this->redirect($this->generateUrl('tipomovimiento'));
        }

        $editForm = $this->createForm(new TipoMovimientoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BackendAdminBundle:TipoMovimiento:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            
        ));
      }
      else
         throw new AccessDeniedException(); 
    }

    /**
    * Creates a form to edit a TipoMovimiento entity.
    *
    * @param TipoMovimiento $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TipoMovimiento $entity)
    {
        $form = $this->createForm(new TipoMovimientoType(), $entity, array(
            'action' => $this->generateUrl('tipomovimiento_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing TipoMovimiento entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
         if ( $this->get('security.context')->isGranted('ROLE_MODTIPOMOVIMIENTO')) {  
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendAdminBundle:TipoMovimiento')->find($id);

        if (!$entity) {
             $this->get('session')->getFlashBag()->add('error' , 'No se ha encontrado el tipo de movimiento de caja.');
             return $this->redirect($this->generateUrl('tipomovimiento'));
        }

       $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new TipoMovimientoType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
             $this->get('session')->getFlashBag()->add('success' , 'Se han actualizado los datos del tipo movimiento de caja .');
            return $this->redirect($this->generateUrl('tipomovimiento_edit', array('id' => $id)));
        }

        return $this->render('BackendAdminBundle:TipoMovimiento:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            
        ));
      }
      else
         throw new AccessDeniedException();  
    }
    /**
     * Deletes a TipoMovimiento entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
         if ( $this->get('security.context')->isGranted('ROLE_DELTIPOMOVIMIENTO')) { 
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BackendAdminBundle:TipoMovimiento')->find($id);

            if (!$entity) {
                $this->get('session')->getFlashBag()->add('error' , 'No se ha encontrado el tipo movimiento indicado.');
             
            }
           else{
            $entity->setIsDelete(true); //baja lógica
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success' , 'Se han borrado los datos del tipomovimiento.');
            }
        }

        return $this->redirect($this->generateUrl('tipomovimiento' ));
      }
      else
       throw new AccessDeniedException();
    }

    /**
     * Creates a form to delete a TipoMovimiento entity by id.
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
}
