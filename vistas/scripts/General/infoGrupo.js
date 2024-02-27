var tabla;
//Funcion que siempre se ejecuta al inicio
function init() {
	InfoGroup();
	ShowSMS();
	// Inicialización de TinyMCE
	tinymce.init({
		selector: '#MensajeText'
	});

	$("#btnMandarMensaje").on("click", function () {
		var contenidoTinyMCE = tinymce.get('MensajeText').getContent();

		// Asigna el contenido al textarea antes del envío del formulario
		$('#MensajeText').val(contenidoTinyMCE);
		event.preventDefault();
		mandarMensaje();
	})

}
function regresarVentana() {

	// Retroceder en la historia de navegación
	window.history.back();
}

function mandarMensaje() {
	AnimationIn();
	$("#btnMandarMensaje").prop("disabled", true);
	var formData = new FormData($("#MensajeForm")[0]);
	$.ajax({
		url: "../ajax/Residente/ajax.grupo.php?op=MandarMensaje",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,
		success: function (datos) {
			if (datos == "Campos Vacíos") {


				Swal.fire({
					title: datos,
					icon: 'error',
					confirmButtonText: 'Entendido',
					timer: 3000
				})
				AnimationOut();
			}
			else if (datos == "Correcto") {
				createToast("success", "Mensaje Enviado");
				LimpiarDatos();
				$('#MandarMensaje').modal('hide');
				ShowSMS();
				AnimationOut();

			}
			else {
				console.log(datos);
				Swal.fire({
					title: datos,
					icon: 'warning',
					confirmButtonText: 'Entendido',
					timer: 3000
				})
				AnimationOut();
			}
			$("#btnMandarMensaje").prop("disabled", false);
			AnimationOut();
		}

	});
}

function LimpiarDatos() {

	$('#asuntoMensaje').val("");
	$('#MensajeText').val("");
	var editor = tinymce.get('MensajeText');
	editor.setContent('');

}
function ShowSMS() {


	$.post("../ajax/Residente/ajax.grupo.php?op=ShowSMS", function (datos) {

		var data = JSON.parse(datos);

		// Encuentra el modelo por su ID
		var modelo = $('#ModeloSMS');

		// Oculta el modelo antes de comenzar el bucle
		modelo.hide();

		// Vacía el contenedor antes de agregar nuevas tarjetas
		$('#contenedorDeSMS').empty();

		// Agrega tarjetas dinámicamente
		data.aaData.forEach(function (usuario) {
			// Clona el modelo y oculta el clon antes de modificarlo
			var nuevaTarjeta = modelo.clone().hide();

			// Modifica los valores en el nuevo clon
			nuevaTarjeta.find('.title').text(usuario[1]);
			//Mis Datos Con la Limpieza
			// Crear un elemento div temporal usando jQuery
			var tempDiv = $('<div/>');

			// Establecer el contenido HTML del div con el texto que contiene entidades
			tempDiv.html(usuario[2]);
			// Obtener el contenido sin entidades HTML
			var contenidoSinEntidades = tempDiv.text();

			// Obtener el contenido sin entidades HTML
			var contenidoSinEntidades = tempDiv.text();
			nuevaTarjeta.find('.description_notify').html(contenidoSinEntidades);
			nuevaTarjeta.find('.time').text(usuario[3]);

			// Añade el nuevo clon al contenedor y muestra el clon
			nuevaTarjeta.appendTo('#contenedorDeSMS').show();
		});

	});

}
function InfoGroup() {

	$.post("../ajax/Residente/ajax.grupo.php?op=InfoGroup", function (datos) {
		var data = JSON.parse(datos);
		$('#InfoGrupoText').text(data.aaData[0][1]);
		$('#MensajeInfo').text("Código de Grupo: " + data.aaData[0][2]);
	});
}


function AnimationInGrupo() {
	$('#onload-load').fadeIn();
}
function AnimationIn() {
	$('#texto').text('Enviando Mensaje...');
	$('#onload-load').fadeIn();
}
function AnimationOut() {
	//$('#texto').text('CARGANDO');
	$('#onload-load').fadeOut();
}
$(document).ready(function () {
	init();

});
