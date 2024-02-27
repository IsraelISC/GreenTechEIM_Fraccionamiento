var tabla;
var scanned = false; // Variable de indicador
var salidaModalShown = false; // Variable de control para el modal

// Variable para controlar si el evento click ya se ha agregado
var eventoClickAgregado = false;
let imagenBase64 = null; // O cualquier otro valor inicial que desees
let url=null;

//Funcion que siempre se ejecuta al inicio

function init(){
	cargarTiposAcceso();
	cargarTiposServicio();
    cargarColores();
    listarVisitasById();
    listarVisitasTerminadasById();
    listarVisitasVencidasById();
}


function cargarTiposAcceso() {
    $.ajax({
        method: "GET",
        url: "../ajax/Residente/ajax.registroVisitante.php",
        data: { funcion: "getTiposAcceso" }, // Envía el parámetro para indicar la función
        dataType: "json",
        success: function(datos) {
            
            // Lógica para llenar el select con los tipos de acceso obtenidos
            var selectTipoAcceso = $('#TipoAcceso');
            selectTipoAcceso.empty(); // Limpiar el select antes de agregar opciones

			selectTipoAcceso.append($('<option>', {
                value: '0',
                text: '--SELECCIONE--',
				selected: true
            }));

            // Recorre la respuesta para agregar opciones al select
            $.each(datos, function(index, item) {
                selectTipoAcceso.append($('<option>', {
                    value: item.idTipoAcceso,
                    text: item.tipoAcceso_Acceso
                }));

            });

            // Si estás utilizando un plugin de selectpicker, puedes actualizarlo después de cambiar las opciones
            selectTipoAcceso.selectpicker('refresh');

        },error: function(xhr, status, error) {
            // Manejo de errores
            console.error(error); // Muestra errores en la consola
        }
    });

}

function cargarTiposServicio() {
    $.ajax({
        method: "GET",
        url: "../ajax/Residente/ajax.registroVisitante.php",
        data: { funcion: "getTiposServicio" }, // Envía el parámetro para indicar la función
        dataType: "json",
        success: function(response) {
            // Aquí manejas la respuesta recibida
            console.log(response); // Puedes imprimir la respuesta en la consola para verificarla

            // Lógica para llenar el select con los tipos de servicio obtenidos
            var selectServicioVisitante = $('#ServicioVisitante');
            selectServicioVisitante.empty(); // Limpiar el select antes de agregar opciones

			selectServicioVisitante.append($('<option>', {
                value: '0',
                text: '--SELECCIONE--',
				selected: true
            }));

            // Recorre la respuesta para agregar opciones al select
            $.each(response, function(index, item) {
                selectServicioVisitante.append($('<option>', {
                    value: item.idServicio,
                    text: item.nombreServicio_Servicio
                }));
            });

            // Si estás utilizando un plugin de selectpicker, puedes actualizarlo después de cambiar las opciones
            selectServicioVisitante.selectpicker('refresh');

        },error: function(xhr, status, error) {
            // Manejo de errores
            console.error(error); // Muestra errores en la consola
        }
    });

}

function cargarColores(){
    $.ajax({
        method: "GET",
        url: "../ajax/Residente/ajax.registroVisitante.php",
        data: { funcion: "getColores" }, // Envía el parámetro para indicar la función
        dataType: "json",
        success: function(response) {
            // Aquí manejas la respuesta recibida
            //console.log(response); // Puedes imprimir la respuesta en la consola para verificarla

            // Lógica para llenar el select con los tipos de servicio obtenidos
            var selectColorAutoVisitante = $('#ColorAutoVisitante');
            selectColorAutoVisitante.empty(); // Limpiar el select antes de agregar opciones

			selectColorAutoVisitante.append($('<option>', {
                value: '0',
                text: '--SELECCIONE--',
				selected: true
            }));

            // Recorre la respuesta para agregar opciones al select
            $.each(response, function(index, item) {
                selectColorAutoVisitante.append($('<option>', {
                    value: item.idColor,
                    text: item.nombreColor_Color
                }));
            });
            // Si estás utilizando un plugin de selectpicker, puedes actualizarlo después de cambiar las opciones
            selectColorAutoVisitante.selectpicker('refresh');

        },error: function(xhr, status, error) {
            // Manejo de errores
            console.error(error); // Muestra errores en la consola
        }
    });

}

function cargarVisitas(){
	$.ajax({
        method: "GET",
        url: "../ajax/Residente/ajax.visitante.php",
        data: { funcion: "getVisitas" }, // Envía el parámetro para indicar la función
        dataType: "json",
        success: function(response) {
            // Aquí manejas la respuesta recibida
            //console.log(response); // Puedes imprimir la respuesta en la consola para verificarla
        },error: function(xhr, status, error) {
            // Manejo de errores
            console.error(error); // Muestra errores en la consola
        }
    });

}

function listarVisitas() {

    tabla = $("#tblAllVisitas").DataTable({
        "processing": true,
        "serverSide": true,
		"dom": 'Bfrtip', // Agrega la opción 'dom' para los botones DOM
        "buttons": [
            'copyHtml5',
			'excelHtml5',
			'csvHtml5',
			'pdf'
        ],

        "ajax": {
            "url": "../ajax/Residente/ajax.visitante.php",
            "type": "GET",
            "data": { funcion: "ListarVisitas2" },
            "dataType": "json",
            "error": function (e) {
                console.log(e.responseText);
            }
        },

		"destroy": true,
		"pageLength": 5,
		"order": [[1, "asc"]]
    });

}

