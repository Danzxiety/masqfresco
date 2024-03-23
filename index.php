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


?>



<!DOCTYPE html>
<html lang="es"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style type="text/css" class="drift-base-styles">.drift-bounding-box,.drift-zoom-pane{position:absolute;pointer-events:none}@keyframes noop{0%{zoom:1}}@-webkit-keyframes noop{0%{zoom:1}}.drift-zoom-pane.drift-open{display:block}.drift-zoom-pane.drift-closing,.drift-zoom-pane.drift-opening{animation:noop 1ms;-webkit-animation:noop 1ms}.drift-zoom-pane{overflow:hidden;width:100%;height:100%;top:0;left:0}.drift-zoom-pane-loader{display:none}.drift-zoom-pane img{position:absolute;display:block;max-width:none;max-height:none}</style>


    
    <title>Más Q'Fresco - Tu tienda online en Cuba</title>
    <!-- SEO Meta Tags-->
    <meta name="description" content="Más Q'Fresco - Tu tienda online en Cuba para electrodomésticos y comida con entrega en 24 a 48 horas.">
    <meta name="keywords" content="tienda, shop, e-commerce, market, modern, responsive, business, mobile, bootstrap, html5, css3, js, gallery, slider, touch, creative, clean, cuba, pay, electrodomésticos, comida, entrega rápida">
    <meta name="author" content="Uixsoftware">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon and Touch Icons-->
    <link rel="apple-touch-icon" sizes="180x180" href="https://masqfresco.com/img/logo.svg">
    <link rel="icon" type="image/png" sizes="32x32" href="https://masqfresco.com/img/logo.svg">
    <link rel="icon" type="image/png" sizes="16x16" href="https://masqfresco.com/img/logo.svg">
    <!-- Vendor Styles including: Font Icons, Plugins, etc.-->
    <script src="js/ajax.js"></script>
    <script src="js/config.js"></script>
    <link rel="stylesheet" media="screen" href="css/simplebar.min.css">
    <link rel="stylesheet" media="screen" href="css/tiny-slider.css">
    <link rel="stylesheet" media="screen" href="css/drift-basic.min.css">
    <link rel="stylesheet" media="screen" href="css/lightgallery-bundle.min.css">
    <!-- Main Theme Styles + Bootstrap-->
    <link rel="stylesheet" media="screen" href="css/theme.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kalam:wght@400;700&display=swap" rel="stylesheet">
  
 
  <style>


@import url("https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;500;600;700;800;900&display=swap");


body {
  font-family: "League Spartan", system-ui, sans-serif !important;
}
    </style>

   </head>
  <!-- Body-->
  <body class="handheld-toolbar-enabled">
 





    <!-- Sign in / sign up modal-->
    <div class="modal fade" id="signin-modal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content dark">
          <div style="background-color: #f6f9fc;" class="modal-header darksec">
            <ul class="nav nav-tabs card-header-tabs" role="tablist">
              <li class="nav-item" role="presentation"><a class="nav-link fw-medium txsub active" href="#signin-tab" data-bs-toggle="tab" role="tab" aria-selected="true"><i class="ci-unlocked me-2 mt-n1"></i>Iniciar Sesión</a></li>
              <li class="nav-item" role="presentation"><a class="nav-link fw-medium txsub" href="#signup-tab" data-bs-toggle="tab" role="tab" aria-selected="false" tabindex="-1"><i class="ci-user me-2 mt-n1"></i>Crear cuenta</a></li>
            </ul>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body tab-content py-4">
          <div class="tab-pane fade show active" role="tabpanel" id="signin-tab">
          <form class="needs-validation" enctype="multipart/form-data" action="funtions" method="post"> 
          <input type="hidden" name="form_name" value="form_login">
          <div class="mb-3">
                <label class="form-label txsub" for="si-name">Correo electrónico</label>
                <input class="form-control dark" type="text" name="correo_electronico" id="correo_electronico" required="">
                <div class="invalid-feedback">Please provide a valid email address.</div>
              </div>
              <div class="mb-3">
                <label class="form-label txsub" for="si-password">Contraseña</label>
                <div class="password-toggle">
                  <input class="form-control dark" type="password" name="contrasena" id="password_login" required="">
                  <label class="password-toggle-btn" aria-label="Show/hide password">
                    <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
                  </label>
                </div>
              </div>
              <div class="mb-3 d-flex flex-wrap justify-content-between">
                <div class="form-check mb-2">
                  <input class="form-check-input darksec" type="checkbox" id="si-remember">
                  <label class="form-check-label" for="si-remember">Recordarme!</label>
                </div><a class="fs-sm" style="color: rgb(37, 180, 80);" href="#">Ayuda y Soporte web</a>
              </div>
              <input class="btn btn-primary btn-shadow d-block w-100" value="Acceder" type="submit">
            </form>
            </div>

            <div class="tab-pane fade" role="tabpanel" id="signup-tab">


            <form method="post" action="funtions" enctype="multipart/form-data">
            <input type="hidden" name="form_name" value="form_use">
            <div class="mb-3">
            
                <label class="form-label txsub" for="su-name">Nombre</label>
                <input class="form-control dark" type="text" name="nombre" id="username" placeholder="" required="">
                <div class="invalid-feedback">Please fill in your name.</div>
              </div>
              <div class="mb-3">
                <label class="form-label txsub" for="su-fullname">Apellidos</label>
                <input class="form-control dark" type="text" name="apellido" id="fullname" placeholder="" required="">
                <div class="invalid-feedback">Please fill in your name.</div>
              </div>

              <div class="mb-3">
  <label class="form-label txsub" for="su-phone">Teléfono</label>
  <select class="form-select dark" name="codigo_pais" id="country-code" required="">
    <option value="+1">Estados Unidos (+1)</option>
    <option value="+53">Cuba (+53)</option>
    <!-- Agrega más opciones para otros países aquí -->
  </select>
  <input class="form-control dark" type="text" name="numero_tel" id="phone" placeholder="555-555-5555" required="">
  <div class="invalid-feedback">Please fill in your phone number.</div>
</div>

              <div class="mb-3">
                <label class="form-label txsub" for="su-name">Correo</label>
                <input class="form-control dark" type="email" name="correo_electronico" id="email" placeholder="usuario@gmail.com" required="">
                <div class="invalid-feedback">Please fill in your name.</div>
              </div>
              
              <div class="mb-3">
                <label class="form-label txsub" for="su-password">Contraseña</label>
                <div class="password-toggle">
                  <input class="form-control dark" name="contrasena" type="password" id="password" required="">
                  <label class="password-toggle-btn" aria-label="Show/hide password">
                    <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
                  </label>
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label txsub" for="su-password-confirm">Confirma la contraseña</label>
                <div class="password-toggle">
                  <input class="form-control dark" name="confirmar_contrasena" type="password" id="confirmpassword" required="">
                  <label class="password-toggle-btn" aria-label="Show/hide password">
                    <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
                  </label>
                </div>
              </div>
              <input class="btn btn-primary btn-shadow d-block w-100" value="Registrarse" type="submit">
            </form>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>




    <main class="page-wrapper">



      
          <!-- Sidebar-->
          <aside  class="col-lg-4 cartside">
            <!-- Sidebar-->
            <div class="offcanvas offcanvas-collapse bg-white w-100 rounded-3 shadow-lg py-1" id="shop-sidebar" style="max-width: 22rem;">
              <div class="offcanvas-header align-items-center shadow-sm">
                <h2 class="h5 mb-0"><i class="ci-cart"></i> Carrito</h2>
                <button class="btn-close ms-auto" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>
              <div class="offcanvas-body py-grid-gutter px-lg-grid-gutter">
                



              <?php
if (isset($_SESSION['user_id'])) {
// Obtén el ID del usuario
$id_usuario = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT carrito.cantidad, productos.id_producto, productos.nombre, productos.descripcion, productos.precio, MAX(fotos_productos.foto_url) AS foto_url FROM carrito INNER JOIN productos ON carrito.id_producto = productos.id_producto INNER JOIN fotos_productos ON carrito.id_producto = fotos_productos.id_producto WHERE carrito.id_usuario = ? GROUP BY productos.id_producto");
$stmt->bind_param("i", $id_usuario);

// Ejecuta la consulta
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  // Hay productos en el carrito, muéstralos
  while ($row = $result->fetch_assoc()) {
  
  ?>
<div class="widget-cart-item pb-2 border-bottom d-flex">
<form action="funtions" method="post">
    <input type="hidden" name="form_name" value="remove_from_cart">
                       <input type="hidden" name="id_producto" value="<?php echo $row["id_producto"]; ?>">

                          <input  style="font-size: 1.5rem; font-weight: 300; " class="btn text-danger" type="submit" value="x" aria-label="Remove">
                          </form>

                          <div class="d-flex align-items-center">
                <a class="d-block flex-shrink-0" href="details?id=<?php echo $row["id_producto"]; ?>">
                <?php echo "<img width='64' alt='Product' src='" . $row['foto_url'] . "' > ";?>
                </a>

                            <div class="ps-2">
                              <h6 class="widget-product-title"><a href="details?id=<?php echo $row["id_producto"]; ?>"><?php echo $row["nombre"]; ?></a></h6>
                              <div class="widget-product-meta"><span class="text-accent me-2">$<?php echo $row["precio"]; ?></span><span class="text-muted">x <?php echo $row["cantidad"]; ?></span></div>
                            </div>
                          </div>
                          </div>
                                            
  <?php
}

} else {

  ?>

<center>
<div>
  <img src="img/nocart.svg" width="150" height="150">
  <p>No hay productos en el carrito</p>
</div>
</center>

  <?php

}
} else {
  // El usuario no ha iniciado sesión, muestra un mensaje de advertencia
  echo "Debes iniciar sesión para ver el contenido del carrito";?>

<br><br>
  <a class="fs-sm mt-3" style="color: rgb(37, 180, 80);" href="#signin-modal" data-bs-toggle="modal">Iniciar Sesión / Registrarse</a>


<?php


}

