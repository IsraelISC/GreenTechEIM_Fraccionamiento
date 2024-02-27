<?php session_start();
require_once "../../modelos/Vigilante/modelo.vigilante.php";
$categoria = new Vigilante();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

	switch ($_GET["op"]){

		case 'RegistroEntrada':
			$idEntrada = isset($_POST["IDVisitanteEntradaModal"]) ? $_POST["IDVisitanteEntradaModal"] : null;
			$idVigilante_Ingreso = $_SESSION['IdUsuario'];
			$claveTemp = isset($_POST["ClaveVisitanteEntradaModal"]) ? $_POST["ClaveVisitanteEntradaModal"] : null;

			if (empty($idEntrada) || empty($claveTemp)) {
				echo $rspta = "Campos Vacíos";
			} else {
                //echo $rspta = $idEntrada . ' ' . $claveTemp;

				$rspta = $categoria -> EntradaVisitante($idEntrada, $claveTemp, $idVigilante_Ingreso);
				echo $rspta ? "Entrada Registrada" : "Entrada no se pudo registrar";
			}
		break;
		
 	break;
break;
}


}
?>