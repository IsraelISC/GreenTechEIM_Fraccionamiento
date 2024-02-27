var tabla;

//Funcion que siempre se ejecuta al inicio
function init(){	
	UsuariosResult();	
	$("#btnCreateGroup").on("click",function()
    {
    	event.preventDefault(); 
       CrearGrupo();   
    })		
}

function UsuariosResult() {
    $.ajax({
        url: "../ajax/Residente/ajax.grupo.php?op=ConsultaResidenteAddGroup",
        type: "POST",
        contentType: false,
        processData: false,
        success: function(datos) {
            var data = JSON.parse(datos);

            var selectElement = $('#mySelect');
            var choicesInstance = new Choices(selectElement[0], { removeItems: true });

            // Obtener las opciones actuales
            var currentOptions = choicesInstance.getValue(true);

            // Añadir opciones basadas en los datos recibidos
            data.aaData.forEach(function(usuario) {
                var optionValue = usuario[0];  // Ajusta según la estructura de tus datos
                var optionText = usuario[1];   // Ajusta según la estructura de tus datos

                // Añadir la opción al array currentOptions
                currentOptions.push({
                    value: optionValue,
                    label: optionText
                });
            });

            // Actualizar las opciones en Choices.js
            choicesInstance.setChoices(currentOptions, 'value', 'label');
        }
    });
}
function CrearGrupo(){
	//AnimationIn();
	$("#btnCreateGroup").prop("disabled",true);	
	var formData = new FormData($("#CreateGroup")[0]);
	$.ajax({
		url: "../ajax/Residente/ajax.grupo.php?op=CreateGroup",
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
				AnimationOut();					
	    	}
	    	else if(datos=="Algo Salió Mal"){
	    		Swal.fire({
  					title:datos,
  					icon:'warning',
  					confirmButtonText: 'Entendido',
  					timer:3000
					})	
	    		AnimationOut();
	    	}
	    	else if(datos=="Correcto"){
	    		Swal.fire({
  					title:"Registro Exitoso",
  					icon:'success',
  					confirmButtonText: 'Entendido',
  					timer:3000
					})	
	    		$("#alert-container").html('<section class="profile-data blk-2"><div class="contenido"><div class="form-group col-md-12"><div class="alert-dismissible alert alert-success">' +'<center><strong>Nota: </strong>Por favor, notifica a tu residente que sus accesos fueron enviados a su correo proporcionado. <strong></center>' +
  							'</div></div></div></section>');	    		
				LimpiarDatos();	
				AnimationOut();	
	    	}
	    	else{
	    		Swal.fire({
  				title:datos,
  					icon:'error',
  						confirmButtonText: 'Entendido',
  						timer:10000
					})	
					AnimationOut();	
	    	
	    	}
	    	$("#btnCreateGroup").prop("disabled",false);		 
	 		}  
	});
}



function LimpiarDatos(){
	$('#nombreGrupo').val("");
	$('#mySelect').val([]);
	
}
function AnimationIn(){
	$('#texto').text('Creando Grupo');
  $('#onload-load').fadeIn();
}
function AnimationOut(){
	//$('#texto').text('CARGANDO');
  $('#onload-load').fadeOut();
}
$(document).ready(function() {
    init();
});
