<html>
<head>
	<title>Add Data</title>
</head>

<body>
<?php
// Include the database connection file
require_once("dbConnection.php");

if (isset($_POST['form-submit'])) {
	// Escape special characters in string for use in SQL statement	
	$nombre = mysqli_real_escape_string($mysqli, $_POST['nombre']);
	$apellido = mysqli_real_escape_string($mysqli, $_POST['apellido']);
	$nombreusuario = mysqli_real_escape_string($mysqli, $_POST['nombreusuario']);
    $correo = mysqli_real_escape_string($mysqli, $_POST['correo']);
    $telefono = mysqli_real_escape_string($mysqli, $_POST['telefono']);
    $contraseña = mysqli_real_escape_string($mysqli, $_POST['contraseña']);
		
	// Check for empty fields
	if (empty($nombre) || empty($apellido) || empty($nombreusuario) || empty($correo) || empty($telefono) || empty($contraseña)) {
		if (empty($nombre)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}
		
		if (empty($apellido)) {
			echo "<font color='red'>Age field is empty.</font><br/>";
		}
		
		if (empty($nombreusuario)) {
			echo "<font color='red'>Email field is empty.</font><br/>";
		}
        if (empty($correo)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}
		
		if (empty($telefono)) {
			echo "<font color='red'>Age field is empty.</font><br/>";
		}
		
		if (empty($contraseña)) {
			echo "<font color='red'>Email field is empty.</font><br/>";
		}
		
		// Show link to the previous page
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else { 
		// If all the fields are filled (not empty) 

		// Insert data into database
		$result = mysqli_query($mysqli, "INSERT INTO usuario (`nombre`, `apellido`, `nombreusuario`, `correo`, `telefono`, , `contraseña`) VALUES ('$nombre', '$apellido', '$nombreusuario', '$correo', '$telefono', '$contraseña')");
		
		// Display success message
		echo "<p><font color='green'>Data added successfully!</p>";
		echo "<a href='index.php'>View Result</a>";
	}
}
?>
</body>
</html>