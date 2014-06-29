$(document).ready(function() {
		var validator = $("#tab").validate({
		
			rules: {                 
				"backend_adminbundle_modelo[name]": {
					required:true,
					minlength:2,
					maxlength:100,
				},
        "backend_adminbundle_modelo[nameManufacture]": {
					required:true,
					minlength:2,
					maxlength:100,
				},
        "backend_adminbundle_modelo[variante]": {
					minlength:2,
					maxlength:100,
				}
        
			},
			
			 messages: {
            "backend_adminbundle_modelo[name]": {
            required: "Ingrese el nombre del modelo",
            maxlength: jQuery.format("Máximo {0} carácteres!"),
            minlength: jQuery.format("Mínimo {0} carácteres!")
            },
            "backend_adminbundle_modelo[nameManufacture]": {
            required: "Ingrese el nombre de fábrica ",
            maxlength: jQuery.format("Máximo {0} carácteres!"),
            minlength: jQuery.format("Mínimo {0} carácteres!")
            },
            "backend_adminbundle_modelo[variante]": {
            maxlength: jQuery.format("Máximo {0} carácteres!"),
            minlength: jQuery.format("Mínimo {0} carácteres!")
            },
      },
      
      errorPlacement: function(error, element) {
             
            	error.appendTo( element.next() );
        }
			
		});
		
	});





