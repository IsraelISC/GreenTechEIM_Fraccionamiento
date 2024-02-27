var tabla;

//Funcion que siempre se ejecuta al inicio
function init() {

	$("#btnRegistroResidente").on("click", function () {
		event.preventDefault();
		registroResidente();
	})
	$("#btnUpdateResidente").on("click", function () {
		event.preventDefault();
		updateDatos();
	})

	listarResidente();
}
function prueba(Name) {
	console.log(Name);

}
function ChangeStatus(idAccount) {
	Swal.fire({
		title: '¿Está Seguro de Desactivar al Usuario?',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Confirmar',
		cancelButtonText: 'Cancelar'
	}).then((result) => {
		if (result.isConfirmed) {
			$.post("../ajax/Residente/ajax.residente.php?op=DesactivarCuenta", { idAccount: idAccount }, function (e) {
				createToast('warning', e);
				tabla.ajax.reload();
			});

		}
	})
}
function ChangeStatusActive(idAccount) {
	Swal.fire({
		title: '¿Está Seguro de Activar al Usuario?',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Confirmar',
		cancelButtonText: 'Cancelar'
	}).then((result) => {
		if (result.isConfirmed) {
			$.post("../ajax/Residente/ajax.residente.php?op=ActivarCuenta", { idAccount: idAccount }, function (e) {
				createToast('success', e);
				tabla.ajax.reload();
			});

		}
	})
}
function listarResidente() {
	tabla = $("#tblAllResidentes").dataTable({

		"aProcessing": true,//Activamos el procesamiento del datatables
		"aServerSide": true,//Paginación y filtrado realizados por el servidor
		dom: 'Bfrtip',//Definimos los elementos del control de tabla
		buttons: [
			'copyHtml5',
			'excelHtml5',
			'csvHtml5',
			'pdf'
		],
		"ajax":
		{
			url: '../ajax/Residente/ajax.residente.php?op=ListarResidente',
			type: "get",
			dataType: "json",
			error: function (e) {
				console.log(e.responseText);
			}
		},
		"bDestroy": true,
		"iDisplayLength": 5,//Paginación
		"order": [[1, "asc"]]//Ordenar (columna,orden)
	}).DataTable();
}
function LimpiarDatos() {
	$('#nombreResidente').val("");
	$('#ApResidente').val("");
	$('#AmResidente').val("");
	$('#FechaResidente').val("");
	$('#EmailResidente').val("");
	$('#TelefonoResidente').val("");
	$('#ManzanaResidente').val("Seleccionar una Manzana");
	$('#LoteResidente').val("");
	$('#NumeroResidente').val("");
	$('#AutomovilResidente').val("");
	$('#ModeloResidente').val("");
	$('#PlacaResidente').val("");

}
function registroResidente() {

	AnimationIn();
	$("#btnRegistroResidente").prop("disabled", true);
	var formData = new FormData($("#RegistroResidente")[0]);
	$.ajax({
		url: "../ajax/Residente/ajax.residente.php?op=RegistroResidente",
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
			else if (datos == "Ingrese un formato de correo válido") {
				Swal.fire({
					title: datos,
					icon: 'warning',
					confirmButtonText: 'Entendido',
					timer: 3000
				})
				AnimationOut();
			}
			else if (datos == "Correcto") {
				createToast("success", "Usuario Registrado Exitosamente");
				// Mostrar el mensaje
				$("#alert-container").html('<section class="profile-data"><div class="contenido"><div class="form-group col-md-12"><div class="alert-dismissible alert alert-success">' + '<center><strong>Nota: </strong>Por favor, notifica a tu residente que sus accesos fueron enviados a su correo electrónico. <strong></center>' + '</div></div></div></section>');

				// Ocultar el mensaje después de 5 minutos
				setTimeout(function () {
					$("#alert-container").empty();  // O utiliza .hide() si solo quieres ocultarlo
				}, .15 * 60 * 1000);  // 5 minutos en milisegundos
				$('#registrarResidente').modal('hide');
				LimpiarDatos();
				AnimationOut();
				tabla.ajax.reload();
			}
			else {
				Swal.fire({
					title: datos,
					icon: 'warning',
					confirmButtonText: 'Entendido',
					timer: 3000
				})
				AnimationOut();

			}
			$("#btnRegistroResidente").prop("disabled", false);
		}
	});


}
function chargeDatos(idAccount) {
	$.post("../ajax/Residente/ajax.residente.php?op=EditDatosByAdmin", { idAccount: idAccount }, function (datos) {
		if (datos == "Campos Vacíos") {
			Swal.fire({
				title: e,
				icon: 'error',
				confirmButtonText: 'Entendido',
				timer: 3000
			});
			$('#updateResidente').modal('hide');
		} else {
			var data = JSON.parse(datos);
			// Accede a los valores del objeto JavaScript y asígnalos a los elementos de entrada						
			$("#ManzanaResidenteUpdate > option[value=" + data.aaData[0][0] + "]").attr("selected", true);
			$("#LoteResidenteUpdate > option[value=" + data.aaData[0][1] + "]").attr("selected", true);
			$("#NumeroResidenteUpdate").val(data.aaData[0][2]);
			$("#AutomovilResidenteUpdate").val(data.aaData[0][3]);
			$("#ModeloResidenteUpdate").val(data.aaData[0][4]);
			$("#PlacaResidenteUpdate").val(data.aaData[0][5]);
			// Después de realizar cambios en el select

			$("#LoteResidenteUpdate").selectpicker('refresh');
			$("#ManzanaResidenteUpdate").selectpicker('refresh');


		}

		tabla.ajax.reload();
	});
}

function updateDatos() {
	var formData = new FormData($("#UpdateResidente")[0]);
	$.ajax({
		url: "../ajax/Residente/ajax.residente.php?op=UpdateResidente",
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
				createToast('success', "Actualización de Datos Correcta");
				tabla.ajax.reload();
				LimpiarDatos();
				AnimationOut();
				$('#updateResidente').modal('hide');

			}
			else {
				Swal.fire({
					title: datos,
					icon: 'warning',
					confirmButtonText: 'Entendido',
					timer: 3000
				})
				AnimationOut();

			}

		}
	});
}
function AnimationIn() {
	$('#texto').text('Registrando Residente');
	$('#onload-load').fadeIn();
}
function AnimationOut() {
	//$('#texto').text('CARGANDO');
	$('#onload-load').fadeOut();
}
$(document).ready(function () {
	init();
});
