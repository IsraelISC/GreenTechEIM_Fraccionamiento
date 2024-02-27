<?php session_start();

require_once "../../modelos/Residente/modelo.grupo.php";
$categoria = new Grupo();

function generarClaveTemporal($longitud)
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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	switch ($_GET["op"]) {
		//Select para unir personas a grupo
		case 'ConsultaResidenteAddGroup':
			$rspta = $categoria->ListResidenteAddGroup();
			$data = array();
			while ($reg = $rspta->fetch_object()) {
				$data[] = array(
					"0" => ($reg->IdResidente),
					"1" => ($reg->FotoPerfil) ? '<img src="' . $reg->FotoPerfil . '" class="img-circle img-panel-short" alt="User Image">' . '<p>' . $reg->NombreDescripcion . '</p>' : '<span class="label bg-red">Error al Cargar la imagen</span>',
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
		case 'JoinGroup':
			$codigoAcceso = limpiarCadena($_POST["codigoAcceso"]);
			if (empty($codigoAcceso)) {
				echo "Campos Vacíos";
			} else {
				if (strlen($codigoAcceso) <= 6) {
					$rspta = $categoria->JoinGroup($_SESSION['IdUsuario'], $codigoAcceso);
					$mensaje = ""; // Variable para almacenar el mensaje

					while ($reg = $rspta->fetch_object()) {
						$mensaje = $reg->Mensaje;
					}

					print_r($mensaje);
				} else {
					echo "El código tiene mas de 6 Caracteres";
				}

			}
			break;

		case 'CreateGroup':
			$nombreGrupo = FiltradoDatos($_POST["nombreGrupo"]);

			$users = isset($_POST["NombreUsers"]) ? limpiarCadena($_POST["NombreUsers"]) : "";

			if (empty($nombreGrupo) || empty($users)) {
				echo "Campos Vacíos";
			} else {
				if (is_array($users)) {
					$claveTemporal = generarClaveTemporal(6);
					//echo $claveTemporal;
					$rspta = $categoria->insertGroup($nombreGrupo, $claveTemporal, $_SESSION['IdUsuario']);

					$rspta ? "Correcto" : "No Se Pudo Crear el Grupo";

					if ($rspta == "Correcto") {

						foreach ($users as $opcion) {
							$rspta2 = $categoria->insertUserGroup($opcion);
							//echo $opcion;
						}
						echo $rspta2 ? "Correcto" : "Algo Salió Mal";
					} else {
						echo $rspta;
					}

				} else {
					echo "Algo Salió Mal";
				}
			}

			//echo $nombreGrupo.$users;
			break;
		case 'ShowGroup':
			$bandera = 0;
			$rspta = $categoria->showGroup($_SESSION['IdUsuario']);
			$data = array();
			while ($reg = $rspta->fetch_object()) {
				$data[] = array(
					"0" => ($reg->idGrupo),
					"1" => ($reg->grupo_Nombre),
					"2" => ($reg->grupo_ClaveGrupo),
					"3" => ($reg->grupo_FechaCreacion)
				);
				$bandera = $reg->idGrupo;
			}
			$results = array(
				"sEcho" => 1, //Información para el datatables
				"iTotalRecords" => count($data), //enviamos el total registros al datatable
				"iTotalDisplayRecords" => count($data), //enviamos el total registros a visualizar
				"aaData" => $data
			);
			if ($bandera == 0)
				echo "No Data";
			else
				echo json_encode($results);

			break;
		case 'InfoGroupVal':
			$GrupoVal;

			$idGrupo = FiltradoDatos($_POST["idGrupo"]);
			$rspta = $categoria->validateGroup($idGrupo);
			while ($reg = $rspta->fetch_object()) {
				$GrupoVal = $reg->idGrupo;
			}
			if (empty($GrupoVal)) {
				echo "No se Encontro Grupo";
			} else {
				$_SESSION['IdGrupo'] = $GrupoVal;
				echo "Correcto";

			}

			break;
		case 'InfoGroup':
			$rspta = $categoria->showGroupInfo($_SESSION['IdGrupo'], $_SESSION['IdUsuario']);
			$data = array();
			while ($reg = $rspta->fetch_object()) {
				$data[] = array(
					"0" => ($reg->idGrupo),
					"1" => ($reg->grupo_Nombre),
					"2" => ($reg->grupo_ClaveGrupo),
					"3" => ($reg->grupo_FechaCreacion)
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
		case 'ShowSMS':
			$rspta = $categoria->showSMSUserGroup($_SESSION['IdUsuario'], $_SESSION['IdGrupo']);
			$data = array();
			while ($reg = $rspta->fetch_object()) {
				$data[] = array(
					"0" => ($reg->id),
					"1" => ($reg->Asunto),
					"2" => (html_entity_decode($reg->Mensaje)),
					"3" => ($reg->Fecha)
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
		case 'MandarMensaje':
			$asuntoMensaje = FiltradoDatos($_POST["asuntoMensaje"]);
			$MensajeText = FiltradoDatos($_POST["MensajeText"]);
			if (empty($asuntoMensaje) || empty($MensajeText)) {
				echo "Campos Vacíos";
			} else {
				if (is_numeric($_SESSION['IdGrupo'])) {

					$rspta = $categoria->showAllUsersGroupSMS($_SESSION['IdGrupo']);
					$data = array();
					while ($reg = $rspta->fetch_object()) {
						$data[] = array(
							"0" => ($reg->idUserGrupo)
						);
					}
					$cantidadDatos = count($data);
					$rspta3 = $categoria->insertSMS($asuntoMensaje, htmlentities($MensajeText), 1);
					$rspta3 ? "Correcto" : "Usuario no se pudo registrar";


					if ($rspta3 == "Correcto") {
						for ($x = 0; $x < $cantidadDatos; $x++) {
							$rspta4 = $categoria->insertUserSMS($data[$x]["0"]);
						}
						echo $rspta4 ? "Correcto" : "Usuario no se pudo registrar";
					}

				} else {
					echo "Campos Vacíos";
				}
			}
			break;

	}
}


?>