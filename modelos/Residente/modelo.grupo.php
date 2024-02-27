<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../../config/Conexion.php";

Class Grupo
{
	//Implementamos nuestro constructor
	public function __construct()
	{
	}
	
	public function ListResidenteAddGroup()
    {
        // Preparar la llamada al procedimiento almacenado
        $stmt ="CALL ShowResidenteAddGrupo()";   
        return ejecutarConsulta($stmt);          
    }
    public function insertGroup($nombre,$clave,$idUser)
    {
        // Preparar la llamada al procedimiento almacenado
        $stmt ="call insertGroup('$nombre','$clave',$idUser);";   
        return ejecutarConsulta($stmt);          
    }
    public function validateGroup($idGrupo)
    {
        // Preparar la llamada al procedimiento almacenado
        $stmt ="call validateGrupo($idGrupo);";   
        return ejecutarConsulta($stmt);          
    }
    public function showGroup($idUser)
    {
        // Preparar la llamada al procedimiento almacenado
        $stmt ="call ShowGrupos($idUser);";   
        return ejecutarConsulta($stmt);          
    }
    public function showGroupInfo($idGrupo,$idUser)
    {
        // Preparar la llamada al procedimiento almacenado
        $stmt ="call ShowGrupoEspecifico($idGrupo,$idUser);";   
        return ejecutarConsulta($stmt);          
    }
    public function insertUserGroup($idUser)
    {
        // Preparar la llamada al procedimiento almacenado
        $stmt ="call insertUserGroup($idUser);";   
        return ejecutarConsulta($stmt);          
    }
    //Validar la union al grupo
    public function JoinGroup($idUser,$claveGrupo)
    {
        // Preparar la llamada al procedimiento almacenado
        $stmt ="call JoinGroup($idUser,'$claveGrupo');";   
        return ejecutarConsulta($stmt);          
    }
    

    //SMS
    public function showAllUsersGroupSMS($idGroup)
    {
        // Preparar la llamada al procedimiento almacenado
        $stmt ="call ShowAllUsersGroupForSMS($idGroup);";   
        return ejecutarConsultaUpdate($stmt);          
    }
    public function showSMSUserGroup($idUser,$idGroup)
    {
        // Preparar la llamada al procedimiento almacenado
        $stmt ="call ShowSMSGroupUser($idUser,$idGroup);";   
        return ejecutarConsulta($stmt);          
    }
    public function insertSMS($asuntoSMS,$sms,$userRegistrado)
    {
        // Preparar la llamada al procedimiento almacenado
        $stmt ="call insertSMS('$asuntoSMS','$sms',$userRegistrado);";   
        return ejecutarConsulta($stmt);          
    }
    public function insertUserSMS($idUser)
    {
        // Preparar la llamada al procedimiento almacenado
        $stmt ="call insertSMSUsers($idUser);";   
        return ejecutarConsulta($stmt);          
    }

    
}

?>