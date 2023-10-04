<?php
/*
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bd_colegio";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
*/
?>

<?php
//CONFUGURACION PARA DOCKER
$servername = "db";  // Cambiamos "localhost" por "db" porque en Docker el nombre del servicio actúa como el hostname
$username = "root";
$password = "";  // La contraseña sigue estando vacía
$dbname = "bd_colegio";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
