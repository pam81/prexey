var frmvalidator  = new Validator("formChange");
	frmvalidator.EnableOnPageErrorDisplay();
  frmvalidator.EnableMsgsTogether();
 	frmvalidator.addValidation("password","req","Ingrese una contraseña");
 	frmvalidator.addValidation("password","maxlen=20",
        "Máximo de 20 carácteres para la contraseña ");
  frmvalidator.addValidation("password","minlen=6",
        "Mínimo de 6 carácteres para la contraseña ");
  frmvalidator.addValidation("confirm","eqelmnt=password",
 "La confirmación del password no coincide");

 $(document).ready(function(){
 
 $("#btn_change").on("click",function(){
 
   
   
    if ( document.formChange.onsubmit() )
    {
         $("#formChange").submit();
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
