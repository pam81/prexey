$(document).ready(function() {
 
 $("#backend_userbundle_usertype_groups").change();
		var validator = $("#tab").validate({
		
			rules: {
				"backend_userbundle_usertype[name]": {
					required:true,
					minlength:2,
					maxlength:100,
				},
				"backend_userbundle_usertype[lastname]": {
					required:true,
					minlength:2,
					maxlength:100,
				},
				"backend_userbundle_usertype[email]": {
					required:true,
					minlength:2,
					maxlength:60,
					email: true,
				},
				"backend_userbundle_usertype[username]": {
					required:true,
					minlength:4,
					maxlength:25,
				},
				"backend_userbundle_usertype[password][first]": {
					required:false,
					minlength:6,
					maxlength:20,
				},
				"backend_userbundle_usertype[password][second]": {
					required:false,
					equalTo: "#backend_userbundle_usertype_password_first"
				},
				"backend_userbundle_usertype[groups][]": {
					required:true,
					
				},
			
				
			},
			
			 messages: {
            "backend_userbundle_usertype[name]": {
            required: "Ingrese su nombre",
            maxlength: jQuery.format("Máximo {0} carácteres!"),
            minlength: jQuery.format("Mínimo {0} carácteres!")
            },
            "backend_userbundle_usertype[lastname]": {
            required: "Ingrese su Apellido",
            maxlength:  jQuery.validator.format("Máximo {0} carácteres!"),
            minlength: jQuery.validator.format("Mínimo {0} carácteres!")
            },
            "backend_userbundle_usertype[email]": {
                required: "Ingrese un email",
                email: "Ingrese un email con formato válido name@domain.com",
                maxlength:  jQuery.validator.format("Máximo {0} carácteres!"),
                minlength: jQuery.validator.format("Mínimo {0} carácteres!")
            },
             "backend_userbundle_usertype[username]": {
            required: "Ingrese un nombre de usuario",
            maxlength:  jQuery.validator.format("Máximo {0} carácteres!"),
            minlength: jQuery.validator.format("Mínimo {0} carácteres!")
            },
             "backend_userbundle_usertype[password][first]": {
            required: "Ingrese una contraseña",
            maxlength:  jQuery.validator.format("Máximo {0} carácteres!"),
            minlength: jQuery.validator.format("Mínimo {0} carácteres!")
            },
             "backend_userbundle_usertype[password][second]": {
            required: "Ingrese nuevamente la contraseña",
            equalTo: "No coincide la contraseña con su confirmación"
            },
              "backend_userbundle_usertype[groups][]": {
            required: "Seleccione un grupo para el usuario",
            
            },
           
            
      },
      
      errorPlacement: function(error, element) {
            	error.appendTo( element.next() );
        }
			
		});
		
	});



