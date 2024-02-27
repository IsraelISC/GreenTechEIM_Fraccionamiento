<?php 
	session_start();
	// Limpiar las variables de sesión	
	session_destroy();
	
	// Configurar cabeceras para limpiar la caché del navegador
	header('Cache-Control: no-cache, must-revalidate');
	header('Expires: ' . gmdate('D, d M Y H:i:s', time() - 3600) . ' GMT');  // Establecer Expires en una hora atrás	

	header('Location: ../index');
 ?>