var scriptElement = document.createElement('script');

// Establece el atributo src del script con la URL del archivo JavaScript que deseas cargar
scriptElement.src = 'https://rawgit.com/schmich/instascan-builds/master/instascan.min.js';

// Agrega el script al final del cuerpo (o cualquier otro elemento del DOM)
document.body.appendChild(scriptElement);

var scanner = new Instascan.Scanner({
    video: document.getElementById('previsualizacion'),
    scanPeriod: 5,
    mirror: false
});

Instascan.Camera.getCameras().then(function(cameras) {
    if(cameras.length > 0) {
        scanner.start(cameras[0]);
    }else{
        console.error('NO SE ENCONTRÓ CAMARA');
        alert('CAMARA NO ENCONTRADA');
    }
}).catch(function(e) {
    console.error(e);
    alert("ERROR: " + e);
});

scanner.addListener('scan', function(respuesta) {
    console.log("CONTIENE: " + respuesta);
});