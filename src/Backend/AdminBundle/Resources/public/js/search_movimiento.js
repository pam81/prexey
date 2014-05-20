$(document).ready(function() {
$("#show_all").on("click",function(){
        $("#search-button-movimiento").click();
});

$("#search-query").keyup(function(event){
    if(event.keyCode == 13){
        $("#search-button-movimiento").click();
    }
});

});
