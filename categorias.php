<?php
$servername = "databases_masqfresco-db";
$username = "mysql";
$password = "b8997437ba8bc6d790b7";
$dbname = "databases";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT id_categoria, nombre_categoria, icono FROM categorias";
$result = $conn->query($sql);

$categorias = array();

if ($result->num_rows > 0) {
    // Salida de cada fila
    while($row = $result->fetch_assoc()) {
        $categorias[] = array(
            'id_categoria' => $row['id_categoria'],
            'nombre_categoria' => $row['nombre_categoria'],
            'icono' => $row['icono']
        );
    }
} else {
    echo "0 resultados";
}

header('Content-Type: application/json');
echo json_encode($categorias);

$conn->close();
?>