?>

              



              

                <div class="d-flex flex-wrap justify-content-between align-items-center py-3">
                  <div class="fs-sm me-2 py-2"><span class="text-muted">Subtotal:</span><span class="text-accent fs-base ms-1"><?php

if (isset($_SESSION['user_id'])) {
                // Asumiendo que tienes el ID del usuario en una variable $id_usuario
                $id_usuario = $_SESSION['user_id'];// Reemplaza esto con el ID del usuario real

                // Crear la consulta SQL para calcular el total de la compra del usuario
                $sql = "SELECT SUM(productos.precio * carrito.cantidad) AS total FROM carrito INNER JOIN productos ON carrito.id_producto = productos.id_producto WHERE carrito.id_usuario = $id_usuario";

                // Ejecutar la consulta y obtener el resultado
                $resultado = mysqli_query($db, $sql);
                $fila = mysqli_fetch_assoc($resultado);
                $total = $fila['total'];

                // Mostrar el total al usuario
                echo '$' . number_format($total, 2);

              } else {
                // El usuario no ha iniciado sesión, muestra un mensaje de advertencia
                echo "$ 00.00";
              }

            ?></span></div>
                </div><a class="btn btn-sm d-block w-100" style="background-color: rgb(37, 180, 80); color:white;" href="checkout"><i class="ci-card me-2 fs-base align-middle"></i>Checkout</a>
              </div>
            </div>
              </div>
            </div>
          </aside>


      <!-- Vista previa Modal-->
      <div class="modal fade" id="review_cmo" tabindex="-1">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title product-title"><a href="#">Dejanos tu opinión</a></h4>
              <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form class="needs-validation" action="funtions" method="post">
                        <div class="mb-3">

                        <input type="hidden" name="form_name" value="form_comen">

                          <label class="form-label" for="review-name">Nombre<span class="text-danger">*</span></label>
                          <input class="form-control" name="nombre_cliente" type="text" value="<?php 
if(isset($_SESSION['user_nombre'])) {
    echo $_SESSION['user_nombre']; 
} 
?>
" required="" id="review-name">
                          <div class="invalid-feedback">Please enter your name!</div><small class="form-text text-muted">Will be displayed on the comment.</small>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="review-email">Correo<span class="text-danger">*</span></label>
                          <input class="form-control" name="correo_cliente" type="email" value="<?php 
if(isset($_SESSION['user_mail'])) {
    echo $_SESSION['user_mail']; 
} 
?>
" required="" id="review-email">
                          <div class="invalid-feedback">Please provide valid email address!</div><small class="form-text text-muted">Authentication only - we won't spam you.</small>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="review-rating">Estrellas<span class="text-danger">*</span></label>
                          <select class="form-select" name="estrellas"  required="" id="review-rating">
                            <option value="">Elegir calificación</option>
                            <option value="5">5 estrellas</option>
                            <option value="4">4 estrellas</option>
                            <option value="3">3 estrellas</option>
                            <option value="2">2 estrellas</option>
                            <option value="1">1 estrellas</option>
                          </select>
                          <div class="invalid-feedback">Please choose rating!</div>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="review-text">Comentario<span class="text-danger">*</span></label>
                          <textarea class="form-control" name="comentario" rows="6" required="" id="review-text"></textarea>
                          <div class="invalid-feedback">Please write a review!</div><small class="form-text text-muted">Your review must be at least 50 characters.</small>
                        </div>
                        
                        <input class="btn btn-primary btn-shadow d-block w-100" value="Enviar" type="submit"/>
                      </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>














 











     <!-- Navbar -->
     <header class="shadow-sm">
        <!-- Topbar-->
       


        <!-- Remove "navbar-sticky" class to make navigation bar scrollable with the page.-->
        <div class="navbar-sticky bg-light py-0">
          <div class="navbar navbar-expand-lg navbar-light py-0">
            <div class="container"><a class="navbar-brand d-none d-sm-flex me-3 flex-shrink-0" href="https://masqfresco.com/"> <img width="50px" src="https://masqfresco.com/img/logo.svg" alt="Logo"> <span style="font-family: 'Kalam', cursive;" class="h4 fw-bold my-auto ms-2">Más Q'Fresco</span></a><a class="navbar-brand d-sm-none me-2" href="https://masqfresco.com/"><img src="https://masqfresco.com/img/logo.svg" width="60" alt="Logo"></a>
              <!-- Search-->
              <form action="search_product" method="get">
              <div class="input-group  d-none d-lg-flex flex-nowrap"><i class="ci-search position-absolute top-50 start-0 translate-middle-y ms-3"></i>
              
         <input style="border-radius: 20px 0px 0px 20px; background:white; border-width:0px; width: 100%" href="#searchBo"  data-bs-toggle="collapse" name="busqueda" id="campo-busqueda"  aria-expanded="false" aria-controls="searchBo" class="form-control dark filter campo-busqueda shadow w-100" type="text" placeholder="Busqueda de productos">
            <button class="btn btn-light shadow flex-shrink-0" type="submit" style="width: 10rem; border-radius: 0px 20px 20px 0px;  border-width:0px;">Buscar</button>
            
          </div></form>
         

          <style>
            #resultados-busqueda {
              display: none;
    margin-bottom: -190px;
    width: 300px;
    height: 200px;
    margin-top: -10px;
    text-align: left;
    padding-top: 8px;
    overflow-y: auto;
    background-color: white;
    border: 1px solid #ccc;
    border-radius: 10px 10px 20px 20px;
}

          </style>
         



              <!-- Toolbar-->
              <div class="navbar-toolbar d-flex flex-shrink-0 align-items-center">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"><span class="navbar-toggler-icon"></span></button><a class="navbar-tool navbar-stuck-toggler" href="#"><span class="navbar-tool-tooltip">Toggle menu</span>





<?php if(isset($_SESSION['user_id'])): 
  

  $id_user = $_SESSION['user_id'];
  $sql = "SELECT * FROM usuarios WHERE id_user = $id_user ";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Obtiene las dos primeras letras del nombre
        $initials = strtoupper(substr($row["nombre"], 0, 2));
  
  ?>

  <a class="navbar-tool ms-1 ms-lg-0 me-n1 me-lg-2" href="profile">
  <div class="me-2 shadow" style="background-color: <?php echo $row["rgbcolor"]; ?>; width: 38px; height: 38px; border-radius: 50%; display: flex; justify-content: center; align-items: center;">
            <span style="color: white; font-size: 12px;"><?php echo $initials; ?></span>
        </div>

        <?php
    }
}

?>
                  <div class="navbar-tool-text ms-n3"><small>Hola,     <?php


if (isset($_SESSION['user_nombre'])) {
  // El usuario ha iniciado sesión
  echo  $_SESSION['user_nombre'];
} else {
  // El usuario no ha iniciado sesión
  echo "Invitado";
}
?>
</small>Mi cuenta</div></a>

  <?php else: ?>
                  <a class="navbar-tool ms-1 ms-lg-0 me-n1 me-lg-2" href="#signin-modal" data-bs-toggle="modal">
                  <div class="navbar-tool-icon-box"><i class="navbar-tool-icon ci-user-circle"></i></div>
                  <div class="navbar-tool-text ms-n3"><small>Hola,     <?php


if (isset($_SESSION['user_nombre'])) {
  // El usuario ha iniciado sesión
  echo  $_SESSION['user_nombre'];
} else {
  // El usuario no ha iniciado sesión
  echo "Invitado";
}
?>
</small>Mi cuenta</div></a>
<?php endif; ?>

                <div class="navbar-tool dropdown ms-3"><a class="navbar-tool-icon-box bg-secondary dropdown-toggle" data-bs-toggle="offcanvas" data-bs-target="#shop-sidebar"><span class="navbar-tool-label " style="background-color: rgb(37, 180, 80); font-weight: 400 !important;"><?php

if (isset($_SESSION['user_id'])) {
                // Asumiendo que tienes el ID del usuario en una variable $id_usuario
                $id_usuario = $_SESSION['user_id'];

                // Crear la consulta SQL para contar cuántos productos tiene el usuario en su carrito
                $sql = "SELECT COUNT(*) FROM carrito WHERE id_usuario = $id_usuario";

                // Ejecutar la consulta y obtener el resultado
                $resultado = mysqli_query($db, $sql);
                $fila = mysqli_fetch_assoc($resultado);
                $numero_productos = $fila['COUNT(*)'];

                // Mostrar el número de productos al usuario
                echo $numero_productos;

              } else {
                // El usuario no ha iniciado sesión, muestra un mensaje de advertencia
                echo "!";
              }
            ?>
            
          </span><i class="navbar-tool-icon ci-cart"></i></a><a class="navbar-tool-text" href="#"><small>Mi carrito</small><?php

if (isset($_SESSION['user_id'])) {
                // Asumiendo que tienes el ID del usuario en una variable $id_usuario
                $id_usuario = $_SESSION['user_id'];// Reemplaza esto con el ID del usuario real

                // Crear la consulta SQL para calcular el total de la compra del usuario
                $sql = "SELECT SUM(productos.precio * carrito.cantidad) AS total FROM carrito INNER JOIN productos ON carrito.id_producto = productos.id_producto WHERE carrito.id_usuario = $id_usuario";

                // Ejecutar la consulta y obtener el resultado
                $resultado = mysqli_query($db, $sql);
                $fila = mysqli_fetch_assoc($resultado);
                $total = $fila['total'];

                // Mostrar el total al usuario
                echo '$' . number_format($total, 2);


              } else {
                // El usuario no ha iniciado sesión, muestra un mensaje de advertencia
                echo "$ 00.00";
              }
            ?></a>
             

                  <!-- Cart dropdown-->
                  <div class="dropdown-menu dropdown-menu-end">
                    <div class="widget widget-cart px-3 pt-2 pb-3" style="width: 20rem;">
                      <div style="height: 22rem;" data-simplebar="init" data-simplebar-auto-hide="false"><div class="simplebar-wrapper" style="margin: 0px -16px 0px 0px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: auto; overflow: hidden;"><div class="simplebar-content" style="padding: 0px 16px 0px 0px;">



                      <?php
