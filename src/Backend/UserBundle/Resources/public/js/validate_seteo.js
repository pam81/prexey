$(document).ready(function() {
		var validator = $("#tab").validate({
		
			rules: {
				"backend_userbundle_seteo[name]": {
					required:true,
					minlength:2,
					maxlength:200,
				},
				"backend_userbundle_seteo[value]": {
					required:true,
					minlength:1,
					maxlength:100,
				}
			},
			
			 messages: {
            "backend_userbundle_seteo[name]": {
            required: "Ingrese el nombre",
            maxlength: jQuery.format("Máximo {0} carácteres!"),
            minlength: jQuery.format("Mínimo {0} carácteres!")
            },
            "backend_userbundle_seteo[value]": {
            required: "Ingrese el valor",
            maxlength:  jQuery.validator.format("Máximo {0} carácteres!"),
            minlength: jQuery.validator.format("Mínimo {0} carácteres!")
            }
            
            
            
      },
      
      errorPlacement: function(error, element) {
             
            	error.appendTo( element.next() );
        }
			
		});
		
	});





