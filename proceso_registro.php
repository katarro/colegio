<?php
include 'configuracion.php';

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Obtener los datos del formulario
        $rut = $_POST['rut'];
        $clave = $_POST['clave'];
        $nombre = $_POST['nombre'];
        $apellido_paterno = $_POST['apellido_paterno'];
        $apellido_materno = $_POST['apellido_materno'];
        $direccion = $_POST['direccion'];
        $celular = $_POST['celular'];
        $correo = $_POST['correo'];
        $rut_apoderado = $_POST['rut_apoderado'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];

        // Consulta SQL para verificar si el RUT ya existe
        $checkRutSql = "SELECT * FROM estudiantes WHERE rut = '$rut'";
        $result = $conn->query($checkRutSql);

        if ($result->num_rows > 0) {
            // El RUT ya existe en la base de datos
            echo "<script>alert('El RUT ya está registrado.');</script>";
        } else {
            // Consulta SQL para insertar los datos
            $sql = "INSERT INTO estudiantes (rut, clave, nombre, apellido_paterno, apellido_materno, direccion, celular, correo, rut_apoderado, fecha_nacimiento)
            VALUES ('$rut', '$clave', '$nombre', '$apellido_paterno', '$apellido_materno', '$direccion', '$celular', '$correo', '$rut_apoderado', '$fecha_nacimiento')";

            // Ejecutar la consulta
            if ($conn->query($sql) === TRUE) {
                echo "Nuevo registro creado exitosamente";
                sleep(2);
                header("Location: index.php");  // Redirigir al inicio de sesión si el usuario no ha iniciado sesión
            } else {
                throw new Exception("Error: " . $sql . "<br>" . $conn->error);
            }
        }
    } catch (Exception $e) {
        echo "Se produjo un error: " . $e->getMessage();
    } finally {
        // Cerrar la conexión
        $conn->close();
    }
}
?>
