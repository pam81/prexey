var frmvalidator  = new Validator("formForgot");
	frmvalidator.EnableOnPageErrorDisplay();
  frmvalidator.EnableMsgsTogether();
 	frmvalidator.addValidation("email","req","Ingrese el nombre de usuario o el email");


 $(document).ready(function(){
 
 $("#btn_forgot").on("click",function(){
 
   
   
    if ( document.formForgot.onsubmit() )
    {
         $("#formForgot").submit();
    /*var path = $(this).data('url');
    $.ajax({
        type: "POST",
        url: path,
        dataType: 'json',
        data: $("#formForgot").serialize(),
        success: function(data) {
           alert(data.message);
          if (data.status == 0)
            $("#formForgot").get(0).reset();   
        }
    });*/
    }
       
 });   
 
 });   	