if (isset($_SESSION['user_id'])) {
// Obtén el ID del usuario
$id_usuario = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT carrito.cantidad, productos.id_producto, productos.nombre, productos.descripcion, productos.precio, MAX(fotos_productos.foto_url) AS foto_url FROM carrito INNER JOIN productos ON carrito.id_producto = productos.id_producto INNER JOIN fotos_productos ON carrito.id_producto = fotos_productos.id_producto WHERE carrito.id_usuario = ? GROUP BY productos.id_producto");
$stmt->bind_param("i", $id_usuario);

// Ejecuta la consulta
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  // Hay productos en el carrito, muéstralos
  while ($row = $result->fetch_assoc()) {
  
  ?>
<div class="widget-cart-item pb-2 border-bottom d-flex">
<form action="funtions" method="post">
    <input type="hidden" name="form_name" value="remove_from_cart">
                       <input type="hidden" name="id_producto" value="<?php echo $row["id_producto"]; ?>">

                       <button class="btn bg-faded-danger btn-icon" style="margin-top: 12px;" type="submit" data-bs-toggle="tooltip" aria-label="Remover" data-bs-original-title="Remover"><i class="ci-trash text-danger"></i></button>
                          
                          </form>

                          <div class="d-flex align-items-center">
                <a class="d-block flex-shrink-0" href="details?id=<?php echo $row["id_producto"]; ?>">
                <?php echo "<img width='64' alt='Product' src='" . $row['foto_url'] . "' > ";?>
                </a>

                            <div class="ps-2">
                              <h6 class="widget-product-title"><a href="details?id=<?php echo $row["id_producto"]; ?>"><?php echo $row["nombre"]; ?></a></h6>
                              <div class="widget-product-meta"><span class="text-accent me-2">$<?php echo $row["precio"]; ?></span><span class="text-muted">x <?php echo $row["cantidad"]; ?></span></div>
                            </div>
                          </div>
                          </div>
                                            
  <?php
}

} else {
  ?>

<center>
<div class="mt-2">
  <img src="img/nocart.svg" width="150" height="150">
  <p class="mt-2">No hay productos en el carrito</p>
</div>
</center>

  <?php
}
} else {
  // El usuario no ha iniciado sesión, muestra un mensaje de advertencia
  echo "Debes iniciar sesión para ver el contenido del carrito";
  ?>
  <br><br>
  <a class="fs-sm mt-3" style="color: rgb(37, 180, 80);" href="#signin-modal" data-bs-toggle="modal">Iniciar Sesión / Registrarse</a>
  <?php

}

?>


                     

                      



                      </div></div></div></div><div class="simplebar-placeholder" style="width: 0px; height: 0px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar simplebar-visible" style="width: 0px; display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: hidden;"><div class="simplebar-scrollbar simplebar-visible" style="height: 0px; display: none;"></div></div></div>
                      <div class="d-flex flex-wrap justify-content-between align-items-center py-3">
                        <div class="fs-sm me-2 py-2"><span class="text-muted">Subtotal:</span><span class="text-accent fs-base ms-1"><?php

if (isset($_SESSION['user_id'])) {
                // Asumiendo que tienes el ID del usuario en una variable $id_usuario
                $id_usuario = $_SESSION['user_id'];// Reemplaza esto con el ID del usuario real

                // Crear la consulta SQL para calcular el total de la compra del usuario
                $sql = "SELECT SUM(productos.precio * carrito.cantidad) AS total FROM carrito INNER JOIN productos ON carrito.id_producto = productos.id_producto WHERE carrito.id_usuario = $id_usuario";

                // Ejecutar la consulta y obtener el resultado
                $resultado = mysqli_query($db, $sql);
                $fila = mysqli_fetch_assoc($resultado);
                $total = $fila['total'];

                // Mostrar el total al usuario
                echo '$' . number_format($total, 2);

                
              } else {
                // El usuario no ha iniciado sesión, muestra un mensaje de advertencia
                echo "$ 00.00";
              }
            ?></span></div>
                      </div><a class="btn bg-secondary shadow rounded-3 text-dark d-block w-100 " href="checkout"><i class="ci-card me-2 fs-base align-middle" ></i>Checkout</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div style="display: flex;
  justify-content: center;
  align-items: center;">
          <center style="z-index: 1000;">
          <div id="resultados-busqueda"></div>
          </center>
          </div>
          <div class="navbar navbar-expand-lg navbar-light navbar-stuck-menu mt-n2 pt-0 pb-2">
            <div class="container">
              <div class="collapse navbar-collapse" id="navbarCollapse">
                <!-- Search-->
                <form action="search_product" method="get">
                <div class="input-group d-lg-none my-3"><i class="ci-search position-absolute top-50 start-0 translate-middle-y ms-3"></i>
                  <input class="form-control rounded-start" name="busqueda campo-busqueda"  id="campo-busqueda" type="text" placeholder="Busqueda de productos...">
                </div></form>
                <!-- Departments menu-->
                 <!-- Departments menu-->
                <ul class="navbar-nav navbar-mega-nav pe-lg-2 me-lg-2">
                  <li class="nav-item dropdown"><a class="nav-link dropdown-toggle ps-lg-0" data-bs-toggle="dropdown" data-bs-auto-close="outside"><i class="ci-menu align-middle mt-n1 me-2"></i>Categorías</a>
                    <ul class="dropdown-menu">

  
        <?php


// Consulta para obtener todas las categorías
$sql = "SELECT * FROM categorias";
$result = $conn->query($sql);

// Recorremos todas las categorías
while ($row = $result->fetch_assoc()) { ?>
                      <li class="dropdown mega-dropdown">
  
                      <a class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown"><i class="<?php echo $row["icono"]; ?> opacity-60 fs-lg mt-n1 me-2"></i><?php echo $row["nombre_categoria"]; ?></a>
                        <div class="dropdown-menu p-0">
                          <div class="d-flex flex-wrap flex-sm-nowrap px-2">
                            <div class="mega-dropdown-column pt-4 pb-0 py-sm-4 px-3">
                              <div class="widget widget-links">
                                <ul class="widget-list">

                                <?php
  $sql2 = "SELECT * FROM productos WHERE categoria='" . $row["nombre_categoria"] . "'";
  $result2 = $conn->query($sql2);
  // Recorremos todos los productos de esta categoría
  while ($row2 = $result2->fetch_assoc()) { ?>
                                  <li class="widget-list-item pb-1"><a class="widget-list-link" href="details.php?id=<?php echo $row2["id_producto"]; ?>"><?php echo $row2 ["nombre"]; ?></a></li> 
                                  <?php
                    }

?>  
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                      </li>
                      <?php
                    }

?>


                     
                    </ul>
                  </li>
                </ul>
                <!-- Primary menu-->
                <ul class="navbar-nav">
                  <li class="nav-item active"><a class="nav-link" href="https://masqfresco.com">Inicio</a>
                   
                  </li>
                  <li class="nav-item"><a class="nav-link" href="https://masqfresco.com/products">Productos</a>
                  </li>

                  <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">Cuenta</a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="#signin-modal" data-bs-toggle="modal">Iniciar Sesión / Registrarse</a></li>
                     
                      <li><a class="dropdown-item" href="https://masqfresco.com/profile">Ver perfil</a></li>
              
                    </ul>
                  </li>
                  <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">Páginas</a>
                    <ul class="dropdown-menu">


                      <li><a class="dropdown-item" href="https://masqfresco.com/terms">Términos y condiciones</a></li>
                    
                    </ul>
                  </li>
                  
                </ul>
              </div>
            </div>
          </div>
        </div>
      </header>





      <script>
$(document).ready(function(){
 $('#campo-busqueda').keyup(function(){
  var query = $(this).val();
  if (query != '') {
   $.ajax({
    url:"busqueda_productos.php",
    method:"POST",
    data:{query:query},
    success:function(data) {
     $('#resultados-busqueda').fadeIn();
     $('#resultados-busqueda').html(data);
    }
   });
  } else {
   $('#resultados-busqueda').fadeOut();
   $('#resultados-busqueda').html("");
  }
 });

 // Oculta los resultados cuando se hace clic fuera del campo de búsqueda y del contenedor de los resultados
 $(document).on('click', function (e) {
    if ($(e.target).closest("#campo-busqueda").length === 0 && $(e.target).closest("#resultados-busqueda").length === 0) {
        $('#resultados-busqueda').fadeOut();
    }
 });
});


          </script>





























      





     
    <section  class="bg-secondary pt-md-5" style="background-image:url(img/whooping_banner_shape_2.png); background-position: bottom left; background-repeat: space;
    background-size: cover; ">
        <div class="container pt-5 pb-5">
          <div class="row">
            <!-- Slider     -->
            <div class="col-xl-12  order-xl-2">



        


              <div style="margin-top: -30px;" class="tns-carousel">
                <div class="tns-outer" id="tns1-ow"><div class="tns-liveregion tns-visually-hidden" aria-live="polite" aria-atomic="true">slide <span class="current">1</span>  of 3</div><div id="tns1-mw" class="tns-ovh"><div class="tns-inner" id="tns1-iw"> <div class="tns-carousel-inner tns-slider tns-carousel tns-subpixel tns-calc tns-horizontal" data-carousel-options="{&quot;items&quot;: 1, &quot;controls&quot;: false, &quot;loop&quot;: true, &quot;autoplay&quot;: true, &quot;autoplayTimeout&quot;: 5000}" id="tns1" style="transition-duration: 0s; transform: translate3d(0%, 0px, 0px);">
                


                  <div class="tns-item tns-slide-active" id="tns1-item0">
                    <div class="row align-items-center">
                      <div class="col-md-6 order-md-2"><img class="d-block mx-auto" alt="Presentacion" src="img/1690584557366.png" width="60%" ></div>
                      <div class="col-lg-5 col-md-6 offset-lg-1 order-md-1 pt-4 pb-md-4 text-center text-md-start">
                        <small>VPS</small>
                        <h2 style="font-family: 'Kalam', cursive;" class="fw-light pb-1 from-bottom">Bienvenidos a</h2>
                        <h1 style="font-family: 'Kalam', cursive;" class="display-5 scale-up fw-bold delay-1">Más Q' Fresco</h1>
                        <h5 style="font-family: 'Kalam', cursive;" class="fw-light pb-3 from-bottom delay-2">Tu tienda online con productos de calidad</h5>
                        <div class="d-table  delay-4 mx-auto mx-md-0"><a class="btn btn-light rounded-3 shadow" href="login">Iniciar Sesión<i class="ci-arrow-right ms-2 me-n1"></i></a></div>
                      </div>
                    </div>
                  </div>

                  <?php



