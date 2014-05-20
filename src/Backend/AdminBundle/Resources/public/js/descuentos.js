$(document).ready(function() {

var checkout =$('#fecha_hasta').datetimepicker({
      pickTime: false,
      language: 'es',
      
    }).on('changeDate', function(ev){
         if($("#search-date_desde").val() != ''){  
          comp = $("#search-date_desde").val().split('-');
          d = parseInt(comp[0], 10);
          m = parseInt(comp[1], 10);
          y = parseInt(comp[2], 10);
          
          var desde = new Date(y,m-1,d,0,0,0,0);
           
          var hasta = ev.date;
           
				  if (desde > hasta)
				   {  alert("Fecha Hasta No puede ser Menor a Fecha Desde");
              $('#fecha_hasta').datetimepicker('setValue',desde);
				   }
         }
				 $('#fecha_hasta').datetimepicker('hide');   	
				});
    
    

var checkin = $('#fecha_desde').datetimepicker({
      pickTime: false,
      language: 'es',
      
    }).on('changeDate', function(ev){
         if($("#search-date_hasta").val() != ''){  
          comp = $("#search-date_hasta").val().split('-');
          d = parseInt(comp[0], 10);
          m = parseInt(comp[1], 10);
          y = parseInt(comp[2], 10);
          
          var hasta = new Date(y,m-1,d,0,0,0,0);
           
          var desde = ev.date;
           
				  if (desde > hasta)
				   {  alert("Fecha Desde No puede ser Mayor a Fecha Hasta");
              $('#fecha_desde').datetimepicker('setValue',hasta);
				   }
         }
				  $('#fecha_desde').datetimepicker('hide');   	   	
				});
 
    
    
 });   