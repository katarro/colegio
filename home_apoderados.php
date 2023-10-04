<?php
// home_apoderados.php
session_start();

if (!isset($_SESSION['rut'])) {
    header("Location: index.php");
    exit();
}

include 'configuracion.php';

$rut = $_SESSION['rut'];

$sql = "SELECT * FROM apoderados WHERE rut = '$rut'";
$result = $conn->query($sql);

// Consulta para obtener los estudiantes asociados al apoderado
$sql_estudiantes = "SELECT * FROM estudiantes WHERE rut_apoderado = '$rut'";
$result_estudiantes = $conn->query($sql_estudiantes);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home Apoderados</title>
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
        <h1>Hola apoderado <?php echo $row['nombre']; ?> </h1>
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
                <td><a href="editar_apoderado.php?campo=rut" class="btn btn-primary">Editar</a></td>
            </tr>
            <tr>
                <td>Nombre</td>
                <td><?php echo $row['nombre']; ?></td>
                <td><a href="editar_apoderado.php?campo=nombre" class="btn btn-primary">Editar</a></td>
            </tr>
            <!-- Añade aquí las filas adicionales para los otros atributos del apoderado -->
            <!-- Por ejemplo, para el apellido paterno: -->
            <tr>
                <td>Apellido Paterno</td>
                <td><?php echo $row['apellido_paterno']; ?></td>
                <td><a href="editar_apoderado.php?campo=apellido_paterno" class="btn btn-primary">Editar</a></td>
            </tr>

            <tr>
                <td>Direccion</td>
                <td><?php echo $row['direccion']; ?></td>
                <td><a href="editar_apoderado.php?campo=direccion" class="btn btn-primary">Editar</a></td>
            </tr>
            <tr>
                <td>Celular</td>
                <td><?php echo $row['celular']; ?></td>
                <td><a href="editar_apoderado.php?campo=celular" class="btn btn-primary">Editar</a></td>
            </tr>

            <tr>
                <td>Correo</td>
                <td><?php echo $row['correo']; ?></td>
                <td><a href="editar_apoderado.php?campo=correo" class="btn btn-primary">Editar</a></td>
            </tr>
            <!-- Repite el proceso para los demás campos -->
        </tbody>
    </table>
<hr><br><br>
    <!-- Mostrar notas de los estudiantes asociados al apoderado -->
    <h2 class="text-center">Notas de los estudiantes</h2>
    <br><br><br>

    <?php
    while ($row_estudiante = $result_estudiantes->fetch_assoc()) {
        echo "<h3>" . $row_estudiante['nombre'] . " " . $row_estudiante['apellido_paterno'] . "</h3>";
    
        $sql_notas = "SELECT * FROM materias WHERE rut_estudiante = '" . $row_estudiante['rut'] . "'";
        $result_notas = $conn->query($sql_notas);
    
        $suma_promedios = 0;
        $contador_materias = 0;
    
        if ($result_notas->num_rows > 0) {
            echo "<table class='table table-bordered'>";
            echo "<thead><tr><th>Materia</th><th>Nota 1</th><th>Nota 2</th><th>Nota 3</th><th>Promedio</th></tr></thead>";
            echo "<tbody>";
            while ($row_notas = $result_notas->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row_notas['nombre_materia'] . "</td>";
                echo "<td>" . $row_notas['nota1'] . "</td>";
                echo "<td>" . $row_notas['nota2'] . "</td>";
                echo "<td>" . $row_notas['nota3'] . "</td>";
                echo "<td>" . $row_notas['promedio'] . "</td>";
                echo "</tr>";
    
                $suma_promedios += $row_notas['promedio'];
                $contador_materias++;
            }
            echo "</tbody></table>";
    
            // Calculamos el promedio final del estudiante
            if ($contador_materias > 0) {
                $promedio_final = $suma_promedios / $contador_materias;
                echo "<h4>Promedio Final: " . number_format($promedio_final, 1) . "</h4><br><br>";
            }
    
        } else {
            echo "<p>No hay notas registradas para este estudiante.</p>";
        }
    }
    
    ?>

    <?php
    } else {
        echo "<p>No se encontraron datos del apoderado.</p>";
    }

    $conn->close();
    ?>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
