$(document).ready(function() {

$("#search-query").keyup(function(event){
    if(event.keyCode == 13){
        $("#search-button").click();
    }
});

});
