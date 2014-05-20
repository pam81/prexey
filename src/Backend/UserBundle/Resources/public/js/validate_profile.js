$(document).ready(function() {
		var validator = $("#tab").validate({
		
			rules: {
				"backend_userbundle_profiletype[name]": {
					required:true,
					minlength:2,
					maxlength:100,
				},
				"backend_userbundle_profiletype[lastname]": {
					required:true,
					minlength:2,
					maxlength:100,
				},
				"backend_userbundle_profiletype[email]": {
					required:true,
					minlength:2,
					maxlength:60,
					email: true,
				},
				"backend_userbundle_profiletype[username]": {
					required:true,
					minlength:4,
					maxlength:25,
				}
			
			},
			
			 messages: {
            "backend_userbundle_profiletype[name]": {
            required: "Ingrese su nombre",
            maxlength: jQuery.format("Máximo {0} carácteres!"),
            minlength: jQuery.format("Mínimo {0} carácteres!")
            },
            "backend_userbundle_profiletype[lastname]": {
            required: "Ingrese su Apellido",
            maxlength:  jQuery.validator.format("Máximo {0} carácteres!"),
            minlength: jQuery.validator.format("Mínimo {0} carácteres!")
            },
            "backend_userbundle_profiletype[email]": {
                required: "Ingrese un email",
                email: "Ingrese un email con formato válido name@domain.com",
                maxlength:  jQuery.validator.format("Máximo {0} carácteres!"),
                minlength: jQuery.validator.format("Mínimo {0} carácteres!")
            },
             "backend_userbundle_profiletype[username]": {
            required: "Ingrese un nombre de usuario",
            maxlength:  jQuery.validator.format("Máximo {0} carácteres!"),
            minlength: jQuery.validator.format("Mínimo {0} carácteres!")
            }
            
            
      },
      
      errorPlacement: function(error, element) {
            	error.appendTo( element.next() );
        }
			
		});
		
		
		var validator2 = $("#tab2").validate({
		
			rules: {
				"form[password][first]": {
					required:true,
					minlength:6,
					maxlength:20,
				},
				"form[password][second]": {
					required:true,
					equalTo: "#form_password_first"
				}
				
			},
			
			 messages: {
             "form[password][first]": {
            required: "Ingrese una contraseña",
            maxlength:  jQuery.validator.format("Máximo {0} carácteres!"),
            minlength: jQuery.validator.format("Mínimo {0} carácteres!")
            },
             "form[password][second]": {
            required: "Ingrese nuevamente la contraseña",
            equalTo: "No coincide la contraseña con su confirmación"
            }
            
      },
      
      errorPlacement: function(error, element) {
            	error.appendTo( element.next() );
        }
			
		});
		
		
		
		
	});


/*var frmvalidator  = new Validator("tab");
 	frmvalidator.EnableOnPageErrorDisplaySingleBox();
 	
frmvalidator.EnableMsgsTogether();
  frmvalidator.addValidation("backend_userbundle_profiletype_name","req","Ingrese el nombre");
  frmvalidator.addValidation("backend_userbundle_profiletype_name","minlen=2",
        "el nombre debe tener 2 carácteres como mínimo");
  frmvalidator.addValidation("backend_userbundle_profiletype_name","maxlen=100",
        "el nombre debe tener 100 carácteres máximo");
  
  frmvalidator.addValidation("backend_userbundle_profiletype_lastname","req","Ingrese el apellido");
  frmvalidator.addValidation("backend_userbundle_profiletype_lastname","minlen=2",
        "el apellido debe tener 2 carácteres como mínimo");
  frmvalidator.addValidation("backend_userbundle_profiletype_lastname","maxlen=100",
        "el apellido debe tener 100 carácteres máximo");
  
  
 frmvalidator.addValidation("backend_userbundle_profiletype_email","maxlen=60","El email debe tener 60 carácteres máximo");
 frmvalidator.addValidation("backend_userbundle_profiletype_email","minlen=4","El email debe tener al menos 4 carácteres");
  frmvalidator.addValidation("backend_userbundle_profiletype_email","req","Ingrese un email");
  frmvalidator.addValidation("backend_userbundle_profiletype_email","email","Ingrese un email válido");
 
frmvalidator.addValidation("backend_userbundle_profiletype_username","req","Ingrese el username");
  frmvalidator.addValidation("backend_userbundle_profiletype_username","minlen=4",
        "El username debe tener al menos 4 carácteres");
  frmvalidator.addValidation("backend_userbundle_profiletype_username","maxlen=25",
        "el El username debe tener 25 carácteres máximo");


var validator = new Validator("tab2")
 	validator.EnableOnPageErrorDisplaySingleBox();
 	
validator.EnableMsgsTogether();
 validator.addValidation("form_password_first","req","Ingrese la contraseña");
 validator.addValidation("form_password_second","eqelmnt=form_password_first",
 "La repetición de la contraseña no coincide");     */  

