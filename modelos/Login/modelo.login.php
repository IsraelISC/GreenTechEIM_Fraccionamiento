<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../../config/Conexion.php";

Class Login
{
	//Implementamos nuestro constructor
	public function __construct()
	{
	}
	// Implementamos un método para validar un usuario 
    public function ValidarUser($usuario, $password)
    {
        // Preparar la llamada al procedimiento almacenado
        $stmt ="CALL ValidateUser('$usuario', '$password');";
        
        return ejecutarConsulta($stmt);  

    }
	public function ResetPassword($username,$mail,$password)
    {
        // Preparar la llamada al procedimiento almacenado
        $stmt ="CALL ResetPassword('$username','$mail','$password')";        
        return ejecutarConsulta($stmt);  

    }
    
}

?>