// Consulta para seleccionar los nombres de las categorías
$sql = "SELECT * FROM promociones";
$result = $db->query($sql);

// Mostrar los resultados
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      ?>


<div class="tns-item" id="tns1-item2" aria-hidden="true" tabindex="-1">
                    <div class="row align-items-center">
                      <div class="col-md-6 order-md-2"><img class="d-block mx-auto" src="uploads/<?php echo $row["foto"]; ?>" width="60%"  alt="Presentacion" ></div>
                      <div class="col-lg-5 col-md-6 offset-lg-1 order-md-1 pt-4 pb-md-4 text-center text-md-start">
                        <h3 style="font-family: 'Kalam', cursive;" class="fw-light pb-1 scale-up"><?php echo $row["presentacion"]; ?></h3>
                        <h2 style="font-family: 'Kalam', cursive;" class="display-5 fw-bold scale-up delay-1"><?php echo $row["titulo"]; ?></h2>
                        <h5 style="font-family: 'Kalam', cursive;" class="fw-light pb-3 delay-2"><?php echo $row["discripcion"]; ?></h5>
                        <div class="d-table scale-up delay-4 mx-auto mx-md-0"><a class="btn btn-light rounded-3 shadow" href="<?php echo $row["enlace_del_boton"]; ?>"><?php echo $row["texto_del_boton"]; ?><i class="ci-arrow-right ms-2 me-n1"></i></a></div>
                      </div>
                    </div>
                  </div>


        <?php

    }
} else {
    echo "No se encontraron resultados";
}

?>

                  
                  




                </div>
              
              
              
              
              
              </div></div></div>
              </div>
            </div>
           
          </div>
        </div>
      </section>

 


 

      <style>
        @media (max-width: 1000px) {
          .tabsx::-webkit-scrollbar{
            display: none;
          }
        }
      </style>

     
      <section class="mt-4 pt-4" >


      <div class="container">
      <div class="row pb-3">
            <div class="col-md-3 col-sm-6 mb-4">
              <div class="d-flex"><i class="ci-delivery " style="font-size: 2.25rem; color:rgb(255,138,0)"></i>
                <div class="ps-3">
                  <h6 class="fs-base text-dark mb-1">Envios rápidos y seguros</h6>
                  <p class="mb-0 text-dark opacity-50">Entregas de 24/48 horas</p>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-4">
              <div class="d-flex"><i class="ci-package" style="font-size: 2.25rem; color:rgb(37, 180, 80)"></i>
                <div class="ps-3">
                  <h6 class="fs-base text-dark mb-1">Productos de calidad</h6>
                  <p class="mb-0 text-dark opacity-50">Compra seguro tus productos</p>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-4">
              <div class="d-flex"><i class="ci-support " style="font-size: 2.25rem;  color:rgb(255,138,0)"></i>
                <div class="ps-3">
                  <h6 class="fs-base text-dark mb-1">Atención al cliente</h6>
                  <p class="mb-0 text-dark opacity-50">Nuestro soporte para sus dudas</p>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-4">
              <div class="d-flex"><i  class="ci-card" style="font-size: 2.25rem; color:rgb(37, 180, 80)"></i>
                <div class="ps-3">
                  <h6 class="fs-base text-dark mb-1">Pagos seguros</h6>
                  <p class="mb-0 text-dark opacity-50">Certificado SSL / TropiPay</p>
                </div>
              </div>
            </div>
          </div>
          </div>



       
        <div class="container pb-4">
        <!-- Heading-->
        <div class="d-flex flex-wrap justify-content-between align-items-center pt-1 pb-3 mb-2">
          <h2 style="font-weight: 600 !important;" class="h3 mb-0 pt-3 me-2 text-dark">Categorías</h2>  
        </div>
  
    

       
        <div style="overflow-x: scroll; display: flex; scrollbar-width: none; overflow-x: auto;" class="tabsx d-sm-flex pb-2 pt-2 justify-content-sm-start">
          

        <?php
       $sql = "SELECT * FROM categorias ORDER BY id_categoria DESC";
      
       $result = $conn->query($sql);
       
       if ($result->num_rows > 0) {
           // Muestra los resultados de la primera consulta utilizando la plantilla HTML
           while($row = $result->fetch_assoc()) {
           
            ?>

          <a href="categories?categoria=<?php echo $row["nombre_categoria"]; ?>" style="margin-right: 8px;" class="btn rounded-pill shadow-sm d-sm-flex bg-light text-dark d-sm-flex justify-content-sm-center align-items-sm-center" type="button"><i class="<?php echo $row["icono"]; ?>" style="margin-right: 5px;"></i> <?php echo $row["nombre_categoria"]; ?></a>


          <?php
    }
} else {
    echo "No hay categorías";
}
                    ?>
        
        
        </div>
