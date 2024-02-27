// Obtener el elemento div donde se mostrará el lector de QR
const readerDiv = document.getElementById('reader');

// Crear un objeto HTML5QrcodeScanner
const html5QrcodeScanner = new Html5QrcodeScanner(
  "reader",
  { fps: 10, qrbox: 250 },
  /* verbose= */ false
);

// Función para manejar el resultado del escaneo de QR
function onScanSuccess(qrCodeMessage) {
    alert(`Contenido del código QR: ${qrCodeMessage}`);
}

// Iniciar el escáner de QR
html5QrcodeScanner.render(onScanSuccess);