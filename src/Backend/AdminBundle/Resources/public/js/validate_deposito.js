$(document).ready(function() {
		var validator = $("#tab").validate({
		
			rules: {
				"backend_adminbundle_deposito[name]": {
					required:true,
					minlength:2,
					maxlength:100,
				},
				"backend_adminbundle_deposito[direccion]": {
					required:true,
					minlength:2,
					maxlength:300,
				},
				"backend_adminbundle_deposito[observacion]": {
					maxlength:500,
				},
				"backend_adminbundle_deposito[lat]": {
					maxlength:100,
				},
				"backend_adminbundle_deposito[lng]": {
					maxlength:100,
				},
				"backend_adminbundle_deposito[cliente]": {
					required:true,
				},
				
			},
			
			 messages: {
            "backend_adminbundle_deposito[name]": {
            required: "Ingrese el nombre",
            maxlength: jQuery.format("Máximo {0} carácteres!"),
            minlength: jQuery.format("Mínimo {0} carácteres!")
            },
            "backend_adminbundle_deposito[direccion]": {
            required: "Ingrese la dirección",
            maxlength:  jQuery.validator.format("Máximo {0} carácteres!"),
            minlength: jQuery.validator.format("Mínimo {0} carácteres!")
            },
            "backend_adminbundle_deposito[observacion]": {
            maxlength:  jQuery.validator.format("Máximo {0} carácteres!"),
            },
            "backend_adminbundle_deposito[lat]": {
            maxlength:  jQuery.validator.format("Máximo {0} carácteres!"),
            },
            "backend_adminbundle_deposito[lng]": {
            maxlength:  jQuery.validator.format("Máximo {0} carácteres!"),
            },
            "backend_adminbundle_deposito[cliente]": {
            required: "Ingrese un cliente",
            
            },
            
            
            
      },
      
      errorPlacement: function(error, element) {
             
            	error.appendTo( element.next() );
        }
			
		});
		
	});





