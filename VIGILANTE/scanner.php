<?php 
	session_start();
	require_once('../config/DestroySessionTime.php');
	//error_reporting(0);
	//$_SESSION['alerta']="";
	if(isset($_SESSION['IdUsuario']) && isset($_SESSION['NombreUsuario'])){
		if($_SESSION['Cargo']=="ADMINISTRADOR" || $_SESSION['Cargo']=="VIGILANTE"){
			require '../vistas/VIGILANTE/view.qr_reader.php';		
		}else{
			require '../vistas/EIM/view.eim.php';
		}
	}
	else{
		require '../vistas/Login/view.login.php';
	}
 	
 ?>