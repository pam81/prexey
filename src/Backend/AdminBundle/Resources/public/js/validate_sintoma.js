$(document).ready(function() {
		var validator = $("#tab").validate({
		
			rules: {                 
				"backend_adminbundle_sintoma[name]": {
					required:true,
					minlength:2,
					maxlength:100,
				},
        "backend_adminbundle_sintoma[description]": {
					minlength:2,
					maxlength:500,
				}
			},
			
			 messages: {
            "backend_adminbundle_sintoma[name]": {
            required: "Ingrese el nombre del sintoma",
            maxlength: jQuery.format("Máximo {0} carácteres!"),
            minlength: jQuery.format("Mínimo {0} carácteres!")
            },
            "backend_adminbundle_sintoma[description]": {
            maxlength: jQuery.format("Máximo {0} carácteres!"),
            minlength: jQuery.format("Mínimo {0} carácteres!")
            },
      },
      
      errorPlacement: function(error, element) {
             
            	error.appendTo( element.next() );
        }
			
		});
		
	});





