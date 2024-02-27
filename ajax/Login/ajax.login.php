<?php session_start();


require_once "../../modelos/Login/modelo.login.php";

//Mandar el Mensaje
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Implementacion de la funcion
function MandarCorreo($correo, $passTemp)
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
		$mail->Username   = 'recuperarcuenta@greentecheim.com.mx';                     //SMTP username
		$mail->Password   = 'Admin@135';                               //SMTP password
		$mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
		$mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

		//Recipients
		$mail->setFrom('recuperarcuenta@greentecheim.com.mx'); //User that send the mail...
		$mail->addAddress($correo);     //Add a recipient
		//$mail->addAddress('luismiguelzamoranunez@gmail.com');               
		//$message=file_get_contents('../../vistas/Mail/mail.html');
		//$message=str_replace('{nombre}', $nombreResidente, $message);
		//$message=str_replace('{user}', $usuario, $message);
		//$message=str_replace('{password}', $password, $message);

		//Content
		$mail->isHTML(true);                                  //Set email format to HTML
		$mail->Subject = 'GreenTech EIM - Recuperación de Contraseña';

		// 		$mail->Body    = "<!DOCTYPE html> <html lang='en'> <head> <meta charset='UTF-8'> <meta name='viewport' content='width=device-width, initial-scale=1.0'> <title>MAIL</title> <style type='text/css'> @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap'); @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap'); @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap'); \*{ top: 0; margin: 0; box-sizing: border-box; } </style> </head> <body> <div style='top:0; margin:0; box-sizing:border-box;'> <section class='mail' style='position: relative; width: 100%; height: 75vh; background-color: #f6f6f6; border: 1px solid transparent; border-radius: 3px; font-family: 'Poppins', sans-serif;'> <div class='mail-header' style='position: relative; width: 100%; background-image: linear-gradient(60deg, #29323c7a 0%, #48556371 100%), url('https://i.ibb.co/X3YpQrY/bg3.jpg'); background-repeat: no-repeat; background-size: cover; object-fit: cover; border: none; outline: none; padding-top: 5px; padding-bottom: 55px; border-radius: 3px 3px 0 0;'> <img src='https://i.ibb.co/nQMLJpt/GREENTECH2.png' alt='' class='logo' style='display: block; width: 250px; margin: 10px auto; object-fit: cover;'> <div class='wave' style='position: absolute; width: 100%; top: -25px; left: 0; height: 150px; overflow: hidden;'>
		// <svg viewBox='0 0 500 150' preserveAspectRatio='none' style='height: 100%; width: 100%;'><path d='M-1.35,112.69 C320.32,165.83 277.42,89.06 501.46,120.57 L500.00,149.60 L0.00,149.60 Z' style='stroke: none; fill: #f6f6f6;'></path></svg></div>
		// </div> <div class='mail-body' style='position: relative; width: 100%; height: 70%;'> <div class='asunto-mail' style='display: block; position: relative; margin: 25px auto; width: 95%; background-image: linear-gradient(60deg, #29323c 0%, #485563 100%); text-align: center; font-size: 0.9rem; color: #fff; border-radius: 5px; padding: 2px; z-index: 20;'> <h2>ACCESO</h2> </div> <div class='cuerpo-mail' style='position: absolute; width: 93%; top: 33px; left: 3.5%; text-align: justify; padding-top: 15px; padding-bottom: 15px; padding-left: 30px; padding-right: 30px; border-radius: 0 0 10px 10px; background-color: rgba(0, 0, 0, 0.473); color: snow; z-index: 10;'> <p class='mail-text' style='font-weight: 300; padding-top: 5px;'>
		//  Solicitud para recuperación de Contraseña <br>Para poder acceder a la plataforma, te proporcionamos tu nueva contraseña para poder ingresar.</p>
		// <h3 class='mail-sub\_title' style='font-weight: 500; padding-top: 15px; border-bottom: 3px solid;'>CREDENCIALES</h3> <p class='mail-text'>
		// 	Contraseña: <strong>" . $passTemp . "</strong>
		// </p>
		// <a href='https://greentecheim.com.mx/Fraccionamiento/' class='btn-mail-link' style='display: block; margin-top: 12px; margin-bottom: 12px; width: 150px; background-image: linear-gradient(60deg, #29323c 0%, #485563 100%); color: #fff; padding: 4px 15px; outline: none; text-decoration: none; text-align: center; border-radius: 12px; border: 1px solid transparent; transition: .3s;'>INICIA SESIÓN</a>
		// </div> </div> <div class='mail-copyright' style='position: absolute; width: 100%; padding: 7px; background-image: linear-gradient(60deg, #29323c 0%, #485563 100%); color: snow; font-weight: 300; top: calc(65.6vh + 5vh); left: 0; border-radius: 3px;'> <p>Copyright&copy; 2023 - GreenTechEIM - Todos los derechos reservados</p></div> </section> <div> </body> </html>";

		$mail->CharSet = 'UTF-8';

		$mail->Body = '
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
							<h2 style="background-color: #485563; color: #f6f6f6; text-align: center; border-bottom: 3px solid #485563; border-top: 3px solid #485563;">CLAVE DE ACCESO</h2>
							<p>Solicitud para recuperación de Contraseña <br>Para poder acceder a la plataforma, te proporcionamos tu nueva contraseña para poder ingresar.</p>
							<h3 style="border-bottom: 3px solid black;">CREDENCIALES</h3>
							<p>
								Contraseña: <strong>' . $passTemp . '</strong>
							</p>
							<a href="https://greentecheim.com.mx/Fraccionamiento/" style="display: block; margin: 12px auto; width: 150px; background: linear-gradient(60deg, #29323c 0%, #485563 100%); color: #fff !important; padding: 4px 15px; text-decoration: none; text-align: center; border-radius: 12px;">ACCEDER</a>
						</td>
					</tr>
					<tr>
						<td style="background: linear-gradient(60deg, #29323c 0%, #485563 100%); color: snow; font-weight: 300; padding: 7px; text-align: center;">
							<p>Copyright&copy; 2023 - GreenTechEIM - Todos los derechos reservados</p>
						</td>
					</tr>
				</table>
			</body>
			
			</html>';

		$mail->send();
	} catch (Exception $e) {

		echo "<script>alert('Error al enviar, revisar sus datos y volver a intentar...');
    window.location.href = 'form.php';
    </script>";
		echo "Error: {$mail->ErrorInfo}";
	}
}



