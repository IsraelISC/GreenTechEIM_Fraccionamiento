<?php session_start();

require_once "../../modelos/Residente/modelo.visitante.php";

$categoria=new Visitante();

if(isset($_GET['funcion']) && !empty($_GET['funcion'])) {
    $funcion = $_GET['funcion'];

    //En función del parámetro que nos llegue ejecutamos una función u otra
    switch($funcion) {
        case 'PruebadropDown': 
            PruebadropDown();
            break;
		case 'getTiposAcceso':
			getTiposAcceso();
			break;
		case 'getTiposServicio':
			getTiposServicio();
			break;
		case 'getColores':
			getColores();
			break;
    }
}

function PruebadropDown(){
    $result = [];
    $result['first_name'] = "John";
    $result['last_name'] = "Doe";

    echo json_encode($result);
}

function getTiposAcceso() {
    $categoria = new Visitante();
    
    // Obtener los tipos de acceso desde el modelo
    $tiposAcceso = $categoria->obtenerTiposAcceso();

    // Convertir los resultados a un arreglo asociativo para la respuesta JSON
    $res_arr = [];
    while ($row = mysqli_fetch_assoc($tiposAcceso)) {
        $res_arr[] = $row;
    }

    // Devolver los resultados como JSON
    echo json_encode($res_arr);
}

function getTiposServicio(){
	$categoria = new Visitante();

	$tiposServicio = $categoria->obtenerTiposServicio();

    // Convertir los resultados a un arreglo asociativo para la respuesta JSON
    $res_arr = [];
    while ($row = mysqli_fetch_assoc($tiposServicio)) {
        $res_arr[] = $row;
    }

    // Devolver los resultados como JSON
    echo json_encode($res_arr);
}

