<?php
// home_profesores.php
session_start();

if (!isset($_SESSION['rut'])) {
    header("Location: index.php");
    exit();
}

include 'configuracion.php';

$rut = $_SESSION['rut'];

$sql = "SELECT * FROM profesores WHERE rut = '$rut'";
$result = $conn->query($sql);

// Consulta para obtener todos los estudiantes
$sql_estudiantes = "SELECT * FROM estudiantes";
$result_estudiantes = $conn->query($sql_estudiantes);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rut_estudiante = $_POST['alumno'];
    $materia = $_POST['materia'];
    $nota1 = $_POST['nota1'];
    $nota2 = $_POST['nota2'];
    $nota3 = $_POST['nota3'];

    // Calcular el promedio
    $promedio = ($nota1 + $nota2 + $nota3) / 3;

    // Consulta SQL para insertar las notas en la base de datos
    $sql = "INSERT INTO materias (rut_estudiante, nombre_materia, nota1, nota2, nota3, promedio)
            VALUES ('$rut_estudiante', '$materia', '$nota1', '$nota2', '$nota3', '$promedio')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Notas guardadas exitosamente!')</script>";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home Profesor</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div id="popup" class="popup"></div>

    <?php
    if ($result->num_rows > 0) {$row = $result->fetch_assoc();?>

    <div class="d-flex justify-content-between">

        <h1>Hola Profe <?php echo $row['nombre']; ?> </h1>
        <?php include_once "boton_cerrar_sesion.php" ?>
    </div>
    <button class="btn btn-info" data-toggle="collapse" data-target="#apoderadoTable">Información</button>
        <br>
    <table class="table table-striped collapse" id="apoderadoTable">
        <thead>
            <tr>
                <th>Propiedad</th>
                <th>Valor</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <tr>
                <td>RUT</td>
                <td><?php echo $row['rut']; ?></td>
                <td><a href="editar_profesor.php?campo=rut" class="btn btn-primary">Editar</a></td>
            </tr>
            <tr>
                <td>Nombre</td>
                <td><?php echo $row['nombre']; ?></td>
                <td><a href="editar_profesor.php?campo=nombre" class="btn btn-primary">Editar</a></td>
            </tr>
            <!-- Añade aquí las filas adicionales para los otros atributos del apoderado -->
            <!-- Por ejemplo, para el apellido paterno: -->
            <tr>
                <td>Apellido Paterno</td>
                <td><?php echo $row['apellido_paterno']; ?></td>
                <td><a href="editar_profesor.php?campo=apellido_paterno" class="btn btn-primary">Editar</a></td>
            </tr>

            <tr>
                <td>Direccion</td>
                <td><?php echo $row['direccion']; ?></td>
                <td><a href="editar_profesor.php?campo=direccion" class="btn btn-primary">Editar</a></td>
            </tr>
            <tr>
                <td>Celular</td>
                <td><?php echo $row['celular']; ?></td>
                <td><a href="editar_profesor.php?campo=celular" class="btn btn-primary">Editar</a></td>
            </tr>

            <tr>
                <td>Correo</td>
                <td><?php echo $row['correo']; ?></td>
                <td><a href="editar_profesor.php?campo=correo" class="btn btn-primary">Editar</a></td>
            </tr>
        </tbody>
    </table>
    <hr>
    <!-- Formulario para ingresar notas -->
    <h2>Ingresar Notas</h2>
    <form action="home_profesores.php" method="post">
        <div class="form-group">
            <label for="alumno">Seleccionar Alumno</label>
            <select class="form-control" id="alumno" name="alumno">
                <?php
                while($row_estudiante = $result_estudiantes->fetch_assoc()) {
                    echo "<option value='".$row_estudiante['rut']."'>".$row_estudiante['nombre']." ".$row_estudiante['apellido_paterno']."</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="materia">Materia</label>
            <select class="form-control" id="materia" name="materia">
                <option value="Matemáticas">Matemáticas</option>
                <option value="Lenguaje">Lenguaje</option>
                <option value="Historia">Historia</option>
                <option value="Ciencias">Ciencias</option>
                <option value="Inglés">Inglés</option>
                <!-- Puedes agregar más materias según lo necesites -->
                <option value="Inglés">Programacion</option>
                <option value="Inglés">Religion</option>
                <option value="Inglés">Ed. Fisica</option>
            </select>
        </div>
        <div class="form-group">
            <label for="nota1">Nota 1</label>
            <input type="number" class="form-control" id="nota1" name="nota1" step="0.1" required>
        </div>
        <div class="form-group">
            <label for="nota2">Nota 2</label>
            <input type="number" class="form-control" id="nota2" name="nota2" step="0.1" required>
        </div>
        <div class="form-group">
            <label for="nota3">Nota 3</label>
            <input type="number" class="form-control" id="nota3" name="nota3" step="0.1" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Notas</button>
        <br><br><br><br><br>
    </form>

    <?php
    } else {
        echo "<p>No se encontraron datos del profesor.</p>";
    }

    ?>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
