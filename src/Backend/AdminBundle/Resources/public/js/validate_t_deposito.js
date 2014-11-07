$(document).ready(function() {
		var validator = $("#tab").validate({
		
			rules: {
				"backend_adminbundle_tdeposito[nombre]": {
					required:true,
					minlength:2,
					maxlength:100,
				},
				
			
			 messages: {
            "backend_adminbundle_tdeposito[nombre]": {
            required: "Ingrese el nombre del tipo de deposito",
            maxlength: jQuery.format("Máximo {0} carácteres!"),
            minlength: jQuery.format("Mínimo {0} carácteres!")
            },
                        
      },
      
      errorPlacement: function(error, element) {
             
            	error.appendTo( element.next() );
        }
			
		});
		
	});
