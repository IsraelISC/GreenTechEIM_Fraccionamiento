// Variable para controlar si el evento click ya se ha agregado
var eventoClickAgregado = false;

let imagenBase64 = null; // O cualquier otro valor inicial que desees
let url = null;

function init() {
  GenerarQR();
}

function GenerarQR() {
  const wrapper = document.querySelector(".wrapper"),
    qrInput = document.querySelector(".form input"),
    qrImg = wrapper.querySelector("#MiQR");

  let preValue;
  let qrValue = qr;
  if (!qrValue || preValue === qrValue) return;
  preValue = qrValue;

  // Aplicar estilos CSS para agregar un borde de 10px alrededor del código QR
  // qrImg.style.border = "25px    #FFF"; // Cambia el color de borde según tus preferencias

  // Generar el código QR
  qrImg.src = `https://quickchart.io/qr?text=` + qrValue + `&size=200&ecLevel=Q&margin=4&centerImageUrl=https://i.postimg.cc/jqnsgwpx/LOGO-TESIS-MODIFIED.png`;
  url = qrImg.src;
}


//Guarda la imagen en Temporal en la URL
function GuardarImagen(url) {
  var xhr = new XMLHttpRequest();
  xhr.open('GET', url, true);
  xhr.responseType = 'blob';

  xhr.onload = function () {
    if (xhr.status === 200) {
      var blob = xhr.response;
      var reader = new FileReader();
      reader.onloadend = function () {
        imagenBase64 = reader.result; // Actualiza imagenBase64 con los datos de la imagen descargada        
        GuardarImagenServer(imagenBase64, qr);
      };
      reader.readAsDataURL(blob);
    } else {
      console.error('Error al descargar la imagen desde la URL.');
    }
  };

  xhr.send();

  // Obtener el lienzo
  var canvas = document.getElementById("miCanvas");
  var context = canvas.getContext("2d");

  // Dibujar el fondo azul
  context.fillStyle = "#1e2e59"; // Color azul
  context.fillRect(0, 0, canvas.width, canvas.height);

  // Dibujar la primera imagen en el lienzo
  var imagen1 = new Image();
  imagen1.src = "../public/img/img_login/GREENTECH2.png";

  // Ruta de la primera imagen
  imagen1.onload = function () {
    var nuevoAncho1 = imagen1.width * 0.2;
    var nuevoAlto1 = imagen1.height * 0.2;
    var x1 = (canvas.width - nuevoAncho1) / 2;

    // Dibujar la primera imagen centrada al 20% de su tamaño original
    context.drawImage(imagen1, x1, 150, nuevoAncho1, nuevoAlto1);

    // Dibujar la segunda imagen en el lienzo
    var imagen2 = new Image();

    imagen2.src = "../files/TempQr/" + qr + ".jpg"; // Reemplaza con la URL de la segunda imagen que deseas agregar

    // Ruta de la segunda imagen
    imagen2.onload = function () {
      var nuevoAncho2 = imagen2.width * 2.5;
      var nuevoAlto2 = imagen2.height * 2.5;
      var x2 = (canvas.width - nuevoAncho2) / 2;

      context.fillStyle = "#ffffff"; // Color del texto (blanco)
      context.font = "64px Century Gothic"; // Fuente y tamaño del texto
      var texto = "ACCESO QR";
      var xTexto = (canvas.width - context.measureText(texto).width) / 2; // Calcula la posición x
      context.fillText(texto, xTexto, 450); // Texto y ubicación (x, y)
      // Dibujar la segunda imagen centrada al 20% de su tamaño original
      context.drawImage(imagen2, x2, 500, nuevoAncho2, nuevoAlto2);
      context.font = "36px Century Gothic"; // Fuente y tamaño del texto
      var texto1 = "Recuerda que este acceso es único para ti";
      var xTexto1 = (canvas.width - context.measureText(texto1).width) / 2; // Calcula la posición x
      context.fillText(texto1, xTexto1, 1100); // Texto y ubicación (x, y)
      // Convertir el lienzo en una imagen
      var imagenDataUrl = canvas.toDataURL("image/png");

      // Crear un enlace de descarga
      var enlace = document.createElement("a");
      enlace.href = imagenDataUrl;
      enlace.download = "MiQR.png";

      // Simular un clic en el enlace para iniciar la descarga
      enlace.click();
    };
  };
}
//Manda a Guardar la Imagen en el Servidor
var ban = 0;
function GuardarImagenServer(url, data) {
  console.log(data);
  $.ajax({
    url: "../ajax/Datos/ajax.datos.php?op=ImagenQr", // Ruta al archivo PHP que procesará la imagen
    type: 'POST',
    data: { imagenBase64: imagenBase64, data: data },
    success: function (response) {
      if (ban == 0) {
        GuardarImagen(url);
        ban = 1;
        createToast("success", response);

      }


    },
    error: function () {
      // Manejo de errores
      console.error('Error al guardar la imagen en el servidor.');
    }
  });
}

init();
