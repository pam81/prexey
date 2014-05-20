<?php

namespace Backend\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Backend\UserBundle\Entity\User;
use Backend\UserBundle\Form\UserType;
use Backend\UserBundle\Form\ProfileType;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
/**
 * User controller.
 *
 */
class UserController extends Controller
{
    /**
     * Lists all User entities.
     * ADMIN: solo puede tener acceso a abm de usuarios
     */
     
    public function setContainer(ContainerInterface $container = null)
{
     parent::setContainer($container); 
   
}
     
    public function indexAction(Request $request,$search)
    {
     
      if ( $this->get('security.context')->isGranted('ROLE_VIEWUSER')) {
        $em = $this->getDoctrine()->getManager();
         //setear la busqueda del place para direccionar luego
        $this->get('session')->set('user_search',$search);
        
        $dql="SELECT u FROM BackendUserBundle:User u where u.isDelete=0 ";
        if($search)
          $dql .= " and (u.username like '%$search%' or u.email like '%$search%' or u.name like '%$search%' or u.lastname like '%$search%' )";
        
        $dql .=" order by u.username"; 
        $query = $em->createQuery($dql);
        
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
        $query,
        $this->get('request')->query->get('page', 1)/*page number*/,
        $this->container->getParameter('max_on_listepage')/*limit per page*/
    );
        
        $deleteForm = $this->createDeleteForm(0);
        return $this->render('BackendUserBundle:User:index.html.twig', 
        array('pagination' => $pagination,
        'delete_form' => $deleteForm->createView(),
        'search'=>$search
        ));
        
    }
     else
         throw new AccessDeniedException();  
        
    
    }

    /**
     * Creates a new User entity.
     *
     */
    public function createAction(Request $request)
    {
       
        if ( $this->get('security.context')->isGranted('ROLE_ADDUSER')) {
        $entity  = new User();
        $form = $this->createForm(new UserType(), $entity);
        $form->bind($request);
         
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success' , 'Se ha creado un nuevo usuario.');
            return $this->redirect($this->generateUrl('user_edit', array('id' => $entity->getId())));
        }
        
        

        return $this->render('BackendUserBundle:User:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
           
        ));
      }
      else
       throw new AccessDeniedException();    
    }

    /**
     * Displays a form to create a new User entity.
     *
     */
    public function newAction()
    {
        if ( $this->get('security.context')->isGranted('ROLE_ADDUSER')) {
        $entity = new User();
        $form   = $this->createForm(new UserType(), $entity);

        return $this->render('BackendUserBundle:User:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
            
        ));
       }
       else
          throw new AccessDeniedException();   
    }

    /**
     * Finds and displays a User entity.
     *
     */
    public function showAction($id)
    {
      if ( $this->get('security.context')->isGranted('ROLE_VIEWUSER')) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendUserBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se ha encontrado el usuario.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BackendUserBundle:User:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
      }
      else
         throw new AccessDeniedException();        
    }

    /**
     * Displays a form to edit an existing User entity.
     *
     */
    public function editAction($id)
    {
       if ( $this->get('security.context')->isGranted('ROLE_MODUSER')) { 
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendUserBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se ha encontrado el usuario.');
        }

        $editForm = $this->createForm(new UserType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BackendUserBundle:User:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            
        ));
      }
      else
         throw new AccessDeniedException();    
    }

    /**
     * Edits an existing User entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
       if ( $this->get('security.context')->isGranted('ROLE_MODUSER')) {  
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendUserBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se ha encontrado el usuario.');
        }

       $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new UserType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
             $this->get('session')->getFlashBag()->add('success' , 'Se ha actualizado el usuario.');
            return $this->redirect($this->generateUrl('user_edit', array('id' => $id)));
        }

        return $this->render('BackendUserBundle:User:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            
        ));
      }
      else
         throw new AccessDeniedException();    
        
    }

    /**
     * Deletes a User entity.
     *  No se borra se pone en true isDelete
     */
    public function deleteAction(Request $request, $id)
    {
        if ( $this->get('security.context')->isGranted('ROLE_DELUSER')) { 
            $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BackendUserBundle:User')->find($id);

            if (!$entity) {
                $this->get('session')->getFlashBag()->add('error' , 'No se ha borrado el usuario.');
                throw $this->createNotFoundException('No se ha encontrado el Usuario.');
            }
            $entity->setIsDelete(true);
            $entity->setIsActive(false);
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success' , 'Se ha borrado el usuario.');
        }

        return $this->redirect($this->generateUrl('user',array('search' => $this->get('session')->get('user_search') )));
      }
      else
       throw new AccessDeniedException();    
    }
    
    
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    
    public function profileAction(Request $request) {
        
        $user=$this->getUser();
        
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendUserBundle:User')->find($user->getId());

        if (!$entity) {
            throw $this->createNotFoundException('No se ha encontrado el usuario.');
        }

        $editForm = $this->createForm(new ProfileType(), $entity);
       

      $defaultData = array('message' => 'Type your message here');
      $form = $this->createFormBuilder($defaultData)
         ->add('password', 'repeated', array(
                        'type' => 'password',
                        'invalid_message' => 'No coincide la contraseña.',
                        'options' => array('attr' => array('class' => 'password-field')),
                        'required' => true,
                        'first_options'  => array('label' => 'Contraseña'),
                        'second_options' => array('label' => 'Repetir contraseña'),
                    ))
        
    
     
        ->getForm();

        if ($request->isMethod('POST')) {
          //update del profile
          if ($request->get('action') == 'update')
          {
          try{  
               
             $editForm->bind($request);

             if ($editForm->isValid()) {
               $em->persist($entity);
               $em->flush();
               $this->get('session')->getFlashBag()->add('success' , 'Se ha actualizado el perfil.');
            
             }
             else
                $this->get('session')->getFlashBag()->add('error' , 'No se ha podido modificar su perfil.');
             
           }
           catch(\Exception $e){
           
             $this->get('session')->getFlashBag()->add('error' , 'No se ha podido modificar su perfil.');
           }  
             
          }
          //change es para cambiar la contraseña
          if ($request->get('action') == 'change')
          {  
             $form->bind($request);
            // data is an array with "password", "confirm" as keys
            
            if ($form->isValid()){
                $data = $form->getData();
                $entity->setPassword($data["password"]);
                $em->persist($entity);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success' , 'Se ha cambiado su contraseña.');
            }
            else
                $this->get('session')->getFlashBag()->add('error' , 'No se ha podido modificar su contraseña.');
          }  
        }
        
        return $this->render('BackendUserBundle:User:profile.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'pass'   => $form->createView()
            
        ));
        
        
        
    }
    
    public function registerAction(Request $request)
    {
        $usuario=array();
        $usuario["email"] = $this->getRequest()->get("email", null);
        $usuario["username"] = $this->getRequest()->get("username", null);
    		$usuario["password"] = $this->getRequest()->get("password", null);
    		$usuario["name"] = $this->getRequest()->get("name", null);
        $usuario["lastname"] = $this->getRequest()->get("lastname", null);
        $usuario["empleado"] = $this->getRequest()->get("empleado", null);
        $usuario["role"]=$this->container->getParameter("role_default");
        
        
    		$service = new \Backend\UserBundle\Services\UserService($this->get('doctrine.orm.default_entity_manager'));
    		$registerResponse = $service->register($usuario);
    		
    		$respuesta=json_decode($registerResponse);
    		
    		if ($respuesta->status == 0) //se creo el usuario envio mail
    		{
    		  $em = $this->getDoctrine()->getManager();
          $empresa = $em->getRepository('BackendUserBundle:Seteo')->findOneByName("empresa");
    		  $email_site = $em->getRepository('BackendUserBundle:Seteo')->findOneByName("email");
    		  
    		  $url= $this->generateUrl(
            'activate_account',
            array('codigo' =>$respuesta->codigo ), true );
    		  
    		  $message = \Swift_Message::newInstance()
                    ->setSubject("Registro en ".$empresa->getValue())
                    ->setFrom($email_site->getValue())
                    ->setTo($usuario["email"])
                    ->setBody(
                        $this->renderView(
                            'BackendUserBundle:User:register_email.html.twig',
                            array('name' => $usuario["name"],
                             'url' =>$url
                             )
                        ),'text/html'
                    );
        
        
         
          $this->get('mailer')->send($message);
    		}
    		
    		$response = new Response($registerResponse);
    		$response->headers->set('Content-Type', 'application/json');
    		
    		return $response;
        
    }
    
    public function forgotPasswordAction(Request $request){
     
    if ($request->getMethod() == 'POST') {
    	$service = new \Backend\UserBundle\Services\UserService($this->get('doctrine.orm.default_entity_manager'));
    	$forgotResponse = $service->forgotPassword($this->getRequest()->get("email", null));
    		
    	$respuesta=json_decode($forgotResponse);
    
      if ($respuesta->status == 0) //se creo el usuario envio mail
    		{
    		  $em = $this->getDoctrine()->getManager();
          $empresa = $em->getRepository('BackendUserBundle:Seteo')->findOneByName("empresa");
    		  $email_site = $em->getRepository('BackendUserBundle:Seteo')->findOneByName("email");
    		  $url= $this->generateUrl(
            'change_pass',
            array('codigo' =>$respuesta->codigo ), true );
        
          $message = \Swift_Message::newInstance()
                    ->setSubject("Olvido su Contraseña en el sitio ".$empresa->getValue())
                    ->setFrom($email_site->getValue())
                    ->setTo($respuesta->email)
                    ->setBody(
                        $this->renderView(
                            'BackendUserBundle:User:forgot_email.html.twig',
                            array('name' => $respuesta->name,
                                   'url' => $url  )
                        ),'text/html'
                    );
        
        
         
          $this->get('mailer')->send($message);
         $this->get('session')->getFlashBag()->add('success' , 'Se ha enviado un mail para cambiar su contraseña.');  
    		}
    	else{
          $this->get('session')->getFlashBag()->add('error' , 'No se ha encontrado el usuario.');
      }	
    
    }
     return $this->render('BackendUserBundle:User:forgot.html.twig');         
        
    
    }
    
    public function changePasswordAction(Request $request, $codigo){
    
       
    if ($request->getMethod() == 'POST') {
       if ($codigo != '')
       {
       	$cambio=array("codigo"=>$this->getRequest()->get("codigo", null),
                      "password"=>$this->getRequest()->get("password", null)
         );
         
        $service = new \Backend\UserBundle\Services\UserService($this->get('doctrine.orm.default_entity_manager'));
      	$response = $service->changePassword($cambio);
    		
      	$respuesta=json_decode($response);
      
      	if ($respuesta->status == 0) //se cambio la contraseña
    		{
    		  $em = $this->getDoctrine()->getManager();
          $empresa = $em->getRepository('BackendUserBundle:Seteo')->findOneByName("empresa");
    		  $email_site = $em->getRepository('BackendUserBundle:Seteo')->findOneByName("email");
    		  
          $message = \Swift_Message::newInstance()
                    ->setSubject("Cambio de Contraseña para el sitio ".$empresa->getValue())
                    ->setFrom($email_site->getValue())
                    ->setTo($respuesta->email)
                    ->setBody(
                        $this->renderView(
                            'BackendUserBundle:User:changepass_email.html.twig',
                            array('name' => $respuesta->name,
                                   'username' => $respuesta->username,
                                    'password' => $respuesta->password )
                        ),'text/html'
                    );
        
        
         
          $this->get('mailer')->send($message);
         $this->get('session')->getFlashBag()->add('success' , 'Se ha enviado un mail con los datos de su cuenta.');  
    		}
    	else{
          $this->get('session')->getFlashBag()->add('error' , 'No se ha encontrado el usuario.');
      }	
    
       }
       else{
       
       $this->get('session')->getFlashBag()->add('error' , 'Link incorrecto.');
       }
    
    
    }
       return $this->render('BackendUserBundle:User:change.html.twig', array('codigo'=>$codigo));
     
       
       
    
    }
    
    
    public function activateAccountAction(Request $request, $codigo){
    
       
   
       if ($codigo != '')
       {
       	$codigo=$this->getRequest()->get("codigo", null);
         
        $service = new \Backend\UserBundle\Services\UserService($this->get('doctrine.orm.default_entity_manager'));
      	$response = $service->activateAccount($codigo);
    		
      	$respuesta=json_decode($response);
      
      	if ($respuesta->status == 0) //se activo la cuenta
    		{
    		  $em = $this->getDoctrine()->getManager();
          $empresa = $em->getRepository('BackendUserBundle:Seteo')->findOneByName("empresa");
    		  $email_site = $em->getRepository('BackendUserBundle:Seteo')->findOneByName("email");
    		  
          $message = \Swift_Message::newInstance()
                    ->setSubject("Activo su cuenta para el sitio ".$empresa->getValue())
                    ->setFrom($email_site->getValue())
                    ->setTo($respuesta->email)
                    ->setBody(
                        $this->renderView(
                            'BackendUserBundle:User:activar_email.html.twig',
                            array('name' => $respuesta->name)
                        ),'text/html'
                    );
        
        
         
          $this->get('mailer')->send($message);
         $this->get('session')->getFlashBag()->add('success' , 'Se ha activado su cuenta correctamente.');  
    		}
    	else{
          $this->get('session')->getFlashBag()->add('error' , 'No se ha podido activar la cuenta.');
      }	
    
       }
       else{
       
       $this->get('session')->getFlashBag()->add('error' , 'Link incorrecto.');
       }
    
    
    
       return $this->render('BackendUserBundle:User:activate_account.html.twig', array('codigo'=>$codigo));
     
       
       
    
    }
    

    
}
