<?php
  
namespace Backend\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Backend\AdminBundle\Entity\TipoCosto;
use Backend\AdminBundle\Form\TipoCostoType;

/**
 * TipoCosto controller.
 *                                   
 */
class TipoCostoController extends Controller
{

    /**
     * Lists all TipoCosto entities.
     *
     */
    public function indexAction(Request $request,$search)
    {
         if ( $this->get('security.context')->isGranted('ROLE_VIEWTIPOCOSTO')) {
        $em = $this->getDoctrine()->getManager();

        $dql="SELECT u FROM BackendAdminBundle:TipoCosto u where u.isDelete=false";
        
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
        return $this->render('BackendAdminBundle:TipoCosto:index.html.twig', 
        array('pagination' => $pagination,
        'delete_form' => $deleteForm->createView(),
        'search'=>$search
        
        ));
        
    }
     else
         throw new AccessDeniedException();  
    }
    /**
     * Creates a new TipoCosto entity.
     *
     */
    public function createAction(Request $request)
    {
        if ( $this->get('security.context')->isGranted('ROLE_ADDTIPOCOSTO')) {
        $entity  = new TipoCosto();
        $form = $this->createForm(new TipoCostoType(), $entity);
        $form->bind($request);
         
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success' , 'Se ha agregado un nuevo tipo de costo.');
            return $this->redirect($this->generateUrl('tipocosto_edit', array('id' => $entity->getId())));
        }
        
        

        return $this->render('BackendAdminBundle:TipoCosto:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
           
        ));
      }
      else
       throw new AccessDeniedException();
    }

    /**
    * Creates a form to create a TipoCosto entity.
    *
    * @param TipoCosto $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(TipoCosto $entity)
    {
        $form = $this->createForm(new TipoCostoType(), $entity, array(
            'action' => $this->generateUrl('tipocosto_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new TipoCosto entity.
     *
     */
    public function newAction()
    {
        if ( $this->get('security.context')->isGranted('ROLE_ADDTIPOCOSTO')) {
        $entity = new TipoCosto();
        $form   = $this->createForm(new TipoCostoType(), $entity);

        return $this->render('BackendAdminBundle:TipoCosto:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
            
        ));
       }
       else
          throw new AccessDeniedException();
    }

   

    /**
     * Displays a form to edit an existing TipoCosto entity.
     *
     */
    public function editAction($id)
    {
         if ( $this->get('security.context')->isGranted('ROLE_MODTIPOCOSTO')) { 
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendAdminBundle:TipoCosto')->find($id);
                                                                  
        if (!$entity) {
            
             $this->get('session')->getFlashBag()->add('error' , 'No se ha encontrado el tipo de costo .');
             return $this->redirect($this->generateUrl('tipocosto'));
        }

        $editForm = $this->createForm(new TipoCostoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BackendAdminBundle:TipoCosto:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            
        ));
      }
      else
         throw new AccessDeniedException(); 
    }

    /**
    * Creates a form to edit a TipoCosto entity.
    *
    * @param TipoCosto $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TipoCosto $entity)
    {
        $form = $this->createForm(new TipoCostoType(), $entity, array(
            'action' => $this->generateUrl('tipocosto_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing TipoCosto entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
         if ( $this->get('security.context')->isGranted('ROLE_MODTIPOCOSTO')) {  
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendAdminBundle:TipoCosto')->find($id);

        if (!$entity) {
             $this->get('session')->getFlashBag()->add('error' , 'No se ha encontrado el tipo de costo.');
             return $this->redirect($this->generateUrl('tipocosto'));
        }

       $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new TipoCostoType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
             $this->get('session')->getFlashBag()->add('success' , 'Se han actualizado los datos del tipo de costo.');
            return $this->redirect($this->generateUrl('tipocosto_edit', array('id' => $id)));
        }

        return $this->render('BackendAdminBundle:TipoCosto:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            
        ));
      }
      else
         throw new AccessDeniedException();  
    }
    /**
     * Deletes a TipoCosto entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
         if ( $this->get('security.context')->isGranted('ROLE_DELTIPOCOSTO')) { 
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BackendAdminBundle:TipoCosto')->find($id);

            if (!$entity) {
                $this->get('session')->getFlashBag()->add('error' , 'No se ha encontrado el tipo de costo indicado.');
             
            }
           else{                                                               
            $entity->setIsDelete(true); //baja lógica
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success' , 'Se han borrado los datos del tipo de costo.');
            }
        }

        return $this->redirect($this->generateUrl('tipocosto' ));
      }
      else
       throw new AccessDeniedException();
    }

    /**
     * Creates a form to delete a TipoCosto entity by id.
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
