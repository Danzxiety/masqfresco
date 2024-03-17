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
    $id_producto = $_POST['id'];
  
  
    // Preparar la consulta SQL para obtener los datos del checkout
    $stmt = $conn->prepare("SELECT * FROM productos WHERE id_producto = ?");
    $stmt->bind_param("i", $id_producto);
    $stmt->execute();
    $result = $stmt->get_result();
  
    // Comprobar si se encontró un registro
    if ($result->num_rows > 0) {
      
      // Obtener los datos del registro
      $row = $result->fetch_assoc();
      
      
       // Recupera la primera foto del producto
       $foto_url = "";
       $sql = "SELECT * FROM fotos_productos WHERE id_producto = " . $row["id_producto"] . " LIMIT 1";
       $fotos_result = $conn->query($sql);
       if ($fotos_result->num_rows > 0) {
           $foto_row = $fotos_result->fetch_assoc();
           $foto_url = $foto_row["foto_url"];
       }

       
      ?>






<div class="row">

 
<div class="col-lg-4 col-md-6 col-12 px-1 mb-4">
            <div class="card shadow-lg rounded-3 product-card">
              <div class="product-card-actions d-flex align-items-center">
                
                <?php
                echo '    </div><a class="card-img-top d-block overflow-hidden"><img src="' . htmlspecialchars($foto_url) . '" alt="Product"></a>' 
                ?>
              <div class="card-body py-2"><a class="product-meta d-block fs-xs pb-1" href="details?id=<?php echo $row["id_producto"]; ?>"><?php echo $row["categoria"]; ?> <span style="float: right;">Stock: <?php echo $row["stock"]; ?></span></a>
                <h3 class="product-title fs-sm"><a id="myProduct" href="details?id=<?php echo $row["id_producto"]; ?>"><?php echo $row["nombre"]; ?></a></h3>
                <div class="d-flex justify-content-between">
                  <div class="product-price"><span class="text-accent">$<span><?php echo $row["precio"]; ?></span></span>
                  </div>
                  <?php
                  echo '        <div class="star-rating">';
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $rating) {
                echo '<i class="star-rating-icon ci-star-filled active"></i>';
            } else {
                echo '<i class="star-rating-icon ci-star-filled"></i>';
            }
        }?>
                  </div>
                </div>
              </div>
              <div class="card-body">

    
              </div>
            </div>
            <hr class="d-sm-none">
          </div>



          <div class="col-lg-8 col-md-6 col-12">


          <h5 class="mt-1">Editar datos del producto:</h5>

          <form action="funtions" method="post" enctype="multipart/form-data">
          <input type="hidden" name="form_name" value="form_editprod">
          <input type="hidden" name="id_producto" value="<?php echo $row["id_producto"]; ?>">



          <label class="mt-4" for="img">Cambiar imagen del producto</label>
          <input class="form-control mb-3" type="file" name="img" id="">



          <input class="form-control mb-3" type="text" name="nombre" id="" value="<?php echo $row["nombre"]; ?>" placeholder="Nombre del producto">

          <textarea class="form-control mb-3" name="descripcion" id="" cols="30" rows="3"><?php echo $row["descripcion"]; ?></textarea>

          <div class="row">
            <div class="col-6">
            <input class="form-control mb-3" type="text" name="precio" id="" value="<?php echo $row["precio"]; ?>" placeholder="Precio">
            </div>
            <div class="col-6">
            <input class="form-control mb-3" type="number" name="stock" id="" value="<?php echo $row["stock"]; ?>" placeholder="Stock">
            </div>
          </div>

          <button class="btn btn-primary w-100" type="submit">Actualizar</button>

          </form>
          </div>

          </div>






         
      <?php
    } else {
      // No se encontró un registro con el id especificado
      echo "<p>No se encontró un registro con el id especificado.</p>";
    }
  
    // Cerrar la conexión a la base de datos
    $conn->close();
  }
  
?>
