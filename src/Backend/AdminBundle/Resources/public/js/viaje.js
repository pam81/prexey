$(document).ready(function() {
    
    function cargarHojaRuta(){
      //obtengo depositos de salida
      var max_orden = 0;
     
     
      //obtengo hoja de ruta y la agrego a la tabla
       var destinos;  
      var path_destinos=$("#hoja_ruta").data("path_hoja_ruta");
      $.ajax({
            type: "GET",
            url: path_destinos,
            dataType: 'json',
            data: '',
          })
          .done(function(data){
          
           var deposito_salida;
            var clientes; 
           var path_dsalida=$("#hoja_ruta").data("path_deposito_salida");
            $.ajax({
                  type: "GET",
                  url: path_dsalida,
                  dataType: 'json',
                  data: '',
                })
                .done(function(deposito){
                  deposito_salida=deposito;
                  var path_cliente=$("#hoja_ruta").data("path_cliente");
                  $.ajax({
                        type: "GET",
                        url: path_cliente,
                        dataType: 'json',
                        data: '',
                      })
                      .done(function(c){
                        clientes=c;
                        
                         $.each(data, function(i) {
                            max_orden = data[i].orden;
                           
                             var tr="<tr id='tr"+data[i].orden+"'> <td> <input class='input-mini' type='text' readonly='true' name='orden"+data[i].orden+"' value='"+data[i].orden+"' id='orden"+data[i].orden+"'/>"; 
                             tr += "<input type='hidden' name='hoja"+data[i].orden+"'  value='"+data[i].id+"' />   </td>  ";
                             tr +="<td><select id='ds"+data[i].orden+"' class='select-deposito-salida' name='ds"+data[i].orden+"'>";
                              var deposito_s = data[i].salida;
                             $.each(deposito_salida,function(j){
                                 
                                tr += "<option ";
                                if (deposito_salida[j].id == deposito_s){
                                 tr += " selected='selected' ";
                                } 
                                tr += "value='"+deposito_salida[j].id+"'>"+deposito_salida[j].name+" </option>";
                             });
                             
                             tr +="</select></td>";
                             tr +="<td><select  id='cl"+data[i].orden+"' class='select-cliente'  name='cl"+data[i].orden+"'>";
                            var client=data[i].cliente;
                             $.each(clientes,function(k){
                                 
                                tr += "<option ";
                                if (clientes[k].id == client ){
                                 tr += " selected='selected' ";
                                } 
                                tr += "value='"+clientes[k].id+"'>"+clientes[k].name+" </option>";
                             });
                             tr +="</select></td>";     
                             tr+="<td> <select id='dp"+data[i].orden+"' class='select-deposito' name='dp"+data[i].orden+"'>";
                             var deposito_c = data[i].deposito;
                             
                             $.each(deposito_salida,function(j){
                               if (deposito_salida[j].cliente == client){    
                                  tr += "<option ";
                                  if (deposito_salida[j].id == deposito_c){
                                    tr += " selected='selected' ";
                                  } 
                                    tr += "value='"+deposito_salida[j].id+"'>"+deposito_salida[j].name+" </option>";
                                }
                             });
                             tr +="</select> </td>";
                             tr +=" <td> <input class='input-nro input-small' type='text' autocomplete='off' name='nro"+data[i].orden+"' value='"+data[i].numero+"' id='nro"+data[i].orden+"' /> </td>";    
                             tr +=" <td> <i class='icon-plus mas' data-nro='"+data[i].orden+"' ></i> <i class='icon-minus menos' data-base='"+data[i].orden+"' data-nro='"+data[i].orden+"'></i>    </td> </tr>";
                            
                             $("#hoja_ruta").find("tbody").append(tr);
                             $("#ds"+data[i].orden).select2(); 
                           });
                        
                      });
                  
                });
          
           //obtengo clientes  
            
             
             $("#total_tr").val(max_orden);
             
          });   
    
    }
      cargarHojaRuta();
    
    $(".select-deposito-salida").select2();
    
    $(document).keyup(function(e){
      code = e.keyCode ? e.keyCode : e.which;
      if (code.toString() == 113){ //F2
         $("#hoja_ruta tbody >tr:last").last("td").find(".mas").click();
      }    
    }); 
    
    $("#hoja_ruta").on("keyup","tr",function(e){
         e.preventDefault();
         code = e.keyCode ? e.keyCode : e.which;
      if (code.toString() == 114 || code.toString() == 38 ){ //F3 y flecha arriba
         
         $(this).last('td').find(".mas").click();
      } 
    
      if (code.toString() == 115 || code.toString() == 40){ //F4 y flecha abajo
         $(this).last('td').find(".menos").click();
      } 
    }); 
    
 $("#plus_first").on('click',function(){
   var rowCount = $('#hoja_ruta tbody >tr').length;
  
    if (rowCount == 0){
    $("#plus_first").attr('disabled','disabled');
       var tr="<tr id='tr1'> <td> <input class='input-mini' type='text' readonly='true' name='orden1' value='1' id='orden1'/> </td>  ";
       tr +="<td><select id='ds1' class='select-deposito-salida' name='ds1'></select></td>";
       tr +="<td><select  id='cl1' class='select-cliente'  name='cl1'>";
       tr +="</select></td>";     
       tr+="<td> <select id='dp1' class='select-deposito' name='dp1'>";
       tr +="</select> </td>";
       tr +=" <td> <input class='input-nro input-small' type='text' autocomplete='off' name='nro1' value='' id='nro1' /> </td>";    
       tr +=" <td> <i class='icon-plus mas' data-nro='1' ></i> <i class='icon-minus menos' data-base='0' data-nro='1'></i>    </td> </tr>";
      
      $("#hoja_ruta").find("tbody").append(tr);
    
      var path_dsalida=$("#hoja_ruta").data("path_deposito_salida");
      $.ajax({
            type: "GET",
            url: path_dsalida,
            dataType: 'json',
            data: '',
          })
          .done(function(data){
            var deposito_id=$("#backend_adminbundle_viaje_deposito").val();  
            var options=''; 
             $.each(data, function(i) {
              
              options +=" <option ";
              if (data[i].id == deposito_id)
                options +=" selected = selected ";
              options +=" value='"+data[i].id+"'>"+data[i].name+"</option>";
              
              });
             $("#ds1").append(options);
             $("#ds1").select2();
          });
      
       var path_cliente=$("#hoja_ruta").data("path_cliente");
        $.ajax({
            type: "GET",
            url: path_cliente,
            dataType: 'json',
            data: '',
          })
          .done(function(data){
              var options='';
              var cliente_id=$("#backend_adminbundle_viaje_cliente").val(); 
               $.each(data, function(i) {
                   
                   options +=" <option ";
                   if (data[i].id == cliente_id)
                     options +=" selected = selected ";
                   options += "value='"+data[i].id+"'>"+data[i].name+"</option>";
                
                });
               
               $("#cl1").append(options);
               
                 var path_deposito=$("#hoja_ruta").data("path_deposito");
                 var dataString="cliente="+$("#backend_adminbundle_viaje_cliente").val();
                  $.ajax({
                        type: "POST",
                        url: path_deposito,
                        dataType: 'json',
                        data: dataString,
                      })
                      .done(function(data) {
                          var deposito_id=$("#backend_adminbundle_viaje_deposito").val();  
                          var options=''; 
                           $.each(data, function(i) {
                            
                            options +=" <option ";
                            if (data[i].id == deposito_id)
                              options +=" selected = selected ";
                            options +=" value='"+data[i].id+"'>"+data[i].name+"</option>";
                            
                            });
                           $("#dp1").append(options);
                        })
                        .always(function(){
                         $("#plus_first").removeAttr('disabled');
                        
                        });
               
               
            });
            
      
    
      
  $("#total_tr").val(1);
  }
  else{
  var i=$("#hoja_ruta tbody >tr:first").find(".icon-plus").data("nro");
  var j= parseInt($("#total_tr").val())+1;
 
  var $tr = agregarTR(i,j);
  $tr.find('.input-mini').val(1); //le pongo orden 1
 
  $("#hoja_ruta tbody >tr:first").before($tr);
  $("#total_tr").val(j);

  ordenarTabla();
  }
  
 });  
 
 $("#hoja_ruta").on('click','.mas',function(){
   //creo una fila en la siguiente posición debajo de la actual
   
   var i=$(this).data("nro");
   var j= parseInt($("#total_tr").val())+1;
  
   var $tr = agregarTR(i,j);
   
   var orden=$tr.find('input').val();     
   $("#tr"+i).after($tr);
   var total=j;//parseInt($("#total_tr").val())+1;
   $("#total_tr").val(total); //va contando cuantas filas hay
    
  
  
   ordenarTabla();     
   
 });
 
 $("#hoja_ruta").on('click','.menos',function(){
       
    var i =$(this).data("nro");
    $("#tr"+i).remove();
    if ($(this).data("base") != 0)
    {
        var del_tr=$("#del_tr").val();
        $("#del_tr").val( $(this).data("base")+','+del_tr );
    }
    ordenarTabla();
 });
 
  
  $("#hoja_ruta").on('change','.select-cliente',function(){
     
      var path_deposito=$("#hoja_ruta").data("path_deposito");
      var dataString="cliente="+$(this).val();
      var depositos=$(this).parent().next().find(".select-deposito"); 
      depositos.empty();
      $.ajax({
            type: "POST",
            url: path_deposito,
            dataType: 'json',
            data: dataString,
            success: function(data) {
             
               $.each(data, function(i) {
                
                depositos.append($('<option>', {value: data[i].id})
                            .text(data[i].name));
                
                });
               
            }
          });
  
  });
  
  $(document).ajaxSend(function(event, request, settings) {
    $("#myModalLoading").show();
});

$(document).ajaxComplete(function(event, request, settings) {
    $("#myModalLoading").hide();
});

});

