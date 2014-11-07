$(document).ready(function() {
		var validator = $("#tab").validate({
		
			rules: {                 
				"backend_adminbundle_tipo_ordeningreso[name]": {
					required:true,
					minlength:2,
					maxlength:100,
				}
        	},
			
			 messages: {
            "backend_adminbundle_tipo_ordeningreso[name]": {
            required: "Ingrese el nombre del tipo de orden de ingreso",
            maxlength: jQuery.format("Máximo {0} carácteres!"),
            minlength: jQuery.format("Mínimo {0} carácteres!")
            },
      },
      
      errorPlacement: function(error, element) {
             
            	error.appendTo( element.next() );
        }
			
		});
		
	});
