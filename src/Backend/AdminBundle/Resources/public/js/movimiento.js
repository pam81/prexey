$(document).ready(function() {

 var show_destino=0;
 var show_tipo=0;
 
    $("#backend_adminbundle_movimiento_clase").change(function(){
    
     $("#list_destinos").hide();
     $("#list_tipo").hide();
     show_destino=0;
     show_tipo=0;
      $('#backend_adminbundle_movimiento_clase option:selected').each(function(){
        var str=$(this).text();
        var a=str.split("-"); 
      
        if ( a[0] == 'MOV1' )
        {  $("#list_destinos").show();
           show_destino=1;
        } 
         else //( a[0] == 'MOV2' )
        {  $("#list_tipo").show();
           show_tipo=1;
        } 
    
    });
      if (show_destino == 0)
        $("#backend_adminbundle_movimiento_deposito_destino").val([]);
    });

 $("#backend_adminbundle_movimiento_clase").change(); 
}); 