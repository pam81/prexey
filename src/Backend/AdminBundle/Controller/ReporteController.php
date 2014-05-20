<?php 
namespace Backend\AdminBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class ReporteController extends Controller
{
   
   
   public function generateSQLViajesCerrados(Request $request)
   {
   
      $dql="SELECT u FROM BackendAdminBundle:Viaje u JOIN u.estado e
      JOIN u.camion c  JOIN u.chofer h  JOIN u.created_by o
      JOIN u.deposito d
       ";   
      $where= " where u.isDelete=false and e.code='RENDIDO' 
      ";
      $search=array("date"=>'',"camion"=>'',"chofer"=>'',"operario"=>'');
      //no quiero los filtros si esta clear-filter
      if (!$request->query->get("clear-filter")){  
        
          if ($request->query->get("camion"))
         {  $search["camion"]=$request->query->get("camion");
              
              $where .= " and (c.patente like '%".$search["camion"]."%' )";
         }
         if ($request->query->get("date"))
        {    
             $search["date"]= date("Y-m-d",strtotime($request->query->get("date")));
            $where .= " and (u.fecha_regreso like '%".$search["date"]."%' )"; 
        }
         if ($request->query->get("chofer"))
        {   $search["chofer"]=$request->query->get("chofer");
             
           $where .= " and (h.name like '%".$search["chofer"]."%' or h.lastname like '%".$search["chofer"]."%' )";
       
         }        
         if ($request->query->get("operario"))
         {   $search["operario"]= $request->query->get("operario");
           
             $where .= " and (o.name like '%".$search["operario"]."%' or o.lastname like '%".$search["operario"]."%' or o.username like '%".$search["operario"]."%' )"; 
          }   
  
      }
        
        $dql .=$where." order by u.fecha_salida";
      $search["dql"]=$dql;
     return $search;
   
   }
   

