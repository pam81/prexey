$(document).ready(function() {
		var validator = $("#tab").validate({
		
			rules: {                 
				"backend_adminbundle_articulo[isDisponible]": {
					required:false,
				},
        "backend_adminbundle_articulo[descripcion]": {
					required:false,
					minlength:2,
					
				},
        "backend_adminbundle_articulo[Observacion]": {
					required:false,
					minlength:2,
					
				}
        
			},
			
			 messages: {
            "backend_adminbundle_articulo[descripcion]": {
            minlength: jQuery.format("Mínimo {0} carácteres!")
            },
            "backend_adminbundle_articulo[observacion]": {
            minlength: jQuery.format("Mínimo {0} carácteres!")
            },
      },
      
      errorPlacement: function(error, element) {
             
            	error.appendTo( element.next() );
        }
			
		});
		
	});





