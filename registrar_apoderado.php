<?php
include 'configuracion.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Recopilar los datos del formulario
        $rut = $_POST['rut'];
        $clave = $_POST['contraseña'];
        $nombre = $_POST['nombre'];
        $direccion = $_POST['direccion'];
        $celular = $_POST['celular'];
        $correo = $_POST['correo'];

        // Consulta SQL para verificar si el RUT ya existe en la tabla de apoderados
        $checkRutSql = "SELECT * FROM apoderados WHERE rut = '$rut'";
        $result = $conn->query($checkRutSql);

        if ($result->num_rows > 0) {
            // El RUT ya existe en la base de datos
            echo "<script>alert('El RUT ya está registrado.');</script>";
        } else {
            // Consulta SQL para insertar nuevos registros en la tabla de apoderados
            $sql = "INSERT INTO apoderados (rut, clave, nombre, direccion, celular, correo)
            VALUES ('$rut', '$clave', '$nombre', '$direccion', '$celular', '$correo')";

            // Ejecutar la consulta
            if ($conn->query($sql) === TRUE) {
                echo "Nuevo registro creado exitosamente";
                sleep(2);
                header("Location: index.php");  // Redirigir al inicio de sesión
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
<!DOCTYPE html>
<html>

<head>
    <title>Registro apoderados</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<style>
    .container {
        overflow-y: auto;
        padding-top: 20px;
    }
</style>
<body>
    <img class="wave" src="img/wave.png">
    <div class="container">
        <div class="img">
        
        <img src="img/bg.svg">

        </div>
        
        <div class="login-content">
            
            <form action="procesar_registro_apoderado.php" method="post" id="registrationForm">
            <img src="img/avatar.svg">
                <div>
                    <h2 class="title">Registro Apoderados</h2>
                </div>    


                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-id-card"></i>
                    </div>
                    <div class="div">
                        <h5>RUT</h5>
                        <input type="text" class="input" id="rutInput" name="rut" required>
                    </div>
                </div>


                
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Contraseña</h5>
                        <input type="password" class="input" name="clave" required>
                    </div>
                </div>
                <div class="input-div">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Nombre</h5>
                        <input type="text" class="input" name="nombre" required>
                    </div>
                </div>
                <div class="input-div">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Apellido Paterno</h5>
                        <input type="text" class="input" name="apellido_paterno" required>
                    </div>
                </div>
                <div class="input-div">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Apellido Materno</h5>
                        <input type="text" class="input" name="apellido_materno" required>
                    </div>
                </div>
                <div class="input-div one">
                    <div class="i">
                        <i class="fa fa-home" aria-hidden="true"></i>
                    </div>
                    <div class="div">
                        <h5>Dirección</h5>
                        <input type="text" class="input" name="direccion" required>
                    </div>
                </div>
                <div class="input-div one">
                    <div class="i">
                        <i class="fa fa-phone-square" aria-hidden="true"></i>
                    </div>
                    <div class="div">
                        <h5>Celular</h5>
                        <input type="tel" class="input" name="celular" required>
                    </div>
                </div>
                <div class="input-div one">
                    <div class="i">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                    </div>
                    <div class="div">
                        <h5>Correo</h5>
                        <input type="email" class="input" name="correo" required>
                    </div>
                </div>

                <button type="submit" class="btn" id="showRegister">Registrarse</button>
            </form>
        </div>
    </div>

    <script type="text/javascript" src="js/main.js" defer></script>
</body>

</html>
