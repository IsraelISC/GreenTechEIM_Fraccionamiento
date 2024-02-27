var tabla;

//Funcion que siempre se ejecuta al inicio
function init(){
	$("#btnGuardarPassword").prop("disabled",true);	
	DatosPerfil();			
	$("#btnGuardarPerfil").on("click",function()
    {
    	event.preventDefault(); 
       UpdateDatosPerfil(); 

    });

    $("#btnGuardarPassword").on("click",function(e)
	{				
		ChangePassword(e);	
	});	
}

function LimpiarDatos()
{
	$('#nombrePerfil').val("");
	$('#ApPerfil').val("");
	$('#AmPerfil').val("");
	$('#FechaPerfil').val("");
	$('#EmailPerfil').val("");
	$('#TelefonoPerfil').val("");	
	$('#passwordOld').val("");	
	$('#passwordNew').val("");	
	$("#passwordValidationMessage").text("");        
	$("#passwordSameMessage").text("");
	DatosPerfil();

}
function DatosPerfil()
{			
	$.ajax({
		url: "../ajax/Datos/ajax.datos.php?op=DatosPerfil",
	    type: "POST",	    
	    contentType: false,
	    processData: false,
	    success: function(datos)
	    {            
	    	var data = JSON.parse(datos);
			// Accede a los valores del objeto JavaScript y asígnalos a los elementos de entrada			

			$("#ImagenPerfil").attr("src", data.aaData[0][0] + '?' + new Date().getTime());
			$("#nombrePerfil").val(data.aaData[0][1]);
			$("#ApPerfil").val(data.aaData[0][2]);
			$("#AmPerfil").val(data.aaData[0][3]);
			$("#FechaPerfil").val(data.aaData[0][4]);
			$("#EmailPerfil").val(data.aaData[0][5]);
			$("#TelefonoPerfil").val(data.aaData[0][6]);	
	    }	   
	});
}

function UpdateDatosPerfil() { 
			
  var formData = new FormData($("#DatosPerfil")[0]);
  Swal.fire({
    title: '¿Está Seguro de Guardar Cambios?',
    icon: 'warning',
    grow: 'false',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Confirmar'
  }).then((result) => {
    if (result.isConfirmed) {
    	AnimationIn();
      $.ajax({
        url: "../ajax/Datos/ajax.datos.php?op=EditPerfil",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (datos) {
          // Ocultar el div de carga al recibir la respuesta

          if (datos == "Usuario Actualizado") {
            Swal.fire({
              title: datos,
              icon: 'success',
              confirmButtonText: 'Entendido',
              timer: 3000
            })
            AnimationOut();
            DatosPerfil();
          } else if (datos == "Algún Campo Está Mal") {
            Swal.fire({
              title: datos,
              icon: 'error',
              confirmButtonText: 'Entendido',
              timer: 3000
            })
            AnimationOut();
            DatosPerfil();
          } else {
            Swal.fire({
              title: datos,
              icon: 'error',
              confirmButtonText: 'Entendido',
              timer: 3000
            })
            AnimationOut();
            DatosPerfil();
          }

        }
      });
    } else {
      // Ocultar el div de carga si el usuario cancela
      AnimationOut();
    }
  });
}


function ChangePassword(e){
	$("#btnGuardarPassword").prop("disabled",true);	
	e.preventDefault(); //No se activará la acción predeterminada del evento
	var formData = new FormData($("#PasswordContain")[0]);
	$.ajax({
		url: "../ajax/Datos/ajax.datos.php?op=ChangePassword",
	   type: "POST",
	   data: formData,	    
	   contentType: false,	    		
		processData: false,
		success: function(datos)
		{  
	    			if(datos=="Campos Vacíos"){
	    				Swal.fire({
  						title:datos,
  						icon:'error',
  						confirmButtonText: 'Entendido',
  						timer:3000
						})						
	    			}
	    		   else if(datos=="Las Contraseñas no coinciden"){
	    		   	Swal.fire({
  						title:datos,
  						icon:'warning',
  						confirmButtonText: 'Entendido',
  						timer:3000
						})						
	    		   }
	    		   else if(datos=="Contraseña muy corta"){
	    		   	Swal.fire({
  						title:datos,
  						icon:'error',
  						confirmButtonText: 'Entendido',
  						timer:3000
						})
						
	    		   }
	    		   else if(datos=="Contraseña Actualizada"){
	    		   	Swal.fire({
  						title:datos,
  						icon:'success',
  						confirmButtonText: 'Entendido',
  						timer:3000
						})
						LimpiarDatos();
						$("#exampleModal").modal("hide");
	    		   }
	    		   else{
	    		   	Swal.fire({
  						title:datos,
  						icon:'success',
  						confirmButtonText: 'Entendido',
  						timer:3000
						})
	    		   }
	    		   $("#btnGuardarPassword").prop("disabled",false);	
	    			}   
			});

}


function validatePassword() {
    var password = $("#passwordOld").val();
    
    var passwordValidationMessage = $("#passwordValidationMessage");
    var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$%^&!])[A-Za-z\d@#$%^&!]{8,}$/;

    var hasLowercase = /[a-z]/.test(password);
    var hasUppercase = /[A-Z]/.test(password);
    var hasDigit = /\d/.test(password);
    var hasSpecialChar = /[@#$%^&!]/.test(password);
    var hasMinLength = password.length >= 8;

    

    if (hasMinLength && hasLowercase && hasUppercase && hasDigit && hasSpecialChar) {        
        passwordValidationMessage.text("");        
        
    } else {    	
        var message = "La contraseña debe tener \n";
        if (!hasMinLength) {
            message += "al menos 8 caracteres.\n";
        }
        if (!hasLowercase) {
            message += "una letra minúscula.\n";
        }
        if (!hasUppercase) {
            message += "una letra mayúscula.\n";
        }
        if (!hasDigit) {
            message += "un número.\n";
        }
        if (!hasSpecialChar) {
            message += "un carácter especial (@#$).\n";
        }
        passwordValidationMessage.text(message);
    }
}

function SamePassword(){

	var passwordSameMessage = $("#passwordSameMessage");
	var password = $("#passwordOld").val();
   var passwordNew = $("#passwordNew").val();

   if (password==passwordNew) {
   	passwordSameMessage.text("");
   	$("#btnGuardarPassword").prop("disabled",false);	
   } else {   	
   	$("#btnGuardarPassword").prop("disabled",true);
   	passwordSameMessage.text("Las contraseñas no coinciden.");
   }   
}


function AnimationIn(){
	$('#texto').text('Validando Tus Datos');
  $('#onload-load').fadeIn();
}
function AnimationOut(){
	//$('#texto').text('CARGANDO');
  $('#onload-load').fadeOut();
}

$(document).ready(function() { 
  init();

});
