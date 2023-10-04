<!DOCTYPE html>
<html>
<head>
	<title>Ingreso</title>

	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
	<img class="wave" src="img/wave.png">
	<div class="container">
		<div class="img">
			<img src="img/bg.svg">
		</div>
		<div class="login-content">
			<form action="iniciar_sesion.php" method="post">
				<img src="img/avatar.svg">
				<h2 class="title">ingreso </h2>
				<div class="input-div one">
					<div class="i">
						<i class="fas fa-user"></i>
					</div>
					<div class="div">
						<h5>Rut</h5>
						<input type="text" class="input" name="rut" required >
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
				<input type="submit" class="btn" value="Ingresar">

				<div class="botones_registro">
				<a href="/colegio/registrar.php">
					<button type="button" class="btn-register" id="showRegister">Registrar Alumno</button>
				</a>
				<a href="/colegio/registrar_apoderado.php">
					<button type="button" class="btn-register" id="showRegister">Registrar Apoderado</button>
				</a>
				<a href="/colegio/registrar_profesor.php">
					<button type="button" class="btn-register" id="showRegister">Registrar Profesor</button>
				</a>
				</div>
			</form>
		</div>
	</div>

	<script type="text/javascript" src="js/main.js" defer></script>
</body>

</html>
