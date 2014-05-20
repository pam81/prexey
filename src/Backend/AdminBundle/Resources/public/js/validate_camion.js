$(document).ready(function() {

$('#fecha_senasa').datetimepicker({
      pickTime: false,
      language: 'es',
    });
$('#fecha_vtv').datetimepicker({
      pickTime: false,
      language: 'es',
    });
$('#fecha_ruta').datetimepicker({
      pickTime: false,
      language: 'es',
    });    
 $('#fecha_seguro').datetimepicker({
      pickTime: false,
      language: 'es',
    });   
		var validator = $("#tab").validate({
		
			rules: {
				"backend_adminbundle_camion[patente]": {
					required:true,
					minlength:2,
					maxlength:100,
					
				},
				"backend_adminbundle_camion[kmxlitro]": {
					maxlength:100,
				},
				"backend_adminbundle_camion[observacion]": {
					maxlength:500,
				},
				"backend_adminbundle_camion[maxTanque]": {
					required:true,
					maxlength:100,
				},
				"backend_adminbundle_camion[marca]": {
					required:false,
					maxlength:100,
				},
				"backend_adminbundle_camion[modelo]": {
					required:false,
					maxlength:100,
				},
				"backend_adminbundle_camion[color]": {
					required:false,
					maxlength:100,
				},
				"backend_adminbundle_camion[interno]":{
        	required:false,
					maxlength:100,
        },
        "backend_adminbundle_camion[senasa]":{
        	required:false,
					maxlength:100,
        },
        "backend_adminbundle_camion[empresa]":{
        	required:true,
				
        },
       "backend_adminbundle_camion[ruta]":{
        	required:false,
					maxlength:100,
        },
        "backend_adminbundle_camion[eficiencia_ideal]":{
        	required:true,
					maxlength:100,
        },
        "backend_adminbundle_camion[seguro]":{
        	required:false,
					maxlength:100,
        }
        
				
			},
			
			 messages: {
            "backend_adminbundle_camion[patente]": {
            required: "Ingrese el número de patente",
            maxlength: jQuery.format("Máximo {0} carácteres!"),
            minlength: jQuery.format("Mínimo {0} carácteres!"),
           
            },
            "backend_adminbundle_camion[kmxlitro]": {
            required: "Ingrese km/litro",
            maxlength:  jQuery.validator.format("Máximo {0} carácteres!"),
            },
            "backend_adminbundle_deposito[observacion]": {
            maxlength:  jQuery.validator.format("Máximo {0} carácteres!"),
            },
            "backend_adminbundle_camion[maxTanque]": {
            required: "Ingrese la capacidad del tanque",
            maxlength:  jQuery.validator.format("Máximo {0} carácteres!"),
            },
            "backend_adminbundle_camion[marca]": {
            maxlength:  jQuery.validator.format("Máximo {0} carácteres!"),
            },
            "backend_adminbundle_camion[modelo]": {
            maxlength:  jQuery.validator.format("Máximo {0} carácteres!"),
            },
            "backend_adminbundle_camion[color]": {
            maxlength:  jQuery.validator.format("Máximo {0} carácteres!"),
            },
            "backend_adminbundle_camion[interno]": {
            maxlength:  jQuery.validator.format("Máximo {0} carácteres!"),
            },
            "backend_adminbundle_camion[senasa]": {
            maxlength:  jQuery.validator.format("Máximo {0} carácteres!"),
            },
            "backend_adminbundle_camion[empresa]": {
             required: "Seleccione una empresa del listado",
            },
            "backend_adminbundle_camion[ruta]": {
            maxlength:  jQuery.validator.format("Máximo {0} carácteres!"),
            },
            "backend_adminbundle_camion[seguro]": {
            maxlength:  jQuery.validator.format("Máximo {0} carácteres!"),
            },
            "backend_adminbundle_camion[eficiencia_ideal]": {
            required: "Ingrese la eficiencia ideal",
            maxlength:  jQuery.validator.format("Máximo {0} carácteres!"),
            },
            
            
            
      },
      
      errorPlacement: function(error, element) {
             
            	error.appendTo( element.next() );
        }
			
		});
		
	});





