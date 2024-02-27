var tabla;

//Funcion que siempre se ejecuta al inicio

function init(){
	

	// Ocultar la sección del automóvil por defecto al cargar el modal
    $('#section_automovil').hide();
    $('#MarcaAutoVisitante').val('');
    $('#ModeloAutoVisitante').val('');
    $('#ColorAutoVisitante').val('0').selectpicker('refresh');
    $('#PlacaAutoVisitante').val('');
    

	$("#btnRegistroVisitante").on("click",function(){
        event.preventDefault(); 
        registroVisitante();   
    })

    $("#btnRegistroSalida").on("click",function(){
        event.preventDefault(); 
        registroSalida();   
    })

	$("#btnBasicResponse").on("click",function(){
    	event.preventDefault(); 
		basicJson();
    })

	$('#TipoAcceso').on('change', function() {
        var tipoAccesoSeleccionado = $(this).val();
        if (tipoAccesoSeleccionado === '0' || tipoAccesoSeleccionado === '2') {
            // Limpiar los campos del automóvil
            $('#MarcaAutoVisitante').val('');
            $('#ModeloAutoVisitante').val('');
            $('#ColorAutoVisitante').val('0').selectpicker('refresh');
            $('#PlacaAutoVisitante').val('');

            $('#section_automovil').hide();
        } else {
            $('#section_automovil').show();
        }
    });

    $('#salidaModal').on('show.bs.modal', function () {
        const now = new Date();
        now.setHours(now.getHours() - 6);
        // Obtener la fecha actual en formato ISO (YYYY-MM-DDTHH:MM)
        const formattedDateTime = now.toISOString().slice(0, 16);
        
        // Establecer el valor de FechaSalidaVisitante y deshabilitar la edición
        $('#FechaSalidaVisitante').val(formattedDateTime).prop('disabled', true);
    });

}

function VerificaFormatoFecha(){	

    var inputFecha = document.getElementById("FechaEstimadaVisitante").value;
    var fecha = new Date(inputFecha);

    // Formatea la fecha según tu requerimiento
    var formatoFecha = fecha.getFullYear() + '-' + 
    padNumber(fecha.getMonth() + 1) + '-' + 
    padNumber(fecha.getDate()) + ' ' + 
    padNumber(fecha.getHours()) + ':' + 
    padNumber(fecha.getMinutes()) + ':' + 
    padNumber(fecha.getSeconds());

    Swal.fire({
		title:formatoFecha,
		icon:'success',
		confirmButtonText: 'Entendido',
		timer:3000
	})

	/*const inputDateTimeLocal = document.querySelector("#FechaIngresoVisitante");
	const now = new Date();

	now.setHours(now.getHours() - 6);
	const formattedDateTime = now.toISOString().slice(0, 16);

	inputDateTimeLocal.value = formattedDateTime;

	Swal.fire({
		title:$('#FechaIngresoVisitante').val(),
		icon:'success',
		confirmButtonText: 'Entendido',
		timer:3000
	})*/

}

function padNumber(num) {
    return num.toString().padStart(2, '0');
}

function LimpiarDatos(){

	$('#nombreVisitante').val("");
	$('#ApVisitante').val("");
	$('#AmVisitante').val("");
	$('#CantidadVisitante').val("");
	$('#TipoAcceso').val('0').selectpicker('refresh');
	$('#MarcaAutoVisitante').val("");
	$('#ModeloAutoVisitante').val("");
    $('#ColorAutoVisitante').val('0').selectpicker('refresh');	
	$('#PlacaAutoVisitante').val("");		
	$('#FechaIngresoVisitante').val("");		
    $('#ServicioVisitante').val('0').selectpicker('refresh');
}

function LimpiarFechaSalida(){
    $('#FechaSalidaVisitante').val("");
}

function registroVisitante(){		
    var now = new Date();
    var fechaEstimada = new Date($('#FechaEstimadaVisitante').val());

    // Calcular la diferencia en milisegundos entre las fechas
    var diff = now - fechaEstimada;

    // Obtener la diferencia en minutos
    var diffInMinutes = diff / 1000 / 60;

    // Establecer el margen de tiempo de tolerancia (10 minutos o el tiempo que sea necesario)
    var toleranceMargin = 10;

    if (diffInMinutes > toleranceMargin) {
        Swal.fire({
            //title: 'Ha pasado demasiado tiempo desde la fecha estimada.',
            //text: 'Registra una fecha de estimación más reciente.',
            title: 'Error en fecha de estimación',
            text: 'Registra una fecha actual',
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

            success: function(datos){     
                datos = datos.trim();
                if(datos==="Campos Vacíos"){
                    Swal.fire({
                        title:datos,
                        icon:'question',
                        confirmButtonText: 'Entendido',
                        timer:3000
                        })

                }else if(datos==="Visita Registrada"){
                    // Deshabilitar el botón antes de mostrar el mensaje
                    $("#btnRegistroVisitante").prop("disabled", true);

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
                            listarVisitasById();

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
                
                }else{
                    Swal.fire({
                        title:datos,
                        icon:'error',
                        confirmButtonText: 'Entendido',
                         
                    })		
                }

                

            }  

        });

    }

}

function registroSalida(){
    var formData = new FormData($("#RegistroSalida")[0]);

    //var fechaSalida = $('#FechaSalidaVisitante').val();
    var idSalida = $('#IDVisitanteSalidaModal').text();
    var claveTemp = $('#ClaveVisitanteSalidaModal').text();


    // Log para verificar los valores antes de enviar la solicitud AJAX
    //console.log('Fecha de salida:', fechaSalida);
    

    $.ajax({
        url: "../ajax/Residente/ajax.registroVisitante.php?op=RegistroSalida",
        type: "POST",
        data: {
            //FechaSalidaVisitante: fechaSalida,
            IDVisitanteSalidaModal: idSalida,
            ClaveVisitanteSalidaModal: claveTemp
        },
        success: function (datos) {
            datos = datos.trim();
            if (datos === "Campos Vacíos") {
                Swal.fire({
                    title:datos,
                    icon:'question',
                    confirmButtonText: 'Entendido',
                    timer:3000
                    })
            } else if (datos === "Salida Registrada") {
                // Deshabilitar el botón antes de mostrar el mensaje
                $("#btnRegistroSalida").prop("disabled", true);

                Swal.fire({
                    title:datos,
                    icon:'success',
                    confirmButtonText: 'Entendido',
                    timer:3000,

                    willClose: () => {
                        // Habilitar el botón después de cerrar el modal
                        $("#btnRegistroSalida").prop("disabled", false);

                        // Cierra el modal después de que el usuario confirme el mensaje
                        $('#salidaModal').modal('hide');

                        // Limpia los campos después de cerrar el modal
                        LimpiarFechaSalida();
                        listarVisitasById();

                    }
                })	
            } else {
                Swal.fire({
                    title:datos,
                    icon:'error',
                    confirmButtonText: 'Entendido',
                    timer:3000 
                })
            }
            
        },
        error: function (xhr, status, error) {
            // Manejar errores de AJAX
            console.error(xhr, status, error);
        }
    });

}

init();