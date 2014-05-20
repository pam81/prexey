// JavaScript Document
$(document).ready(function(){

$('.eficiencia-descuento').on('click', function(e) {
    
    var id = $(this).data('id');
 
     $('#myModal').find('#save').data('id', id);
     $("#myModal").find("#extra").val(0);
      var path= $(this).data('url');
       $.ajax({
            type: "POST",
            url: path,
            dataType: 'json',
            data: '',
          })
          .done(function(data){
              $("#myModal").find("#extra").val(data.extra); 
                       
          });
        
     
    
});

$("#myModal #save").on('click',function(){
 
   if ( $(this).data('id') != 0 ) {
       $(this).attr("disabled","disabled"); //disabled button to prevent more than one deleted
       var id=$(this).data('id');
       var path=$(this).data('url');
      
       
       var dataString = "id="+id+"&nafta="+$("#nafta").val()+"&extra="+$("#extra").val() 
        $.ajax({
            type: "POST",
            url: path,
            dataType: 'json',
            data: dataString,
          })
          .done(function(data){   //TODO ver como manejo que no se repita
              alert(data.message);
              $("#myModal").modal('toggle');
              window.location.reload(); 
                       
          }).always(function(){
          $("#myModal #save").removeAttr("disabled");
          });
       
        
   }
 
 
 });

});