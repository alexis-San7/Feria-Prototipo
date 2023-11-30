<?php
$servername = "localhost"; 
$username = "root";
$password = "";
$database = "mibd";
$port = "3307";


// Crear conexión
$conn = new mysqli($servername, $username, $password, $database, $port);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

echo "Conexión exitosa";

// Aquí puedes realizar consultas a la base de datos o ejecutar otras operaciones

// Cerrar la conexión al finalizar
$conn->close();
?>