    public function reporteViajesCerradosAction(Request $request)
    {
        if ( $this->get('security.context')->isGranted('ROLE_REPOCERRADO')) {
        $em = $this->getDoctrine()->getManager();
        $search=$this->generateSQLViajesCerrados($request); 
         
        $query = $em->createQuery($search["dql"]);
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
        $query,
        $this->get('request')->query->get('page', 1)/*page number*/, 
        $this->container->getParameter('max_on_listepage')/*limit per page*/
    );
        
        
        return $this->render('BackendAdminBundle:Reporte:cerrados.html.twig', 
        array('pagination' => $pagination,
        'search'=>$search
        ));
        }
        else{
           throw new AccessDeniedException(); 
        }
    
    
    }
    
    
    
    public function exportarCerradosAction(Request $request)
    {
     if ( $this->get('security.context')->isGranted('ROLE_REPOCERRADO')) {
         
         $em = $this->getDoctrine()->getManager();

       
        $search=$this->generateSQLViajesCerrados($request); 
           
       
        $query = $em->createQuery($search["dql"]);
        
        $excelService = $this->get('xls.service_xls5');
                         
                            
        $excelService->excelObj->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Fecha Salida')
                    ->setCellValue('B1', 'Hora Salida')
                    ->setCellValue('C1', 'Fecha Regreso')
                    ->setCellValue('D1', 'Hora Regreso')
                    ->setCellValue('E1', 'Camión')
                    ->setCellValue('F1', 'Chofer')
                    ->setCellValue('G1', 'Depósito');
                  
        
        $resultados=$query->getResult();
        $i=2;
        foreach($resultados as $r)
        {
         
           $excelService->excelObj->setActiveSheetIndex(0)
                         ->setCellValue("A$i",$r->getFechaSalida()->format("d-m-Y"))
                         ->setCellValue("B$i",$r->getHoraSalida()->format("H:i"))
                         ->setCellValue("C$i",$r->getFechaRegreso()->format("d-m-Y"))
                         ->setCellValue("D$i",$r->getHoraRegreso()->format("H:i"))
                         ->setCellValue("E$i",$r->getCamion()->__toString())
                         ->setCellValue("F$i",$r->getChofer()->__toString())
                         ->setCellValue("G$i",$r->getDeposito()->__toString());
          $i++;
        }
                            
        $excelService->excelObj->getActiveSheet()->setTitle('Viajes Rendidos');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $excelService->excelObj->setActiveSheetIndex(0);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        
        
        $fileName="viajes_rendidos_".date("Ymd").".xls";
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
    
    
     public function generateSQLHruta(Request $request)
   {
   
      
       $dql="SELECT u FROM BackendAdminBundle:Hoja u JOIN u.viaje v
               JOIN v.camion c JOIN v.chofer h JOIN v.deposito d
               JOIN u.deposito n JOIN v.estado e
       ";
          
      $where= " where v.isDelete = false and e.code!='ANULADO' ";
      
      $search=array("deposito"=>'',"camion"=>'',"chofer"=>'',"destino"=>'',"viaje"=>'',"pedido"=>'');
      //no quiero los filtros si esta clear-filter
      if (!$request->query->get("clear-filter")){  
        
          if ($request->query->get("camion"))
         {  $search["camion"]=$request->query->get("camion");
              
              $where .= " and (c.patente like '%".$search["camion"]."%' )";
         }
         if ($request->query->get("deposito"))
        {    
             $search["deposito"]= $request->query->get("deposito");
            $where .= " and (d.name like '%".$search["deposito"]."%' )"; 
        } 
         if ($request->query->get("chofer"))
        {   $search["chofer"]=$request->query->get("chofer");
             
           $where .= " and (h.name like '%".$search["chofer"]."%' or h.lastname like '%".$search["chofer"]."%' )";
       
         } 
         
         if ($request->query->get("viaje"))
         {   $search["viaje"]= $request->query->get("viaje");
           
             $where .= " and v.id = ".$search["viaje"]; 
          }        
         if ($request->query->get("destino"))
         {   $search["destino"]= $request->query->get("destino");
           
             $where .= " and (n.name like '%".$search["destino"]."%') "; 
          } 
          
          if ($request->query->get("pedido"))
         {   $search["pedido"]= $request->query->get("pedido");
           
             $where .= " and (u.numero = ".$search["pedido"].") "; 
          }   
  
      } 
        
        $dql .=$where." order by v.id,u.orden";
      $search["dql"]=$dql;
     return $search;
   
   }
    
    
     public function reporteHrutaAction(Request $request)
    {
        if ( $this->get('security.context')->isGranted('ROLE_REPOHRUTA')) {
        $em = $this->getDoctrine()->getManager();
        $search=$this->generateSQLHruta($request); 
         
        $query = $em->createQuery($search["dql"]);
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
        $query,
        $this->get('request')->query->get('page', 1)/*page number*/, 
        $this->container->getParameter('max_on_listepage')/*limit per page*/
    );
        
        
        return $this->render('BackendAdminBundle:Reporte:hruta.html.twig', 
        array('pagination' => $pagination,
        'search'=>$search
        ));
        }
        else{
           throw new AccessDeniedException(); 
        }
    
    
    }
    
    
    public function exportarHrutaAction(Request $request)
    {
     if ( $this->get('security.context')->isGranted('ROLE_REPOHRUTA')) {
         
         $em = $this->getDoctrine()->getManager();

       
        $search=$this->generateSQLHruta($request); 
           
       
        $query = $em->createQuery($search["dql"]);
        
        $excelService = $this->get('xls.service_xls5');
                         
                            
        $excelService->excelObj->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Nº viaje')
                    ->setCellValue('B1', 'Depósito')
                    ->setCellValue('C1', 'Chofer')
                    ->setCellValue('D1', 'Camión')
                    ->setCellValue('E1', 'Interno')
                    ->setCellValue('F1', 'Fecha')
                    ->setCellValue('G1', 'Hora')
                    ->setCellValue('H1', 'Tipo viaje')
                    ->setCellValue('I1', 'Orden')
                    ->setCellValue('J1', 'Cliente')
                    ->setCellValue('K1', 'Destino')
                    ->setCellValue('L1', 'Número');
                    
                   
                  
        
        $resultados=$query->getResult();
        $i=2;
        foreach($resultados as $r)
        {   
               
           $excelService->excelObj->setActiveSheetIndex(0)
                         ->setCellValue("A$i",$r->getViaje()->getId())
                         ->setCellValue("B$i",$r->getViaje()->getDeposito()->__toString())
                         ->setCellValue("C$i",$r->getViaje()->getChofer()->__toString())
                         ->setCellValue("D$i",$r->getViaje()->getCamion()->__toString())
                         ->setCellValue("E$i",$r->getViaje()->getCamion()->getInterno())
                         ->setCellValue("F$i",$r->getViaje()->getFechaSalida()->format("d-m-Y"))
                         ->setCellValue("G$i",$r->getViaje()->getHoraSalida()->format("H:i"))
                         ->setCellValue("H$i",$r->getViaje()->getTipoviaje()->__toString())
                         ->setCellValue("I$i",$r->getOrden())
                         ->setCellValue("J$i",$r->getCliente()->__toString())
                         ->setCellValue("K$i",$r->getDeposito()->__toString())
                         ->setCellValue("L$i",$r->getNumero());
                        
                         
                         
                         
          $i++;
        }
                            
        $excelService->excelObj->getActiveSheet()->setTitle('Hoja de ruta de viajes');
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
        
        
        
        $fileName="hruta_viajes_".date("Ymd").".xls";
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
    
    
    public function generateSQLCostos(Request $request)
   {
   
      
       $dql="SELECT u FROM BackendAdminBundle:Costo u JOIN u.viaje v
             JOIN u.tipo t  JOIN v.camion c JOIN v.chofer h JOIN v.deposito d
             JOIN v.estado e
       ";
          
      $where= " where u.isDelete=false  and v.isDelete = false and e.code!='ANULADO' ";
      
      $search=array("deposito"=>'',"camion"=>'',"chofer"=>'',"tipocosto"=>'',"viaje"=>'');
      //no quiero los filtros si esta clear-filter
      if (!$request->query->get("clear-filter")){  
        
          if ($request->query->get("camion"))
         {  $search["camion"]=$request->query->get("camion");
              
              $where .= " and (c.patente like '%".$search["camion"]."%' )";
         }
         if ($request->query->get("deposito"))
        {    
             $search["deposito"]= $request->query->get("deposito");
            $where .= " and (d.name like '%".$search["deposito"]."%' )"; 
        } 
         if ($request->query->get("chofer"))
        {   $search["chofer"]=$request->query->get("chofer");
             
           $where .= " and (h.name like '%".$search["chofer"]."%' or h.lastname like '%".$search["chofer"]."%' )";
       
         } 
         
         if ($request->query->get("viaje"))
         {   $search["viaje"]= $request->query->get("viaje");
           
             $where .= " and v.id = ".$search["viaje"]; 
          }        
         if ($request->query->get("tipocosto"))
         {   $search["tipocosto"]= $request->query->get("tipocosto");
           
             $where .= " and t.texto like '%".$search["tipocosto"]."%'"; 
          }   
  
      } 
        
        $dql .=$where." order by u.fecha";
      $search["dql"]=$dql;
     return $search;
   
   }
   
   
   public function reporteCostosAction(Request $request)
    {
        if ( $this->get('security.context')->isGranted('ROLE_REPOCOSTOS')) {
        $em = $this->getDoctrine()->getManager();
        $search=$this->generateSQLCostos($request); 
         
        $query = $em->createQuery($search["dql"]);
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
        $query,
        $this->get('request')->query->get('page', 1)/*page number*/, 
        $this->container->getParameter('max_on_listepage')/*limit per page*/
    );
        
        
        return $this->render('BackendAdminBundle:Reporte:costos.html.twig', 
        array('pagination' => $pagination,
        'search'=>$search
        ));
        }
        else{
           throw new AccessDeniedException(); 
        }
    
    
    }
   
   public function exportarCostosAction(Request $request)
    {
     if ( $this->get('security.context')->isGranted('ROLE_REPOCOSTOS')) {
         
         $em = $this->getDoctrine()->getManager();

       
        $search=$this->generateSQLCostos($request); 
           
       
        $query = $em->createQuery($search["dql"]);
        
        $excelService = $this->get('xls.service_xls5');
                         
                            
        $excelService->excelObj->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Nº viaje')
                    ->setCellValue('B1', 'Chofer')
                    ->setCellValue('C1', 'Camión')
                    ->setCellValue('D1', 'Interno')
                    ->setCellValue('E1', 'Depósito')
                    ->setCellValue('F1', 'Fecha')
                    ->setCellValue('G1', 'Hora')
                    ->setCellValue('H1', 'Tipo viaje')
                    ->setCellValue('I1', 'Concepto')
                    ->setCellValue('J1', 'Tipo costo')
                    ->setCellValue('K1', 'Fecha')
                    ->setCellValue('L1', 'Recibo')
                    ->setCellValue('M1', 'Monto')
                    ->setCellValue('N1', 'Aprobado');
                  
        
        $resultados=$query->getResult();
        $i=2;
        foreach($resultados as $r)
        {   $aprobado="NO";
             if ($r->getIsAprobado())
               $aprobado="SI";
               
           $excelService->excelObj->setActiveSheetIndex(0)
                         ->setCellValue("A$i",$r->getViaje()->getId())
                         ->setCellValue("B$i",$r->getViaje()->getChofer()->__toString())
                         ->setCellValue("C$i",$r->getViaje()->getCamion()->__toString())
                         ->setCellValue("D$i",$r->getViaje()->getCamion()->getInterno())
                         ->setCellValue("E$i",$r->getViaje()->getDeposito()->__toString())
                         ->setCellValue("F$i",$r->getViaje()->getFechaSalida()->format("d-m-Y"))
                         ->setCellValue("G$i",$r->getViaje()->getHoraSalida()->format("H:i"))
                         ->setCellValue("H$i",$r->getViaje()->getTipoviaje()->__toString())
                         ->setCellValue("I$i",$r->getConcepto())
                         ->setCellValue("J$i",$r->getTipo()->__toString())
                         ->setCellValue("K$i",$r->getFecha()->format("d-m-Y"))
                         ->setCellValue("L$i",$r->getRecibo())
                         ->setCellValue("M$i",$r->getMonto())
                         ->setCellValue("N$i",$aprobado);
                         
                         
          $i++;
        }
                            
        $excelService->excelObj->getActiveSheet()->setTitle('Costos de viajes');
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
        
        
        $fileName="costos_viajes_".date("Ymd").".xls";
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
    
    /*public function generateSQLDescuentos(Request $request)
   {
   
      $dql="SELECT u FROM BackendAdminBundle:Costo u JOIN u.viaje v JOIN v.chofer c JOIN u.tipo t";   
      $where= " where u.isDelete=false and u.isAprobado=false ";
      $search=array("date_desde"=>'',"date_hasta"=>'',"chofer"=>'',"viaje"=>'',"monto"=>'',"recibo"=>'',"tipo"=>'');
      //no quiero los filtros si esta clear-filter
      if (!$request->query->get("clear-filter")){  
        
          
        if ($request->query->get("date_desde") && $request->query->get("date_hasta"))
        {    $search["date_desde"]= date("Y-m-d",strtotime($request->query->get("date_desde")));
             $search["date_hasta"]= date("Y-m-d",strtotime($request->query->get("date_hasta")));
            $where .= " and (u.fecha between '".$search["date_desde"]."' and '".$search["date_hasta"]."' )"; 
        }
        elseif ($request->query->get("date_desde"))
           {
             $search["date_desde"]= date("Y-m-d",strtotime($request->query->get("date_desde")));
             $where .=" and u.fecha >= '".$search["date_desde"]."' "; 
           }
        elseif ($request->query->get("date_hasta"))
        {
             $search["date_hasta"]= date("Y-m-d",strtotime($request->query->get("date_hasta")));
             $where .=" and u.fecha <= '".$search["date_hasta"]."' ";
        }
         if ($request->query->get("chofer"))
        {   $search["chofer"]=$request->query->get("chofer");
            $where .= " and (c.name like '%".$search["chofer"]."%' or c.lastname like '%".$search["chofer"]."%' )";
       
         }
         if ($request->query->get("monto"))
         {
           $search["monto"]=$request->query->get("monto");
            $where .= " and u.monto=".$search["monto"];
         }        
         
           if ($request->query->get("recibo"))
         {
           $search["recibo"]=$request->query->get("recibo");
            $where .= " and u.recibo=".$search["recibo"];
         }
         
           if ($request->query->get("viaje"))
         {
           $search["viaje"]=$request->query->get("viaje");
            $where .= " and v.id=".$search["viaje"];
         }
         
            if ($request->query->get("tipo"))
         {
           $search["tipo"]=$request->query->get("tipo");
            $where .= " and t.id=".$search["tipo"];
         }
    
      }
        
        $dql .=$where." order by u.fecha";
      $search["dql"]=$dql;
     return $search;
   
   }  */
   
   public function generateSQLDescuentos(Request $request){
      
      $search=array("date_desde"=>'',"tipo"=>'',"date_hasta"=>'',"chofer"=>'',"viaje"=>'',"monto"=>'',"recibo"=>'');
   
        
        $dql="SELECT u FROM BackendAdminBundle:Caja u JOIN u.chofer c LEFT JOIN u.viaje v
               LEFT JOIN u.costo t
         where u.isDelete=false ";
    
        if (!$request->query->get("clear-filter")){           
           if ($request->query->get("chofer"))
          {  $search["chofer"]=$request->query->get("chofer");
             $dql .= " and  c.name like '%".$search["chofer"]."%' or c.lastname like '%".$search["chofer"]." %' ";
           }
      
            if ($request->query->get("tipo"))
         {
           $search["tipo"]=$request->query->get("tipo");
            $dql .= " and t.tipo=".$search["tipo"];
         }
         
         if ($request->query->get("recibo"))
         {
           $search["recibo"]=$request->query->get("recibo");
            $dql .= " and t.recibo=".$search["recibo"];
         }
         
         if ($request->query->get("date_desde") && $request->query->get("date_hasta"))
        {    $search["date_desde"]= date("Y-m-d",strtotime($request->query->get("date_desde")));
             $search["date_hasta"]= date("Y-m-d",strtotime($request->query->get("date_hasta")));
            $dql .= " and (u.fecha between '".$search["date_desde"]."' and '".$search["date_hasta"]."' )"; 
        }
        elseif ($request->query->get("date_desde"))
           {
             $search["date_desde"]= date("Y-m-d",strtotime($request->query->get("date_desde")));
             $dql .=" and u.fecha >= '".$search["date_desde"]."' "; 
           }
        elseif ($request->query->get("date_hasta"))
        {
             $search["date_hasta"]= date("Y-m-d",strtotime($request->query->get("date_hasta")));
             $dql .=" and u.fecha <= '".$search["date_hasta"]."' ";
        }
        
         if ($request->query->get("monto"))
         {
           $search["monto"]=$request->query->get("monto");
            $dql .= " and u.monto=".$search["monto"];
         }
         
           if ($request->query->get("viaje"))
         {
           $search["viaje"]=$request->query->get("viaje");
            $dql .= " and v.id=".$search["viaje"];
         }
         }                  
        $dql .=" order by u.fecha desc";
        $search["dql"]=$dql;
        
        return $search;
                    
    }
    
   
  
    
    public function reporteDescuentoSueldoAction(Request $request)
    {
        if ( $this->get('security.context')->isGranted('ROLE_REPODTOSUELDO')) {
         $em = $this->getDoctrine()->getManager();
        $search=$this->generateSQLDescuentos($request); 
         
        $query = $em->createQuery($search["dql"]);
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
        $query,
        $this->get('request')->query->get('page', 1)/*page number*/, 
        $this->container->getParameter('max_on_listepage')/*limit per page*/
    );
        $tipos=$em->getRepository("BackendAdminBundle:Tipocosto")->findAll();
          
        return $this->render('BackendAdminBundle:Reporte:descuentos.html.twig', 
        array('pagination' => $pagination,
        'search'=>$search,
        'tipos'=>$tipos,
        ));
        
        }
        else{
           throw new AccessDeniedException(); 
        }
    
    
    }
    
    
    public function exportarDescuentoSueldoAction(Request $request)
    {
     if ( $this->get('security.context')->isGranted('ROLE_REPODTOSUELDO')) {
         
         $em = $this->getDoctrine()->getManager();

       
        $search=$this->generateSQLDescuentos($request); 
           
       
        $query = $em->createQuery($search["dql"]);
        
        $excelService = $this->get('xls.service_xls5');
                         
                            
        $excelService->excelObj->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Fecha')
                    ->setCellValue('B1', 'Tipo')
                    ->setCellValue('C1', 'Motivo')
                    ->setCellValue('D1', 'Recibo')
                    ->setCellValue('E1', 'Monto')
                    ->setCellValue('F1', 'Chofer')
                    ->setCellValue('G1', 'Viaje');
        
        $resultados=$query->getResult();
        $i=2;
        foreach($resultados as $r)
        {
         
           $excelService->excelObj->setActiveSheetIndex(0)
                         ->setCellValue("A$i",$r->getFecha()->format("d-m-Y"))
                         ->setCellValue("B$i",$r->getTipoText())
                         ->setCellValue("C$i",$r->getMotivo())
                         ->setCellValue("E$i",$r->getMonto())
                         ->setCellValue("F$i",$r->getChofer()->__toString());
                     if ($r->getCosto())    
                     {   $excelService->excelObj->setActiveSheetIndex(0)->setCellValue("D$i",$r->getCosto()->getRecibo()); }
                     if ($r->getViaje()) 
                     {    $excelService->excelObj->setActiveSheetIndex(0)->setCellValue("G$i",$r->getViaje()->__toString());}
                         
          $i++;
        }
                            
        $excelService->excelObj->getActiveSheet()->setTitle('Viajes Rendidos');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $excelService->excelObj->setActiveSheetIndex(0);
        $excelService->excelObj->setActiveSheetIndex(0);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        
        $fileName="dtosueldo_".date("Ymd").".xls";
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
    
    
    public function generateSQLEficienciaCamiones(Request $request)
   {
   
      $dql="SELECT u FROM BackendAdminBundle:Viaje u JOIN u.estado e JOIN u.camion c JOIN u.chofer h JOIN u.cajaempleado d ";   
      $where= " where u.isDelete=false and e.code='RENDIDO' ";
      $search=array("date_desde"=>'',"date_hasta"=>'',"camion"=>'', "chofer"=>'', "excepcion"=>0);
      //no quiero los filtros si esta clear-filter
      if (!$request->query->get("clear-filter")){  
        
          if ($request->query->get("camion"))
         {  $search["camion"]=$request->query->get("camion");
            
              $where .= " and c.patente like '%".$search["camion"]."%' ";
         }
          if ($request->query->get("chofer"))
         {  $search["chofer"]=$request->query->get("chofer");
            
              $where .= " and (h.lastname like '%".$search["chofer"]."%' or h.name like '%".$search["chofer"]."%') ";
         }
          if ($request->query->get("excepcion"))
         {  $search["excepcion"]=$request->query->get("excepcion");
            
              $where .= " and u.hasException = '1'  ";
         }
        if ($request->query->get("date_desde") && $request->query->get("date_hasta"))
        {    $search["date_desde"]= date("Y-m-d",strtotime($request->query->get("date_desde")));
             $search["date_hasta"]= date("Y-m-d",strtotime($request->query->get("date_hasta")));
            $where .= " and (u.fecha_salida between '".$search["date_desde"]."' and '".$search["date_hasta"]."' )"; 
        }
        elseif ($request->query->get("date_desde"))
           {
             $search["date_desde"]= date("Y-m-d",strtotime($request->query->get("date_desde")));
             $where .=" and u.fecha_salida >= '".$search["date_desde"]."' "; 
           }
        elseif ($request->query->get("date_hasta"))
        {
             $search["date_hasta"]= date("Y-m-d",strtotime($request->query->get("date_hasta")));
             $where .=" and u.fecha_salida <= '".$search["date_hasta"]."' ";
        }
        
        
         
       
      }
        
        $dql .=$where." order by u.fecha_salida";
      $search["dql"]=$dql;
     return $search;
   
   }
    
    public function reporteEficienciaCamionesAction(Request $request)
    {
        if ( $this->get('security.context')->isGranted('ROLE_REPOEFICIENCIA')) {
         
        $em = $this->getDoctrine()->getManager();
        $search=$this->generateSQLEficienciaCamiones($request); 
         
        $query = $em->createQuery($search["dql"]);
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
        $query,
        $this->get('request')->query->get('page', 1)/*page number*/, 
        $this->container->getParameter('max_on_listepage')/*limit per page*/
    );
       $desvio = $em->getRepository('BackendUserBundle:Seteo')->findOneByName("desvio"); 
        
        return $this->render('BackendAdminBundle:Reporte:eficiencia.html.twig', 
        array('pagination' => $pagination,
        'search'=>$search,
        'desvio'=>$desvio->getValue(),
        ));
        }
        else{
           throw new AccessDeniedException(); 
        }
    
    
    }
    
    
    public function exportarEficienciaAction(Request $request)
    {
     if ( $this->get('security.context')->isGranted('ROLE_REPOEFICIENCIA')) {
         
         $em = $this->getDoctrine()->getManager();

       
        $search=$this->generateSQLEficienciaCamiones($request); 
           
       
        $query = $em->createQuery($search["dql"]);
        
        $excelService = $this->get('xls.service_xls5');
                         
                            
        $excelService->excelObj->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Fecha Salida')
                    ->setCellValue('B1', 'Fecha Regreso')
                    ->setCellValue('C1', 'Camión')
                    ->setCellValue('D1', 'Interno')
                    ->setCellValue('E1', 'Chofer')
                    ->setCellValue('F1', 'Km Totales')
                    ->setCellValue('G1', 'Combustible')
                    ->setCellValue('H1', 'Eficiencia')
                    ->setCellValue('I1', 'Eficiencia Ideal');
        
        $resultados=$query->getResult();
        $i=2;
        $desvio = $em->getRepository('BackendUserBundle:Seteo')->findOneByName("desvio"); 
        foreach($resultados as $r)
        {
           $km_totales=$r->getKmRetorno() - $r->getKmCamion();
           //$eficiencia=0;
           //if ($r->getConsumido() != 0)
            //  $eficiencia=$km_totales / $r->getConsumido();
           $excelService->excelObj->setActiveSheetIndex(0)
                         ->setCellValue("A$i",$r->getFechaSalida()->format("d-m-Y"))
                         ->setCellValue("B$i",$r->getFechaRegreso()->format("d-m-Y"))
                         ->setCellValue("C$i",$r->getCamion()->__toString())
                         ->setCellValue("D$i",$r->getCamion()->getInterno())
                         ->setCellValue("E$i",$r->getChofer()->__toString())
                         ->setCellValue("F$i",$km_totales)
                         ->setCellValue("G$i",$r->getConsumido())
                         ->setCellValue("H$i",$r->getEficiencia())
                         ->setCellValue("I$i",$r->getCamion()->getEficienciaIdeal());
                         
          $i++;
        }
                            
        $excelService->excelObj->getActiveSheet()->setTitle('Viajes Rendidos');
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
        
        $fileName="eficiencia_".date("Ymd").".xls";
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
    
    
     public function generateSQLCashFlow(Request $request)
   {
   
      $dql="SELECT u FROM BackendAdminBundle:Movimiento u JOIN u.deposito d ";   
      $where= " where u.isDelete=false and d.isSpecial=0 ";
      $search=array("monto"=>'',"deposito"=>'',"tipo"=>'');
      //no quiero los filtros si esta clear-filter
      if (!$request->query->get("clear-filter")){  
        
          if ($request->query->get("deposito"))
         {    $search["deposito"]=$request->query->get("deposito");
              
              $where .= " and d.name like '%".$search["deposito"]."%' ";
         }
        if ($request->query->get("monto"))
         {    $search["monto"]=$request->query->get("monto");
              
              $where .= " and u.monto =".$search["monto"];
         }
        if ($request->query->get("tipo"))
         {    $search["tipo"]=$request->query->get("tipo");
              
              $where .= " and u.tipo ='".$search["tipo"]."' ";
         } 
              
      } 
        
        $dql .=$where." order by u.fecha desc";
        
      $search["dql"]=$dql;
     return $search;
   
   }
    
    public function reporteCashflowAction(Request $request)
    {
        if ( $this->get('security.context')->isGranted('ROLE_REPOCASHFLOW')) {
           $em = $this->getDoctrine()->getManager();
        $search=$this->generateSQLCashFlow($request); 
         
        $query = $em->createQuery($search["dql"]);
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
        $query,
        $this->get('request')->query->get('page', 1)/*page number*/, 
        $this->container->getParameter('max_on_listepage')/*limit per page*/
    );
        
        
        return $this->render('BackendAdminBundle:Reporte:cashflow.html.twig', 
        array('pagination' => $pagination,
        'search'=>$search
        )); 
        
        }
        else{
           throw new AccessDeniedException(); 
        }
    
    
    }
    
     public function exportarCashFlowAction(Request $request)
    {
     if ( $this->get('security.context')->isGranted('ROLE_REPOCASHFLOW')) {
         
         $em = $this->getDoctrine()->getManager();

       
        $search=$this->generateSQLCashFlow($request); 
           
       
        $query = $em->createQuery($search["dql"]);
        
        $excelService = $this->get('xls.service_xls5');
                         
                            
        $excelService->excelObj->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Fecha')
                    ->setCellValue('B1', 'Depósito')
                    ->setCellValue('C1', 'Descripción')
                    ->setCellValue('D1', 'Monto')
                    ->setCellValue('E1', 'Saldo')
                    ->setCellValue('F1', 'Tipo');
                    
        
        $resultados=$query->getResult();
        $i=2;
        foreach($resultados as $r)
        {
           $tipo="egreso";
           if ($r->getTipo() == "i")
               $tipo="ingreso";
               
           $excelService->excelObj->setActiveSheetIndex(0)
                         ->setCellValue("A$i",$r->getFecha()->format("d-m-Y"))
                         ->setCellValue("B$i",$r->getDeposito()->__toString())
                         ->setCellValue("C$i",$r->getMotivo())
                         ->setCellValue("D$i",$r->getMonto())
                         ->setCellValue("E$i",$r->getSaldoDeposito())
                         ->setCellValue("F$i",$tipo);
                        
          $i++;
        }
                            
        $excelService->excelObj->getActiveSheet()->setTitle('Movimientos');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $excelService->excelObj->setActiveSheetIndex(0);
        $excelService->excelObj->setActiveSheetIndex(0);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        
        $fileName="cashflow_".date("Ymd").".xls";
        //create the response
        $response = $excelService->getResponse();
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        //$response->headers->set('Content-Disposition', 'attachment;filename='.$fileName);
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
    
    public function generateSQLCajaCentral(Request $request)
   {
   
      $dql="SELECT u FROM BackendAdminBundle:Movimiento u JOIN u.deposito d 
            left JOIN u.deposito_destino e  JOIN u.clase c
      ";   
      $where= " where u.isDelete=false and d.isSpecial=1 ";
      $search=array("monto"=>'',"deposito"=>'',"tipo"=>'',"categoria"=>'');
      //no quiero los filtros si esta clear-filter
      if (!$request->query->get("clear-filter")){  
        
          if ($request->query->get("deposito"))
         {  $search["deposito"]=$request->query->get("deposito");
              
              $where .= " and (e.name like '%".$search["deposito"]."%' )";
         }
         if ($request->query->get("monto"))
        {   $search["monto"]=$request->query->get("monto"); 
            $where .=" and u.monto = ".$search["monto"]; 
        }
         if ($request->query->get("categoria"))
        {   $search["categoria"]=$request->query->get("categoria");
             $where .= " and c.texto like'%".$search["categoria"]."%'";
       
         } 
        if ($request->query->get("tipo"))
        {   $search["tipo"]=$request->query->get("tipo");
             $where .= " and u.tipo='".$search["tipo"]."'";
       
         } 
                
      } 
        
        $dql .=$where." order by u.fecha desc";
      $search["dql"]=$dql;
     return $search;
   
   }
    
    
    public function reporteCajaCentralAction(Request $request)
    {
        if ( $this->get('security.context')->isGranted('ROLE_REPOCAJA')) {
         $em = $this->getDoctrine()->getManager();
        $search=$this->generateSQLCajaCentral($request); 
         
        $query = $em->createQuery($search["dql"]);
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
        $query,
        $this->get('request')->query->get('page', 1)/*page number*/, 
        $this->container->getParameter('max_on_listepage')/*limit per page*/
    );
        
        
        return $this->render('BackendAdminBundle:Reporte:caja.html.twig', 
        array('pagination' => $pagination,
        'search'=>$search
        )); 
        
        }
        else{
           throw new AccessDeniedException(); 
        }
    
    
    }
    
     public function exportarCajaAction(Request $request)
    {
     if ( $this->get('security.context')->isGranted('ROLE_REPOCAJA')) {
         
         $em = $this->getDoctrine()->getManager();

       
        $search=$this->generateSQLCajaCentral($request); 
           
       
        $query = $em->createQuery($search["dql"]);
        
        $excelService = $this->get('xls.service_xls5');
                         
                            
        $excelService->excelObj->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Fecha')
                    ->setCellValue('B1', 'Depósito Destino')
                    ->setCellValue('C1', 'Categoría')
                    ->setCellValue('D1', 'Descripción')
                    ->setCellValue('E1', 'Monto')
                    ->setCellValue('F1', 'Saldo')
                    ->setCellValue('G1', 'Tipo');
                    
        
        $resultados=$query->getResult();
        $i=2;
        foreach($resultados as $r)
        {
           $tipo="egreso";
           if ($r->getTipo() == "i")
               $tipo="ingreso";
          
          $deposito_destino='';   
           if ($r->getDepositoDestino())
             $deposito_destino=$r->getDepositoDestino()->__toString();
                  
           $excelService->excelObj->setActiveSheetIndex(0)
                         ->setCellValue("A$i",$r->getFecha()->format("d-m-Y"))
                         ->setCellValue("B$i",$deposito_destino)
                         ->setCellValue("C$i",$r->getClase()->getTexto())
                         ->setCellValue("D$i",$r->getMotivo())
                         ->setCellValue("E$i",$r->getMonto())
                         ->setCellValue("F$i",$r->getSaldoDeposito())
                         ->setCellValue("G$i",$tipo);
                        
          $i++;
        }
                            
        $excelService->excelObj->getActiveSheet()->setTitle('Movimientos Caja Central');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $excelService->excelObj->setActiveSheetIndex(0);
        $excelService->excelObj->setActiveSheetIndex(0);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $excelService->excelObj->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        
        $fileName="caja_movimientos_".date("Ymd").".xls";
        //create the response
        $response = $excelService->getResponse();
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        //$response->headers->set('Content-Disposition', 'attachment; ');
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