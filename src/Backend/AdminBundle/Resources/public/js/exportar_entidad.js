$(document).ready(function() {
$("#exportar_button").click(function(){
   
  var path=$(this).data("url");
  
  var query=$("#custom-search-form").serialize();
  if (query != '')
    path = path +'?'+query;
  
   
  location.href=path;
 

  

}); 

$("#custom-search-form input").keyup(function(event){
    if(event.keyCode == 13){
        $("#search-reporte-button").click();
    }
});





});
