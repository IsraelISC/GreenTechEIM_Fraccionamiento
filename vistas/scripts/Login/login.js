
//Funcion que siempre se ejecuta al inicio
function init(){		
	$("#Login").on("submit",function(e)
	{		
		ValidarLogin(e);	
	})
}

//Función limpiar
function limpiar()
{
	$("#username").val("");	
	$("#pswd").val("");
}

//Función cancelarform
function cancelarform()
{
	limpiar();	
}
//Función para guardar o editar Usuario
function ValidarLogin(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnLogin").prop("disabled",true);
	var formData = new FormData($("#Login")[0]);

			var btnLogin = document.getElementById("btnLogin");
			var btnCancel = document.getElementById("btn-cancel");
			var btnForgot = document.getElementById("forgot-pw");
            var loadingSpinner = document.getElementById("loadingSpinner");

            btnLogin.classList.add("hidden");
            btnCancel.classList.add("hidden");
            btnForgot.classList.add("hidden");
            loadingSpinner.classList.add("active"); // Agrega la clase "active" para mostrar el spinner suavemente

            setTimeout(function () {
				//---
                loadingSpinner.classList.remove("active");
                setTimeout(function () {
                    btnLogin.classList.remove("hidden");
                    btnCancel.classList.remove("hidden");
                    btnForgot.classList.remove("hidden");
                }, 100);
                // Aquí podrías realizar la acción de envío real o cualquier otra lógica
				$.ajax({
					url: "../ajax/Login/ajax.login.php?op=validarUser",
					type: "POST",
					data: formData,
					contentType: false,
					processData: false,
					success: function(datos)
					{            
						if(datos=="Correcto"){		    	    		
							$("#btnLogin").prop("disabled",false);
							window.location.href="../EIM"
						}  
						else if(datos=="Datos No Coinciden"){	
							$("#alert-container").html('<div class="alert-dismissible alert alert-danger">' +'<center><strong>Identificación de usuario o contraseña incorrecta.</strong></center>' +
								'</div>');
							$("#btnLogin").prop("disabled",false);
						}  	  
						else if(datos=="Campo Vacío"){		    
							$("#alert-container").html('<div class="alert-dismissible alert alert-danger">' +'<center><strong>Campos Vacíos.</strong></center>' +
								'</div>');
							$("#btnLogin").prop("disabled",false);
							$("#btnLogin").prop("disabled",false);
						}
						$("#btnLogin").prop("disabled",false);   					
					}
				});
                
            }, 500); // 2 segundos de espera simulada	
}