</div>





        </div></div>
      </section>


      <?php
      $sql = "SELECT * FROM productos WHERE estado = 'oferta' AND stock > 0";

      
      
       $result = $conn->query($sql);
       
       if ($result->num_rows > 0) {
          
               ?>

      <section class="container pt-1">
        <!-- Heading-->
        <div class="d-flex flex-wrap justify-content-between align-items-center pt-1 border-bottom pb-4 mb-4">
          <h2 style="font-weight: 600 !important;" class="h3 mb-0 pt-3 me-2">Ofertas</h2>
          <div class="pt-3"><a class="btn pt-2 pb-2 rounded-3 shadow" style="background-color: rgb(37, 180, 80); color:white;" href="products">Más productos<i class="ci-arrow-right ms-1 me-n1"></i></a></div>
        </div>
        <!-- Grid-->
        <div class="row pt-2 mx-n2">
         



        <?php
      $sql = "SELECT * FROM productos WHERE estado = 'oferta' AND stock > 0 ORDER BY id_producto DESC LIMIT 8";

      
      
       $result = $conn->query($sql);
       
       if ($result->num_rows > 0) {
           // Muestra los resultados de la primera consulta utilizando la plantilla HTML
           while($row = $result->fetch_assoc()) {
            $foto_url = "";
            $sql = "SELECT * FROM fotos_productos WHERE id_producto = " . $row["id_producto"] . " LIMIT 1";
            $fotos_result = $conn->query($sql);
            if ($fotos_result->num_rows > 0) {
                $foto_row = $fotos_result->fetch_assoc();
                $foto_url = $foto_row["foto_url"];
            }
    
            // Calcula la calificación promedio del producto
            $rating = 0;
            $sql = "SELECT AVG(estrellas) as rating FROM comentarios_productos WHERE id_producto = " . $row["id_producto"];
            $rating_result = $conn->query($sql);
            if ($rating_result->num_rows > 0) {
                $rating_row = $rating_result->fetch_assoc();
                $rating = round($rating_row["rating"]);
            }
            
               ?>
         


            <!-- Product-->
            <div class="col-lg-3 col-md-4 col-6 px-1 mb-4">
            <div class="card shadow-lg rounded-3 product-card"><span style="background-color: rgb(37, 180, 80); color: white;" class="badge badge-shadow px-3 py-2 rounded-pill">Oferta</span>
              <div class="product-card-actions d-flex align-items-center">
              <img class="rounded-circle" src="img/logo.svg" width="45" alt="Avatar">
                <?php
                echo '    </div><a class="card-img-top d-block overflow-hidden">
                <img class="w-100 p-2" src="' . htmlspecialchars($foto_url) . '" alt="Product" style="object-fit: contain; height: 250px; width: 200px;">
            </a>' 
                ?>
              <div class="card-body py-2"><a class="product-meta d-block fs-xs pb-1" href="details?id=<?php echo $row["id_producto"]; ?>"><?php echo $row["categoria"]; ?></a>
                <h3 class="product-title fs-sm"><a href="details?id=<?php echo $row["id_producto"]; ?>"><?php echo $row["nombre"]; ?></a></h3>
                <div class="d-flex justify-content-between">
                <div class="product-price"><span class="text-accent">$<span><?php echo $row["precio"]; ?></span></span>
                    <del class="fs-sm text-muted">$<span><?php echo $row["old_precio"]; ?></span></del>
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

              <form action="funtions" method="post">
                <input type="hidden" name="form_name" value="form_cart">
                <input type="hidden" name="id_producto" value="<?php echo $row["id_producto"]; ?>">
                <button class="btn btn-primary btn-sm d-block w-100 mb-2" type="submit"><i class="ci-cart fs-sm me-1"></i>Añadir</button>
                </form>
                <div class="text-center"><a class="nav-link-style fs-ms" href="details?id=<?php echo $row["id_producto"]; ?>"><i class="ci-eye align-middle me-1"></i>Ver producto</a></div>
              </div>
            </div>
            <hr class="d-sm-none">
          </div>


          <?php
    }
} else {
    echo "0 resultados";
}
                    ?>





          </div>
        </div>
      </section>

      <?php
    }
                    ?>













    
      <section class="container pt-5">
        <!-- Heading-->
        <div class="d-flex flex-wrap justify-content-between align-items-center pt-1 border-bottom pb-4 mb-4">
          <h2 style="font-weight: 600 !important;" class="h3 mb-0 pt-3 me-2">Productos</h2>
          <div class="pt-3"><a class="btn pt-2 pb-2 rounded-3 shadow" style="background-color: rgb(37, 180, 80); color:white;" href="products">Más productos<i class="ci-arrow-right ms-1 me-n1"></i></a></div>
        </div>
        <!-- Grid-->
        <div class="row pt-2 mx-0">

        

        <?php
      $sql = "SELECT * FROM productos WHERE estado = 'venta' AND stock > 0 ORDER BY id_producto DESC LIMIT 40";

      
       $result = $conn->query($sql);
       
       if ($result->num_rows > 0) {
           // Muestra los resultados de la primera consulta utilizando la plantilla HTML
           while($row = $result->fetch_assoc()) {
            $foto_url = "";
            $sql = "SELECT * FROM fotos_productos WHERE id_producto = " . $row["id_producto"] . " LIMIT 1";
            $fotos_result = $conn->query($sql);
            if ($fotos_result->num_rows > 0) {
                $foto_row = $fotos_result->fetch_assoc();
                $foto_url = $foto_row["foto_url"];
            }
    
            // Calcula la calificación promedio del producto
            $rating = 0;
            $sql = "SELECT AVG(estrellas) as rating FROM comentarios_productos WHERE id_producto = " . $row["id_producto"];
            $rating_result = $conn->query($sql);
            if ($rating_result->num_rows > 0) {
                $rating_row = $rating_result->fetch_assoc();
                $rating = round($rating_row["rating"]);
            }
            
               ?>


          <!-- Product-->
          <div class="col-lg-3 col-md-4 col-6 px-1 mb-4">
            <div class="card shadow-lg rounded-3 product-card">
              <div class="product-card-actions d-flex align-items-center">
              <img class="rounded-circle" src="img/logo.svg" width="45" alt="Avatar">

                <?php
                echo '    </div><a class="card-img-top d-block overflow-hidden">
                <img class="w-100 p-2" src="' . htmlspecialchars($foto_url) . '" alt="Product" style="object-fit: contain; height: 250px; width: 200px;">
            </a>' 
                ?>
              <div class="card-body py-2"><a class="product-meta d-block fs-xs pb-1" href="details?id=<?php echo $row["id_producto"]; ?>"><?php echo $row["categoria"]; ?></span></a>
                <h3 class="product-title fs-sm"><a href="details?id=<?php echo $row["id_producto"]; ?>"><?php echo $row["nombre"]; ?></a></h3>
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

              <form action="funtions" method="post">
                <input type="hidden" name="form_name" value="form_cart">
                <input type="hidden" name="id_producto" value="<?php echo $row["id_producto"]; ?>">
                <button class="btn btn-primary btn-sm d-block w-100 mb-2" type="submit"><i class="ci-cart fs-sm me-1"></i>Añadir</button>
                </form>
                <div class="text-center"><a class="nav-link-style fs-ms" href="details?id=<?php echo $row["id_producto"]; ?>"><i class="ci-eye align-middle me-1"></i>Ver producto</a></div>
              </div>
            </div>
            <hr class="d-sm-none">
          </div>



                <?php
    }
} else {
    echo "0 resultados";
}
                    ?>




        </div>
      </section>
      
      <!-- Product widgets-->
      <section class="container mt-5 pb-4 pb-md-5">
        <div class="row">
          <!-- Bestsellers-->

         <div class="col-md-4 col-sm-6 mb-2 py-3">
            <div class="widget">
              <h3 class="widget-title">Más vendidos</h3>



              <?php
       $sql = "SELECT p.*, (SELECT COUNT(*) FROM check_out_productos WHERE id_producto = p.id_producto) as compras
       FROM productos p
       WHERE stock > 0
       ORDER BY compras DESC
       LIMIT 4";
      
       $result = $conn->query($sql);
       
       if ($result->num_rows > 0) {
           // Muestra los resultados de la primera consulta utilizando la plantilla HTML
           while($row = $result->fetch_assoc()) {
            $foto_url = "";
            $sql = "SELECT * FROM fotos_productos WHERE id_producto = " . $row["id_producto"] . " LIMIT 1";
            $fotos_result = $conn->query($sql);
            if ($fotos_result->num_rows > 0) {
                $foto_row = $fotos_result->fetch_assoc();
                $foto_url = $foto_row["foto_url"];
            }
    
            // Calcula la calificación promedio del producto
            $rating = 0;
            $sql = "SELECT AVG(estrellas) as rating FROM comentarios_productos WHERE id_producto = " . $row["id_producto"];
            $rating_result = $conn->query($sql);
            if ($rating_result->num_rows > 0) {
                $rating_row = $rating_result->fetch_assoc();
                $rating = round($rating_row["rating"]);
            }
            
               ?>


              <div class="d-flex align-items-center py-2 border-bottom"><a class="d-block flex-shrink-0" href="details?id=<?php echo $row["id_producto"]; ?>">
              <?php
                echo '    <img src="' . htmlspecialchars($foto_url) . '" width="64" alt="Product">' 
                ?>
            </a>
                <div class="ps-2">
                  <h6 class="widget-product-title"><a href="details?id=<?php echo $row["id_producto"]; ?>"><?php echo $row["nombre"]; ?></a></h6>
                  <div class="widget-product-meta"><span class="text-accent">$ <span><?php echo $row["precio"]; ?></span></span></div>
                </div>
              </div>


              <?php
    }
} else {
    echo "0 resultados";
}
                    ?>


<div class="mt-3 text-center">
              <a class="fs-sm " href="products">Ver más<i class="ci-arrow-right fs-xs ms-1"></i></a></div>
            </div>
          </div>








    




          <!-- New arrivals-->
          <div class="col-md-4 col-sm-6 mb-2 py-3">
            <div class="widget">
              <h3 class="widget-title">Recientes</h3>



              <?php
       $sql = "SELECT * FROM productos WHERE stock > 0 ORDER BY id_producto DESC LIMIT 4";
      
       $result = $conn->query($sql);
       
       if ($result->num_rows > 0) {
           // Muestra los resultados de la primera consulta utilizando la plantilla HTML
           while($row = $result->fetch_assoc()) {
            $foto_url = "";
            $sql = "SELECT * FROM fotos_productos WHERE id_producto = " . $row["id_producto"] . " LIMIT 1";
            $fotos_result = $conn->query($sql);
            if ($fotos_result->num_rows > 0) {
                $foto_row = $fotos_result->fetch_assoc();
                $foto_url = $foto_row["foto_url"];
            }
    
            // Calcula la calificación promedio del producto
            $rating = 0;
            $sql = "SELECT AVG(estrellas) as rating FROM comentarios_productos WHERE id_producto = " . $row["id_producto"];
            $rating_result = $conn->query($sql);
            if ($rating_result->num_rows > 0) {
                $rating_row = $rating_result->fetch_assoc();
                $rating = round($rating_row["rating"]);
            }
            
               ?>


              <div class="d-flex align-items-center py-2 border-bottom"><a class="d-block flex-shrink-0" href="details?id=<?php echo $row["id_producto"]; ?>">
              <?php
                echo '    <img src="' . htmlspecialchars($foto_url) . '" width="64" alt="Product">' 
                ?>
            </a>
                <div class="ps-2">
                  <h6 class="widget-product-title"><a href="details?id=<?php echo $row["id_producto"]; ?>"><?php echo $row["nombre"]; ?></a></h6>
                  <div class="widget-product-meta"><span class="text-accent">$ <span><?php echo $row["precio"]; ?></span></span></div>
                </div>
              </div>


              <?php
    }
} else {
    echo "0 resultados";
}
                    ?>


<div class="mt-3 text-center">
              <a class="fs-sm " href="products">Ver más<i class="ci-arrow-right fs-xs ms-1"></i></a></div>
            </div>
          </div>





         








          <!-- Top rated-->
          <div class="col-md-4 col-sm-6 mb-2 py-3">
            <div class="widget">
              <h3 class="widget-title">Destacados</h3>



              <?php
      $sql = "SELECT p.*, (SELECT AVG(estrellas) FROM comentarios_productos WHERE id_producto = p.id_producto) as rating FROM productos p WHERE stock > 0 ORDER BY rating DESC LIMIT 4";

      
       $result = $conn->query($sql);
       
       if ($result->num_rows > 0) {
           // Muestra los resultados de la primera consulta utilizando la plantilla HTML
           while($row = $result->fetch_assoc()) {
            $foto_url = "";
            $sql = "SELECT * FROM fotos_productos WHERE id_producto = " . $row["id_producto"] . " LIMIT 1";
            $fotos_result = $conn->query($sql);
            if ($fotos_result->num_rows > 0) {
                $foto_row = $fotos_result->fetch_assoc();
                $foto_url = $foto_row["foto_url"];
            }
    
            // Calcula la calificación promedio del producto
            $rating = 0;
            $sql = "SELECT AVG(estrellas) as rating FROM comentarios_productos WHERE id_producto = " . $row["id_producto"];
            $rating_result = $conn->query($sql);
            if ($rating_result->num_rows > 0) {
                $rating_row = $rating_result->fetch_assoc();
                $rating = round($rating_row["rating"]);
            }
            
               ?>


              <div class="d-flex align-items-center py-2 border-bottom"><a class="d-block flex-shrink-0" href="details?id=<?php echo $row["id_producto"]; ?>">
              <?php
                echo '    <img src="' . htmlspecialchars($foto_url) . '" width="64" alt="Product">' 
                ?>
            </a>
                <div class="ps-2">
                  <h6 class="widget-product-title"><a href="details?id=<?php echo $row["id_producto"]; ?>"><?php echo $row["nombre"]; ?></a></h6>
                  <div class="widget-product-meta"><span class="text-accent">$ <span><?php echo $row["precio"]; ?></span></span></div>
                </div>
              </div>


              <?php
    }
} else {
    echo "0 resultados";
}
                    ?>