function agregarTR(i,j)
{
  
   var $tr = $("#tr"+i).clone();
   $tr.attr('id', 'tr'+j);
   $tr.find('.input-mini').attr('name','orden'+j);
   var orden=parseInt($tr.find('.input-mini').val()) + 1;
   $tr.find('.input-mini').val(orden);
   $tr.find('.input-mini').attr('id','orden'+j);
  
  $tr.find('.input-nro').attr('id','nro'+j);
  $tr.find('.input-nro').attr('name','nro'+j);
  $tr.find('.input-nro').val('');
  
  var cl_ori=$("#tr"+i).find('.select-cliente').find(":selected").val();
  
   var cl=$tr.find('.select-cliente');
   cl.attr('name','cl'+j);
   cl.attr('id','cl'+j);
   
  $tr.find('.select-cliente option').each(function(){
        if ( $(this).val() == cl_ori)
          $(this).attr("selected","selected");
        else
            $(this).removeAttr('selected');
  });
  
   
   var dp_ori=$("#tr"+i).find('.select-deposito').find(":selected").val();
   var dp=$tr.find('.select-deposito');
   dp.attr('name','dp'+j);
   dp.attr('id','dp'+j);
   
   $tr.find('.select-deposito option').each(function(){
        if ( $(this).val() == dp_ori)
          $(this).attr("selected","selected");
        else
            $(this).removeAttr('selected');
  });
   
   
  /* var ds_ori=$("#tr"+i).find('.select-deposito-salida').find(":selected").val();
   var ds=$("#tr"+i).find("td:first").next("td").find('select');
   
   ds.attr('name','ds'+j);
   ds.attr('id','ds'+j);
   ds.select2();
  console.log(ds);*/
   var ds="<select id='ds"+j+"' class='select-deposito-salida' name='ds"+j+"'></select>";
   $tr.find("td:first").next("td").html(ds);
   
   /*$tr.find('.select-deposito-salida option').each(function(){
        if ( $(this).val() == ds_ori)
          $(this).attr("selected","selected");
        else
            $(this).removeAttr('selected');
  });*/
    var path_dsalida=$("#hoja_ruta").data("path_deposito_salida");
      $.ajax({
            type: "GET",
            url: path_dsalida,
            dataType: 'json',
            data: '',
          })
          .done(function(data){
            var deposito_id=$("#backend_adminbundle_viaje_deposito").val();  
            var options=''; 
             $.each(data, function(i) {
              
              options +=" <option ";
              if (data[i].id == deposito_id)
                options +=" selected = selected ";
              options +=" value='"+data[i].id+"'>"+data[i].name+"</option>";
              
              });
             $("#ds"+j).append(options);
             $("#ds"+j).select2();
          });
 
   
   
   
   $tr.find('.icon-plus').attr('data-nro',j);
   $tr.find('.icon-minus').attr('data-nro',j);
   $tr.find(".icon-minus").attr("data-base",0); //indico que no es de la base
  
   return $tr;
}



function ordenarTabla()
{
  var orden=1;
$("#hoja_ruta tbody >tr").each(function(){
     $(this).find('.input-mini').val(orden);
     orden= parseInt(orden) + 1;    
});
}
