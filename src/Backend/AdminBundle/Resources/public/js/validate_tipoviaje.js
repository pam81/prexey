$(document).ready(function() {
		var validator = $("#tab").validate({
		
			rules: {
				"backend_adminbundle_tipoviaje[code]": {
					required:true,
					minlength:2,
					maxlength:100,
				},
				"backend_adminbundle_tipoviaje[texto]": {
					required:true,
					maxlength:100,
				},
				
				
			},
			
			 messages: {
            "backend_adminbundle_tipoviaje[code]": {
            required: "Ingrese un código",
            maxlength: jQuery.format("Máximo {0} carácteres!"),
            minlength: jQuery.format("Mínimo {0} carácteres!")
            },
            "backend_adminbundle_tipoviaje[texto]": {
            required: "Ingrese una descripción",
            maxlength:  jQuery.validator.format("Máximo {0} carácteres!"),
            },
           
            
            
            
      },
      
      errorPlacement: function(error, element) {
             
            	error.appendTo( element.next() );
        }
			
		});
		
	});





