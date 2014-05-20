$(document).ready(function() {
 	var validator = $("#tabMov").validate({
 	
 	rules: {
				"backend_adminbundle_movimiento[clase]": {
					required:true,
					
				},
				"backend_adminbundle_movimiento[deposito]": {
					required:true,
					
				},
				
				"backend_adminbundle_movimiento[monto]": {
					required:true,
					
				},
				"backend_adminbundle_movimiento[motivo]": {
					required:false,
					maxlength:500,
				},
				"backend_adminbundle_movimiento[deposito_destino]": {
					required:true,
					
				},
				
			},
			messages: {
            "backend_adminbundle_movimiento[clase]": {
            required: "Seleccione una clase",
            
            },
           "backend_adminbundle_movimiento[deposito]": {
            required: "Seleccione un depósito",
            
            },
            "backend_adminbundle_movimiento[deposito_destino]": {
            required: "Seleccione un depósito destino",
            
            },
           "backend_adminbundle_movimiento[monto]": {
            required: "Ingrese un monto",
            
            }, 
            "backend_adminbundle_movimiento[motivo]": {
            maxlength: jQuery.format("Máximo {0} carácteres!"),
            
            }, 
            
            
      },
      errorPlacement: function(error, element) {
             
            	error.appendTo( element.next() );
        }
 	
 	});
 
 
 
});
