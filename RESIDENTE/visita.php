<?php 
	session_start();
	require_once('../config/DestroySessionTime.php');
	//error_reporting(0);
	//$_SESSION['alerta']="";
	if(isset($_SESSION['IdUsuario']) && isset($_SESSION['NombreUsuario'])){
		if($_SESSION['Cargo']=="ADMINISTRADOR" || $_SESSION['Cargo']=="RESIDENTE"){
			//require '../vistas/VIGILANTE/view.registroVisita.php';
			require '../vistas/RESIDENTE/view.registroVisita.php';
		}else{
			require '../vistas/EIM/view.eim.php';
		}
	}
	else{
		require '../vistas/Login/view.login.php';
	}
 	
 ?>