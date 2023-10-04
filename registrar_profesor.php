<?php
include 'configuracion.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rut = $_POST['rut'];
    $clave = $_POST['clave'];
    $nombre = $_POST['nombre'];
    $apellido_paterno = $_POST['apellido_paterno'];
    $apellido_materno = $_POST['apellido_materno'];
    $direccion = $_POST['direccion'];
    $celular = $_POST['celular'];
    $correo = $_POST['correo'];

    // Consulta SQL para insertar nuevos registros en la tabla de profesores
    $sql = "INSERT INTO profesores (rut, clave, nombre, apellido_paterno, apellido_materno, direccion, celular, correo)
            VALUES ('$rut', '$clave', '$nombre', '$apellido_paterno', '$apellido_materno', '$direccion', '$celular', '$correo')";

    if ($conn->query($sql) === TRUE) {
        echo "Profesor registrado exitosamente";
        header("Location: index.php"); 

    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Registro Profesores</title>
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
            
            <form action="registrar_profesor.php" method="post" id="registrationForm">
            <img src="img/avatar.svg">
            <div>
            <h2 class="title">Registro Profesores</h2>
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
