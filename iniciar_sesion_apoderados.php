<?php
// iniciar_sesion_apoderados.php
session_start();  // Iniciar una nueva sesión o reanudar la existente
include 'configuracion.php';  // Asume que tienes un archivo de configuración para conectar a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rut = $_POST['rut'];
    $clave = $_POST['clave'];

    // Consulta SQL para verificar si el apoderado existe
    $sql = "SELECT * FROM apoderados WHERE rut = '$rut' AND clave = '$clave'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // El apoderado y la contraseña son correctos
        $apoderado = $result->fetch_assoc();

        // Guardar datos del apoderado en la sesión
        $_SESSION['rut'] = $apoderado['rut'];
        $_SESSION['nombre'] = $apoderado['nombre'];

        // Redirigir al panel de control o página principal de apoderados
        header("Location: home_apoderados.php");
        exit(); 
    } else {
        echo "<script>alert('RUT o contraseña incorrectos');</script>";
    }

    $conn->close();
}
?>
