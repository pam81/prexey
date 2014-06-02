var frmvalidator  = new Validator("formLogin");
	frmvalidator.EnableOnPageErrorDisplay();
  frmvalidator.EnableMsgsTogether();
 	frmvalidator.addValidation("formUsername","req","Ingrese el nombre de usuario");
  frmvalidator.addValidation("formPassword","req","Ingrese la contraseña");

var frmregister  = new Validator("formRegister");
 	
 	frmregister.EnableOnPageErrorDisplay();
  frmregister.EnableMsgsTogether();
  
  frmregister.addValidation("inputNombre","req","Ingrese el nombre");
  frmregister.addValidation("inputNombre","maxlen=100",
        "Máximo de 100 carácteres para el nombre ");
  frmregister.addValidation("inputApellido","req","Ingrese el apellido");
  frmregister.addValidation("inputApellido","maxlen=100",
        "Máximo de 100 carácteres para el apellido ");
  frmregister.addValidation("inputEmail","req","Ingrese el email");
  frmregister.addValidation("inputEmail","email","Ingrese email válido");
  frmregister.addValidation("inputEmail","maxlen=60",
        "Máximo de 60 carácteres para el email ");
  frmregister.addValidation("inputUsuario","req","Ingrese el nombre de usuario");
  frmregister.addValidation("inputUsuario","maxlen=25",
        "Máximo de 25 carácteres para el nombre de usuario ");
  frmregister.addValidation("inputUsuario","minlen=4",
        "Mínimo de 4 carácteres para el nombre de usuario ");      
  frmregister.addValidation("inputPass","req","Ingrese una contraseña");
  frmregister.addValidation("inputPass","maxlen=20",
        "Máximo de 20 carácteres para la contraseña ");
  frmregister.addValidation("inputPass","minlen=6",
        "Mínimo de 6 carácteres para la contraseña ");
        
  frmregister.addValidation("inputConfirmPass","eqelmnt=inputPass",
 "La confirmación del password no coincide"); 
 
 
 
 $(document).ready(function(){
 
 

 
 $("#btn_create_account").on("click",function(){
 
   
   
    if ( document.formRegister.onsubmit() )
    {
         
    var path = $(this).data('url');
    $.ajax({
        type: "POST",
        url: path,
        dataType: 'json',
        data: $("#formRegister").serialize(),
        success: function(data) {
           alert(data.message);
          if (data.status == 0)
            $("#formRegister").get(0).reset();   
        }
    });
    }
       
 });   
 
 
 $(document).ajaxSend(function(event, request, settings) {
    $("#myModalLoading").show();
});

$(document).ajaxComplete(function(event, request, settings) {
    $("#myModalLoading").hide();
});
 
 });  
