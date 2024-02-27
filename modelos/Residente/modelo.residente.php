<?php
//Incluímos inicialmente la conexión a la base de datos
require "../../config/Conexion.php";

class Residente
{
    //Implementamos nuestro constructor
    public function __construct()
    {
    }
    // Implementamos un método para cargar datos de perfil
    public function insertResidente($email, $telefono, $tipoR, $manzana, $lote, $numero, $marca, $modelo, $placa, $nombre, $ap, $am, $fn, $usuario, $pass, $cargo)
    {
        // Preparar la llamada al procedimiento almacenado
        $stmt = "CALL insertResidente('$email','$telefono','$tipoR','$manzana','$lote','$numero','$marca','$modelo','$placa','$nombre','$ap','$am','$fn','$usuario','$pass','$cargo')";
        return ejecutarConsulta($stmt);
    }
    // Implementamos un método para editar perfil
    public function UpdatePerfil($idUser, $nombre, $ap, $am, $fn, $correo, $tel, $foto)
    {
        // Preparar la llamada al procedimiento almacenado
        $stmt = "CALL EditPerfil('$idUser','$nombre','$ap','$am','$fn','$correo','$tel','$foto')";
        return ejecutarConsulta($stmt);
    }
    public function ShowDomicilioCarro($idUser)
    {
        // Preparar la llamada al procedimiento almacenado
        $stmt = "CALL ShowDomicilioCarro($idUser)";
        return ejecutarConsulta($stmt);
    }
    public function EditDatosResidente($idUser, $manzana, $lote, $numero, $marca, $modelo, $placa)
    {
        // Preparar la llamada al procedimiento almacenado
        $stmt = "CALL EditDatosResidenteByAdmin($idUser,'$manzana','$lote','$numero','$marca','$modelo','$placa')";
        return ejecutarConsulta($stmt);
    }

    public function ListResidente()
    {
        // Preparar la llamada al procedimiento almacenado
        $stmt = "CALL ShowResidente()";
        return ejecutarConsulta($stmt);
    }
    public function ChangeStatus($id, $status)
    {
        $stmt = "CALL ChangeStatus($id,$status)";
        return ejecutarConsulta($stmt);
    }

}

?>