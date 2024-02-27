<?php session_start();

error_reporting(0);



require_once "../../modelos/Residente/modelo.residente.php";

$categoria = new Residente();
//Creació de dependencias para el correo 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Implementacion de la funcion
function MandarCorreo($destinatario, $usuario, $password, $nombre)
{
	//Import PHPMailer classes into the global namespace
	//These must be at the top of your script, not inside a function

	//Load Composer's autoloader
	require '../../public/PHPMailer/Exception.php';
	require '../../public/PHPMailer/PHPMailer.php';
	require '../../public/PHPMailer/SMTP.php';

	//Create an instance; passing `true` enables exceptions
	$mail = new PHPMailer(true);

	try {
		//Server settings
		$mail->SMTPDebug = 0;                      //Enable verbose debug output DEBUG:2 NOT:0
		$mail->isSMTP();                                            //Send using SMTP
		$mail->Host       = 'mail.greentecheim.com.mx';                     //Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
		$mail->Username   = 'MiAcceso@greentecheim.com.mx';                     //SMTP username
		$mail->Password   = 'Admin@135';                               //SMTP password
		$mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
		$mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

		//Recipients
		$mail->setFrom('MiAcceso@greentecheim.com.mx'); //User that send the mail...
		$mail->addAddress($destinatario);     //Add a recipient
		//$mail->addAddress('luismiguelzamoranunez@gmail.com');               
		//$message=file_get_contents('../../vistas/Mail/mail.html');
		//$message=str_replace('{nombre}', $nombreResidente, $message);
		//$message=str_replace('{user}', $usuario, $message);
		//$message=str_replace('{password}', $password, $message);

		//Content
		$mail->isHTML(true);                                  //Set email format to HTML
		$mail->Subject = 'GreenTech EIM - Mi Acceso';
		$mail->CharSet = 'UTF-8';
		//     	$mail->Body    = "<!DOCTYPE html> <html lang='en'> <head> <meta charset='UTF-8'> <meta name='viewport' content='width=device-width, initial-scale=1.0'> <title>MAIL</title> <style type='text/css'> @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap'); @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap'); @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap'); \*{ top: 0; margin: 0; box-sizing: border-box; } </style> </head> <body> <div style='top:0; margin:0; box-sizing:border-box;'> <section class='mail' style='position: relative; width: 100%; height: 75vh; background-color: #f6f6f6; border: 1px solid transparent; border-radius: 3px; font-family: 'Poppins', sans-serif;'> <div class='mail-header' style='position: relative; width: 100%; background-image: linear-gradient(60deg, #29323c7a 0%, #48556371 100%), url('https://i.ibb.co/X3YpQrY/bg3.jpg'); background-repeat: no-repeat; background-size: cover; object-fit: cover; border: none; outline: none; padding-top: 5px; padding-bottom: 55px; border-radius: 3px 3px 0 0;'> <img src='https://i.ibb.co/nQMLJpt/GREENTECH2.png' alt='' class='logo' style='display: block; width: 250px; margin: 10px auto; object-fit: cover;'> <div class='wave' style='position: absolute; width: 100%; top: -25px; left: 0; height: 150px; overflow: hidden;'>
		// <svg viewBox='0 0 500 150' preserveAspectRatio='none' style='height: 100%; width: 100%;'><path d='M-1.35,112.69 C320.32,165.83 277.42,89.06 501.46,120.57 L500.00,149.60 L0.00,149.60 Z' style='stroke: none; fill: #f6f6f6;'></path></svg></div>
		// </div> <div class='mail-body' style='position: relative; width: 100%; height: 70%;'> <div class='asunto-mail' style='display: block; position: relative; margin: 25px auto; width: 95%; background-image: linear-gradient(60deg, #29323c 0%, #485563 100%); text-align: center; font-size: 0.9rem; color: #fff; border-radius: 5px; padding: 2px; z-index: 20;'> <h2>ACCESO</h2> </div> <div class='cuerpo-mail' style='position: absolute; width: 93%; top: 33px; left: 3.5%; text-align: justify; padding-top: 15px; padding-bottom: 15px; padding-left: 30px; padding-right: 30px; border-radius: 0 0 10px 10px; background-color: rgba(0, 0, 0, 0.473); color: snow; z-index: 10;'> <p class='mail-text' style='font-weight: 300; padding-top: 5px;'>
		// Hola, <strong>" .$nombre." </strong>. Te damos la bienvenida a GREENTECH. <br>Para poder acceder a la plataforma, te proporcionamos tu acceso para poder ingresar.</p>
		// <h3 class='mail-sub\_title' style='font-weight: 500; padding-top: 15px; border-bottom: 3px solid;'>CREDENCIALES</h3> <p class='mail-text'>
		// Usuario: <strong>" .$usuario." </strong><br>Contraseña: <strong>" .$password."</strong>
		// </p>
		// <a href='https://greentecheim.com.mx/Fraccionamiento/' class='btn-mail-link' style='display: block; margin-top: 12px; margin-bottom: 12px; width: 150px; background-image: linear-gradient(60deg, #29323c 0%, #485563 100%); color: #fff; padding: 4px 15px; outline: none; text-decoration: none; text-align: center; border-radius: 12px; border: 1px solid transparent; transition: .3s;'>INICIA SESIÓN</a>
		// </div> </div> <div class='mail-copyright' style='position: absolute; width: 100%; padding: 7px; background-image: linear-gradient(60deg, #29323c 0%, #485563 100%); color: snow; font-weight: 300; top: calc(65.6vh + 5vh); left: 0; border-radius: 3px;'> <p>Copyright&copy; 2023 - GreenTechEIM - Todos los derechos reservados</p></div> </section> <div> </body> </html>";
		$mail->Body    = '
		<!DOCTYPE html>
		<html lang="es">

		<head>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title>MAIL</title>
		</head>

		<body style="margin: 0; padding: 0; font-family: \'Poppins\', sans-serif;">
			<table style="width: 100%; max-width: 500px; margin: 0 auto; background-color: #f6f6f6;">
				<tr>
					<td style="background: linear-gradient(60deg, #29323c 0%, #485563 100%); padding: 5px; text-align: center;">
						<img src="https://i.postimg.cc/xkTMb0SJ/GREENTECH2.png" alt="GreenTech Logo" style="display: block; margin: 10px auto; max-width: 50%; height: auto;">
					</td>
				</tr>
				<tr>
					<td style="padding: 15px;">
						<h2 style="background-color: #485563; color: #f6f6f6; text-align: center; border-bottom: 3px solid #485563; border-top: 3px solid #485563;">ACCESO</h2>
						<p>Hola, <strong>'.$nombre.'</strong>. Te damos la bienvenida a GREENTECH. Para poder acceder a la plataforma,
							te proporcionamos tu acceso para poder ingresar.</p>
						<h3 style="border-bottom: 3px solid black;">CREDENCIALES</h3>
						<p>
							Usuario: <strong>'.$usuario.'</strong><br>Contraseña: <strong>'.$password.'</strong>
						</p>
						<a href="https://greentecheim.com.mx/Fraccionamiento/" style="display: block; margin: 12px auto; width: 150px; background: linear-gradient(60deg, #29323c 0%, #485563 100%); color: #fff; padding: 4px 15px; text-decoration: none; text-align: center; border-radius: 12px;">ACCEDER</a>
					</td>
				</tr>
				<tr>
					<td style="background: linear-gradient(60deg, #29323c 0%, #485563 100%); color: snow; font-weight: 300; padding: 7px; text-align: center;">
						<p>Copyright&copy; 2023 - GreenTechEIM - Todos los derechos reservados</p>
					</td>
				</tr>
			</table>
		</body>

		</html>

		';


		$mail->send();
	} catch (Exception $e) {

		echo "<script>alert('Error al enviar, revisar sus datos y volver a intentar...');
    window.location.href = 'form.php';
    </script>";
		echo "Error: {$mail->ErrorInfo}";
	}
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

	//Registros de Usuarios
	function EliminarAcento($str)
	{
		$acentos = ['á', 'é', 'í', 'ó', 'ú', 'ü', 'ñ', 'Á', 'É', 'Í', 'Ó', 'Ú', 'Ü', 'Ñ'];
		$sinAcentos = ['a', 'e', 'i', 'o', 'u', 'u', 'n', 'A', 'E', 'I', 'O', 'U', 'U', 'N'];

		$str = str_replace($acentos, $sinAcentos, $str);
		return $str;
	}

	function generarUserAutomatico($nombre, $apellidoPaterno, $apellidoMaterno)
	{
		// Tomar los primeros dos dígitos del nombre, apellido paterno y apellido materno
		$primerosDosNombre = substr($nombre, 0, 2);
		$primerosDosPaterno = substr($apellidoPaterno, 0, 2);
		$primerosDosMaterno = substr($apellidoMaterno, 0, 2);



		// Generar un número aleatorio entre 1 y 100
		$numeroAleatorio = rand(1, 100);

		// Generar una letra aleatoria de la A a la Z
		$letraAleatoria = chr(rand(65, 90));

		// Combinar los elementos para formar la contraseña
		$contraseñaAleatoria = $primerosDosNombre . $primerosDosPaterno . $primerosDosMaterno . $numeroAleatorio . $letraAleatoria;

		return $contraseñaAleatoria;
	}
	function generarPasswordAutomatico($apellidoPaterno)
	{
		// Generar un número aleatorio entre 1 y 100
		$numeroAleatorio = rand(1, 100);
		// Generar una letra aleatoria de la A a la Z
		$letraAleatoria = chr(rand(65, 90));

		$apellidoPaternoFormateado = ucfirst(strtolower($apellidoPaterno));
		$passAuto = "@" . $apellidoPaterno . "-" . $numeroAleatorio . $letraAleatoria;
		return $passAuto;
	}

	//Validacion de Campos Personales
	$nombreResidente = FiltradoDatos($_POST["nombreResidente"]);
	$ApResidente = FiltradoDatos($_POST["ApResidente"]);
	$AmResidente = FiltradoDatos($_POST["AmResidente"]);
	$TelefonoResidente = FiltradoDatos($_POST["TelefonoResidente"]);
	$ManzanaResidente = FiltradoDatos($_POST["ManzanaResidente"]);
	$LoteResidente = FiltradoDatos($_POST["LoteResidente"]);
	$NumeroResidente = FiltradoDatos($_POST["NumeroResidente"]);
	$AutomovilResidente = FiltradoDatos($_POST["AutomovilResidente"]);
	$ModeloResidente = FiltradoDatos($_POST["ModeloResidente"]);
	$PlacaResidente = FiltradoDatos($_POST["PlacaResidente"]);


	$FechaResidente = isset($_POST["FechaResidente"]) ? limpiarCadena($_POST["FechaResidente"]) : "";
	$EmailResidente = isset($_POST["EmailResidente"]) ? limpiarCadena($_POST["EmailResidente"]) : "";

	$idDesactivarCuentaEn = isset($_POST["idAccount"]) ? limpiarCadena($_POST["idAccount"]) : "";
	$idDesactivarCuenta = decryptData($idDesactivarCuentaEn);
	switch ($_GET["op"]) {
		//Listado de Residente		
		case 'RegistroResidente':
			$EmailResidente = trim($EmailResidente, " ");
			if (empty($nombreResidente) || empty($ApResidente) || empty($AmResidente) || empty($TelefonoResidente) || empty($ManzanaResidente) || empty($LoteResidente) || empty($NumeroResidente) || empty($AutomovilResidente) || empty($ModeloResidente) || empty($PlacaResidente) || empty($FechaResidente) || empty($EmailResidente)) {
				echo $rspta = "Campos Vacíos";
			} else {
				// Definir una expresión regular para validar el formato de 	correo
				$patron_correo = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

				// Verificar si el valor cumple con el formato de correo
				if (preg_match($patron_correo, $EmailResidente)) {
					//Eliminación de acento
					$nombreResidenteClean = EliminarAcento($nombreResidente);
					$ApResidenteClean = EliminarAcento($ApResidente);
					$AmResidenteClean = EliminarAcento($AmResidente);

					$user = generarUserAutomatico($nombreResidenteClean, $ApResidenteClean, $AmResidenteClean);
					$pass = generarPasswordAutomatico($ApResidenteClean);

					//Encriptamiento de el password
					$passHash = hash("sha512", $pass);
					$PlacaResidente = encryptData($PlacaResidente);



$rspta = $categoria->insertResidente($EmailResidente, $TelefonoResidente, 1, $ManzanaResidente, $LoteResidente, $NumeroResidente, $AutomovilResidente, $ModeloResidente, $PlacaResidente, $nombreResidente, $ApResidente, $AmResidente, $FechaResidente, $user, $passHash, 2);
					echo $rspta ? "Correcto" : "Usuario no se pudo registrar";

					
if ($rspta == "Correcto")
						MandarCorreo($EmailResidente, $user, $pass, $nombreResidente);

				} else {
					echo "Ingrese un formato de correo válido";
				}
			}


			break;
		case "EditDatosByAdmin":
			//Dato id de la Cuenta $idDesactivarCuenta
			if (empty($idDesactivarCuenta)) {
				echo "Campos Vacíos";
			} else {
				if (is_numeric($idDesactivarCuenta)) {
					$rspta = $categoria->ShowDomicilioCarro($idDesactivarCuenta);
					$data = array();
					$_SESSION['IdValResidente'] = $idDesactivarCuenta;
					while ($reg = $rspta->fetch_object()) {
						$data[] = array(
							"0" => ($reg->manzana),
							"1" => ($reg->lote),
							"2" => ($reg->numero),
							"3" => ($reg->marca),
							"4" => ($reg->modelo),
							"5" => (decryptData($reg->placa))
						);
					}
					$results = array(
						"sEcho" => 1, //Información para el datatables
						"iTotalRecords" => count($data), //enviamos el total registros al datatable
						"iTotalDisplayRecords" => count($data), //enviamos el total registros a visualizar
						"aaData" => $data
					);
					echo json_encode($results);
				} else {
					echo "Campos Vacíos";
				}

			}
			break;
		case 'UpdateResidente':
			if (empty($ManzanaResidente) || empty($LoteResidente) || empty($NumeroResidente) || empty($AutomovilResidente) || empty($ModeloResidente) || empty($PlacaResidente)) {
				echo "Campos Vacíos";
			} else {

				//EditDatosResidente				
				$PlacaResidente = encryptData($PlacaResidente);
				$rspta = $categoria->EditDatosResidente($_SESSION['IdValResidente'], $ManzanaResidente, $LoteResidente, $NumeroResidente, $AutomovilResidente, $ModeloResidente, $PlacaResidente);
				echo $rspta ? "Correcto" : "Usuario no se pudo actualizar";
			}
			break;


		case 'EditPerfil':
			if (empty($nombrePerfil) || empty($ApPerfil) || empty($AmPerfil) || empty($FechaPerfil) || empty($EmailPerfil) || empty($TelefonoPerfil))
				echo $rspta = "Algún Campo Está Mal";
			else {
				//Validar si es una fecha
				$valores = explode('-', $FechaPerfil);
				// Definir una expresión regular para validar el formato de 	correo
				$patron_correo = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

				if (count($valores) == 3 && checkdate($valores[1], $valores[2], $valores[0])) {
					if (empty($archivo["name"])) {
						$ruta = '../files/FotoPerfil/' . $_SESSION['IdUsuario'] . ".png";
						// Verificar si el valor cumple con el formato de correo
						if (preg_match($patron_correo, $EmailPerfil)) {
							$rspta = $categoria->UpdatePerfil($_SESSION['IdUsuario'], $nombrePerfil, $ApPerfil, $AmPerfil, $FechaPerfil, $EmailPerfil, $TelefonoPerfil, $ruta);
							echo $rspta ? "Usuario Actualizado" : "Usuario no se pudo registrar";
						} else {
							echo "Algo Salió Mal";
						}
					} else {
						// Verificar si no hubo errores durante la carga
						if ($archivo['error'] === UPLOAD_ERR_OK) {
							// Verificar que el archivo sea una imagen JPG o PNG
							$tipo = mime_content_type($archivo['tmp_name']);
							if ($tipo == 'image/jpeg' || $tipo == 'image/png') {
								// Verificar que el tamaño sea menor a 5 MB
								if ($archivo['size'] <= 5 * 1024 * 1024) {
									// Mover el archivo a la ubicación deseada
									$ruta = '../files/FotoPerfil/' . $_SESSION['IdUsuario'] . ".png";
									move_uploaded_file($archivo['tmp_name'], "../" . $ruta);
									// Verificar si el valor cumple con el formato de correo
									if (preg_match($patron_correo, $EmailPerfil)) {
										$rspta = $categoria->UpdatePerfil($_SESSION['IdUsuario'], $nombrePerfil, $ApPerfil, $AmPerfil, $FechaPerfil, $EmailPerfil, $TelefonoPerfil, $ruta);
										echo $rspta ? "Usuario Actualizado" : "Usuario no se pudo Actualizar";
									} else {
										echo "Algo Salió Mal";
									}
								} else {
									echo $rspta = "El archivo es demasiado grande (máximo 5 MB)";
								}
							} else {
								echo $rspta = "El archivo debe ser una imagen JPG o PNG.";
							}
						} else {
							echo $rspta = "Error al Subir la Imagen";
						}
					}
				} else {
					echo $rspta = "Algún Campo Está Mal";
				}
			}
			break;
		case 'DesactivarCuenta':
			$rspta = $categoria->ChangeStatus($idDesactivarCuenta, 0);
			echo $rspta ? "Cuenta Desactivada" : "Algo falló al desactivar la Cuenta";
			break;
		case 'ActivarCuenta':
			$rspta = $categoria->ChangeStatus($idDesactivarCuenta, 1);
			echo $rspta ? "Cuenta Activada" : "Algo falló al desactivar la Cuenta";
			break;

	}

}
if ($_SERVER["REQUEST_METHOD"] === "GET") {
	switch ($_GET["op"]) {
		//Listado de Residente
		case 'ListarResidente':

			$rspta = $categoria->ListResidente();
			//Vamos a declarar un array
			$data = array();

			while ($reg = $rspta->fetch_object()) {
				$data[] = array(
					"0" => ($reg->FotoPerfil) ? '<img src="' . $reg->FotoPerfil . '"class="img-circle img-panel-short" alt="User Image">' : '<span class="label bg-red">Error al Cargar la imagen</span>',
					"1" => ($reg->Nombre),
					"2" => ($reg->User),
					"3" => ($reg->Manzana),
					"4" => ($reg->Lote),
					"5" => ($reg->Numero),
					"6" => ($reg->MarcaAuto),
					"7" => ($reg->ModeloAuto),
					"8" => (decryptData($reg->PlacaAuto)),
					"9" => ($reg->status) ? '<span class="label bg-green">Activo</span>' :
						'<span class="label bg-red">Inactivo</span>',
					"10" => ($reg->status) ? '
    <button class="btn btn-warning" data-toggle="modal" data-target="#updateResidente" onclick="chargeDatos( \'' . encryptData($reg->IdResidente) . '\')">
        <i class="fa fa-pencil"></i>
    </button>
    <button class="btn btn-danger" onclick="ChangeStatus( \'' . encryptData($reg->IdResidente) . '\')">
        <i class="fa fa-trash"></i>
    </button>' :
						' <button class="btn btn-primary" onclick="ChangeStatusActive(\'' . encryptData($reg->IdResidente) . '\')">
        <i class="fa fa-check"></i> Activar
    </button>'


				);
			}
			$results = array(
				"sEcho" => 1, //Información para el datatables
				"iTotalRecords" => count($data), //enviamos el total registros al datatable
				"iTotalDisplayRecords" => count($data), //enviamos el total registros a visualizar
				"aaData" => $data
			);
			echo json_encode($results);
			break;
	}
}
?>