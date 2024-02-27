<?php
session_start();
require_once('../config/DestroySessionTime.php');
$_SESSION["timeout"] = time();
if(isset($_SESSION['IdUsuario']) && isset($_SESSION['NombreUsuario'])){
	require '../vistas/EIM/General/view.miqr.php';
}
else{
	require '../vistas/Login/view.login.php';
}
?>
