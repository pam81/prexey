$(document).ready(function() {
		var validator = $("#tab").validate({
		
			rules: {
				"backend_adminbundle_empresa[name]": {
					required:true,
					minlength:2,
					maxlength:100,
				},
				"backend_adminbundle_empresa[cuit]": {
					required:true,
					minlength:2,
					maxlength:100,
				},
				
				
			},
			
			 messages: {
            "backend_adminbundle_empresa[name]": {
            required: "Ingrese el nombre de la empresa",
            maxlength: jQuery.format("Máximo {0} carácteres!"),
            minlength: jQuery.format("Mínimo {0} carácteres!")
            },
            "backend_adminbundle_empresa[cuit]": {
            required: "Ingrese el CUIT de la empresa",
            maxlength: jQuery.format("Máximo {0} carácteres!"),
            minlength: jQuery.format("Mínimo {0} carácteres!")
            },
            
            
            
            
            
      },
      
      errorPlacement: function(error, element) {
             
            	error.appendTo( element.next() );
        }
			
		});
		
	});





