$(document).ready(function() {
$("#search-button").on('click',function(){
  
  var path=$(this).data("url");
  var query=$("#search-query").val();
  if (query != '')
    path = path +'/'+query;
  
  $("#custom-search-form").attr('action',path);
  $("#custom-search-form").submit();
  

});

$("#search-query").keyup(function(event){
    if(event.keyCode == 13){
        $("#search-button").click();
    }
});

});
