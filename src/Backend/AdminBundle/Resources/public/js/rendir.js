// JavaScript Document
$(document).ready(function(){

$('#addEficiencia').click(function() {
    
    var id = $(this).data('id');
 
     $('#myModalEficiencia').find('#save').data('id', id);
     $("#myModalEficiencia").find("#extra").val(0);
      var path= $(this).data('url');
       $.ajax({
            type: "POST",
            url: path,
            dataType: 'json',
            data: '',
          })
          .done(function(data){
              $("#myModalEficiencia").find("#extra").val(data.extra); 
                       
          });
        
     
    
});

$("#myModalEficiencia #save").on('click',function(){
      
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
              $("#myModalEficiencia").modal('toggle'); 
                       
          }).always(function(){
          $(this).removeAttr("disabled");
          });
       
        
   }
 
 
 });

});