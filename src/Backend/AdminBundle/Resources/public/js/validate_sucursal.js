$(document).ready(function() {
		var validator = $("#tab").validate({
		
			rules: {
				"backend_adminbundle_sucursal[nombre]": {
					required:true,
					minlength:2,
					maxlength:100,
				},
				"backend_adminbundle_sucursal[responsable]": {
					required:true,
					minlength:2,
					maxlength:100,          
				},
        		"backend_adminbundle_sucursal[calle]": {
					required:false,
					minlength:2,
					maxlength:100,          
				},
				"backend_adminbundle_sucursal[numero]": {
					required:true,
          			minlength:2,
					maxlength:8,
					number: true,
				},
				"backend_adminbundle_sucursal[piso]": {
					required:true,
          			minlength:1,
					maxlength:3,					
				},
				"backend_adminbundle_sucursal[cp]": {
					required:true,
          			minlength:4,
					maxlength:10,					
				},
				"backend_adminbundle_sucursal[telefono]": {
					required:true,
					minlength:8,
					maxlength:15,
				},
				"backend_adminbundle_sucursal[fax]": {
					required:false,
					minlength:8,
					maxlength:15,
				},
				"backend_adminbundle_sucursal[email]": {
					required:false,
					email: true,
					maxlength:100,
				}
				
			},
			
			 messages: {
            "backend_adminbundle_sucursal[nombre]": {
            required: "Ingrese el nombre de la sucursal",
            maxlength: jQuery.format("Máximo {0} carácteres!"),
            minlength: jQuery.format("Mínimo {0} carácteres!")
            },
            "backend_adminbundle_sucursal[responsable]": {
            required: "Ingrese el nombre del responsable de la sucursal",
            maxlength: jQuery.format("Máximo {0} carácteres!"),
            minlength: jQuery.format("Mínimo {0} carácteres!")            
            },
            "backend_adminbundle_cliente[dni]": {
            required: "Ingrese el DNI del cliente",
            number: "Ingrese solo números",
            maxlength: jQuery.format("Máximo {0} carácteres!"),
            minlength: jQuery.format("Mínimo {0} carácteres!")
            },
            "backend_adminbundle_sucursal[calle]": {
            required: "Ingrese la calle",
            maxlength:  jQuery.validator.format("Máximo {0} carácteres!"),
            minlength: jQuery.format("Mínimo {0} carácteres!")
            },
            "backend_adminbundle_sucursal[numero]": {
            required: "Ingrese el número",
            maxlength:  jQuery.validator.format("Máximo {0} carácteres!"),
            minlength: jQuery.format("Mínimo {0} carácteres!"),
            number: "Ingrese solo números"
            },
            "backend_adminbundle_sucursal[piso]": {
            required: "Ingrese el piso",
            maxlength:  jQuery.validator.format("Máximo {0} carácteres!"),
            minlength: jQuery.format("Mínimo {0} carácteres!"),
            number: "Ingrese solo números"
            },
            "backend_adminbundle_sucursal[cp]": {
            required: "Ingrese el Código Postal",
            maxlength:  jQuery.validator.format("Máximo {0} carácteres!"),
            minlength: jQuery.format("Mínimo {0} carácteres!"),
            },
            "backend_adminbundle_sucursal[telefono]": {
            required: "Ingrese el número de teléfono",
            maxlength:  jQuery.validator.format("Máximo {0} carácteres!"),
            minlength: jQuery.format("Mínimo {0} carácteres!")
            },
            "backend_adminbundle_sucursal[fax]": {
            maxlength:  jQuery.validator.format("Máximo {0} carácteres!"),
            minlength: jQuery.format("Mínimo {0} carácteres!")
            },
            "backend_adminbundle_sucursal[email]": {
            email: "No es un formato de email válido",
            maxlength:  jQuery.validator.format("Máximo {0} carácteres!"),
            }            
      },
      
      errorPlacement: function(error, element) {
             
            	error.appendTo( element.next() );
        }
			
		});
		
	});