<div class="mt-3 text-center">
              <a class="fs-sm " href="products">Ver más<i class="ci-arrow-right fs-xs ms-1"></i></a></div>
            </div>
          </div>





        </div>
      </section>








       <!-- Reviews-->
       <section class="container mt-5 pb-4 pb-md-5 d-none">
        <div class="d-flex flex-wrap justify-content-between align-items-center pt-1 border-bottom pb-4 mb-4">
          <h2 style="font-weight: 600 !important;" class="h3 mb-0 pt-3 me-2">Opiniones</h2>
          <div class="pt-3"><a class="btn pt-2 pb-2 rounded-3 shadow" style="background-color: rgb(37, 180, 80); color:white;" data-bs-target="#review_cmo" data-bs-toggle="modal">Comentar<i class="ci-arrow-right ms-1 me-n1"></i></a></div>
        </div>
          <div class="tns-carousel mb-3">
            <div class="tns-outer" id="tns4-ow"><div class="tns-liveregion tns-visually-hidden" aria-live="polite" aria-atomic="true">slide <span class="current">12 to 14</span>  of 6</div><div id="tns4-mw" class="tns-ovh"><div class="tns-inner" id="tns4-iw"><div class="tns-carousel-inner  tns-slider tns-carousel tns-subpixel tns-calc tns-horizontal" data-carousel-options="{&quot;items&quot;: 2, &quot;gutter&quot;: 20, &quot;controls&quot;: false, &quot;autoplay&quot;: true, &quot;autoplayTimeout&quot;: 5000, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1}, &quot;576&quot;:{&quot;items&quot;:2},&quot;1200&quot;:{&quot;items&quot;:3},&quot;1560&quot;:{&quot;items&quot;:4}}}" id="tns4" style="transform: translate3d(-55%, 0px, 0px); transition-duration: 0s;">
            
            
            



            <?php




// Prepara la consulta SQL para seleccionar los comentarios del producto
$sql = "SELECT * FROM comentarios";

// Ejecuta la consulta
$result = $conn->query($sql);

// Verifica si se encontraron comentarios
if ($result->num_rows > 0) {
    // Muestra los comentarios del producto
    while ($row = $result->fetch_assoc()) {
?>



            
            <blockquote class="mb-2 tns-item tns-slide-cloned" aria-hidden="true" tabindex="-1">
                <div class="card dark border-0">
                  <div class="card-body px-3 fs-md text-muted">
                    <div class="mb-2">
                      <div class="star-rating"><?php for ($i = 1; $i <= 5; $i++): ?>
                    <?php if ($i <= $row["estrellas"]): ?>
                        <i class="star-rating-icon ci-star-filled active"></i>
                    <?php else: ?>
                        <i class="star-rating-icon ci-star"></i>
                    <?php endif; ?>
                <?php endfor; ?>
                      </div>
                    </div><?php echo htmlspecialchars($row["comentario"]); ?>
                  </div>
                </div>
                <footer class="d-flex justify-content-left align-items-left pt-4"><img class="rounded-circle" src="img/logo.svg" width="50" alt="Logo">
                  <div class="ps-3">
                    <h6 class="fs-sm mb-n1"><?php echo htmlspecialchars($row["nombre_cliente"]); ?></h6><span class="fs-ms text-muted opacity-75"></span>
                  </div>
                </footer>
              </blockquote>
              
              
              
  
     


                 
          <?php
    }
} else {
  ?>
   
    <div>

    <img class="img-fluid" style="width:200px !important;" src="img/comentarios.svg">

    </div>
    
    


    <?php
}

?>
               
            
            
            
            
            
            
            
            
               </div>
     
          
     </div></div></div>
     </div>



        </section>

  




        <style>
.support-chat .card-body {
    height: 27rem;
}
.scrollbar, .offcanvas.faq-sidebar, .tox .tox-toolbar--scrolling, .picmo__picker.picmo__picker .picmo__emojiArea, html:not(.navbar-vertical-collapsed) .navbar-vertical .navbar-vertical-content, .scrollbar-overlay {
    overflow: auto;
}.flex-column-reverse {
    -webkit-box-orient: vertical !important;
    -webkit-box-direction: reverse !important;
    -ms-flex-direction: column-reverse !important;
    flex-direction: column-reverse !important;
}
          .support-chat-container{display:none}.support-chat-container.show{display:block}.support-chat{position:fixed;bottom:3rem;right:0;max-width:27.87rem;width:100%;-webkit-transform:scale(0);-ms-transform:scale(0);transform:scale(0);opacity:0;-webkit-transform-origin:bottom right;-ms-transform-origin:bottom right;transform-origin:bottom right;z-index:1045;-webkit-transition:.3s ease-out;-o-transition:.3s ease-out;transition:.3s ease-out;padding-bottom:3rem}.support-chat-start .support-chat{right:auto;left:0;-webkit-transform-origin:bottom left;-ms-transform-origin:bottom left;transform-origin:bottom left}.support-chat-bottom-lg .support-chat{bottom:5rem}@media(min-width: 576px){.support-chat{right:1rem}.support-chat-start .support-chat{left:1rem}}@media(min-width: 992px){.support-chat{right:2rem}.support-chat-start .support-chat{left:2rem}}.support-chat .card{-webkit-box-shadow:0px 0px 32px 0px rgba(36,40,46,.12);box-shadow:0px 0px 32px 0px rgba(36,40,46,.12)}.dark .support-chat .card{-webkit-box-shadow:0px 0px 32px 10px rgba(0,0,0,.41);box-shadow:0px 0px 32px 10px rgba(0,0,0,.41)}.support-chat .card-body{height:27rem}.support-chat.show-chat{-webkit-transform:scale(1);-ms-transform:scale(1);transform:scale(1);opacity:1}.support-chat .send-btn{width:37.06px;height:37.06px;border-radius:50%;}.support-chat+.btn-support-chat{position:fixed;bottom:2.5rem;right:1rem;width:9rem;height:3rem;display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;-webkit-box-align:center;-ms-flex-align:center;align-items:center;overflow:hidden; z-index:1045; -webkit-box-shadow:0px 0px 32px 0px rgba(36,40,46,.12);box-shadow:0px 0px 32px 0px rgba(36,40,46,.12);-webkit-transition:.3s ease;-o-transition:.3s ease;transition:.3s ease}.dark .support-chat+.btn-support-chat,.dark .picmo__popupContainer.picmo__light .support-chat+.btn-support-chat{-webkit-box-shadow:0px 0px 32px 10px rgba(0,0,0,.41);box-shadow:0px 0px 32px 10px rgba(0,0,0,.41)}.support-chat-start .support-chat+.btn-support-chat{right:auto;left:1rem}.support-chat-bottom-lg .support-chat+.btn-support-chat{bottom:4.5rem}@media(min-width: 576px){.support-chat+.btn-support-chat{right:2rem}.support-chat-start .support-chat+.btn-support-chat{left:2rem}}@media(min-width: 992px){.support-chat+.btn-support-chat{right:3rem}.support-chat-start .support-chat+.btn-support-chat{left:3rem}}.support-chat+.btn-support-chat .fa-chevron-down{display:none}.support-chat+.btn-support-chat.btn-chat-close{border-radius:50%;width:3rem}.support-chat+.btn-support-chat.btn-chat-close .btn-text,.support-chat+.btn-support-chat.btn-chat-close .fa-circle{display:none}.support-chat+.btn-support-chat.btn-chat-close .fa-chevron-down{display:block}.kanban-content{position:fixed;padding-top:var(--phoenix-navbar-top-height);padding-left:0 !important;padding-right:0 !important;left:0;right:0}

        </style>
        

        <div class="support-chat-container show">
        <div class="container-fluid support-chat">
          <div class="card rounded-4 bg-white">
            
            <div class="card-body chat p-0">
              <div class="d-flex flex-column-reverse scrollbar h-100 p-3">




              <div  id="chatContainer"></div>


              <?php

if (isset($_SESSION['user_id'])) {
  $id_user = $_SESSION['user_id']; // Obtén el id de la sesión si existe
} else {
  $id_user = 0; // Si no existe la sesión, asigna 0 a $id_user
}
// Consulta SQL para obtener todos los mensajes de la empresa actual
$sql = "
    (SELECT mensaje_o AS mensaje, fecha_sms_o AS fecha, 'operador' AS tipo FROM sms_o WHERE id_user_send = $id_user)
    UNION ALL
    (SELECT mensaje_c AS mensaje, fecha_sms_c AS fecha, 'cliente' AS tipo FROM sms_c WHERE id_user = $id_user)
    ORDER BY fecha DESC
";

$result = $conn->query($sql);

// Clave de cifrado - asegúrate de que esta clave sea segura y no la compartas
$clave_cifrado = 'clave-secreta';