//Funciones para constraseña
function forgot_pswd_method(){
            //alert("1")
            $(document).ready(function(){
                $('.container-form').fadeOut()
                setTimeout(function(){
                    $('.container-form').remove()
                    $('.administrator').append('<div class="container-form"><form method="POST" id="Login" name="Login"><label for="chk" aria-hidden="true">Contraseña</label><div id="alert-container"></div><input type="text" name="username" placeholder="Ingresar nombre de usuario" required id="username" autocomplete="off"><input type="text" name="email" placeholder="Ingresar correo electrónico" required id="email" autocomplete="off"><button class="submit-btn" type="submit" id="btnLogin" onclick="recuperarPassword_method()"><i class="fa fa-save"></i> Recuperar</button><button class="submit-btn-return" type="button" id="forgot-pw-return" onclick="return_password()"><i class="fa fa-save"></i>Regresar</button><div id="loadingSpinner" class="loading-spinner"><div class="spinner"></div></div></form></div>')
                },400)
            })
        }
        function return_password(){
                $(document).ready(function(){
                    //alert("2")
                    $('.container-form').fadeOut()
                    setTimeout(function(){
                        $('.container-form').remove()
                        $('.administrator').append('<div class="container-form"><form method="POST" id="Login" name="Login"><label for="chk" aria-hidden="true">Login</label><div id="alert-container"></div><input type="text" name="username" placeholder="Nombre de Usuario" required id="username" autocomplete="off"><input type="password" name="pswd" placeholder="Contraseña" id="pswd" autocomplete="off"><span class="icon-eye" id="eye-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);"><path d="M12 5c-7.633 0-9.927 6.617-9.948 6.684L1.946 12l.105.316C2.073 12.383 4.367 19 12 19s9.927-6.617 9.948-6.684l.106-.316-.105-.316C21.927 11.617 19.633 5 12 5zm0 11c-2.206 0-4-1.794-4-4s1.794-4 4-4 4 1.794 4 4-1.794 4-4 4z"></path><path d="M12 10c-1.084 0-2 .916-2 2s.916 2 2 2 2-.916 2-2-.916-2-2-2z"></path></svg></span><button class="submit-btn" type="submit" id="btnLogin" onclick="init()"><i class="fa fa-save"></i> Iniciar Sesión</button><button class="submit-btn" id="btn-cancel" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button></form><button id="forgot-pw" class="forgot_pswd" onclick="forgot_pswd_method()">olvidaste tu contraseña?</button><div id="loadingSpinner" class="loading-spinner"><div class="spinner"></div></div></div>')
                    },350)
                })
            
        }
        function recuperarPassword_method(){
        	$("#btnLogin").prop("disabled",true);
			var formData = new FormData($("#Login")[0]);
			var btnLogin = document.getElementById("btnLogin");
			var btnReturn = document.getElementById("forgot-pw-return");
			var loadingSpinner = document.getElementById("loadingSpinner");

			btnLogin.classList.add("hidden");
			btnReturn.classList.add("hidden");
			loadingSpinner.classList.add("active"); // Agrega la clase "active" para mostrar el spinner suavemente
            setTimeout(function () {
				//---
                loadingSpinner.classList.remove("active");
                setTimeout(function () {
                    btnLogin.classList.remove("hidden");
                    btnReturn.classList.remove("hidden");
                }, 200);
  		
        	$.ajax({
					url: "../ajax/Login/ajax.login.php?op=ResetPassword",
					type: "POST",
					data: formData,
					contentType: false,
					processData: false,
					success: function(datos)
					{            
						if(datos=="Correcto"){		    	    		
							$("#btnLogin").prop("disabled",false);							
							$(document).ready(function(){
                    		//alert("3")
                    		$('.container-form').fadeOut()
                    			setTimeout(function(){
                        		$('.container-form').remove()
                        		$('.administrator').append('<div class="container-form" id="Login"><label for="chk" aria-hidden="true">Mensaje</label><div id="alert-container"></div><label class="messaje-recuperar_paassword" aria-hidden="true">Hemos enviado tu solicitud al correo registrado en tu cuenta</label><button class="submit-btn-return" type="button" id="forgot-pw-return" onclick="return_password()"><i class="fa fa-save"></i>Continuar</button><div id="loadingSpinner" class="loading-spinner"><div class="spinner"></div></div></div>')
                    		},100)
            			})
						}  
						else if(datos=="Algo falló con el correo electrónico o el Usuario."){	
							$("#alert-container").html('<div class="alert-dismissible alert alert-danger">' +'<center><strong>Algo falló con el correo electrónico o el Usuario.</strong></center>' +
								'</div>');
							$("#btnLogin").prop("disabled",false);
						}  	  
						else if(datos=="Campo Vacío"){		    
							$("#alert-container").html('<div class="alert-dismissible alert alert-danger">' +'<center><strong>Campos Vacíos.</strong></center>' +
								'</div>');
							$("#btnLogin").prop("disabled",false);
							$("#btnLogin").prop("disabled",false);
						}	
						else{
							console.log(datos);
						}					
						$("#btnLogin").prop("disabled",false);   					
					}
				}); 
			}, 500); // 2 segundos de espera simulada	           
        }
init();