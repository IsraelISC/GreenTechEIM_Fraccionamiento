var scanned = false; // Variable de indicador
var entradaModalShown = false;
var salidaModalShown = false; // Variable de control para el modal
var residenteModalShown = false; // Variable de control para el modal
var idEntrada; // Declarar fuera para tener un alcance más amplio
var idSalida;

//Funcion que siempre se ejecuta al inicio
function init(){

	EscaneoGeneral();

    $("#btnRegistroEntradaV").on("click",function(){
        event.preventDefault(); 
        registroEntrada(idEntrada); 
    })

    $("#btnRegistroSalidaV").on("click",function(){
        event.preventDefault(); 
        registroSalida(idSalida);  
    })

}

function EscaneoGeneral(){
    var decodedTextElement = document.getElementById('decoded-text');
    var scanCountElement = document.getElementById('scan-count');

    var resultContainer = document.getElementById('qr-reader-results');
    var lastResult, countResults = 1;

         

    async function onScanSuccess(decodedText, decodedResult) {
        // Actualiza el contenido del elemento HTML con el decodedText y el número de veces escaneado.
              
        // Incrementa el contador de escaneos.
        ++countResults;
        lastResult = decodedText;
        // Procesa el código QR cada vez que se escanea, sin importar si es el mismo.
        // Esto permitirá la lectura repetida del mismo código QR.
       
        if (!scanned) { // Verifica si no se ha escaneado o si su estado es NO o falso
            scanned = true; // Cambia el indicador a true para que no se muestre la alerta nuevamente
            ConsultaGeneral(decodedText);
        }

    }

    setTimeout(function(){
        var html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", { fps: 10, qrbox: {width: 250,
            height: 250} });
        html5QrcodeScanner.render(onScanSuccess);            
    },500);
}

