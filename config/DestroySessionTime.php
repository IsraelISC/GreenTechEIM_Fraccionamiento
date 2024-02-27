<?php
// Establecer tiempo de vida de la sesión en segundos
$inactividad = 1600;

if (isset($_SESSION["timeout"])) {
    $sessionTTL = time() - $_SESSION["timeout"];
    if ($sessionTTL > $inactividad) {
        session_destroy();
        header("Location: ../index");
        exit;
    }
}
?>