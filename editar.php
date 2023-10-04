<?php
session_start();
include 'configuracion.php';

// Comprobar si el usuario está logueado
if (!isset($_SESSION['rut'])) {
    header("Location: index.html");
    exit();
}

// Obtener el campo a editar desde la URL
$campo = $_GET['campo'];

// Obtener el valor actual del campo
$sql = "SELECT $campo FROM estudiantes WHERE rut = '" . $_SESSION['rut'] . "'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$valorActual = $row[$campo];

// Comprobar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nuevoValor = $_POST['nuevoValor'];

    // Actualizar el campo en la base de datos
    $sql = "UPDATE estudiantes SET $campo = '$nuevoValor' WHERE rut = '" . $_SESSION['rut'] . "'";
    if ($conn->query($sql) === TRUE) {
        echo "Registro actualizado exitosamente";
        sleep(1);
        header("Location: home.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar</title>
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