function registroEntrada(idEntrada){

    var formData = new FormData($("#RegistroEntrada")[0]);
    var claveTemp = $('#ClaveVisitanteEntradaModal').text();

    $.ajax({
        url: "../ajax/Vigilante/ajax.registroEntradaVisitante.php?op=RegistroEntrada",
        type: "POST",
        data: {
            IDVisitanteEntradaModal: idEntrada,
            ClaveVisitanteEntradaModal: claveTemp
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
            } else if (datos === "Entrada Registrada") {
                // Deshabilitar el botón antes de mostrar el mensaje
                idEntrada = undefined;
                $("#btnRegistroEntradaV").prop("disabled", true);

                Swal.fire({
                    title:datos,
                    icon:'success',
                    confirmButtonText: 'Entendido',
                    timer:3000,

                    willClose: () => {
                        // Habilitar el botón después de cerrar el modal
                        $("#btnRegistroEntradaV").prop("disabled", false);
                        $('#entradaModal').modal('hide');

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
            //console.log(datos);
        },
        error: function (xhr, status, error) {
            // Manejar errores de AJAX
            console.error(xhr, status, error);
        }
    });
}

function registroSalida(idSalida){

    var formData = new FormData($("#RegistroSalida")[0]);
    var claveTemp = $('#ClaveVisitanteSalidaModal').text();

    $.ajax({
        url: "../ajax/Vigilante/ajax.registroSalidaVisitante.php?op=RegistroSalida",
        type: "POST",
        data: {
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
                idSalida = undefined;
                $("#btnRegistroSalida").prop("disabled", true);

                Swal.fire({
                    title:datos,
                    icon:'success',
                    confirmButtonText: 'Entendido',
                    timer:3000,

                    willClose: () => {
                        // Habilitar el botón después de cerrar el modal
                        $("#btnRegistroSalida").prop("disabled", false);
                        $('#salidaModal').modal('hide');
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
            //console.log(datos);
        },
        error: function (xhr, status, error) {
            // Manejar errores de AJAX
            console.error(xhr, status, error);
        }
    });

}

function ConsultaGeneral(decodedText){
    var codigoScann = decodedText;

    $.post("../ajax/Vigilante/ajax.scanGeneral.php?op=ConsultaCodigoQR", {codigoScann : codigoScann}, function(response){                
        
        response = JSON.parse(response.trim());

        var userType = response.userType;
        var data = response.results;
        var message = response.message;

        if(message === "Campo Vacío"){
            Swal.fire({
                title:message,
                icon:'error',
                confirmButtonText: 'Entendido',
                timer: 4000
            }).then(() => {
                scanned = false; // Reanuda el escaneo
            });

        } else if(message === "No se encontraron resultados"){
            Swal.fire({
                icon: 'info',
                title: 'Sin resultados',
                text: message,
                timer: 4000
            }).then(() => {
                scanned = false;
            });

        } else if (message === "Código QR Expirado"){
            Swal.fire({
                title: message,
                icon: 'warning',
                confirmButtonText: 'Entendido',
                timer: 4000
            }).then(() => {
                scanned = false;
            });

        } else if (message === "NO EXISTE QR EN EL SISTEMA"){
            Swal.fire({
                title: message,
                icon: 'error',
                confirmButtonText: 'Entendido',
                timer: 4000
            }).then(() => {
                scanned = false;
            });

        } else{            

            scanned = true;

            if (userType === "Residente" && !residenteModalShown) {

                $('#residenteModal').modal('show');
                residenteModalShown = true;

                // Accede a los valores del objeto JavaScript y asígnalos a los elementos de entrada                    
                $("#FotoPerfilModal").attr("src", data.aaData[0][1] + '?' + new Date().getTime());
                $("#NombreModal").text(data.aaData[0][2]);                    
                $("#ManzanaModal").text("Manzana: "+data.aaData[0][3]);
                $("#LoteModal").text("Lote: "+data.aaData[0][4]);
                $("#NumeroModal").text("Numero: "+data.aaData[0][5]);
                $("#MarcaModal").text("Marca: "+data.aaData[0][6]);
                $("#ModeloModal").text("Modelo: "+data.aaData[0][7]);
                $("#PlacaModal").text("Placa: "+data.aaData[0][8]);
            
                
            } else if (userType === "Visitante" && !salidaModalShown) {

                if (message === "Registro Entrada Detectado"){
                
                    $('#entradaModal').modal('show');
                    entradaModalShown = true;

                    //$("#IDVisitanteEntradaModal").text(data.aaData[0][0]);
                    idEntrada = data.aaData[0][0];
                    $("#NombreVisitanteEntradaModal").text(data.aaData[0][1]);
                    $("#ClaveVisitanteEntradaModal").text(data.aaData[0][2]);
                    $("#FechaEstimadaEntradaModal").text(data.aaData[0][11]);
                
                } else if (message === "Registro Salida Detectado"){
                
                    $('#salidaModal').modal('show');
                    salidaModalShown = true;

                    //$("#IDVisitanteSalidaModal").text(data.aaData[0][0]);
                    idSalida = data.aaData[0][0];
                    $("#NombreVisitanteSalidaModal").text(data.aaData[0][1]);
                    $("#ClaveVisitanteSalidaModal").text(data.aaData[0][2]);
                    $("#FechaEstimadaModal").text(data.aaData[0][11]);

                } else {
                    Swal.fire({
                        title:message,
                        icon:'error',
                        confirmButtonText: 'Entendido',
                        timer: 4000
                    }).then(() => {
                        scanned = false; // Reanuda el escaneo
                    });
                }

            }

            // Al cerrar el modal, reanuda el escaneo
            $('#salidaModal, #residenteModal, #entradaModal').on('hidden.bs.modal', function (e) {
                scanned = false;
                salidaModalShown = false;
                residenteModalShown = false;
                entradaModalShown = false;
            });
            
        }
    })

}

function CloseEntradaModal(){
    $('#entradaModal').modal('hide');
}

function CloseSalidaModal(){
    $('#salidaModal').modal('hide');
}

function DeshabilitarRegistro(idRegistro){
    var idRegistroV = idRegistro;

    $.post("../ajax/Vigilante/ajax.scanGeneral.php?op=DeshabilitarRegistro", {idRegistroV : idRegistroV}, function(response){                
        
        response = JSON.parse(response.trim());

        var message = response.message;


        if(message === "Campo Vacío"){
            Swal.fire({
                title:message,
                icon:'error',
                confirmButtonText: 'Entendido',
                timer: 4000
            }).then(() => {
                scanned = false; // Reanuda el escaneo
            });

        } else if(message === "Código QR Expirado"){
            Swal.fire({
                title:message,
                icon:'info',
                text: 'La fecha estimada ha vencido, genere un registro de visita nuevo',
                confirmButtonText: 'Entendido',
                timer: 4000
            }).then(() => {
                scanned = false; // Reanuda el escaneo
            });

        }
        
        else {
            Swal.fire({
                title:message,
                icon:'error',
                confirmButtonText: 'Entendido',
                timer: 4000
            }).then(() => {
                scanned = false; // Reanuda el escaneo
            });
        }
    })
}

init()