// Verifica si se encontraron mensajes
if ($result->num_rows > 0) {
    // Muestra los mensajes
    while ($row = $result->fetch_assoc()) {
        // Descifra el mensaje
        $mensaje_descifrado = openssl_decrypt($row["mensaje"], 'AES-128-ECB', $clave_cifrado);

        // Verifica el tipo de mensaje y muestra el mensaje correspondiente
        if ($row["tipo"] == 'operador') {
          ?>



                <div class="text-start">
                <a style="max-width: 70%; background-color: rgb(37, 180, 80);" class="mb-2 d-inline-flex align-items-center text-decoration-none text-1100 text-light rounded-3 py-2 ps-4 pe-3">
                    <p class="mb-0 fw-semi-bold"><?php echo $mensaje_descifrado; ?></p>
                  </a></div>
                
                 

                  <?php
        } else {
          ?>

              


          <div class="text-end">
           <a style="max-width: 70%; border-width: 1px; border-style: solid; border-color: rgb(255,138,0);" class="mb-2 d-inline-flex align-items-center text-decoration-none text-1100  rounded-3 py-2 ps-4 pe-3">
               <p style="color: rgb(255,138,0);" class="mb-0 text-start fw-semi-bold"><?php echo $mensaje_descifrado; ?></p>
             </a></div>
           
            
             <?php
        }
    }
}


?>




               <div class="text-start">
                <a style="max-width: 70%; background-color: rgb(37, 180, 80);" class="mb-2 d-inline-flex align-items-center text-decoration-none text-1100 text-light rounded-3 py-2 ps-4 pe-3">
                    <p class="mb-0 fw-semi-bold fs-xs">Bienvenido a nuestra plataforma! Preguntenos cualquier duda o sugerencia que tenga, estaremos encantados de atenderlo.</p>
                  </a></div>


                

                  <center>
                  <div style="width:80%" class="d-block px-3  pb-4">



                  <img src="img/logo.svg" width="50" alt="Logo">
                  
               <p style="font-size: 16px !important;" class="mb-0 fw-bold">Masqfresco</p>
               <p class="fs--xs">En que podemos ayudarle?</p>
              
                  </div> </center>

                 
              </div>
            </div>



            <?php

// Verifica si el usuario ha iniciado sesión
if (isset($_SESSION['user_id'])) {
    // Muestra el formulario si el usuario ha iniciado sesión
    ?>
            <div class="card-footer d-flex align-items-center gap-2 border-top  py-3">
              <div class="d-flex align-items-center flex-1 gap-3 border w-100 rounded-pill px-4">
                <form action="funtions" id="formsmsc" method="post" enctype="multipart/form-data">

                  <input type="hidden" name="form_name" value="form_sms_c">


              <input class="form-control outline-none border-0 px-0 w-100" name="mensaje_c" type="text" placeholder="Escribe tu mensaje" required>
              
             </div>
                
                <button class="btn p-2 border-0 send-btn" type="submit"><svg style="color: rgb(255,138,0);" class="svg-inline--fa fa-paper-plane fs-xs" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="paper-plane" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M511.6 36.86l-64 415.1c-1.5 9.734-7.375 18.22-15.97 23.05c-4.844 2.719-10.27 4.097-15.68 4.097c-4.188 0-8.319-.8154-12.29-2.472l-122.6-51.1l-50.86 76.29C226.3 508.5 219.8 512 212.8 512C201.3 512 192 502.7 192 491.2v-96.18c0-7.115 2.372-14.03 6.742-19.64L416 96l-293.7 264.3L19.69 317.5C8.438 312.8 .8125 302.2 .0625 289.1s5.469-23.72 16.06-29.77l448-255.1c10.69-6.109 23.88-5.547 34 1.406S513.5 24.72 511.6 36.86z"></path></svg><!-- <span class="fa-solid fa-paper-plane fs--1"></span> Font Awesome fontawesome.com --></button>
                
              </form>
              </div>


              <?php
} else {
  ?>

<div class="px-4 py-3 text-center">
<p>Inicia sesión para poder enviarnos un mensaje <span><a class="text-primary" href="login">Click aqui!</a></span></p>
</div>

<?php
}
    ?>




          </div>

        </div>
        
        



        <button style="background-color: rgb(255,138,0);" class="btn mb-4 rounded-pill shadow btn-support-chat"><span class="fs-0 btn-text text-light text-nowrap me-2">Chat</span><i class="ci-message text-light" style="font-size: 20px;"></i></button>



        <script>
 (function() {
    $('#formsmsc').on('submit', function(e) {
        e.preventDefault();

        // Obtén el mensaje del campo de entrada
        var mensaje = $('input[name="mensaje_c"]').val();

        // Crea los elementos HTML necesarios
        var mensajeElement = $('<div class="text-end"><a style="max-width: 70%; border-width: 1px; border-style: solid; border-color: rgb(255,138,0);" class="mb-2 d-inline-flex align-items-center text-decoration-none text-1100  rounded-3 py-2 ps-4 pe-3"><p style="color: rgb(255,138,0);" class="mb-0 text-start fw-semi-bold fs-xs"></p></a></div>');

        // Añade el mensaje al elemento <p>
        mensajeElement.find('p').text(mensaje);

        // Añade el nuevo mensaje al contenedor del chat
        $('#chatContainer').append(mensajeElement);

        // Crea un objeto FormData con los datos del formulario
        var formData = new FormData(this);

        $.ajax({
            type: 'post',
            url: 'funtions.php',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                // Aquí puedes manejar la respuesta del servidor
                console.log(response);
                
                // Borrar el contenido del campo de entrada
                $('input[name="mensaje_c"]').val('');
            }
        });
    });
})();

</script>

                  <!-- Mensaje que se mostrará encima del botón del chat -->
                  <div id="devMessage" class="shadow p-3 bg-light" style="position: fixed; bottom: 5rem; right: 1rem; display: none; margin-bottom: 50px; margin-right: 40px; border-radius: 10px 10px 0px 10px; z-index: 9999; max-width: 250px;">
<p class="mb-0 text-dark">👋 Hola, en que podemos ayudarle? 😊</p>
</div>



<script>
window.addEventListener('load', function() {
    var devMessage = document.getElementById('devMessage');
   

    // Muestra el mensaje y reproduce el sonido después de 3 segundos
    setTimeout(function() {
        devMessage.style.display = 'block';
      
    }, 3000);

    // Oculta el mensaje después de otros 3 segundos
    setTimeout(function() {
        devMessage.style.display = 'none';
    }, 10000);
});
</script>

     
</main>





























    
    <!-- Footer-->
    <footer class="footer bg-dark pt-5">
      <div class="container">
        <div class="row py-4">
          <div class="col-md-4 col-12 text-center text-md-start">
            <img src="img/logo.svg" width="60" alt="Logo">

            <h2 class="widget-title text-light mt-4">Masqfresco.com</h2>
            <p class="text-light">contacta@masqfresco.com</p>
            
               
                <div class="mb-4">
                <div class="btn-group dropdown disable-autohide">
                  <button class="btn btn-outline-light border-light btn-sm dropdown-toggle px-2" type="button" data-bs-toggle="dropdown">Idiomas</button>
                  <ul class="dropdown-menu my-1">
                    

                  <li><a class="dropdown-item pb-1" href="https://www-masqfresco-com.translate.goog/?_x_tr_sl=auto&_x_tr_tl=en&_x_tr_hl=es-419&_x_tr_pto=wapp"><img class="me-2" src="img/en.png" width="20" alt="Français">English</a></li>
                    <li><a class="dropdown-item pb-1" href="https://www-masqfresco-com.translate.goog/?_x_tr_sl=auto&_x_tr_tl=fr&_x_tr_hl=es-419&_x_tr_pto=wapp"><img class="me-2" src="img/fr.png" width="20" alt="Français">Français</a></li>
                    <li><a class="dropdown-item pb-1" href="https://www-masqfresco-com.translate.goog/?_x_tr_sl=auto&_x_tr_tl=de&_x_tr_hl=es-419&_x_tr_pto=wapp"><img class="me-2" src="img/de.png" width="20" alt="Deutsch">Deutsch</a></li>
                    <li><a class="dropdown-item" href="https://www-masqfresco-com.translate.goog/?_x_tr_sl=auto&_x_tr_tl=it&_x_tr_hl=es-419&_x_tr_pto=wapp"><img class="me-2" src="img/it.png" width="20" alt="Italiano">Italiano</a></li>
                  </ul>
                </div>
                <a class="btn-social bs-light bs-instagram ms-2 mb-2" href="https://www.instagram.com/masqfresco/"><i class="ci-instagram"></i></a>
                <a class="btn-social bs-light bs-facebook ms-2 mb-2" href="https://www.facebook.com/profile.php?id=100091620391062&mibextid=LQQJ4d"><i class="ci-facebook"></i></a>
                <a class="btn-social bs-light bs-youtube ms-2 mb-2" href="https://www.youtube.com/@MasQFresco"><i class="ci-youtube"></i></a>
              </div>
             
          </div>
          <div class="col-md-4 col-6">
            <div class="widget widget-links widget-light pb-2 mb-4">
              <h2 class="widget-title text-light">Enlaces</h2>
              <ul class="widget-list">
                <li class="widget-list-item"><a class="widget-list-link" href="https://masqfresco.com/profile">Mi cuenta</a></li>
                <li class="widget-list-item"><a class="widget-list-link" href="https://masqfresco.com/products">Productos</a></li>
                </ul>
            </div>
            <div class="widget widget-links widget-light pb-2 mb-4">
              <h2 class="widget-title text-light">Nosotros</h2>
              <ul class="widget-list">
      
                <li class="widget-list-item"><a class="widget-list-link" href="https://masqfresco.com/terms">Términos de uso</a></li>
      
              
              </ul>
            </div>
          </div>
          <div class="col-md-4 col-6">
            

          <div class="widget widget-links widget-light pb-2 mb-4">
              <h2 class="widget-title text-light">Categorías</h2>
              <ul class="widget-list">

              <?php



// Consulta para seleccionar los nombres de las categorías
$sql = "SELECT nombre_categoria FROM categorias LIMIT 10";
$result = $db->query($sql);

