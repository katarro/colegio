<?php
// cerrar_sesion.php
session_start();  // Iniciar una nueva sesión o reanudar la existente

if (isset($_POST['logout'])) {
    // Eliminar todas las variables de sesión
    $_SESSION = array();

    // Destruir la sesión
    session_destroy();

    // Redirigir al usuario a la página de inicio de sesión
    header("Location: index.php");
}
?>
