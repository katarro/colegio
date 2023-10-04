<?php
    include 'configuracion.php'; 

    // Consulta para obtener los apoderados
    $sql_apoderados = "SELECT * FROM apoderados";
    $result_apoderados = $conn->query($sql_apoderados);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registro Alumno</title>
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
    .input-div select.input {
    border: none;
    background: none;
    outline: none;
    padding: 0.5rem 1rem;
    font-size: 1.1rem;
    color: #333;
    margin-top: 9px;
    width: 100%;
    box-shadow: none;
    border-radius: 0;
    -webkit-appearance: none; /* Para quitar el estilo predeterminado en Safari */
    -moz-appearance: none;    /* Para quitar el estilo predeterminado en Firefox */
    appearance: none;         /* Para quitar el estilo predeterminado en otros navegadores */
}

.input-div .h5 {
    position: absolute;
    top: 10px;
    left: 10px;
    font-size: 12px;
    color: #999;
    transition: none;
}

.input-div .div select {
    padding-top: 20px; /* Ajusta este valor según tus necesidades */
}
</style>

<body>
    <img class="wave" src="img/wave.png">
    <div class="container">
        <div class="img">
            <img src="img/bg.svg">
        </div>
        <div class="login-content">
            <form action="proceso_registro.php" method="post" id="registrationForm">

                <img src="img/avatar.svg">
                <h2 class="title">Registro Alumno</h2>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Rut</h5>
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
                <div class="input-div">
                    <div class="i">
                        <i class="fas fa-calendar"></i>
                    </div>
                    <div class="div">
                        <!-- <h5>Fecha de Nacimiento</h5> -->
                        <input type="date" class="input" name="fecha_nacimiento" required>
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
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                    </div>
                    <div class="div">
                        <h5>Correo</h5>
                        <input type="email" class="input" name="correo" required>
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
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div class="div">
                        <h5 class="h5">Apoderado</h5>
                        <select class="input" name="rut_apoderado" required>
                            <?php
                            while ($row_apoderado = $result_apoderados->fetch_assoc()) {
                                echo "<option value='" . $row_apoderado['rut'] . "'>" . $row_apoderado['nombre'] . " (" . $row_apoderado['rut'] . ")</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

             

                
                
                <button type="submit" class="btn" id="showRegister">Registrarse</button>
            </form>
        </div>
    </div>

    <script type="text/javascript" src="js/main.js" defer></script>
</body>

</html>
