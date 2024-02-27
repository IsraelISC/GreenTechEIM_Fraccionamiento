<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../../config/Conexion.php";

Class Perfil
{
	//Implementamos nuestro constructor
	public function __construct()
	{
	}
	// Implementamos un método para cargar datos de perfil
    public function DatosPerfil($idUser)
    {
        // Preparar la llamada al procedimiento almacenado
        $stmt ="CALL DatosPerfil('$idUser')";   
        return ejecutarConsulta($stmt);  
    }
    // Implementamos un método para editar perfil
    public function UpdatePerfil($idUser,$nombre,$ap,$am,$fn,$correo,$tel,$foto)
    {
        // Preparar la llamada al procedimiento almacenado
        $stmt ="CALL EditPerfil('$idUser','$nombre','$ap','$am','$fn','$correo','$tel','$foto')";   
        return ejecutarConsulta($stmt);  
         
    }
    // Implementamos un método para cambiar password
    public function ChangePassword($idUser,$pass)
    {
        // Preparar la llamada al procedimiento almacenado
        $stmt ="CALL ChangePassword('$idUser','$pass')";   
        return ejecutarConsulta($stmt);  
         
    }
	
}

?>