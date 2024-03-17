<?php
// Incluye el archivo con las constantes de la base de datos
include 'config.php';

// Crea la conexión
$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Verifica si la conexión es exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
} 

if(isset($_POST["query"])) {
 $query = $_POST["query"];
 $stmt = $conn->prepare("SELECT * FROM productos WHERE nombre LIKE ?");
 $likeQuery = "%$query%";
 $stmt->bind_param('s', $likeQuery);
 $stmt->execute();
 $result = $stmt->get_result();

 while ($row = $result->fetch_assoc()) {?>
 <div class="px-3 p-2">
  <a  href="details?id=<?php echo $row["id_producto"]; ?>"><?php echo $row["nombre"]; ?></a><br></div><hr>

  <?php
 }
}
?>
