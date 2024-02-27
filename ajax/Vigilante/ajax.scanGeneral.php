<?php session_start();

date_default_timezone_set('America/Mexico_City');

require_once "../../modelos/Vigilante/modelo.vigilante.php";
$categoria = new Vigilante();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

	$codigoScann = isset($_POST["codigoScann"]) ? limpiarCadena($_POST["codigoScann"]) : "";
	$idRegistro = isset($_POST["idRegistroV"]) ? limpiarCadena($_POST["idRegistroV"]) : "";
	$codigoScann = decryptData($codigoScann);

	switch ($_GET["op"]) {

		case 'ConsultaCodigoQR':

			if (empty($codigoScann)) {
				echo json_encode(["message" => "Campo Vacío", "userType" => ""]);

			} else {
				$codeTemp = substr($codigoScann, 0, 4);

				if (is_numeric($codigoScann)) {

					//echo "RESIDENTE DETECTADO";
					$categoria = new Vigilante();
					$rspta = $categoria->SelectUser($codigoScann);

					if (empty($rspta)) {
						//echo "No se Encontraron Resultados";
						echo json_encode(["message" => "No se Encontraron Resultados", "userType" => "Residente"]);
					} else {

						$data = array();
						while ($reg = $rspta->fetch_object()) {
							$data[] = array(
								"0" => ($reg->IdResidente),
								"1" => ($reg->FotoPerfil),
								"2" => ($reg->Nombre),
								"3" => ($reg->Manzana),
								"4" => ($reg->Lote),
								"5" => ($reg->Numero),
								"6" => ($reg->MarcaAuto),
								"7" => ($reg->ModeloAuto),
								"8" => (decryptData($reg->PlacaAuto))
							);
						}
						$results = array(
							"sEcho" => 1, //Información para el datatables
							"iTotalRecords" => count($data), //enviamos el total registros al datatable
							"iTotalDisplayRecords" => count($data), //enviamos el total registros a visualizar
							"aaData" => $data
						);

						if (empty($data)) {
							$info = "No se encontraron resultados";
							//echo $info;
							echo json_encode(["message" => $info, "userType" => "Residente"]);
						} else {
							//echo json_encode($results);
							echo json_encode(["results" => $results, "userType" => "Residente"]);
						}
					}
				} else if ($codeTemp == "TEMP") {
					//echo "VISITANTE DETECTADO";

					$categoria = new Vigilante();
					$idSession = $_SESSION['IdUsuario'];

					$claveSelected = $codigoScann;

					$rspta = $categoria->SelectVisitaByClave($idSession, $claveSelected);

					//Vamos a declarar un array
					if (empty($rspta)) {
						//echo json_encode(["message" => "ERROR SQL"]);
						echo json_encode(["message" => "No se encontraron resultados", "userType" => "Visita"]);
					} else {
						$data = array();
						while ($reg = $rspta->fetch_object()) {
							$data[] = array(
								$reg->ID,
								$reg->Nombre_Visitante,
								$reg->Clave,
								$reg->TipoAcceso,
								$reg->Nombre_Residente,
								$reg->NumeroCasa,
								$reg->CantidadPersonas,
								$reg->MarcaAuto,
								$reg->ModeloAuto,
								$reg->ColorAuto,
								$reg->PlacaAuto,
								$reg->FechaEstimada,
								$reg->FechaIngreso,
								$reg->FechaSalida,
								$reg->Servicio,
								$reg->StatusRegistro,
								$reg->StatusVisita
							);
						}

						$results = array(
							"sEcho" => 1, //Información para el datatables
							"iTotalRecords" => count($data), //enviamos el total registros al datatable
							"iTotalDisplayRecords" => count($data), //enviamos el total registros a visualizar
							"aaData" => $data
						);

						if (empty($data)) {
							$info = "No se encontraron resultados";
							echo json_encode(["message" => $info, "userType" => "Visitante"]);

						} else {
							//echo json_encode($results);
							//echo json_encode(["results" => $results, "userType" => "Visitante"]);

							$fechaEstimada = $data[0][11];
							$fechaActual = date("Y-m-d H:i:s");
							$diaFechaActual = date("d", strtotime($fechaActual));
							$diaFechaEstimada = date("d", strtotime($fechaEstimada));

							$statusRegistro = $data[0][15];
							$statusVisita = $data[0][16];

							if ($statusRegistro == 1 && $statusVisita == 0) {
								echo json_encode(["results" => $results, "userType" => "Visitante", "message" => "Registro Entrada Detectado"]);
							} else if ($statusRegistro == 1 && $statusVisita == 1) {
								echo json_encode(["results" => $results, "userType" => "Visitante", "message" => "Registro Salida Detectado"]);
							} else {
								echo json_encode(["message" => "Código QR Expirado", "userType" => "Visitante"]);
							}

						}
					}

				} else {
					//echo "NO EXISTE QR EN EL SISTEMA";
					echo json_encode(["message" => "NO EXISTE QR EN EL SISTEMA", "userType" => ""]);
				}
			}

			break;

		case 'DeshabilitarRegistro':

			if (empty($idRegistro)) {
				echo json_encode(["message" => "Campo Vacío"]);

			} else {
				//echo json_encode(["message" => "REGISTRO DESHABILITADO"]);
				$categoria = new Vigilante();
				$rspta = $categoria->ExpiraRegistroVisitante($idRegistro);

				if (empty($rspta)) {
					//echo "No se Encontraron Resultados";
					echo json_encode(["message" => "No se Encontraron Resultados"]);
				} else {
					echo json_encode(["message" => "Código QR Expirado"]);
				}

			}

			break;

	}
}

?>