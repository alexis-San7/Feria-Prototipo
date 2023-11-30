<html>
<head>
	<title>Add Data</title>
</head>

<body>
<?php
// Include the database connection file
require_once("dbConnection.php");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
	// Escape special characters in string for use in SQL statement	

	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$nombreusuario = $_POST['nombreusuario'];
	$correo = $_POST['correo'];
	$telefono = $_POST['telefono'];
	$contraseña = $_POST['contraseña'];
	
	
	// Insertar datos en la base de datos
	$sql = "INSERT INTO usuario (`nombre`, `apellido`, `nombreusuario`, `correo`, `telefono`, `contraseña`) VALUES ('$nombre', '$apellido', '$nombreusuario', '$correo', '$telefono' , '$contraseña')";
	
	if ($conn->query($sql) === TRUE) {
		echo "Datos insertados correctamente";
	} else {
		echo "Error al insertar datos: " . $conn->error;
	}
	
	// Cerrar la conexión
	$conn->close();
	?>
</body>
</html>