//Declaracion de Funciones
function generarClaveTemporal($longitud = 10)
{
	// Caracteres permitidos en la clave temporal
	$caracteresPermitidos = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

	// Obtener la longitud de la cadena de caracteres permitidos
	$longitudCaracteres = strlen($caracteresPermitidos);

	// Inicializar la clave temporal como una cadena vacía
	$claveTemporal = '';

	// Generar la clave temporal aleatoria
	for ($i = 0; $i < $longitud; $i++) {
		// Obtener un carácter aleatorio de la cadena de caracteres permitidos
		$claveTemporal .= $caracteresPermitidos[rand(0, $longitudCaracteres - 1)];
	}

	return $claveTemporal;
}



//Ejecución del codigo
$categoria = new Login();
$cat2 = new Login();
$username = isset($_POST["username"]) ? limpiarCadena($_POST["username"]) : "";
$pswd = isset($_POST["pswd"]) ? $_POST["pswd"] : "";


//Recuperar Contraseña
$email = isset($_POST["email"]) ? limpiarCadena($_POST["email"]) : "";

switch ($_GET["op"]) {
	case 'validarUser':

		$pswd = hash("sha512", $pswd);
		$rspta = $categoria->ValidarUser($username, $pswd);
		//Vamos a declarar un array
		$data = array();
		$id = 0;
		$nombre = "";
		$cargo = "";
		$foto = "";
		while ($reg = $rspta->fetch_object()) {
			$id = $reg->IdUsuario;
			$nombre = $reg->Nombre;
			$cargo = $reg->Cargo;
			$foto = $reg->Foto;
		}
		if ($nombre == "") {
			$rspta = "Datos No Coinciden";
			echo $rspta;
		} else {
			$_SESSION['IdUsuario'] = $id;
			$_SESSION['NombreUsuario'] = $nombre;
			$_SESSION['Cargo'] = $cargo;
			$_SESSION['Foto'] = $foto;
			$rspta = "Correcto";
			//echo $_SESSION['NombreUsuario'];
			echo $rspta;
		}



		break;

	case 'ResetPassword':
		$idUser = 0;
		if (empty($email) || empty($username)) {
			echo "Campo Vacío";
		} else {

			$claveTemporalGenerada = generarClaveTemporal(12);
			$pswdTempHash = hash("sha512", $claveTemporalGenerada);
			$rspta = $categoria->ResetPassword(
				$username,
				$email,
				$pswdTempHash
			);
			while ($reg = $rspta->fetch_object()) {
				$mensaje = $reg->mensaje;
			}
			if ($mensaje == "Correcto") {

				MandarCorreo($email, $claveTemporalGenerada);
			}
			echo $mensaje;
		}

		break;
}
