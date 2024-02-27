<?php session_start();
require_once "../../modelos/Residente/modelo.visitante.php";
$categoria=new Visitante();

if(isset($_GET['funcion']) && !empty($_GET['funcion'])) {
    $funcion = $_GET['funcion'];

    //En función del parámetro que nos llegue ejecutamos una función u otra
    switch($funcion) {
        case 'getVisitas': 
            ListarVisitas();
            break;

        case 'ListarVisitas2': 
            ListarVisitas2();
            break;
        
        case 'ListarVisitasById': 
            ListarVisitasById();
            break;

        case 'ListarVisitasTerminadasById':
            ListarVisitasTerminadasById();
            break;

        case 'ListarVisitasVencidasById':
            ListarVisitasVencidasById();
            break;
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {	

	$idSelected=isset($_POST["idSelected"])? limpiarCadena($_POST["idSelected"]):"";
    $idSelected=decryptData($idSelected);
	switch ($_GET["op"]){
		case 'ConsultaVisita':
			if(empty($idSelected)){
				echo "Campo Vacío";
			}else{
                $categoria = new Visitante();
				$rspta = $categoria -> SelectVisita($idSelected);

				//Vamos a declarar un array
				if(empty($rspta)){
					echo "No se Encontraron Resultados";
				}else{

 				//$data= Array(); 
                $data = array();

                while ($reg = $rspta->fetch_object()) {
                    $data[] = array(
                        encryptData($reg->ID),
                        $reg->Nombre_Visitante,
                        encryptData($reg->Clave),
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
                        $reg->StatusVisita,
                        $reg->StatusRegistro
                    );

                    // Verificar si la fecha estimada coincide con el día actual
                    $fechaEstimada = new DateTime($reg->FechaEstimada);
                    $fechaActual = new DateTime();
                    $fechaCoincide = $fechaEstimada->format('Y-m-d') === $fechaActual->format('Y-m-d');

                    // Añadir la información de coincidencia en la respuesta JSON
                    $data["FechaCoincide"] = $fechaCoincide;
                    
                }

                    $results = array(
                    "sEcho"=>1, //Información para el datatables
                    "iTotalRecords"=>count($data), //enviamos el total registros al datatable
                    "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
                    "aaData"=>$data);

                    /*if ($fechaCoincide) {
                        echo json_encode(["results" => $results, "message" => "Se genera QR"]);
                        
                    }else if (!$fechaCoincide) {
                        echo json_encode(["results" => $results, "message" => "No se genera QR"]);

                    }else{
                        echo json_encode(["results" => $results, "message" => "Fuera de condición"]);
                    }*/
                    
                    //echo json_encode($results);
                    echo json_encode(["results" => $results, "message" => "Se genera QR"]);
                }
 				
			}
		break;
        
	}
}

function ListarVisitas() {
    $categoria = new Visitante();
    
    // Obtener los tipos de acceso desde el modelo
    $visitas = $categoria->ListAllVisitas();

    // Convertir los resultados a un arreglo asociativo para la respuesta JSON
    $res_arr = [];
    while ($row = mysqli_fetch_assoc($visitas)) {
        $res_arr[] = $row;
    }

    // Devolver los resultados como JSON
    echo json_encode($res_arr);
}

function ListarVisitas2() {
    $categoria = new Visitante();
    $rspta = $categoria->ListAllVisitas();
    $data = array();

    while ($reg = $rspta->fetch_object()) {
        $data[] = array(
            // Definir los campos correspondientes a las columnas de la tabla
            // Por ejemplo:
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
            $reg->FechaIngreso,
            $reg->FechaSalida,
            $reg->Servicio
        );
    }

    $results = array(
        "sEcho" => 1,
        "iTotalRecords" => count($data),
        "iTotalDisplayRecords" => count($data),
        "aaData" => $data
    );
    echo json_encode($results);
}

function ListarVisitasById() {
    $categoria = new Visitante();
    $rspta = $categoria->ListVisitaById($_SESSION['IdUsuario']);
    $data = array();

    while ($reg = $rspta->fetch_object()) {
        $data[] = array(
            //$reg->ID,
            $reg->Nombre_Visitante,
            $reg->Clave,
            $reg->TipoAcceso,
            //$reg->Nombre_Residente,
            //$reg->NumeroCasa,
            $reg->CantidadPersonas,
            //$reg->MarcaAuto,
            //$reg->ModeloAuto,
            //$reg->ColorAuto,
            //$reg->PlacaAuto,
            $reg->FechaEstimada,
            $reg->FechaIngreso,
            $reg->FechaSalida,
            //$reg->Servicio,
            $reg->StatusVisita ? '<span class="label bg-green">Activo</span>' : '<span class="label bg-red">Inactivo</span>',
            $reg->StatusRegistro ? '<span class="label bg-green">Activo</span>' : '<span class="label bg-red">Inactivo</span>',
        '<button class="btn btn-warning btn-edit" data-id="'.encryptData($reg->ID).'" onclick="ShowDetailsVisita(\''.encryptData($reg->ID).'\')"><i class="fa fa-qrcode"></i></button>'        
        );
    }

    // Crear un array con los datos que DataTables espera recibir
    $response = array(
        "draw" => intval($_GET['draw']),
        "recordsTotal" => count($data), // Total de registros sin filtrar
        "recordsFiltered" => count($data), // Total de registros después de aplicar filtros
        "data" => $data // Los datos en sí
    );

    echo json_encode($response);
}

function ListarVisitasTerminadasById() {
    $categoria = new Visitante();
    $rspta = $categoria->ListVisitasTerminadasById($_SESSION['IdUsuario']);
    $data = array();

    while ($reg = $rspta->fetch_object()) {
        $data[] = array(
            $reg->Nombre_Visitante,
            $reg->TipoAcceso,
            $reg->FechaEstimada,
            $reg->FechaIngreso,
            $reg->FechaSalida,
            $reg->StatusVisita ? '<span class="label bg-red">Pendiente</span>' : '<span class="label bg-green">Finalizado</span>'
        );
    }

    // Crear un array con los datos que DataTables espera recibir
    $response = array(
        "draw" => intval($_GET['draw']),
        "recordsTotal" => count($data), // Total de registros sin filtrar
        "recordsFiltered" => count($data), // Total de registros después de aplicar filtros
        "data" => $data // Los datos en sí
    );

    echo json_encode($response);
}

function ListarVisitasVencidasById() {
    $categoria = new Visitante();
    $rspta = $categoria->ListVisitasVencidasById($_SESSION['IdUsuario']);
    $data = array();

    while ($reg = $rspta->fetch_object()) {
        $data[] = array(
            $reg->Nombre_Visitante,
            $reg->TipoAcceso,
            $reg->FechaEstimada,
            $reg->FechaIngreso,
            $reg->FechaSalida,
            $reg->StatusVisita ? '<span class="label bg-green">Pendiente</span>' : '<span class="label bg-red">Sin acceso</span>'
        );
    }

    // Crear un array con los datos que DataTables espera recibir
    $response = array(
        "draw" => intval($_GET['draw']),
        "recordsTotal" => count($data), // Total de registros sin filtrar
        "recordsFiltered" => count($data), // Total de registros después de aplicar filtros
        "data" => $data // Los datos en sí
    );

    echo json_encode($response);
}
?>