// Mostrar los resultados
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      ?>


<li class="widget-list-item"><a class="widget-list-link"><?php echo $row["nombre_categoria"]; ?></a></li>




        <?php

    }
} else {
    echo "No se encontraron resultados";
}

?>
            
 
 
             
              </ul>
            </div>



            
          </div>
        </div>
      </div>
      <div class="bg-darker pt-4 pb-5">
        <div class="container">
          <div class="row">
            <div class="col-md-6 text-center text-md-start">
              
            <div class="pb-4 text-light opacity-50 text-center text-md-start">© All rights reserved. Powered by <a class="text-light" href="https://www.uixsoftware.com/" target="_blank" rel="noopener">Uixsoftware</a></div>
              
            </div>
            <div class="col-md-6 text-center text-md-end">
            
          </div>
         
        </div>
      </div>
    </footer>

   

        <!-- Toolbar for handheld devices (Default)-->
        <div class="handheld-toolbar">
          <div class="d-table table-layout-fixed w-100"><a class="d-table-cell handheld-toolbar-item" href="index"><span class="handheld-toolbar-icon"><i class="ci-home"></i></span><span class="handheld-toolbar-label">Inicio</span></a>
            
            <a class="d-table-cell handheld-toolbar-item" href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" onclick="window.scrollTo(0, 0)"><span class="handheld-toolbar-icon"><i class="ci-menu"></i></span><span class="handheld-toolbar-label">Menu</span></a>
            
            <a class="d-table-cell handheld-toolbar-item" href="#" ><span class="handheld-toolbar-icon" data-bs-toggle="offcanvas" data-bs-target="#shop-sidebar"><i class="ci-cart"></i><span style="background-color: rgb(37, 180, 80);" class="badge rounded-pill"><?php
                // Asumiendo que tienes el ID del usuario en una variable $id_usuari<?php

if (isset($_SESSION['user_id'])) {
  // Asumiendo que tienes el ID del usuario en una variable $id_usuario
  $id_usuario = $_SESSION['user_id'];

  // Crear la consulta SQL para contar cuántos productos tiene el usuario en su carrito
  $sql = "SELECT COUNT(*) FROM carrito WHERE id_usuario = $id_usuario";

  // Ejecutar la consulta y obtener el resultado
  $resultado = mysqli_query($db, $sql);
  $fila = mysqli_fetch_assoc($resultado);
  $numero_productos = $fila['COUNT(*)'];

  // Mostrar el número de productos al usuario
  echo $numero_productos;

} else {
  // El usuario no ha iniciado sesión, muestra un mensaje de advertencia
  echo "!";
}
?></span></span><span class="handheld-toolbar-label"><?php

if (isset($_SESSION['user_id'])) {
            // Asumiendo que tienes el ID del usuario en una variable $id_usuario
            $id_usuario = $_SESSION['user_id'];// Reemplaza esto con el ID del usuario real

            // Crear la consulta SQL para calcular el total de la compra del usuario
            $sql = "SELECT SUM(productos.precio * carrito.cantidad) AS total FROM carrito INNER JOIN productos ON carrito.id_producto = productos.id_producto WHERE carrito.id_usuario = $id_usuario";

            // Ejecutar la consulta y obtener el resultado
            $resultado = mysqli_query($db, $sql);
            $fila = mysqli_fetch_assoc($resultado);
            $total = $fila['total'];

            // Mostrar el total al usuario
            echo '$' . number_format($total, 2);

          } else {
            // El usuario no ha iniciado sesión, muestra un mensaje de advertencia
            echo "$ 00.00";
          }
        ?></span></a></div>
        </div>



    <!-- Back To Top Button--><a class="btn-scroll-top" href="#top" data-scroll=""><span class="btn-scroll-top-tooltip text-muted fs-sm me-2">Top</span><i class="btn-scroll-top-icon ci-arrow-up">   </i></a>
    <!-- Vendor scrits: js libraries and plugins-->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/simplebar.min.js"></script>
    <script src="js/tiny-slider.js"></script>
    <script src="js/smooth-scroll.polyfills.min.js"></script>
    <script src="js/Drift.min.js"></script>
    <script src="js/lightgallery.min.js"></script>
    <script src="js/lg-video.min.js"></script>



    <script src="js/lodash.min.js"></script>
    <script src="js/uixsoftware.js"></script>

    <!-- Main theme script-->
    <script src="js/theme.min.js"></script>
        <div class="lg-container  " id="lg-container-1" tabindex="-1" aria-modal="true" role="dialog">
            <div id="lg-backdrop-1" class="lg-backdrop" style="transition-duration: 300ms;"></div>

            <div id="lg-outer-1" class="lg-outer lg-use-css3 lg-css3 lg-single-item lg-slide lg-grab">

              <div id="lg-content-1" class="lg-content">
                <div id="lg-inner-1" class="lg-inner" style="transition-timing-function: ease; transition-duration: 400ms;">
                </div>
                <button type="button" id="lg-prev-1" aria-label="Previous slide" class="lg-prev lg-icon">  </button>
                <button type="button" id="lg-next-1" aria-label="Next slide" class="lg-next lg-icon">  </button>
              </div>
                <div id="lg-toolbar-1" class="lg-toolbar lg-group">
                    
                    <button type="button" aria-label="Close gallery" id="lg-close-1" class="lg-close lg-icon"></button>
                    <div class="lg-counter" role="status" aria-live="polite">
                <span id="lg-counter-current-1" class="lg-counter-current">1 </span> /
                <span id="lg-counter-all-1" class="lg-counter-all">1 </span></div></div>
                    
                <div id="lg-components-1" class="lg-components">
                    <div class="lg-sub-html" role="status" aria-live="polite"></div>
                </div>
            </div>
        </div>
        
        <div class="lg-container  " id="lg-container-2" tabindex="-1" aria-modal="true" role="dialog">
            <div id="lg-backdrop-2" class="lg-backdrop" style="transition-duration: 300ms;"></div>

            <div id="lg-outer-2" class="lg-outer lg-use-css3 lg-css3 lg-single-item lg-slide lg-grab">

              <div id="lg-content-2" class="lg-content">
                <div id="lg-inner-2" class="lg-inner" style="transition-timing-function: ease; transition-duration: 400ms;">
                </div>
                <button type="button" id="lg-prev-2" aria-label="Previous slide" class="lg-prev lg-icon">  </button>
                <button type="button" id="lg-next-2" aria-label="Next slide" class="lg-next lg-icon">  </button>
              </div>
                <div id="lg-toolbar-2" class="lg-toolbar lg-group">
                    
                    <button type="button" aria-label="Close gallery" id="lg-close-2" class="lg-close lg-icon"></button>
                    <div class="lg-counter" role="status" aria-live="polite">
                <span id="lg-counter-current-2" class="lg-counter-current">1 </span> /
                <span id="lg-counter-all-2" class="lg-counter-all">1 </span></div></div>
                    
                <div id="lg-components-2" class="lg-components">
                    <div class="lg-sub-html" role="status" aria-live="polite"></div>
                </div>
            </div>
        </div>
        
        <div class="lg-container  " id="lg-container-3" tabindex="-1" aria-modal="true" role="dialog">
            <div id="lg-backdrop-3" class="lg-backdrop" style="transition-duration: 300ms;"></div>

            <div id="lg-outer-3" class="lg-outer lg-use-css3 lg-css3 lg-single-item lg-slide lg-grab">

              <div id="lg-content-3" class="lg-content">
                <div id="lg-inner-3" class="lg-inner" style="transition-timing-function: ease; transition-duration: 400ms;">
                </div>
                <button type="button" id="lg-prev-3" aria-label="Previous slide" class="lg-prev lg-icon">  </button>
                <button type="button" id="lg-next-3" aria-label="Next slide" class="lg-next lg-icon">  </button>
              </div>
                <div id="lg-toolbar-3" class="lg-toolbar lg-group">
                    
                    <button type="button" aria-label="Close gallery" id="lg-close-3" class="lg-close lg-icon"></button>
                    <div class="lg-counter" role="status" aria-live="polite">
                <span id="lg-counter-current-3" class="lg-counter-current">1 </span> /
                <span id="lg-counter-all-3" class="lg-counter-all">1 </span></div></div>
                    
                <div id="lg-components-3" class="lg-components">
                    <div class="lg-sub-html" role="status" aria-live="polite"></div>
                </div>
            </div>
        </div>
        
        <div class="lg-container  " id="lg-container-4" tabindex="-1" aria-modal="true" role="dialog">
            <div id="lg-backdrop-4" class="lg-backdrop" style="transition-duration: 300ms;"></div>

            <div id="lg-outer-4" class="lg-outer lg-use-css3 lg-css3 lg-single-item lg-slide lg-grab">

              <div id="lg-content-4" class="lg-content">
                <div id="lg-inner-4" class="lg-inner" style="transition-timing-function: ease; transition-duration: 400ms;">
                </div>
                <button type="button" id="lg-prev-4" aria-label="Previous slide" class="lg-prev lg-icon">  </button>
                <button type="button" id="lg-next-4" aria-label="Next slide" class="lg-next lg-icon">  </button>
              </div>
                <div id="lg-toolbar-4" class="lg-toolbar lg-group">
                    
                    <button type="button" aria-label="Close gallery" id="lg-close-4" class="lg-close lg-icon"></button>
                    <div class="lg-counter" role="status" aria-live="polite">
                <span id="lg-counter-current-4" class="lg-counter-current">1 </span> /
                <span id="lg-counter-all-4" class="lg-counter-all">1 </span></div></div>
                    
                <div id="lg-components-4" class="lg-components">
                    <div class="lg-sub-html" role="status" aria-live="polite"></div>
                </div>
            </div>
        </div>
        
   
</body></html>

<?php
// Cierra la conexión cuando hayas terminado
$conn->close();
?>
