<?php
// home.php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['rut'])) {
    header("Location: index.php");
    exit();
}

include 'configuracion.php';

$rut = $_SESSION['rut'];

$sql = "SELECT * FROM estudiantes WHERE rut = '$rut'";
$result = $conn->query($sql);

$sql_materias = "SELECT * FROM materias WHERE rut_estudiante = '$rut'";
$result_materias = $conn->query($sql_materias);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<script>
    document.getElementById('toggleTable').addEventListener('click', function() {
        var table = document.getElementById('apoderadoTable');
        if (table.style.display === "none" || table.style.display === "") {
            table.style.display = "table";
        } else {
            table.style.display = "none";
        }
    });
</script>

<div class="container mt-5">
    <?php
    if ($result->num_rows > 0) {$row = $result->fetch_assoc();?>

    <div class="d-flex justify-content-between">

        <h1>Hola estudiante <?php echo $row['nombre'] . " " . $row['apellido_paterno'] . " " . $row['apellido_materno']; ?> </h1>
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
                <td><a href="editar.php?campo=rut" class="btn btn-primary">Editar</a></td>
            </tr>
            <tr>
                <td>Nombre</td>
                <td><?php echo $row['nombre']; ?></td>
                <td><a href="editar.php?campo=nombre" class="btn btn-primary">Editar</a></td>
            </tr>
            <tr>
                <td>Apellido Paterno</td>
                <td><?php echo $row['apellido_paterno']; ?></td>
                <td><a href="editar.php?campo=apellido_paterno" class="btn btn-primary">Editar</a></td>
            </tr>
            <tr>
                <td>Apellido Materno</td>
                <td><?php echo $row['apellido_materno']; ?></td>
                <td><a href="editar.php?campo=apellido_materno" class="btn btn-primary">Editar</a></td>
            </tr>
            <tr>
                <td>Dirección</td>
                <td><?php echo $row['direccion']; ?></td>
                <td><a href="editar.php?campo=direccion" class="btn btn-primary">Editar</a></td>
            </tr>
            <tr>
                <td>Celular</td>
                <td><?php echo $row['celular']; ?></td>
                <td><a href="editar.php?campo=celular" class="btn btn-primary">Editar</a></td>
            </tr>
            <tr>
                <td>Correo</td>
                <td><?php echo $row['correo']; ?></td>
                <td><a href="editar.php?campo=correo" class="btn btn-primary">Editar</a></td>
            </tr>
            <tr>
                <td>Nombre Apoderado</td>
                <td><?php echo $row['rut_apoderado']; ?></td>
                <td><a href="editar.php?campo=rut_apoderado" class="btn btn-primary">Editar</a></td>
            </tr>
            <tr>
                <td>Fecha de Nacimiento</td>
                <td><?php echo $row['fecha_nacimiento']; ?></td>
                <td><a href="editar.php?campo=fecha_nacimiento" class="btn btn-primary">Editar</a></td>
            </tr>
        </tbody>
    </table>
    <?php
    } else {
        echo "<p>No se encontraron datos del usuario.</p>";
    }

    $conn->close();
    ?>

<div class="container mt-5">
    <h2>Materias y Notas</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Materia</th>
                <th>Nota 1</th>
                <th>Nota 2</th>
                <th>Nota 3</th>
                <th>Promedio</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $suma_promedios = 0;
            $contador_materias = 0;
            while($row_materia = $result_materias->fetch_assoc()) {
                $suma_promedios += $row_materia['promedio'];
                $contador_materias++;
                echo "<tr>";
                echo "<td>" . $row_materia['nombre_materia'] . "</td>";
                echo "<td>" . $row_materia['nota1'] . "</td>";
                echo "<td>" . $row_materia['nota2'] . "</td>";
                echo "<td>" . $row_materia['nota3'] . "</td>";
                echo "<td>" . $row_materia['promedio'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <?php
    if ($contador_materias > 0) {
        $promedio_general = $suma_promedios / $contador_materias;
        echo "<h4>Promedio General: " . number_format($promedio_general, 0) . "</h4>";
    }
    ?>
    <br>
    <br><br><br>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
