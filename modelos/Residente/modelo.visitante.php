<?php 

//Incluímos inicialmente la conexión a la base de datos

require "../../config/Conexion.php";



Class Visitante
{

	//Implementamos nuestro constructor
	public function __construct()
	{
	}

	// Implementamos un método insertar los datos bajo la cláusula / SP insertVisitante
    public function insertAccesoVisitante($tipoAcceso, $nombre, $ap, $am, $cant, $marca, $modelo, $IdColor, $placa, $idResidente, $claveTemp, $fest, $fingr, $fsal, $IdServicio)
    {
        // Preparar la llamada al procedimiento almacenado
        $stmt = "CALL insertAccesoVisitante('$tipoAcceso','$nombre','$ap','$am','$cant','$marca','$modelo','$IdColor','$placa','$idResidente','$claveTemp','$fest','$fingr','$fsal','$IdServicio')";
        return ejecutarConsulta($stmt);  
    }

    public function obtenerTiposAcceso() {
        $stmt = "CALL ShowTiposAcceso()";
        //$stmt = "SELECT * FROM tbl_cat_tipoacceso WHERE status = 1";
        return ejecutarConsulta($stmt);
    }

    public function obtenerTiposServicio() {
        $stmt = "CALL ShowServicio()";
        //$stmt = "SELECT * FROM tbl_cat_servicio WHERE status = 1";
        return ejecutarConsulta($stmt);
    }

    public function obtenerColores() {
        //$stmt = "CALL ShowColores()";
        $stmt = "SELECT * FROM tbl_cat_Color WHERE status = 1";
        return ejecutarConsulta($stmt);
    }

    public function ListVisitaById($id){
        $stmt = "CALL ShowAllVisitasById('$id')";
        return ejecutarConsulta($stmt);
    }

    public function ListVisitasTerminadasById($id){
        $stmt = "CALL ShowAllVisitasTerminadasById('$id')";
        return ejecutarConsulta($stmt);
    }

    public function ListVisitasVencidasById($id){
        $stmt = "CALL ShowAllVisitasVencidasById('$id')";
        return ejecutarConsulta($stmt);
    }

    public function ListAllVisitas(){
        $stmt = "CALL ShowAllVisitas()";
        return ejecutarConsulta($stmt);
    }
    
    // Implementamos un método para cargar datos de visitas por el ID de la sesión y la clave temporal
    public function SelectVisitaByClave($id, $claveTemp)
    {
        // Preparar la llamada al procedimiento almacenado
        $stmt ="CALL SelectVisitaByClave('$id','$claveTemp')";
        return ejecutarConsulta($stmt);  
    }

    public function SelectVisita($id)
    {
        // Preparar la llamada al procedimiento almacenado
        $stmt ="CALL SelectVisita('$id')";
        return ejecutarConsulta($stmt);  
    }

}

?>