function listarVisitasById() {
    tabla = $("#tblAllVisitas").DataTable({
        "processing": true,
        "serverSide": true,
		"dom": 'Bfrtip', // Agrega la opción 'dom' para los botones DOM
        "buttons": [
            'copyHtml5',
			'excelHtml5',
			'csvHtml5',
			'pdf'
        ],

        "ajax": {
            "url": "../ajax/Residente/ajax.visitante.php",
            "type": "GET",
            "data": { funcion: "ListarVisitasById" },
            "dataType": "json",
            "error": function (e) {
                console.log(e.responseText);
            }
        },

		"destroy": true,
		"pageLength": 5,
		"order": [[1, "asc"]]
    });

}

function listarVisitasTerminadasById() {
    tabla = $("#tblVisitasTerminadas").DataTable({
        "processing": true,
        "serverSide": true,
		"dom": 'Bfrtip',
        "buttons": [
            'copyHtml5',
			'excelHtml5',
			'csvHtml5',
			'pdf'
        ],

        "ajax": {
            "url": "../ajax/Residente/ajax.visitante.php",
            "type": "GET",
            "data": { funcion: "ListarVisitasTerminadasById" },
            "dataType": "json",
            "error": function (e) {
                console.log(e.responseText);
            }
        },

		"destroy": true,
		"pageLength": 5,
		"order": [[1, "asc"]]
    });

}

function listarVisitasVencidasById() {
    tabla = $("#tblVisitasVencidas").DataTable({
        "processing": true,
        "serverSide": true,
		"dom": 'Bfrtip',
        "buttons": [
            'copyHtml5',
			'excelHtml5',
			'csvHtml5',
			'pdf'
        ],

        "ajax": {
            "url": "../ajax/Residente/ajax.visitante.php",
            "type": "GET",
            "data": { funcion: "ListarVisitasVencidasById" },
            "dataType": "json",
            "error": function (e) {
                console.log(e.responseText);
            }
        },

		"destroy": true,
		"pageLength": 5,
		"order": [[1, "asc"]]
    });

}

function ShowDetailsVisita(idVisita){  
    var idSelected = idVisita;

    $.post("../ajax/Residente/ajax.visitante.php?op=ConsultaVisita", {idSelected : idSelected}, function(response){                
        
        var data = JSON.parse(response);
        if (data.message === "Se genera QR"){

            $('#detallesModal').modal('show');
            GenerarQR(data.results.aaData[0][2]);

            $("#NombreVisitanteModal").text(data.results.aaData[0][1]);
            $("#ClaveVisitanteModal").text(data.results.aaData[0][2]);
            $("#AccesoVisitanteModal").text(data.results.aaData[0][3]);
            $("#CasaVisitanteModal").text(data.results.aaData[0][5]);
            $("#CantidadPersonasVisitanteModal").text(data.results.aaData[0][6]);
            $("#MarcaAutoVisitanteModal").text(data.results.aaData[0][7]);
            $("#ModeloAutoVisitanteModal").text(data.results.aaData[0][8]);
            $("#ColorAutoVisitanteModal").text(data.results.aaData[0][9]);
            $("#PlacaAutoVisitanteModal").text(data.results.aaData[0][10]);
            $("#FechaEstimadaVisitanteModal").text(data.results.aaData[0][11]);
            $("#ServicioVisitanteModal").text(data.results.aaData[0][14]);

        } else if (data.message === "No se genera QR") {

            // Ocultar la imagen
            //$("#MiQR").hide();
            //$("#espacioQR").hide();

            Swal.fire({
                title: "Atención",
                icon:'info',
                text: "Su código QR se generará a partir del día de la fecha programada :)",
                confirmButtonText: 'Entendido',
                timer: 4000
            })
            
            /*$('#detallesModal').modal('show');

            $("#NombreVisitanteModal").text(data.results.aaData[0][1]);
            $("#ClaveVisitanteModal").text(data.results.aaData[0][2]);
            $("#AccesoVisitanteModal").text(data.results.aaData[0][3]);
            $("#CasaVisitanteModal").text(data.results.aaData[0][5]);
            $("#CantidadPersonasVisitanteModal").text(data.results.aaData[0][6]);
            $("#MarcaAutoVisitanteModal").text(data.results.aaData[0][7]);
            $("#ModeloAutoVisitanteModal").text(data.results.aaData[0][8]);
            $("#ColorAutoVisitanteModal").text(data.results.aaData[0][9]);
            $("#PlacaAutoVisitanteModal").text(data.results.aaData[0][10]);
            $("#FechaEstimadaVisitanteModal").text(data.results.aaData[0][11]);
            $("#ServicioVisitanteModal").text(data.results.aaData[0][14]);*/

        } else {
            Swal.fire({
                title: data.message,
                icon:'error',
                confirmButtonText: 'Entendido',
                timer: 4000
            })
        }
    })

}

function GenerarQR(qr) {
    const wrapper = document.querySelector(".wrapper"),
      qrInput = document.querySelector(".form input"),
      qrImg = wrapper.querySelector("#MiQR");
  
    let preValue;
    let qrValue = qr;
    if (!qrValue || preValue === qrValue) return;
    preValue = qrValue;
  
    // Generar el código QR
    qrImg.src = `https://quickchart.io/qr?text=` + qrValue + `&size=200&ecLevel=Q&margin=4&centerImageUrl=https://i.postimg.cc/jqnsgwpx/LOGO-TESIS-MODIFIED.png`;
    url=qrImg.src;   
}

function CloseDetallesModal(){
    $('#detallesModal').modal('hide');
}

function CloseSalidaModal(){
    $('#salidaModal').modal('hide');
}

init();