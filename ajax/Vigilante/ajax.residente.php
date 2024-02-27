<?php session_start();
require_once "../../modelos/Vigilante/modelo.vigilante.php";
$categoria=new Vigilante();

if ($_SERVER["REQUEST_METHOD"] === "POST") {	
	$codigoScann=isset($_POST["codigoScann"])? limpiarCadena($_POST["codigoScann"]):"";
	
	switch ($_GET["op"]){
		case 'ConsultaUsuario':
			if(empty($codigoScann)){
				echo "Campo Vacío";
			}else{
				$rspta=$categoria->SelectUser($codigoScann);
				//Vamos a declarar un array
				if(empty($rspta)){
					echo "No se Encontraron Resultados";
				}else{

 				$data= Array(); 		
 				while ($reg=$rspta->fetch_object()){ 	
 					$data[]=array(
 						"0"=>($reg->IdResidente),
 						"1"=>($reg->FotoPerfil),
 						"2"=>($reg->Nombre),
 						"3"=>($reg->Manzana),
 						"4"=>($reg->Lote),
 						"5"=>($reg->Numero),
 						"6"=>($reg->MarcaAuto),				
 						"7"=>($reg->ModeloAuto), 				
 						"8"=>($reg->PlacaAuto) 				 				
 					);			 				 				
 				}
 				$results = array(
 				"sEcho"=>1, //Información para el datatables
 				"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 				"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 				"aaData"=>$data);
 				
 					echo json_encode($results);	
 			}
 				
			}


		break;
	}
}


?>