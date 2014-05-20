$(document).ready(function() {

$('#fecha_salida').datetimepicker({
      pickTime: false,
      language: 'es',
    });
$('#fecha_regreso').datetimepicker({
      pickTime: false,
      language: 'es',
    });
 $('#hora_salida').datetimepicker({
      pickDate: false,
      language: 'es',
      pickSeconds: false,
    });
 
 $('#hora_regreso').datetimepicker({
      pickDate: false,
      language: 'es',
      pickSeconds: false,
    });

jQuery.validator.addMethod("DateToFrom", function(value, element, arg0, arg1) {

    var comp = $("#backend_adminbundle_viaje_fecha_salida").val().split('/');
    var d = parseInt(comp[0], 10);
    var m = parseInt(comp[1], 10);
    var y = parseInt(comp[2], 10);
    var hour= $("#backend_adminbundle_viaje_hora_salida").val().split(":");
    var h=parseInt(hour[0],10);
    var i=parseInt(hour[1],10);
    var currentEltdate = new Date(y,m,d,h,i);

    comp = $("#backend_adminbundle_viaje_fecha_regreso").val().split('/');
    d = parseInt(comp[0], 10);
    m = parseInt(comp[1], 10);
    y = parseInt(comp[2], 10);
    var hour= $("#backend_adminbundle_viaje_hora_regreso").val().split(":");
     h=parseInt(hour[0],10);
     i=parseInt(hour[1],10);
    var otherEltDate = new Date(y,m,d,h,i);

    /*var lowerDate, upperDate;
    if(arg1 == true){//current element should be lower date
        lowerDate = currentEltdate;
        upperDate = otherEltDate;
    }else{
        lowerDate = otherEltDate;
        upperDate = currentEltdate;
    }
    
        
    return this.optional(element) || (lowerDate <= upperDate); */
    if ( currentEltdate < otherEltDate)
       return true;
    else
       return false;   


}, "Fecha de Regreso debe ser Mayor a Fecha de Salida");

jQuery.validator.addMethod("Acompaniante", function(value, element, arg0, arg1) {

      var chofer=$("#backend_adminbundle_viaje_chofer option:selected").val();
      var acom=$("#backend_adminbundle_viaje_acompaniante option:selected").val();
      
      if ( chofer == acom )
          return false;
      else
         return true;    
      
      

}, "El Acompañante debe ser distinto del Chofer");

var validator = $("#tabviaje").validate({
		
			rules: {
				
				"backend_adminbundle_viaje[tipo_viaje]": {
					required:true,
					
				},
        "backend_adminbundle_viaje[deposito]": {
					required:true,
					
				},
				"backend_adminbundle_viaje[cliente]": {
					required:true,
				
				},
				"backend_adminbundle_viaje[camion]": {
					required:true,
				
				},
        "backend_adminbundle_viaje[acoplado]": {
					required:false,
				
				},
				"backend_adminbundle_viaje[chofer]": {
					required:true,
					
				},
				"backend_adminbundle_viaje[acompaniante]": {
					required:false,
					Acompaniante: true
				},
				"backend_adminbundle_viaje[km_camion]": {
					required:false,
					maxlength:100,
					
				},
				"backend_adminbundle_viaje[efectivo]": {
					required:true,
					
				},
				"backend_adminbundle_viaje[fecha_salida]":{
          required: true,
          
        },
        "backend_adminbundle_viaje[hora_salida]":{
          required: true,
        },
        "backend_adminbundle_viaje[fecha_regreso]":{
          required: true,
          DateToFrom: ["backend_adminbundle_viaje_fecha_salida",true],
        },
        "backend_adminbundle_viaje[hora_regreso]":{
          required: true,
          
        },
        "backend_adminbundle_viaje[incorpora_dinero]":{
          required: false,
        },
        "backend_adminbundle_viaje[observacion]":{
          required: false,
        },				
			},
			
			 messages: {
           
            "backend_adminbundle_viaje[tipo_viaje]": {
            required: "Ingrese un tipo de viaje",
            
            },
            "backend_adminbundle_viaje[deposito]": {
            required: "Ingrese un depósito",
            
            },
            "backend_adminbundle_viaje[cliente]": {
            required: "Ingrese cliente",
           
            },
            "backend_adminbundle_viaje[camion]": {
             required: "Ingrese camión",
            
            },
            "backend_adminbundle_viaje[chofer]": {
            required: "Ingrese chofer",
            },
            "backend_adminbundle_viaje[km_camion]": {
            maxlength:  jQuery.validator.format("Máximo {0} carácteres!"),
            },
            "backend_adminbundle_viaje[efectivo]":{
            required: "Ingrese efectivo asignado al viaje",
            },
            "backend_adminbundle_viaje[fecha_salida]":{
            required: "Ingrese fecha de salida del viaje",
            },
             "backend_adminbundle_viaje[hora_salida]":{
            required: "Ingrese hora de salida del viaje",
            },
            "backend_adminbundle_viaje[fecha_regreso]":{
            required: "Ingrese fecha de regreso del viaje",
            },
            "backend_adminbundle_viaje[hora_regreso]":{
            required: "Ingrese hora de regreso del viaje",
            },
            
            
            
      },
      
      errorPlacement: function(error, element) {
            
            switch(element.attr('id'))
            {
             case "backend_adminbundle_viaje_fecha_salida":
                   error.appendTo( "#backend_adminbundle_viaje_fecha_salida_errorloc"); 
                   break;
             case "backend_adminbundle_viaje_hora_salida":
                   error.appendTo("#backend_adminbundle_viaje_hora_salida_errorloc");
                   break;       
             case "backend_adminbundle_viaje_fecha_regreso":
                   error.appendTo( "#backend_adminbundle_viaje_fecha_regreso_errorloc"); 
                    break;
             case "backend_adminbundle_viaje_hora_regreso":
                   error.appendTo("#backend_adminbundle_viaje_hora_regreso_errorloc");
                   break;       
             default:       
                     error.appendTo( element.next() );
            }
             
            	
            	
        },
         submitHandler: function(form) {
           var dataString=$("#tabviaje").serialize();
           var path_validatenew=$("#tabviaje").data("valid_url");
           //deshabilitar botones hasta que regrese
           $("#myLoading").show(); 
           $.ajax({
            type: "POST",
            url: path_validatenew,
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
               {   
                  alert(data.message);
                  $("#myLoading").hide();
                  return false;
                  
               }  
          });
          
          
            
        }
			
		});


  
    
});

