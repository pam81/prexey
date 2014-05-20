$(document).ready(function() {

$('#fecha_sanitaria').datetimepicker({
      pickTime: false,
      language: 'es',
    });
$('#fecha_cnrt_peligrosa').datetimepicker({
      pickTime: false,
      language: 'es',
    });
$('#fecha_cnrt').datetimepicker({
      pickTime: false,
      language: 'es',
    });
$('#fecha_cnrt_curso').datetimepicker({
      pickTime: false,
      language: 'es',
    });
$('#fecha_registro').datetimepicker({
      pickTime: false,
      language: 'es',
    });    
		var validator = $("#tab").validate({
		
			rules: {
				"backend_adminbundle_chofer[name]": {
					required:true,
					minlength:2,
					maxlength:100,
				},
				"backend_adminbundle_chofer[lastname]": {
					required:true,
					minlength:2,
					maxlength:100,
				},
				"backend_adminbundle_chofer[direccion]": {
					required:false,
					minlength:2,
					maxlength:300,
				},
				"backend_adminbundle_chofer[observacion]": {
				  required:false,
					minlength:2,
					maxlength:500,
				},
				"backend_adminbundle_chofer[nroEmpleado]": {
					required:true,
					minlength:2,
					maxlength:100,
				},
				"backend_adminbundle_chofer[dni]": {
					required:false,
					minlength:2,
					maxlength:100,
				},
				"backend_adminbundle_chofer[email]": {
					required:false,
					maxlength:100,
					email: true,
				},
				"backend_adminbundle_chofer[celular]": {
					required:false,
					maxlength:100,
				},
				"backend_adminbundle_chofer[radio]": {
					required:false,
					maxlength:100,
				},
				"backend_adminbundle_chofer[telefono]": {
					required:false,
					maxlength:100,
				},
				"backend_adminbundle_chofer[empresa]": {
					required:true,
					
				},
					"backend_adminbundle_chofer[isPeon]": {
					required:false,
					
				},
			},
			
			 messages: {
            "backend_adminbundle_chofer[name]": {
            required: "Ingrese el nombre",
            maxlength: jQuery.format("Máximo {0} carácteres!"),
            minlength: jQuery.format("Mínimo {0} carácteres!")
            },
            "backend_adminbundle_chofer[lastname]": {
            required: "Ingrese el apellido",
            maxlength: jQuery.format("Máximo {0} carácteres!"),
            minlength: jQuery.format("Mínimo {0} carácteres!")
            },
            "backend_adminbundle_chofer[direccion]": {
            required: "Ingrese la dirección",
            maxlength:  jQuery.validator.format("Máximo {0} carácteres!"),
            minlength: jQuery.validator.format("Mínimo {0} carácteres!")
            },
            "backend_adminbundle_chofer[observacion]": {
            maxlength:  jQuery.validator.format("Máximo {0} carácteres!"),
            minlength: jQuery.validator.format("Mínimo {0} carácteres!")
            },
            "backend_adminbundle_chofer[nroEmpleado]": {
            required: "Ingrese un número de empleado",
            maxlength:  jQuery.validator.format("Máximo {0} carácteres!"),
            minlength: jQuery.validator.format("Mínimo {0} carácteres!")
            },
            "backend_adminbundle_chofer[dni]": {
            required: "Ingrese un número de dni",
            maxlength:  jQuery.validator.format("Máximo {0} carácteres!"),
            minlength: jQuery.validator.format("Mínimo {0} carácteres!")
            },
            "backend_adminbundle_chofer[email]": {
            maxlength:  jQuery.validator.format("Máximo {0} carácteres!"),
            email: "Ingrese un email con formato válido name@domain.com",
            },
            "backend_adminbundle_chofer[celular]": {
            maxlength:  jQuery.validator.format("Máximo {0} carácteres!"),
            },
            "backend_adminbundle_chofer[radio]": {
            maxlength:  jQuery.validator.format("Máximo {0} carácteres!"),
            },
           "backend_adminbundle_chofer[telefono]": {
            maxlength:  jQuery.validator.format("Máximo {0} carácteres!"),
            },
            "backend_adminbundle_chofer[empresa]": {
            required: "Seleccione una empresa del listado ",
            
            },
            

            
            
      },
      
      errorPlacement: function(error, element) {
             
            	error.appendTo( element.next() );
        }
			
		});
		
	});





