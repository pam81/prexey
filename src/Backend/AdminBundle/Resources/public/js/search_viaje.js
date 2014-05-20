$(document).ready(function() {
$("#anulado").on("click",function(){
        $("#search-button-viaje").click();
});

$("#excepcion").on("click",function(){
        $("#search-button-viaje").click();
});

$("#search-query").keyup(function(event){
    if(event.keyCode == 13){
        $("#search-button-viaje").click();
    }
});

});
