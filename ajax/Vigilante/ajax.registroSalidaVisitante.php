<?php session_start();
require_once "../../modelos/Vigilante/modelo.vigilante.php";
$categoria=new Vigilante();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

	switch ($_GET["op"]){

		case 'RegistroSalida':
			$idSalida = isset($_POST["IDVisitanteSalidaModal"]) ? $_POST["IDVisitanteSalidaModal"] : null;
			$idVigilante_Salida = $_SESSION['IdUsuario'];
			$claveTemp = isset($_POST["ClaveVisitanteSalidaModal"]) ? $_POST["ClaveVisitanteSalidaModal"] : null;

			if (empty($idSalida) || empty($claveTemp)) {
				echo $rspta = "Campos Vacíos";
			} else {
                //echo $rspta = $idSalida . ' ' . $claveTemp;

				$rspta = $categoria -> SalidaVisitante($idSalida, $claveTemp, $idVigilante_Salida);
				echo $rspta ? "Salida Registrada" : "Salida no se pudo registrar";
			}
		break;
		
 	break;
break;
}


}
?>