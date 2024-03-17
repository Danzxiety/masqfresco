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
$busqueda = $_POST['busqueda'];

// Consulta SQL
$sql = "SELECT * FROM check_out 
        INNER JOIN check_out_productos 
        ON check_out.id_check_out = check_out_productos.id_check_out 
        WHERE nombre LIKE '%$busqueda%' 
        OR apellidos LIKE '%$busqueda%'
        OR id_payment LIKE '%$busqueda%'
        OR nombre_destinatario LIKE '%$busqueda%'
        OR apellido_destinatario LIKE '%$busqueda%'
        ORDER BY check_out.id_check_out DESC";


$resultado = $conn->query($sql); // Aquí estaba el error

// Crear un array para almacenar los resultados
$pedidos = array();

while($row = $resultado->fetch_assoc()) {
    $pedidos[] = $row;
}

// Devolver los resultados en formato JSON
echo json_encode($pedidos);
?>
