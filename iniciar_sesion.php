<?php
// iniciar_sesion.php
session_start();  
include 'configuracion.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rut = $_POST['rut'];
    $clave = $_POST['clave'];

    // Consulta SQL para verificar si el usuario existe en la tabla estudiantes
    $sql_estudiantes = "SELECT * FROM estudiantes WHERE rut = '$rut' AND clave = '$clave'";
    $result_estudiantes = $conn->query($sql_estudiantes);

    // Consulta SQL para verificar si el usuario existe en la tabla apoderados
    $sql_apoderados = "SELECT * FROM apoderados WHERE rut = '$rut' AND clave = '$clave'";
    $result_apoderados = $conn->query($sql_apoderados);

    // Consulta SQL para verificar si el usuario existe en la tabla profesores
    $sql_profesores = "SELECT * FROM profesores WHERE rut = '$rut' AND clave = '$clave'";
    $result_profesores = $conn->query($sql_profesores);

    if ($result_estudiantes->num_rows > 0) {
        // El usuario y la contraseña son correctos en la tabla estudiantes
        $_SESSION['rut'] = $rut;
        header("Location: home.php");  // Redirigir a la página principal de estudiantes
    } elseif ($result_apoderados->num_rows > 0) {
        // El usuario y la contraseña son correctos en la tabla apoderados
        $_SESSION['rut'] = $rut;
        header("Location: home_apoderados.php");  // Redirigir a la página principal de apoderados
    } elseif ($result_profesores->num_rows > 0) {
        // El usuario y la contraseña son correctos en la tabla profesores
        $_SESSION['rut'] = $rut;
        header("Location: home_profesores.php");  // Redirigir a la página principal de profesores
    } else {
        echo "<script>
            alert('RUT o contraseña incorrectos');
            window.location.href = 'index.php';            
        </script>";
    }

    $conn->close();
}
?>
