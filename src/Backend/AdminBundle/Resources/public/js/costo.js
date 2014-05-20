$(document).ready(function() {

 $(document).keyup(function(e){
      code = e.keyCode ? e.keyCode : e.which;
      if (code.toString() == 115){ //F4
         $("#costo_first").click();
      }    
    }); 
    
    $("#costos").on("keyup","tr",function(e){
         e.preventDefault();
         code = e.keyCode ? e.keyCode : e.which;
      if (code.toString() == 112 || code.toString() == 38 ){ //F1 y flecha abajo
         $(this).last('td').find(".menos_costo").click();
      } 
    }); 
$("#costo_first").on('click',function(){
   var rowCount = $('#costos tbody >tr').length;
  
    if (rowCount == 0){
    $("#costo_first").attr('disabled','disabled');
       var tr="<tr id='tc1'> <td> <select class='select-tipo' id='tipo1' name='tipo1'> </select> </td>"; 
       tr +="<td><input class='input-medium' type='text'  id='concepto1' name='concepto1' value='' /> </td>";
       
       tr+="<td><input class='input-small' type='text'  id='recibo1' name='recibo1' value='' /> </td>";
      tr+="<td><input class='input-small input-monto' type='text'  id='monto1' name='monto1' value='' /> </td>"; 
      tr+="<td><input type='checkbox' class='input-aprobado'  id='aprobado1' name='aprobado1' value='1' /> </td>";
       tr +=" <td> <i class='icon-minus menos_costo' data-base='0' data-nro='1'></i>    </td> </tr>";
      
      
      
      $("#costos").find("tbody").append(tr);
      
       var path_tipocosto=$("#costos").data("path_tipocosto");
        $.ajax({
            type: "GET",
            url: path_tipocosto,
            dataType: 'json',
            data: '',
          })
          .done(function(data){
                var options='';
              
               $.each(data, function(i) {
                    var type=0;
                    if (data[i].isCc == true)
                        type=1;
                   options += " <option  data-type='"+ type +"' value='"+data[i].id+"'>"+data[i].texto+"</option>";
                
                });
               
               $("#tipo1").append(options);
               
          })
          .always(function(){
          
          $("#costo_first").removeAttr('disabled');
          });
      
  
  $("#total_tc").val(1);
  }
  else{
  
  var j= parseInt($("#total_tc").val())+1;
 
  var $tr = agregarTRCosto(j);
  
  
 
  $("#costos tbody >tr:last").after($tr);
  $("#total_tc").val(j);

  
  }
   saldo();
 });  
 
 
 $("#costos").on('click','.menos_costo',function(){
       
    var i =$(this).data("nro");
    $("#tc"+i).remove();
    if ($(this).data("base") != 0)
    {
        var del_tc=$("#del_tc").val();
        $("#del_tc").val( $(this).data("base")+','+del_tc );
    }
      saldo();
 });
 
   
  $("#backend_adminbundle_rendir_efectivo_retornado").on('keyup',function(){
  
       saldo();
  });
  
  $("#backend_adminbundle_rendir_efectivo_reintegro").on('keyup',function(){
  
       saldo();
  });
  $("#backend_adminbundle_rendir_efectivo_caja").on('keyup',function(){
  
       saldo();
  });
  $("#costos").on('keyup',".input-monto",function(){
  
       saldo();
  });
  $("#costos").on('keyup',".input-aprobado",function(){
  
       saldo();
  });
  
  $("#costos").on('change',".select-tipo",function(){
  
       saldo();
  });
      saldo();
});


function saldo()
{
     var efectivo =0;
     if ($("#backend_adminbundle_rendir_efectivo").val() != '')
        efectivo=$("#backend_adminbundle_rendir_efectivo").val();
        
     var incorpora=0;
     if ( $("#backend_adminbundle_rendir_incorpora_dinero").val() != '')
        incorpora=$("#backend_adminbundle_rendir_incorpora_dinero").val();
        
     var retornado=0;
     if ($("#backend_adminbundle_rendir_efectivo_retornado").val() != '')
        retornado= $("#backend_adminbundle_rendir_efectivo_retornado").val();
        
     var reintegro=0;
     if ($("#backend_adminbundle_rendir_efectivo_reintegro").val() != '')
       reintegro= $("#backend_adminbundle_rendir_efectivo_reintegro").val();
     var reintegro_caja=0;
     if ($("#backend_adminbundle_rendir_efectivo_caja").val() != '')
       reintegro_caja= $("#backend_adminbundle_rendir_efectivo_caja").val();   
       
     //efectivo + incorpora + reintegro + reintegro_caja - retornado - gastos = 0
     var gastos=0;
    $("table#costos > tbody > tr").each(function(){ 
         
        
         var l=$(this).attr("id").split("tc");
       //solo sumo si no es type CC
        
       if ($("#tipo"+l[1]+" option:selected").data("type") != 1){
       
         var monto=0;
         if ($("#monto"+l[1]).val() != '')
           monto=$("#monto"+l[1]).val();
           
        //sumo todos los gastos aprobados y no aprobados 
          gastos = parseFloat(gastos) + parseFloat(monto);
       }   
    });
    
     
     var saldo=parseFloat(gastos)-parseFloat(efectivo)-parseFloat(incorpora)+parseFloat(retornado)-parseFloat(reintegro)-parseFloat(reintegro_caja);
     $("#backend_adminbundle_rendir_saldo").val(saldo);
}


function agregarTRCosto(j)
{
   var $tr = $("#costos tbody >tr:first").clone();
   $tr.attr('id', 'tc'+j);
  
  $tr.find('select').attr('name','tipo'+j);
  $tr.find('select').attr('id','tipo'+j);
  $tr.find('select').removeAttr("selected");
  
  var concepto=$tr.find("select").parent().next().find("input"); 
  concepto.attr('name','concepto'+j);
  concepto.attr('id','concepto'+j); 
  concepto.val('');
  
  var  recibo= concepto.parent().next().find("input");
  recibo.attr('name','recibo'+j);
  recibo.attr('id','recibo'+j);
  recibo.val('');
  
  var monto=recibo.parent().next().find("input");
  monto.attr('name','monto'+j);
  monto.attr('id','monto'+j);
  monto.val('');
  
  var check=monto.parent().next().find("input");
  check.attr('name','aprobado'+j);
  check.attr('id','aprobado'+j);
  check.attr('value','1');
  check.removeAttr('checked');
 
  $tr.find('.icon-minus').attr('data-nro',j);
  $tr.find(".icon-minus").attr("data-base",0); //indico que no es de la base
   
   
   return $tr;
}
