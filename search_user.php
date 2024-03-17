<?php
session_start();
// Incluye el archivo con las constantes de la base de datos
include 'config.php';

// Crea la conexión
$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
// Verifica si la conexión es exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el término de búsqueda del formulario
$busqueda = $_POST['busqueda_user']; // Aquí estaba el error

// Consulta SQL
$sql = "SELECT * FROM usuarios 
        WHERE nombre LIKE '%$busqueda%' 
        OR apellido LIKE '%$busqueda%'";

$resultado = $conn->query($sql);

// Crear un array para almacenar los resultados
$usuarios = array();

while($row = $resultado->fetch_assoc()) {
    $usuarios[] = $row;
}

// Devolver los resultados en formato JSON
echo json_encode($usuarios);
?>
