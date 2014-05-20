<?php

namespace Backend\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Backend\UserBundle\Entity\Group;
use Backend\UserBundle\Form\GroupType;

/**
 * Group controller.
 *
 */
class GroupController extends Controller
{

    /**
     * Lists all Group entities.
     *
     */
    public function indexAction()
    {
        
       if ( $this->get('security.context')->isGranted('ROLE_ADMIN')) {
        $em = $this->getDoctrine()->getManager();

        $dql="SELECT u FROM BackendUserBundle:Group u";
        $query = $em->createQuery($dql);
        
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
        $query,
        $this->get('request')->query->get('page', 1)/*page number*/,
        $this->container->getParameter('max_on_listepage')/*limit per page*/
    );
        
        $deleteForm = $this->createDeleteForm(0);
        return $this->render('BackendUserBundle:Group:index.html.twig', 
        array('pagination' => $pagination,
        'delete_form' => $deleteForm->createView()
        
        ));
        
    }
     else
         throw new AccessDeniedException();  
        
    }
    /**
     * Creates a new Group entity.
     *
     */
    public function createAction(Request $request)
    {
       
        
        if ( $this->get('security.context')->isGranted('ROLE_ADMIN')) {
        $entity  = new Group();
        $form = $this->createForm(new GroupType(), $entity);
        $form->bind($request);
         
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success' , 'Se ha creado un nuevo grupo.');
            return $this->redirect($this->generateUrl('group_edit', array('id' => $entity->getId())));
        }
        
        

        return $this->render('BackendUserBundle:Group:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
           
        ));
      }
      else
       throw new AccessDeniedException(); 
    }

    /**
    * Creates a form to create a Group entity.
    *
    * @param Group $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Group $entity)
    {
        $form = $this->createForm(new GroupType(), $entity, array(
            'action' => $this->generateUrl('group_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Group entity.
     *
     */
    public function newAction()
    {
      
        if ( $this->get('security.context')->isGranted('ROLE_ADMIN')) {
        $entity = new Group();
        $form   = $this->createForm(new GroupType(), $entity);

        return $this->render('BackendUserBundle:Group:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
            
        ));
       }
       else
          throw new AccessDeniedException();
      
      
        
    }

    /**
     * Finds and displays a Group entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendUserBundle:Group')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Group entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BackendUserBundle:Group:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Group entity.
     *
     */
    public function editAction($id)
    {
      
        
         if ( $this->get('security.context')->isGranted('ROLE_ADMIN')) { 
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendUserBundle:Group')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se ha encontrado el grupo.');
        }

        $editForm = $this->createForm(new GroupType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BackendUserBundle:Group:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            
        ));
      }
      else
         throw new AccessDeniedException();   
        
    }

    /**
    * Creates a form to edit a Group entity.
    *
    * @param Group $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Group $entity)
    {
        $form = $this->createForm(new GroupType(), $entity, array(
            'action' => $this->generateUrl('group_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Group entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
       
        if ( $this->get('security.context')->isGranted('ROLE_ADMIN')) {  
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendUserBundle:Group')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se ha encontrado el grupo.');
        }

       $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new GroupType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
             $this->get('session')->getFlashBag()->add('success' , 'Se ha actualizado el grupo.');
            return $this->redirect($this->generateUrl('group_edit', array('id' => $id)));
        }

        return $this->render('BackendUserBundle:Group:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            
        ));
      }
      else
         throw new AccessDeniedException();  
        
    }
    /**
     * Deletes a Group entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
      
        
        if ( $this->get('security.context')->isGranted('ROLE_ADMIN')) { 
            $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BackendUserBundle:Group')->find($id);

            if (!$entity) {
                $this->get('session')->getFlashBag()->add('error' , 'No se ha borrado el grupo.');
                throw $this->createNotFoundException('No se ha encontrado el grupo.');
            }
           if ( $entity->getRole()  != $this->container->getParameter("role_admin") )          {
            $em->remove($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success' , 'Se ha borrado el grupo.');
            }
            else
            $this->get('session')->getFlashBag()->add('error' , 'No se puede borrar el grupo de administrador.');
        }

        return $this->redirect($this->generateUrl('group' ));
      }
      else
       throw new AccessDeniedException(); 
        
    }

    /**
     * Creates a form to delete a Group entity by id.
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
