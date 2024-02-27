<?php 
require_once "global.php";
require_once "Encryp.php";
$conexion = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);

mysqli_query( $conexion, 'SET NAMES "'.DB_ENCODE.'"');

//Si tenemos un posible error en la conexión lo mostramos
if (mysqli_connect_errno())
{
	printf("Falló conexión a la base de datos: %s\n",mysqli_connect_error());
	exit();
}

function abrirConexion()
{
    global $conexion;
    
    $conexion = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

    mysqli_query($conexion, 'SET NAMES "' . DB_ENCODE . '"');

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }
}
function cerrarConexion()
{
    global $conexion;
    $conexion->close();
}

if (!function_exists('ejecutarConsulta'))
{
	function ejecutarConsulta($sql)
	{
		abrirConexion();
		global $conexion;
		$query = $conexion->query($sql);		
		cerrarConexion();
		return $query;
	}
	function ejecutarConsultaUpdate($sql)
	{
		abrirConexion();
		global $conexion;
		$query = $conexion->query($sql);		
		cerrarConexion();
		return $query;
	}

	function ejecutarConsultaSimpleFila($sql)
	{
		global $conexion;
		$query = $conexion->query($sql);		
		$row = $query->fetch_assoc();
		return $row;
	}

	function ejecutarConsulta_retornarID($sql)
	{
		global $conexion;
		$query = $conexion->query($sql);		
		return $conexion->insert_id;			
	}

	function limpiarCadena($str)
	{
    	global $conexion;

    	// Si es un array, aplicar trim a cada elemento del array
    	if (is_array($str)) {
        	return array_map('limpiarCadena', $str);
    	}

    	// Si es una cadena, aplicar trim
    	$str = mysqli_real_escape_string($conexion, trim($str));
    	return htmlspecialchars($str);
	}
	function FiltradoDatos($nombre) {
    	// Validación: Comprobar si se proporcionó un valor y limpiarlo
    	$nombreLimpio = isset($nombre) ? limpiarCadena($nombre) : "";
    	// Formateo: Convertir el nombre a mayúsculas
    	$nombreFormateado = strtoupper($nombreLimpio);

    	$nombreFormateado=trim($nombreFormateado," ");

    	// Devolver el nombre limpio y formateado
    	return $nombreFormateado;
	}
	

}
?>