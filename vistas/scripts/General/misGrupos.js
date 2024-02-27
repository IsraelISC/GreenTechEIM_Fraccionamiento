var tabla;
//Funcion que siempre se ejecuta al inicio
function init() {
    MisGrupos();
    $("#btnJoinGroup").on("click", function () {
        JoinGroup();
    });

}

function limpiar() {
    $('#codigoAcceso').val("");
}
function JoinGroup() {
    AnimationIn();
    $("#btnJoinGroup").prop("disabled", true);
    var formData = new FormData($("#JoinGroupForm")[0]);
    $.ajax({
        url: "../ajax/Residente/ajax.grupo.php?op=JoinGroup",
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
            else if (datos == "Te uniste exitosamente al Grupo.") {
                createToast("success", datos);
                limpiar();
                $('#JoinGroup').modal('hide');
                MisGrupos();
                AnimationOut();

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
            $("#btnJoinGroup").prop("disabled", false);
            AnimationOut();
        }

    });
}

function InfoGroupVal(idGrupo) {
    //AnimationInGrupo();
    $.post("../ajax/Residente/ajax.grupo.php?op=InfoGroupVal", { idGrupo: idGrupo }, function (datos) {

        if (datos == "Correcto") {
            window.location.href = "../EIM/InfoGrupo";
            //Modificar esto a PHP
        } else {
            Swal.fire({
                title: datos,
                icon: 'error',
                confirmButtonText: 'Entendido',
                timer: 3000
            })
            //AnimationOut();
        }
    });

}

function MisGrupos() {
    $.ajax({
        url: "../ajax/Residente/ajax.grupo.php?op=ShowGroup",
        type: "POST",
        contentType: false,
        processData: false,
        success: function (datos) {
            // Encuentra el modelo por su ID
            var modelo = $('#modeloTarjeta');

            // Oculta el modelo antes de comenzar el bucle
            modelo.hide();
            if (datos == "No Data") {
                $('#EmptyGrupo').text("Actualmente no te has unido a ningún grupo.");
            } else {
                $('#EmptyGrupo').text("");
                var data = JSON.parse(datos);
                // Vacía el contenedor antes de agregar nuevas tarjetas
                $('#contenedorDeTarjetas').empty();

                // Agrega tarjetas dinámicamente
                data.aaData.forEach(function (usuario) {
                    // Clona el modelo y oculta el clon antes de modificarlo
                    var nuevaTarjeta = modelo.clone().hide();

                    // Modifica los valores en el nuevo clon
                    nuevaTarjeta.find('.card-title').text(usuario[1]);
                    nuevaTarjeta.find('.card-text strong:eq(0)').text(usuario[2]);
                    nuevaTarjeta.find('.card-text strong:eq(1)').text(usuario[3]);
                    nuevaTarjeta.find('.btn-primary').attr('onclick', 'InfoGroupVal(' + usuario[0] + ')');

                    // Añade el nuevo clon al contenedor y muestra el clon
                    nuevaTarjeta.appendTo('#contenedorDeTarjetas').show();
                });

            }


        }
    });
}


function AnimationIn() {
    $('#texto').text('Validando Grupo');
    $('#onload-load').fadeIn();
}
function AnimationOut() {
    //$('#texto').text('CARGANDO');
    $('#onload-load').fadeOut();
}
$(document).ready(function () {
    init();

});