function getColores(){
	$categoria = new Visitante();

	$colores = $categoria->obtenerColores();

    // Convertir los resultados a un arreglo asociativo para la respuesta JSON
    $res_arr = [];
    while ($row = mysqli_fetch_assoc($colores)) {
        $res_arr[] = $row;
    }

    // Devolver los resultados como JSON
    echo json_encode($res_arr);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

	
    function generarClaveTemporal($nombre, $apellidoPaterno, $apellidoMaterno){
		$temp="TEMP_";
		$fechaActual = date("Ymd");
		$primerosDosPaterno = substr($apellidoPaterno, 0, 2);
		$primeraMaterno = substr($apellidoPaterno, 0, 1);
		$primeraNombre = substr($apellidoPaterno, 0, 1);

		// Generar un número aleatorio entre 1 y 100
    	$numeroAleatorio1 = rand(1, 9);
		$numeroAleatorio2 = rand(1, 9);
		$numeroAleatorio3 = rand(1, 9);

		// Generar una letra aleatoria de la A a la Z
    	$letraAleatoria = chr(rand(65, 90));

		$claveTemporal = $temp . $fechaActual . $primerosDosPaterno . $primeraMaterno . $primeraNombre . $numeroAleatorio1 . $numeroAleatorio2 . $numeroAleatorio3 . $letraAleatoria;

		return $claveTemporal;

	}

	switch ($_GET["op"]){

		case 'RegistroVisitante':

			//Validacion de Campos Personales
			$nombreVisitante=FiltradoDatos($_POST["nombreVisitante"]);
			$ApVisitante=FiltradoDatos($_POST["ApVisitante"]);
			$AmVisitante=FiltradoDatos($_POST["AmVisitante"]);
			$CantidadVisitante=FiltradoDatos($_POST["CantidadVisitante"]);
			$TipoAccesoVisitante=$_POST["TipoAcceso"];

			$MarcaAutoVisitante=FiltradoDatos($_POST["MarcaAutoVisitante"]);
			$ModeloAutoVisitante=FiltradoDatos($_POST["ModeloAutoVisitante"]);
			$ColorAutoVisitante=FiltradoDatos($_POST["ColorAutoVisitante"]);
			$PlacaAutoVisitante=FiltradoDatos($_POST["PlacaAutoVisitante"]);

			$fechaEstimada = isset($_POST["FechaEstimadaVisitante"]) ? $_POST["FechaEstimadaVisitante"] : null;
			$FechaIngresoVisitante = "0000-00-00 00:00:00";
			$FechaSalidaVisitante = "0000-00-00 00:00:00";

			$ServicioVisitante=FiltradoDatos($_POST["ServicioVisitante"]);

			if ($fechaEstimada !== null) {
				$dateEstimado = new DateTime($fechaEstimada);
				$FechaEstimadaVisitante = $dateEstimado->format('Y-m-d H:i:s');
			}

			$IdResidente = $_SESSION['IdUsuario'];
			
			if(empty($nombreVisitante) || empty($ApVisitante) || empty($AmVisitante) || empty($CantidadVisitante) || $TipoAccesoVisitante === "0" || empty($FechaEstimadaVisitante) || $ServicioVisitante === "0"){
				echo $rspta="Campos Vacíos";
				//echo $rspta . " | Fecha Ingreso: " . $FechaIngresoVisitante . " | Fecha Salida: " . $FechaSalidaVisitante;
				//echo $rspta=$nombreVisitante.' '.$ApVisitante. ' '. $AmVisitante . ' ' . $CantidadVisitante. ' '.$TipoAccesoVisitante. ' '.$AutomovilVisitante. ' '.$ModeloVisitante. ' '.$ColorAutoVisitante. ' '.$PlacaVisitante. ' '.$FechaIngresoVisitante. ' '. $FechaSalidaVisitante. ' ' ;	
			}else if($CantidadVisitante < 0){
				echo $rspta="ERROR";
			}
			else{

				if($TipoAccesoVisitante=="1"){
					//echo $rspta="DETECTADO";
					if (empty($MarcaAutoVisitante) || empty($ModeloAutoVisitante) || $ColorAutoVisitante === "0" || empty($PlacaAutoVisitante)) {
						echo $rspta="Sección Automóvil Vacía";
					}else{
						$claveTemporal = generarClaveTemporal($nombreVisitante, $ApVisitante, $AmVisitante);					
						//echo $rspta = $TipoAccesoVisitante . ' ' . $nombreVisitante . ' ' . $ApVisitante . ' ' . $AmVisitante . ' ' . $CantidadVisitante . ' ' . $MarcaAutoVisitante . ' ' . $ModeloAutoVisitante . ' ' . $ColorAutoVisitante . ' ' . $PlacaAutoVisitante . ' ' . $IdResidente . ' ' . $claveTemporal . ' ' . $FechaEstimadaVisitante . ' ' . $FechaIngresoVisitante . ' ' . $FechaSalidaVisitante . ' ' . $ServicioVisitante;
						$rspta = $categoria -> insertAccesoVisitante($TipoAccesoVisitante, $nombreVisitante, $ApVisitante, $AmVisitante, $CantidadVisitante, $MarcaAutoVisitante, $ModeloAutoVisitante, $ColorAutoVisitante, $PlacaAutoVisitante, $IdResidente, $claveTemporal, $FechaEstimadaVisitante, $FechaIngresoVisitante, $FechaSalidaVisitante, $ServicioVisitante);
						echo $rspta ? "Visita Registrada" : "Visitante no se pudo registrar";
					}
				}else if($TipoAccesoVisitante=="2"){
					//echo $rspta="Sección Peatonal Detectada";
					$MarcaAutoVisitante = "";
					$ModeloAutoVisitante = "";
					$ColorAutoVisitante = "";
					$PlacaAutoVisitante = "";

					$claveTemporal = generarClaveTemporal($nombreVisitante, $ApVisitante, $AmVisitante);

					//echo $rspta = $TipoAccesoVisitante . ' ' . $nombreVisitante . ' ' . $ApVisitante . ' ' . $AmVisitante . ' ' . $CantidadVisitante . ' ' . $MarcaAutoVisitante . ' ' . $ModeloAutoVisitante . ' ' . $ColorAutoVisitante . ' ' . $PlacaAutoVisitante . ' ' . $IdResidente . ' ' . $claveTemporal . ' ' . $FechaEstimadaVisitante . ' ' . $FechaIngresoVisitante . ' ' . $FechaSalidaVisitante . ' ' . $ServicioVisitante;
					$rspta = $categoria -> insertAccesoVisitante($TipoAccesoVisitante, $nombreVisitante, $ApVisitante, $AmVisitante, $CantidadVisitante, $MarcaAutoVisitante, $ModeloAutoVisitante, $ColorAutoVisitante, $PlacaAutoVisitante, $IdResidente, $claveTemporal, $FechaEstimadaVisitante, $FechaIngresoVisitante, $FechaSalidaVisitante, $ServicioVisitante);
					echo $rspta ? "Visita Registrada" : "Visitante no se pudo registrar";
				}		
			}
 		
	 	break;
		
 	break;
break;
}


}
?>