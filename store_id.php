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
    $id_check_out = $_POST['id'];
  
  
    // Preparar la consulta SQL para obtener los datos del checkout
    $stmt = $conn->prepare("SELECT * FROM check_out WHERE id_check_out = ?");
    $stmt->bind_param("i", $id_check_out);
    $stmt->execute();
    $result = $stmt->get_result();
  
    // Comprobar si se encontró un registro
    if ($result->num_rows > 0) {
      // Obtener los datos del registro
      $row = $result->fetch_assoc();?>




<div class="row">

<div class="col-12 col-md-6 ">




<div class="d-flex">
<img class="mt-2 ms-2 mb-3" src="img/logo.svg" width="40" alt="">
<h6 class="ms-2 mt-2"><?php
    if ($row["id_payment"] == null) {
        echo "Pendiente";
    } else {
        echo $row["id_payment"];
    }?></h6></div>



                       <h6 class="ms-2 mt-3">Detalles del remitente:</h6>

                        <div class="ms-3">
                          <p class="text-muted mb-1">Nombre: <span><?php echo $row["nombre"]; ?></span></p>
                          <p class="text-muted mb-1">Apellidos: <span><?php echo $row["apellidos"]; ?></span></p>
                          <p class="text-muted mb-1">Correo: <span><?php echo $row["correo"]; ?></span></p>                      
                          <p class="text-muted mb-1">Telefono: <span><?php echo $row["telefono"]; ?></span></p>
                          </div>


                          <h6 class="mt-5 ms-2">Detalles del destinatario:</h6>

                        <div class="ms-2 bg-secondary rounded-3 p-3">
                          <p class="mb-1">Nombre: <span><?php echo $row["nombre_destinatario"]; ?></span></p>
                          <p class="mb-1">Apellidos: <span><?php echo $row["apellido_destinatario"]; ?></span></p>
                          <p class="mb-1">Telefono: <span><?php echo $row["telefono_destinatario"]; ?></span></p>                      
                          <p class="mb-1">Municipio: <span><?php echo $row["municipio"]; ?></span></p>
                          <p class="mb-1">Dirreción: <span><?php echo $row["direccion_entrega"]; ?></span></p>
                          <p class="mb-1">Carnet de identidad: <span><?php echo $row["cid"]; ?></span></p>
                          </div>
                     
                    





                          <?php

// ID del checkout
$id_check_out = $_POST['id'];

// Consulta SQL
$sql3 = "SELECT img_comprobante, img_entrega FROM check_out WHERE id_check_out = $id_check_out";

// Ejecuta la consulta
$result = $conn->query($sql3);

if ($result->num_rows > 0) {
  // Muestra los resultados
  while($row3 = $result->fetch_assoc()) {
    ?>

<h6 class="ms-2 mt-3">Imagenes de entrega</h6>
    <div class="d-flex mt-3">
      <div class="me-3"><a href="<?php echo $row["img_comprobante"]; ?>" target="_blank" rel="noopener noreferrer"><img class="bg-secondary rounded-2" src="<?php echo $row["img_comprobante"]; ?>" style="object-fit: contain; height: 120px; width: 70px;" alt="Comprobante"></a></div>
      <div><a href="<?php echo $row["img_comprobante"]; ?>" target="_blank" rel="noopener noreferrer"><img class="bg-secondary rounded-2" src="<?php echo $row["img_entrega"]; ?>" style="object-fit: contain; height: 120px; width: 70px;" alt="Imagen"></a></div>


    </div>

    <?php
  }
}

?>




</div>


<aside class="col-12 col-md-6 pt-4 pt-lg-0 ps-xl-5">
            <div class="bg-white rounded-3 shadow-lg p-4 ms-lg-auto">
              <div class="py-2 px-xl-2">


                <div class="widget mb-3">
                  <h2 class="widget-title text-center">Productos adquiridos:</h2>





                  <?php


$id_check_out = $_POST['id'];

// Crear la consulta SQL para seleccionar todas las filas de las tablas check_out, check_out_productos y productos
$sql = "SELECT check_out_productos.id_producto, check_out_productos.nombre_producto, check_out_productos.precio_producto, check_out_productos.cantidad FROM check_out INNER JOIN check_out_productos ON check_out.id_check_out = check_out_productos.id_check_out WHERE check_out.id_check_out = $id_check_out";
// Ejecutar la consulta y obtener los resultados
$resultado = mysqli_query($db, $sql);

// Verificar si se encontraron filas
if (mysqli_num_rows($resultado) > 0) {
    // Se encontraron filas, recorrer los resultados y mostrarlos en pantalla
    while ($fila = mysqli_fetch_assoc($resultado)) {?>





                   <div class="widget-cart-item pb-2 border-bottom d-flex">


                          <div class="d-flex align-items-center">
                <a class="d-block flex-shrink-0" href="details?id=<?php echo $fila["id_producto"]; ?>">
                </a>

                            <div class="ps-2">
                              <h6 class="widget-product-title"><a href="details?id=<?php echo $fila["id_producto"]; ?>"><?php echo $fila["nombre_producto"]; ?></a></h6>
                              <div class="widget-product-meta"><span class="text-accent me-2">$<?php echo $fila["precio_producto"]; ?></span><span class="text-muted">x <?php echo $fila["cantidad"]; ?></span></div>
                            </div>
                          </div>
                          </div>
                                            


        <?php
    }
} else {
    // No se encontraron filas, mostrar un mensaje al usuario
    echo "No hay pedidos aún";
}
?>






                </div>
                <ul class="list-unstyled fs-sm pb-2 border-bottom">
                
                  <li class="d-flex justify-content-between align-items-center"><span class="me-2">Domicilio:</span><span class="text-end">$5.00</small></span></li>
                 
                </ul>
                <h3 class="fw-normal text-center mt-4">$<?php echo $row["total_precio"]; ?></h3>
                <center>
                <?php
    if ($row["estado_pago"] == "Pendiente") {
        echo '<span style="font-size:14px !important;" class="badge bg-warning m-0">' . $row["estado_pago"] . '</span>';
    } else if ($row["estado_pago"] == "Pagado") {
        echo '<span  style="font-size:14px !important;" class="badge bg-success m-0">' . $row["estado_pago"] . '</span>';
    }
?></center>
              </div>
            </div>



            <div class="bg-white mt-3 rounded-3 shadow-lg p-4 ms-lg-auto">


            <form action="funtions" method="post" enctype="multipart/form-data">

<input type="hidden" name="form_name" value="form_delivery">
<input type="hidden" name="id_check_out" value="<?php echo $row["id_check_out"]; ?>">

<?php

$estado_actual = $row["estado_envio"];

?>

<h6 class="mb-3 fs-sm">Estado de entrega</h6>
<select class="form-control mb-3" name="estado_envio" id="estado_envio" required>
    <option value="Pendiente" <?php if ($estado_actual == 'Pendiente') echo 'selected'; ?>>Pendiente</option>
    <option value="En curso" <?php if ($estado_actual == 'En curso') echo 'selected'; ?>>En curso</option>
    <option value="Entregado" <?php if ($estado_actual == 'Entregado') echo 'selected'; ?>>Entregada</option>
</select>



<h6 class="mt-3 fs-sm">Subir comprobante</h6>
<input class="form-control" type="file" name="img_comprobante" id="img_comprobante" required>

<h6 class="mt-3 fs-sm">Imagen de la entrega</h6>
<input class="form-control" type="file" name="img_entrega" id="img_entrega" required>

<button class="w-100 btn btn-success mt-3" type="submit">Guardar y Enviar</button>

</form>



            </div>
          </aside>


</div>




<hr class="mt-4">
                  <div class="text-end pt-4">
                  <button class="btn btn-secondary px-4 me-3" data-bs-dismiss="modal" aria-label="Close" type="button">Volver</button>
                    <a class="btn btn-primary px-4" href="print?id=<?php echo $row["id_check_out"]; ?>">Imprimir</a>
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