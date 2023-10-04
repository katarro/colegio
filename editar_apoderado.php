<?php
// editar_apoderado.php
session_start();

// Verificar si el apoderado ha iniciado sesión
if (!isset($_SESSION['rut'])) {
    header("Location: index_apoderado.php");  // Redirigir al inicio de sesión si el apoderado no ha iniciado sesión
    exit();
}

include 'configuracion.php'; 

// Obtener el RUT del apoderado desde la sesión
$rut = $_SESSION['rut'];

// Obtener el campo a editar desde la URL
$campo = $_GET['campo'];

// Consulta SQL para obtener el valor actual del campo
$sql = "SELECT $campo FROM apoderados WHERE rut = '$rut'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$valorActual = $row[$campo];

// Comprobar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nuevoValor = $_POST['nuevoValor'];

    // Actualizar el campo en la base de datos
    $sql = "UPDATE apoderados SET $campo = '$nuevoValor' WHERE rut = '$rut'";
    if ($conn->query($sql) === TRUE) {
        echo "Registro actualizado exitosamente";
        sleep(1);
        header("Location: home_apoderados.php");  // Redirigir al panel de control de apoderados después de la actualización
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Apoderado</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1>Editar <?php echo ucfirst($campo); ?></h1>
    <form action="" method="post">
        <div class="form-group">
            <label for="nuevoValor">Nuevo valor:</label>
            <input type="text" class="form-control" id="nuevoValor" name="nuevoValor" value="<?php echo $valorActual; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>

</body>
</html>
