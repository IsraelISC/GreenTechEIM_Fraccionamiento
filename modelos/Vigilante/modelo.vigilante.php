<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../../config/Conexion.php";

Class Vigilante
{
	//Implementamos nuestro constructor
	public function __construct()
	{
	}
	// Implementamos un método para cargar datos de perfil
    public function SelectUser($id)
    {
        // Preparar la llamada al procedimiento almacenado
        $stmt ="CALL SelectUser(".$id.")";
        return ejecutarConsulta($stmt);  
    }

    public function SelectVisitaByClave($id, $claveTemp)
    {
        // Preparar la llamada al procedimiento almacenado
        $stmt ="CALL SelectVisitaByClave('$id','$claveTemp')";
        return ejecutarConsulta($stmt);  
    }

    public function EntradaVisitante($idClave, $claveTemp, $idVigilante_Ingreso)
    {
        // Preparar la llamada al procedimiento almacenado
        $stmt ="CALL EntradaVisitante('$idClave','$claveTemp','$idVigilante_Ingreso')";
        return ejecutarConsulta($stmt); 
    }

    public function SalidaVisitante($idClave, $claveTemp, $idVigilante_Salida)
    {
        // Preparar la llamada al procedimiento almacenado
        $stmt ="CALL SalidaVisitante('$idClave','$claveTemp','$idVigilante_Salida')";
        return ejecutarConsulta($stmt); 
    }

    public function ExpiraRegistroVisitante($idClave)
    {
        // Preparar la llamada al procedimiento almacenado
        $stmt ="CALL ExpiraRegistroVisitante($idClave)";
        return ejecutarConsulta($stmt); 
    }
    
}

?>