var tabla;

//Funcion que siempre se ejecuta al inicio
function init(){

	console.log('ACABO DE ENTRAR AL INIT JS');

	// Ocultar la sección del automóvil por defecto al cargar el modal
    $('#section_automovil').hide();
    $('#AutomovilVisitante').val('');
    $('#ModeloVisitante').val('');
    $('#ColorAutomovilVisitante').val('0').selectpicker('refresh');
    $('#PlacaVisitante').val('');

	cargarTiposAcceso();
	cargarTiposServicio();
    cargarColores();
    //cargarVisitas(); //Esto es para ver la respuesta JSON EN EL CONSOLE LOG
    //listarVisitas();
    listarVisitasById();

	$("#btnRegistroVisitante").on("click",function()
    {
    	event.preventDefault(); 
       registroVisitante();   
    })

	$("#btnBasicResponse").on("click",function()
    {
    	event.preventDefault(); 
		basicJson();
    })

	$('#TipoAcceso').on('change', function() {
        var tipoAccesoSeleccionado = $(this).val();

        if (tipoAccesoSeleccionado === '0' || tipoAccesoSeleccionado === '2') {
            // Limpiar los campos del automóvil
            $('#AutomovilVisitante').val('');
            $('#ModeloVisitante').val('');
            $('#ColorAutomovilVisitante').val('0').selectpicker('refresh');
            $('#PlacaVisitante').val('');

            $('#section_automovil').hide();
        } else {
            $('#section_automovil').show();
        }
    });

}

function VerificaFormatoFecha()
{	
	const inputDateTimeLocal = document.querySelector("#FechaIngresoVisitante");
	const now = new Date();
	
	now.setHours(now.getHours() - 6);

	const formattedDateTime = now.toISOString().slice(0, 16);

	inputDateTimeLocal.value = formattedDateTime;
	

	//alert('Generando Formato de Fecha....');
	//alert($('#ModeloVisitante').val());
	//alert($('#PlacaVisitante').val());
	Swal.fire({
		title:$('#FechaIngresoVisitante').val(),
		icon:'success',
		confirmButtonText: 'Entendido',
		timer:3000
	  })
	//$('#FechaIngresoVisitante').val("2023-11-06 12:27:34");		
}

function LimpiarDatos()
{
	$('#nombreVisitante').val("");
	$('#ApVisitante').val("");
	$('#AmVisitante').val("");
	$('#CantidadVisitante').val("");
	$('#TipoAcceso').val('0').selectpicker('refresh');
	$('#AutomovilVisitante').val("");
	$('#ModeloVisitante').val("");
    $('#ColorAutomovilVisitante').val('0').selectpicker('refresh');	
	$('#PlacaVisitante').val("");		
	$('#FechaIngresoVisitante').val("");		
	//$('#FechaSalidaVisitante').val("");
    $('#ServicioVisitante').val('0').selectpicker('refresh');
}

function cargarTiposAcceso() {
    $.ajax({
        method: "GET",
        url: "../ajax/Residente/ajax.registroVisitante.php",
        data: { funcion: "getTiposAcceso" }, // Envía el parámetro para indicar la función
        dataType: "json",
        success: function(datos) {
			
            console.log(datos);

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
        },
        error: function(xhr, status, error) {
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
        },
        error: function(xhr, status, error) {
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
            console.log(response); // Puedes imprimir la respuesta en la consola para verificarla

            // Lógica para llenar el select con los tipos de servicio obtenidos
            var selectColorAutoVisitante = $('#ColorAutomovilVisitante');
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
        },
        error: function(xhr, status, error) {
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
            console.log(response); // Puedes imprimir la respuesta en la consola para verificarla
        },
        error: function(xhr, status, error) {
            // Manejo de errores
            console.error(error); // Muestra errores en la consola
        }
    });
}

