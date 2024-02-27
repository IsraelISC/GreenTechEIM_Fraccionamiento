//Funcion que siempre se ejecuta al inicio
function init(){
	EscaneoResidente();
}

function EscaneoResidente(){

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
              
              ConsultaResidente(decodedText)
            }

           setTimeout(function(){
               var html5QrcodeScanner = new Html5QrcodeScanner(
                "qr-reader", { fps: 10, qrbox: {width: 250,
            height: 250} });
               html5QrcodeScanner.render(onScanSuccess);
                
              
           },500);  
}


function ConsultaResidente(decodedText){
    var codigoScann=decodedText;
    
    $.post("../ajax/Vigilante/ajax.residente.php?op=ConsultaUsuario", {codigoScann : codigoScann}, function(datos){                
        if(datos=="Campo Vacío"){
            Swal.fire({
                title:datos,
                icon:'error',
                confirmButtonText: 'Entendido',
                timer:3000
            })
        }
        else if(datos=="No se Encontraron Resultados"){
            Swal.fire({
                title:datos,
                icon:'info',
                confirmButtonText: 'Entendido',
                timer:3000
            })
        }
        else{            
                var data = JSON.parse(datos);
                // Accede a los valores del objeto JavaScript y asígnalos a los elementos de entrada                    
                $("#FotoPerfilModal").attr("src", data.aaData[0][1] + '?' + new Date().getTime());
                $("#NombreModal").text(data.aaData[0][2]);                    
                $("#ManzanaModal").text("Manzana: "+data.aaData[0][3]);
                $("#LoteModal").text("Lote: "+data.aaData[0][4]);
                $("#NumeroModal").text("Numero: "+data.aaData[0][5]);
                $("#MarcaModal").text("Marca: "+data.aaData[0][6]);
                $("#ModeloModal").text("Modelo: "+data.aaData[0][7]);
                $("#PlacaModal").text("Placa: "+data.aaData[0][8]);
            
                $('#exampleModal').modal('show')
        }
            
    })
    
	
}

init()
