function limpiarSelect(idselect) {
    $('#' + idselect + ' option').each(function(index, option) {
        if (index !== '' && index !== 0) {
            $(option).remove();
        }
    });
}

$(document).ready(function() {

$("#backend_adminbundle_caja_chofer").change(function() {
    var option = $("#backend_adminbundle_caja_chofer option:selected").val();
    //eliminar todas las opciones de la zona
    limpiarSelect("backend_adminbundle_caja_viaje");
  
    if (option !== '')
    {
        var dataString = 'chofer=' + option;
        var path = $(this).data('url');
        $.ajax({
            type: "POST",
            url: path,
            dataType: 'json',
            data: dataString,
            success: function(data) {
                $.each(data, function(i) {
                    $('#backend_adminbundle_caja_viaje')
                            .append($('<option>', {value: data[i].id})
                            .text(data[i].id));
                });
            }
        });
    }
});


		var validator = $("#tab").validate({
		
			rules: {
				"backend_adminbundle_caja[tipo]": {
					required:true,
				},
				"backend_adminbundle_caja[chofer]": {
					required:true,
				},
				"backend_adminbundle_caja[viaje]": {
					required:false,
				},
				"backend_adminbundle_caja[monto]": {
					required:true,
				},	
					"backend_adminbundle_caja[motivo]": {
					required:false,
          minlength:2,
					maxlength:200,
				},
			},
			
			 messages: {
            "backend_adminbundle_caja[tipo]": {
            required: "Seleccione el tipo de movimiento",
            },
            "backend_adminbundle_caja[chofer]": {
            required: "Seleccione el nombre del chofer",
            
            },
            "backend_adminbundle_caja[monto]": {
            required: "Ingrese el monto",
            },
            "backend_adminbundle_caja[motivo]": {
            maxlength: jQuery.format("Máximo {0} carácteres!"),
            minlength: jQuery.format("Mínimo {0} carácteres!")
            },
            
      },
      
      errorPlacement: function(error, element) {
             
            	error.appendTo( element.next() );
        }
			
		});
		
	});
