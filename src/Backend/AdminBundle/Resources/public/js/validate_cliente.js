$(document).ready(function() {
		var validator = $("#tab").validate({
		
			rules: {
				"backend_adminbundle_cliente[name]": {
					required:true,
					minlength:2,
					maxlength:100,
				},
				"backend_adminbundle_cliente[cuit]": {
					required:true,
					minlength:2,
					maxlength:100,
				},
				"backend_adminbundle_cliente[direccion]": {
					required:true,
					maxlength:100,
				},
				"backend_adminbundle_cliente[observacion]": {
					required:false,
					maxlength:500,
				},
				"backend_adminbundle_cliente[email]": {
					required:false,
					email: true,
					maxlength:100,
				},
				"backend_adminbundle_cliente[celular]": {
					required:false,
					maxlength:100,
				},
				"backend_adminbundle_cliente[isDirecto]": {
					required:false,
					
				}
				
			},
			
			 messages: {
            "backend_adminbundle_cliente[name]": {
            required: "Ingrese el nombre del cliente",
            maxlength: jQuery.format("Máximo {0} carácteres!"),
            minlength: jQuery.format("Mínimo {0} carácteres!")
            },
            "backend_adminbundle_cliente[cuit]": {
            required: "Ingrese el CUIT del cliente",
            maxlength: jQuery.format("Máximo {0} carácteres!"),
            minlength: jQuery.format("Mínimo {0} carácteres!")
            },
            "backend_adminbundle_cliente[direccion]": {
            required: "Ingrese la dirección",
            maxlength:  jQuery.validator.format("Máximo {0} carácteres!"),
            },
            "backend_adminbundle_cliente[observacion]": {
            maxlength:  jQuery.validator.format("Máximo {0} carácteres!"),
            },
            "backend_adminbundle_cliente[email]": {
            email: "No es un formato de email válido",
            maxlength:  jQuery.validator.format("Máximo {0} carácteres!"),
            },
            "backend_adminbundle_cliente[celular]": {
            maxlength:  jQuery.validator.format("Máximo {0} carácteres!"),
            }
            
            
            
            
      },
      
      errorPlacement: function(error, element) {
             
            	error.appendTo( element.next() );
        }
			
		});
		
	});





