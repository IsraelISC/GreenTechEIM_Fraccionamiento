<?php session_start();
require_once "../../modelos/Datos/modelo.perfil.php";
$categoria = new Perfil();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	//Validacion de Campos
	$nombrePerfil = isset($_POST["nombrePerfil"]) ? limpiarCadena($_POST["nombrePerfil"]) : "";
	$ApPerfil = isset($_POST["ApPerfil"]) ? limpiarCadena($_POST["ApPerfil"]) : "";
	$AmPerfil = isset($_POST["AmPerfil"]) ? limpiarCadena($_POST["AmPerfil"]) : "";
	$FechaPerfil = isset($_POST["FechaPerfil"]) ? limpiarCadena($_POST["FechaPerfil"]) : "";
	$EmailPerfil = isset($_POST["EmailPerfil"]) ? limpiarCadena($_POST["EmailPerfil"]) : "";
	$TelefonoPerfil = isset($_POST["TelefonoPerfil"]) ? limpiarCadena($_POST["TelefonoPerfil"]) : "";



	//Cambiar Password
	$passwordOld = isset($_POST["passwordOld"]) ? limpiarCadena($_POST["passwordOld"]) : "";
	$passwordNew = isset($_POST["passwordNew"]) ? limpiarCadena($_POST["passwordNew"]) : "";


	$archivo = isset($_FILES["FotoPerfil"]) ? $_FILES["FotoPerfil"] : "";


	//Recibir Temp de la Imagen QR 
	$imagenBase64 = isset($_POST['imagenBase64']) ? limpiarCadena($_POST['imagenBase64']) : "";
	//Eliminar la Imagen
	$qr = isset($_POST['qr']) ? limpiarCadena($_POST['qr']) : "";
	$qr = decryptData($qr);
	switch ($_GET["op"]) {
		case 'DatosPerfil':
			$rspta = $categoria->DatosPerfil($_SESSION['IdUsuario']);
			//Vamos a declarar un array
			$data = array();
			while ($reg = $rspta->fetch_object()) {
				$data[] = array(
					"0" => ($reg->Foto),
					"1" => ($reg->Nombre),
					"2" => ($reg->Ap),
					"3" => ($reg->Am),
					"4" => ($reg->FechaNacimiento),
					"5" => ($reg->Mail),
					"6" => ($reg->Telefono)
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
		case 'EditPerfil':
			//pasarlo a mayuscular
			$nombrePerfil = strtoupper($nombrePerfil);
			$ApPerfil = strtoupper($ApPerfil);
			$AmPerfil = strtoupper($AmPerfil);
			//limpiar espacios en blanco
			$nombrePerfil = trim($nombrePerfil, " ");
			$ApPerfil = trim($ApPerfil, " ");
			$AmPerfil = trim($AmPerfil, " ");
			//$FechaPerfil=trim($FechaPerfil," ");
			$EmailPerfil = trim($EmailPerfil, " ");
			$TelefonoPerfil = trim($TelefonoPerfil, " ");

			if (empty($nombrePerfil) || empty($ApPerfil) || empty($AmPerfil) || empty($FechaPerfil) || empty($EmailPerfil) || empty($TelefonoPerfil))
				echo $rspta = "Algún Campo Está Mal";
			else {
				if (filter_var($EmailPerfil, FILTER_VALIDATE_EMAIL)) {
					if (preg_match("/^\d{10}$/", $TelefonoPerfil)) {
						//Validar si es una fecha
						$valores = explode('-', $FechaPerfil);
						if (count($valores) == 3 && checkdate($valores[1], $valores[2], $valores[0])) {
							if (empty($archivo["name"])) {
								$ruta = $_SESSION['Foto'];
								$rspta = $categoria->UpdatePerfil($_SESSION['IdUsuario'], $nombrePerfil, $ApPerfil, $AmPerfil, $FechaPerfil, $EmailPerfil, $TelefonoPerfil, $ruta);
								echo $rspta ? "Usuario Actualizado" : "Usuario no se pudo registrar";
							} else {
								if ($archivo['size'] <= 5 * 1024 * 1024) {
									$tipo = mime_content_type($archivo['tmp_name']);
									if ($tipo == 'image/jpeg' || $tipo == 'image/png' || $tipo == 'image/PNG' || $tipo == 'image/JPEG' || $tipo == 'image/JPG' || $tipo == 'image/jpg') {
										if ($archivo['error'] === UPLOAD_ERR_OK) {
											// Mover el archivo a la ubicación deseada
											$ruta = '../files/FotoPerfil/' . $_SESSION['IdUsuario'] . ".png";
											move_uploaded_file($archivo['tmp_name'], "../" . $ruta);
											$rspta = $categoria->UpdatePerfil($_SESSION['IdUsuario'], $nombrePerfil, $ApPerfil, $AmPerfil, $FechaPerfil, $EmailPerfil, $TelefonoPerfil, $ruta);
											echo $rspta ? "Usuario Actualizado" : "Usuario no se pudo Actualizar";
										} else {
											echo $rspta = "Error al Subir la Imagen";
										}
									} else {
										echo $rspta = "El archivo debe ser una imagen JPG o PNG.";
									}
								} else {
									echo $rspta = "El archivo es demasiado grande (máximo 5 MB)";
								}
							}
						} else {
							echo $rspta = "Algún Campo Está Mal";
						}
					} else {
						echo $rspta = "Algún Campo Está Mal";
					}

				} else {
					echo $rspta = "Algún Campo Está Mal";
				}
			}
			break;
		case 'ChangePassword':
			if (empty($passwordOld) || empty($passwordNew)) {
				echo $rspta = "Campos Vacíos";
			} else {
				if ($passwordOld == $passwordNew) {
					$CantCaract = strlen($passwordOld);
					if ($CantCaract >= 8) {
						$passwordNew = hash("sha512", $passwordNew);
						$rspta = $categoria->ChangePassword($_SESSION['IdUsuario'], $passwordNew);
						echo $rspta ? "Contraseña Actualizada" : "Contraseña no se pudo Actualizar";

					} else {
						echo $rspta = "Contraseña muy corta";
					}

				} else {
					echo $rspta = "Las Contraseñas no coinciden";
				}
			}
			break;
		case 'ImagenQr':
			$imagenData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imagenBase64));
			$qrData = $_POST['data'];

			$nombreArchivo = $qrData . '.jpg'; // Cambia el nombre del archivo si lo deseas
			$carpetaDestino = '../../files/TempQr/'; // Cambia esto a la carpeta donde deseas guardar la imagen generada.

			if (file_put_contents($carpetaDestino . $nombreArchivo, $imagenData)) {
				echo 'Descargando Imagen';

			} else {
				echo 'Error al guardar la imagen generada.';
			}
			break;
	}
}
?>