<?php

namespace Backend\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Backend\AdminBundle\Entity\TipoViaje;
use Backend\AdminBundle\Form\TipoViajeType;

/**
 * TipoViaje controller.
 *
 */
class TipoViajeController extends Controller
{

    /**
     * Lists all TipoViaje entities.
     *
     */
    public function indexAction(Request $request,$search)
    {
         if ( $this->get('security.context')->isGranted('ROLE_VIEWTIPOVIAJE')) {
        $em = $this->getDoctrine()->getManager();

        $dql="SELECT u FROM BackendAdminBundle:TipoViaje u where u.isDelete=false";
        
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
        return $this->render('BackendAdminBundle:TipoViaje:index.html.twig', 
        array('pagination' => $pagination,
        'delete_form' => $deleteForm->createView(),
        'search'=>$search
        
        ));
        
    }
     else
         throw new AccessDeniedException();  
    }
    /**
     * Creates a new TipoViaje entity.
     *
     */
    public function createAction(Request $request)
    {
         if ( $this->get('security.context')->isGranted('ROLE_ADDTIPOVIAJE')) {
        $entity  = new TipoViaje();
        $form = $this->createForm(new TipoViajeType(), $entity);
        $form->bind($request);
         
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success' , 'Se ha agregado un nuevo tipo de viaje.');
            return $this->redirect($this->generateUrl('tipoviaje_edit', array('id' => $entity->getId())));
        }
        
        

        return $this->render('BackendAdminBundle:TipoViaje:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
           
        ));
      }
      else
       throw new AccessDeniedException();
    }

    /**
    * Creates a form to create a TipoViaje entity.
    *
    * @param TipoViaje $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(TipoViaje $entity)
    {
        $form = $this->createForm(new TipoViajeType(), $entity, array(
            'action' => $this->generateUrl('tipoviaje_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new TipoViaje entity.
     *
     */
    public function newAction()
    {if ( $this->get('security.context')->isGranted('ROLE_ADDTIPOVIAJE')) {
        $entity = new TipoViaje();
        $form   = $this->createForm(new TipoViajeType(), $entity);

        return $this->render('BackendAdminBundle:TipoViaje:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
            
        ));
       }
       else
          throw new AccessDeniedException();
    }

   
    /**
     * Displays a form to edit an existing TipoViaje entity.
     *
     */
    public function editAction($id)
    {
         if ( $this->get('security.context')->isGranted('ROLE_MODTIPOVIAJE')) { 
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendAdminBundle:TipoViaje')->find($id);

        if (!$entity) {
            
             $this->get('session')->getFlashBag()->add('error' , 'No se ha encontrado el tipo de viaje .');
             return $this->redirect($this->generateUrl('tipoviaje'));
        }

        $editForm = $this->createForm(new TipoViajeType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BackendAdminBundle:TipoViaje:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            
        ));
      }
      else
         throw new AccessDeniedException(); 
    }

    /**
    * Creates a form to edit a TipoViaje entity.
    *
    * @param TipoViaje $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TipoViaje $entity)
    {
        $form = $this->createForm(new TipoViajeType(), $entity, array(
            'action' => $this->generateUrl('tipoviaje_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing TipoViaje entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
         if ( $this->get('security.context')->isGranted('ROLE_MODTIPOVIAJE')) {  
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendAdminBundle:TipoViaje')->find($id);

        if (!$entity) {
             $this->get('session')->getFlashBag()->add('error' , 'No se ha encontrado el tipo de viaje.');
             return $this->redirect($this->generateUrl('tipoviaje'));
        }

       $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new TipoViajeType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
             $this->get('session')->getFlashBag()->add('success' , 'Se han actualizado los datos del tipo de viaje.');
            return $this->redirect($this->generateUrl('tipoviaje_edit', array('id' => $id)));
        }

        return $this->render('BackendAdminBundle:TipoViaje:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            
        ));
      }
      else
         throw new AccessDeniedException();  
    }
    /**
     * Deletes a TipoViaje entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
         if ( $this->get('security.context')->isGranted('ROLE_DELTIPOVIAJE')) { 
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BackendAdminBundle:TipoViaje')->find($id);

            if (!$entity) {
                $this->get('session')->getFlashBag()->add('error' , 'No se ha encontrado el tipo de viaje indicado.');
             
            }
           else{
            $entity->setIsDelete(true); //baja lógica
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success' , 'Se han borrado los datos del tipo de viaje.');
            }
        }

        return $this->redirect($this->generateUrl('tipoviaje' ));
      }
      else
       throw new AccessDeniedException();
    }

    /**
     * Creates a form to delete a TipoViaje entity by id.
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
