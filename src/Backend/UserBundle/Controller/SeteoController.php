<?php

namespace Backend\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Backend\UserBundle\Entity\Seteo;
use Backend\UserBundle\Form\SeteoType;

/**
 * Seteo controller.
 *
 */
class SeteoController extends Controller
{

    /**
     * Lists all Seteo entities.
     *
     */
    public function indexAction()
    {
       
        
        
      if ( $this->get('security.context')->isGranted('ROLE_SETEO')) {
        $em = $this->getDoctrine()->getManager();

        $dql="SELECT u FROM BackendUserBundle:Seteo u";
        $query = $em->createQuery($dql);
        
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
        $query,
        $this->get('request')->query->get('page', 1)/*page number*/,
        $this->container->getParameter('max_on_listepage')/*limit per page*/
    );
        
        $deleteForm = $this->createDeleteForm(0);
        return $this->render('BackendUserBundle:Seteo:index.html.twig', 
        array('pagination' => $pagination,
        'delete_form' => $deleteForm->createView()
        
        ));
        
    }
     else
         throw new AccessDeniedException();  
        
        
    }
    /**
     * Creates a new Seteo entity.
     *
     */
    public function createAction(Request $request)
    {
        
        
      if ( $this->get('security.context')->isGranted('ROLE_SETEO')) {
        $entity  = new Seteo();
        $form = $this->createForm(new SeteoType(), $entity);
        $form->bind($request);
         
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success' , 'Se ha creado un nuevo parámetro.');
            return $this->redirect($this->generateUrl('seteo_edit', array('id' => $entity->getId())));
        }
        
        

        return $this->render('BackendUserBundle:Seteo:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
           
        ));
      }
      else
       throw new AccessDeniedException();
        
    }

    /**
    * Creates a form to create a Seteo entity.
    *
    * @param Seteo $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Seteo $entity)
    {
        $form = $this->createForm(new SeteoType(), $entity, array(
            'action' => $this->generateUrl('seteo_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Seteo entity.
     *
     */
    public function newAction()
    {
        
       if ( $this->get('security.context')->isGranted('ROLE_SETEO')) {
        $entity = new Seteo();
        $form   = $this->createForm(new SeteoType(), $entity);

        return $this->render('BackendUserBundle:Seteo:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
            
        ));
       }
       else
          throw new AccessDeniedException();
        
    }

    /**
     * Finds and displays a Seteo entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendUserBundle:Seteo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Seteo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BackendUserBundle:Seteo:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Seteo entity.
     *
     */
    public function editAction($id)
    {
        
        
        if ( $this->get('security.context')->isGranted('ROLE_SETEO')) { 
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendUserBundle:Seteo')->find($id);

        if (!$entity) {
            
             $this->get('session')->getFlashBag()->add('error' , 'No se ha encontrado el parámetro.');
             return $this->redirect($this->generateUrl('seteo'));
        }

        $editForm = $this->createForm(new SeteoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BackendUserBundle:Seteo:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            
        ));
      }
      else
         throw new AccessDeniedException(); 
        
    }

    /**
    * Creates a form to edit a Seteo entity.
    *
    * @param Seteo $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Seteo $entity)
    {
        $form = $this->createForm(new SeteoType(), $entity, array(
            'action' => $this->generateUrl('seteo_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Seteo entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        if ( $this->get('security.context')->isGranted('ROLE_SETEO')) {  
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendUserBundle:Seteo')->find($id);

        if (!$entity) {
             $this->get('session')->getFlashBag()->add('error' , 'No se ha encontrado el parámetro.');
             return $this->redirect($this->generateUrl('seteo'));
        }

       $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new SeteoType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
             $this->get('session')->getFlashBag()->add('success' , 'Se ha actualizado el parámetro.');
            return $this->redirect($this->generateUrl('seteo_edit', array('id' => $id)));
        }

        return $this->render('BackendUserBundle:Seteo:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            
        ));
      }
      else
         throw new AccessDeniedException();  
    }
    /**
     * Deletes a Seteo entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
       
        if ( $this->get('security.context')->isGranted('ROLE_SETEO')) { 
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BackendUserBundle:Seteo')->find($id);

            if (!$entity) {
                $this->get('session')->getFlashBag()->add('error' , 'No se ha encontrado el parámetro.');
             
            }
           else{
            $em->remove($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success' , 'Se ha borrado el parámetro.');
            }
        }

        return $this->redirect($this->generateUrl('seteo' ));
      }
      else
       throw new AccessDeniedException(); 
        
    }

    /**
     * Creates a form to delete a Seteo entity by id.
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
