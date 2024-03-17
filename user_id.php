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


// Comprobar si se envió el id en la solicitud POST
if (isset($_POST['id'])) {
    // Almacenar el id en una variable
    $id_user = $_POST['id'];
  
  
    // Preparar la consulta SQL para obtener los datos del checkout
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE id_user = ?");
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $result = $stmt->get_result();
  
    // Comprobar si se encontró un registro
    if ($result->num_rows > 0) {
      
      // Obtener los datos del registro
      $row = $result->fetch_assoc();
      ?>


<center>


<div style="width:128px; height: 128px;" class="bg-light rounded-pill shadow">
<img src="img/avatar.webp" width="120" alt="">
</div>
<h4 class="mt-4" ><?php echo $row["nombre"]; ?> <?php echo $row["apellido"]; ?></h4>
<p><?php echo $row["correo_electronico"]; ?></p>


<form action="funtions" method="post">
          <input type="hidden" name="form_name" value="form_edituser">
          <input type="hidden" name="id_user" value="<?php echo $row["id_user"]; ?>">
<select class="form-control" name="rango" id="">
    <option value="<?php echo $row["rango"]; ?>">Actual: <?php echo $row["rango"]; ?></option>
    <option value="Delivery">Personal de entregas</option>
    <option value="Miembro">Miembro</option>
</select>
<button class="btn btn-primary w-100 mt-3" type="submit">Actualizar</button>

</form>


</center>


         
      <?php
    } else {
      // No se encontró un registro con el id especificado
      echo "<p>No se encontró un registro con el id especificado.</p>";
    }
  
    // Cerrar la conexión a la base de datos
    $conn->close();
  }
  
?>