function basicJson(){
	// Ajax config
	$.ajax({
		method: "GET",
		url: '../ajax/Residente/ajax.registroVisitante.php', // Ruta al archivo PHP
        data: { funcion: "PruebadropDown" }, // Parámetro para indicar la función
		success: function (response) {
			console.log(response);
		}
	});
}

function listarVisitas() {
    console.log("ENTRÉ A LISTAR VISITAS");
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
    console.log("ENTRÉ A LISTAR VISITAS POR ID");
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


function registroVisitante()
{		
    var now = new Date();
    var fechaIngreso = new Date($('#FechaIngresoVisitante').val());

    // Calcular la diferencia en milisegundos entre las fechas
    var diff = now - fechaIngreso;

    // Obtener la diferencia en minutos
    var diffInMinutes = diff / 1000 / 60;

    // Establecer el margen de tiempo de tolerancia (10 minutos o el tiempo que sea necesario)
    var toleranceMargin = 10;

    if (diffInMinutes > toleranceMargin) {
        Swal.fire({
            title: 'Ha pasado demasiado tiempo desde la fecha de ingreso.',
            text: 'Registra una fecha de ingreso más reciente.',
            icon: 'warning',
            confirmButtonText: 'Entendido',
            timer: 5000
        });
    } else {
        var formData = new FormData($("#RegistroVisitante")[0]);
        $.ajax({
            url: "../ajax/Residente/ajax.registroVisitante.php?op=RegistroVisitante",
            type: "POST",	    
            data: formData,
            contentType: false,
            processData: false,
            success: function(datos)
            {     
                datos = datos.trim();
                if(datos==="Campos Vacíos"){
                    Swal.fire({
                        title:datos,
                        icon:'question',
                        confirmButtonText: 'Entendido',
                        timer:3000
                        })						
                }
                else if(datos==="Visita Registrada"){
                    // Deshabilitar el botón antes de mostrar el mensaje
                    $("#btnRegistroVisitante").prop("disabled", true);
                    
                    $("#alert-container").html('<section class="profile-data blk-2"><div class="contenido"><div class="form-group col-md-12"><div class="alert-dismissible alert alert-success">' +'<center><strong>Nota: </strong>Por favor, notifica a tu residente que sus accesos fueron enviados a su correo proporcionado. <strong></center>' +
                                '</div></div></div></section>');
                    Swal.fire({
                    title:datos,
                        icon:'success',
                            confirmButtonText: 'Entendido',
                            timer:3000,
                            willClose: () => {
                                // Habilitar el botón después de cerrar el modal
                                $("#btnRegistroVisitante").prop("disabled", false);
        
                                // Cierra el modal después de que el usuario confirme el mensaje
                                $('#visitaModal').modal('hide');
                                // Limpia los campos después de cerrar el modal
                                LimpiarDatos();
                            }
                        })		
                }else if(datos==="Sección Automóvil Vacía"){
                    //console.log("CONDICIÓN AUTOMÓVIL APLICADA");
                    Swal.fire({
                    title:datos,
                    icon:'warning',
                            confirmButtonText: 'Entendido',
                            timer:3000 
                        })		
                
                }else if(datos==="Sección Peatonal Detectada"){
                    //console.log("CONDICIÓN PEATONAL APLICADA");
                    Swal.fire({
                    title:datos,
                    icon:'warning',
                            confirmButtonText: 'Entendido',
                            timer:3000 
                        })		
                
                }else if(datos==="ERROR"){
                    //console.log("CONDICIÓN CANTIDAD APLICADA");
                    Swal.fire({
                        title:datos,
                        text: 'La cantidad NO puede ser menor o igual a CERO :((',
                        icon:'error',
                                confirmButtonText: 'Entendido',
                                timer:3000 
                            })
                }
                else{
                    Swal.fire({
                        title:datos,
                        icon:'error',
                        confirmButtonText: 'Entendido',
                        timer:3000 
                        })		
                
                }
                console.log(datos);
            }  
        });
    }
}

init();