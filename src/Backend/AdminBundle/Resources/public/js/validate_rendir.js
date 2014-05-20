$(document).ready(function() {



jQuery.validator.addMethod("KmRetorno", function(value, element) {

    var km_camion=$("#backend_adminbundle_rendir_km_camion").val();
    if (km_camion != ''){ //si esta vacio no valido
    if (parseFloat(km_camion) < parseFloat(value))
     return true; 
    else
     return false; 
     }
     else
       return true;
      

}, "Km Retorno debe ser mayor a Km Camión");

jQuery.validator.addMethod("EfectivoRetornado", function(value, element) {

    var efectivo=$("#backend_adminbundle_rendir_efectivo").val();
    var incorpora=$("#backend_adminbundle_rendir_incorpora_dinero").val();
    if (incorpora == '')
      incorpora = 0;
    var total=parseFloat(efectivo) + parseFloat(incorpora);
    
    if (parseFloat(total) >= parseFloat(value))
     return true; 
    else
     return false; 
      

}, "Efectivo Retornado debe ser menor o igual al Efectivo Entregado");

jQuery.validator.addMethod("mustBeZero", function(value, element) {

    var saldo=$("#backend_adminbundle_rendir_saldo").val();
    var validar=$("#backend_adminbundle_rendir_validar").val();
    
   if (validar == 1){    
    if ( parseFloat(saldo) == parseFloat(0) )
     return true;   //si es cero esta bien
    else
     return false;
   }else  //si no tengo que validarlo retorno siempre TRUE
      return true;   
      

}, "El saldo del viaje no es cero");

var validator = $("#tabRendir").validate({
		
			rules: {
				"backend_adminbundle_rendir[km_retorno]": {
					required:true,
				  KmRetorno: true,	
				},
				"backend_adminbundle_rendir[efectivo_retornado]": {
					required:true,
				  EfectivoRetornado: true,
				},
				"backend_adminbundle_rendir[efectivo_regreso]": {
					required:false,
				
				},
				"backend_adminbundle_rendir[consumido]": {
					required:true,
				
				},
				"backend_adminbundle_rendir[observacion]": {
					required:false,
					
				},
				/*"hoja_ruta":{
         HojaNotEmpty: true,
        },*/
				"backend_adminbundle_rendir[saldo]":{
         mustBeZero: true, 
        },
						    
			},
			
			 messages: {
            "backend_adminbundle_rendir[km_retorno]": {
            required: "Ingrese Km Retorno",
            
            },
            "backend_adminbundle_rendir[efectivo_retornado]": {
            required: "Ingrese efectivo retornado",
           
            },
           "backend_adminbundle_rendir[consumido]": {
            required: "Ingrese cantidad de combustible consumido",
           
            }, 
            
            
            
      },
      
      errorPlacement: function(error, element) {
                 
                 
                     error.appendTo( element.next() );
        },
       submitHandler: function(form) {
       $("#backend_adminbundle_hoja_ruta_errorloc").empty();
         var rowCount = $('#hoja_ruta tbody >tr').length;
         if (rowCount == 0)
         {
          $("#backend_adminbundle_hoja_ruta_errorloc").append("Debe ingresar al menos un destino en la hoja de ruta");
            return false
         }   
         else    
          {
          
           var dataString=$("#tabRendir").serialize(); 
           var path_validate=$("#tabRendir").data("valid_url");
           $("#myLoading").show(); 
           $.ajax({
            type: "POST",
            url: path_validate,
            dataType: 'json',
            data: dataString,
          })
          .done(function(data){
               
               if (data.resultado == 1)
                { 
                 
                 $("<input type='hidden'/>").attr("name", validator.submitButton.name).val( $(validator.submitButton).val() ).appendTo(validator.currentForm);
                   
                  form.submit();
                 
                   return true;
                }
               else
               {  alert(data.message);
                  $("#myLoading").hide();
                  return false;
               }  
          });
          
          }
        }
			
		});




  
});

