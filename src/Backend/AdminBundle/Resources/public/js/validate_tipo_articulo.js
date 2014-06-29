$(document).ready(function() {
		var validator = $("#tab").validate({
		
			rules: {                 
				"backend_adminbundle_tipo_articulo[name]": {
					required:true,
					minlength:2,
					maxlength:100,
				},
        "backend_adminbundle_tipo_articulo[isValido]": {
					required:false,
					
				}
			},
			
			 messages: {
            "backend_adminbundle_tipo_articulo[name]": {
            required: "Ingrese el nombre del tipo artículo",
            maxlength: jQuery.format("Máximo {0} carácteres!"),
            minlength: jQuery.format("Mínimo {0} carácteres!")
            },
      },
      
      errorPlacement: function(error, element) {
             
            	error.appendTo( element.next() );
        }
			
		});
		
	});





