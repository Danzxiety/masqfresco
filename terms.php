<?php
session_start();
// Incluye el archivo con las constantes de la base de datos
include 'config.php';

// Crea la conexión
$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
// Verifica si la conexión es exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
} ?>




<?php
// Verifica si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if ($_POST["form_name"] == "form_use") {
    // Obtén los datos del usuario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo_electronico = $_POST['correo_electronico'];
    $contrasena = $_POST['contrasena'];
    $numero_telefono = $_POST['numero_telefono'];

    // Encripta la contraseña del usuario
    $contrasena_encriptada = password_hash($contrasena, PASSWORD_DEFAULT);

    // Prepara la consulta SQL
    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, apellido, correo_electronico, contrasena, numero_telefono) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nombre, $apellido, $correo_electronico, $contrasena_encriptada, $numero_telefono);
    
    // Ejecuta la consulta
    if ($stmt->execute()) {






 
        ?>
   
      
   <script>
    // Función para mostrar la ventana emergente durante 5 segundos
    function showPopup() {
        // Obtiene el contenedor de la ventana emergente
        var popupContainer = document.querySelector('.popup-container');
        
        // Muestra el contenedor de la ventana emergente
        popupContainer.style.display = 'flex';
        
        // Después de 5 segundos, oculta el contenedor de la ventana emergente
        setTimeout(function() {
            popupContainer.style.display = 'none';
        }, 5000);
    }
    
    // Ejemplo de cómo llamar a la función showPopup() cuando se cumpla una condición específica
    // Reemplaza "true" por tu condición específica
    
   
  </script>
  <style>
    /* Contenedor de la ventana emergente */
    .popup-container {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }
  
    /* Ventana emergente */
    .popup {
        background-color: white;
        color: black;
        padding: 15px;
        border-radius: 6px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.300);
        text-align: center;
        /* Animación para mostrar y ocultar la ventana emergente */
        animation: popup-animation 3s forwards;
    }
  
    /* Animación para mostrar y ocultar la ventana emergente */
    @keyframes popup-animation {
        /* Al inicio de la animación, la ventana emergente está oculta */
        0% {
            opacity: 0;
            transform: scale(0.5);
        }
        /* A los 2 segundos, la ventana emergente se muestra */
        40% {
            opacity: 1;
            transform: scale(1);
        }
        /* A los 4 segundos, la ventana emergente sigue mostrándose */
        80% {
            opacity: 1;
            transform: scale(1);
        }
        /* Al final de la animación, la ventana emergente se oculta */
        100% {
            opacity: 0;
            transform: scale(0.5);
        }
    }
  </style>

        <div class="popup-container" style="display:none;">
       <!-- Ventana emergente -->
        <div class="popup">
         <p>Su cuenta ah sido creada satisfactoriamente</p>
        </div>
        </div>
  
        <script>  showPopup();</script>
        <?php









    } else {
      ?>
      <div class="bg-danger text-light text-center pt-1 pb-1"> 
        <p class="mb-0">Upss, hubo un error</p>
        <?php
        echo "Error: " . $stmt->error;
        ?>
      </div>
      <?php
    }
  }
}
?>




<?php
// Muestra mensajes de error
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Verifica si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if ($_POST["form_name"] == "form_login") {
    // Obtén los datos del usuario
    $nombre = $_POST['nombre'];
    $contrasena = $_POST['contrasena'];

    // Prepara la consulta SQL
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE nombre = ?");
    $stmt->bind_param("s", $nombre);
    
    // Ejecuta la consulta
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Verifica si el usuario existe en la base de datos
    if ($result->num_rows > 0) {
      // Obtén los datos del usuario
      $user = $result->fetch_assoc();
      
      // Verifica si la contraseña es correcta
      if (password_verify($contrasena, $user['contrasena'])) {
        // Guarda los datos del usuario en la sesión
        $_SESSION['user_id'] = $user['id_user'];
        $_SESSION['user_nombre'] = $user['nombre'];
        

        ?>
   
      
   <script>
    // Función para mostrar la ventana emergente durante 5 segundos
    function showPopup() {
        // Obtiene el contenedor de la ventana emergente
        var popupContainer = document.querySelector('.popup-container');
        
        // Muestra el contenedor de la ventana emergente
        popupContainer.style.display = 'flex';
        
        // Después de 5 segundos, oculta el contenedor de la ventana emergente
        setTimeout(function() {
            popupContainer.style.display = 'none';
        }, 5000);
    }
    
    // Ejemplo de cómo llamar a la función showPopup() cuando se cumpla una condición específica
    // Reemplaza "true" por tu condición específica
    
   
  </script>
  <style>
    /* Contenedor de la ventana emergente */
    .popup-container {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }
  
    /* Ventana emergente */
    .popup {
        background-color: white;
        color: black;
        padding: 15px;
        border-radius: 6px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.300);
        text-align: center;
        /* Animación para mostrar y ocultar la ventana emergente */
        animation: popup-animation 3s forwards;
    }
  
    /* Animación para mostrar y ocultar la ventana emergente */
    @keyframes popup-animation {
        /* Al inicio de la animación, la ventana emergente está oculta */
        0% {
            opacity: 0;
            transform: scale(0.5);
        }
        /* A los 2 segundos, la ventana emergente se muestra */
        40% {
            opacity: 1;
            transform: scale(1);
        }
        /* A los 4 segundos, la ventana emergente sigue mostrándose */
        80% {
            opacity: 1;
            transform: scale(1);
        }
        /* Al final de la animación, la ventana emergente se oculta */
        100% {
            opacity: 0;
            transform: scale(0.5);
        }
    }
  </style>

        <div class="popup-container" style="display:none;">
       <!-- Ventana emergente -->
        <div class="popup">
         <?php echo "Bienvenido a nuestra tienda " . $_SESSION['user_nombre'];?>
        </div>
        </div>
  
        <script>  showPopup();</script>
        <?php





      } else {
        // La contraseña es incorrecta
        ?>
        <div class="bg-danger text-light text-center pt-1 pb-1"> 
          <p class="mb-0">La contraseña es incorrecta</p>
        </div>
        <?php
      }
    } else {
      // El usuario no existe en la base de datos
      ?>
      <div class="bg-danger text-light text-center pt-1 pb-1"> 
        <p class="mb-0">El usuario no existe</p>
      </div>
      <?php
    }
  }
}
?>

<?php
// Verifica si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if ($_POST["form_name"] == "remove_from_cart") {
    // Obtén los datos del formulario
    $id_usuario = $_SESSION['user_id'];
    $id_producto = $_POST['id_producto'];

    // Prepara la consulta SQL
    $stmt = $conn->prepare("DELETE FROM carrito WHERE id_usuario = ? AND id_producto = ?");
    if (!$stmt) {
      // Muestra el error
      echo "Error al preparar la consulta: " . $conn->error;
    } else {
      $stmt->bind_param("ii", $id_usuario, $id_producto);
      
      // Ejecuta la consulta
      if (!$stmt->execute()) {
        // Muestra el error
        echo "Error al ejecutar la consulta: " . $stmt->error;
      } else {

      }
    }
  }
}
?>






<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style type="text/css" class="drift-base-styles">.drift-bounding-box,.drift-zoom-pane{position:absolute;pointer-events:none}@keyframes noop{0%{zoom:1}}@-webkit-keyframes noop{0%{zoom:1}}.drift-zoom-pane.drift-open{display:block}.drift-zoom-pane.drift-closing,.drift-zoom-pane.drift-opening{animation:noop 1ms;-webkit-animation:noop 1ms}.drift-zoom-pane{overflow:hidden;width:100%;height:100%;top:0;left:0}.drift-zoom-pane-loader{display:none}.drift-zoom-pane img{position:absolute;display:block;max-width:none;max-height:none}</style>
    
    <title>Más Q'Fresco</title>
    <!-- SEO Meta Tags-->
    <meta name="description" content="Más Q'Fresco - Tienda Online">
    <meta name="keywords" content="tienda, shop, e-commerce, market, modern, responsive,  business, mobile, bootstrap, html5, css3, js, gallery, slider, touch, creative, clean, cuba, pay">
    <meta name="author" content="Uixsoftware">
    <meta name="robots" content="noindex">
    <!-- Viewport-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon and Touch Icons-->
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
  

   </head>
  <!-- Body-->
  <body class="handheld-toolbar-enabled">
    <style>img[alt="www.000webhost.com"]{display:none};</style>
   

    


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
                          <input class="form-control" name="nombre_cliente" type="text" value="<?php echo  $_SESSION['user_nombre'];?>" required="" id="review-name">
                          <div class="invalid-feedback">Please enter your name!</div><small class="form-text text-muted">Will be displayed on the comment.</small>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="review-email">Correo<span class="text-danger">*</span></label>
                          <input class="form-control" name="correo_cliente" type="email" value="<?php echo  $_SESSION['user_mail'];?>" required="" id="review-email">
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
                  <li class="nav-item"><a class="nav-link" href="https://masqfresco.com">Inicio</a>
                   
                  </li>
                  <li class="nav-item"><a class="nav-link" href="https://masqfresco.com/products">Productos</a>
                  </li>

                  <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">Cuenta</a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="#signin-modal" data-bs-toggle="modal">Iniciar Sesión / Registrarse</a></li>
                     
                      <li><a class="dropdown-item" href="https://masqfresco.com/profile">Ver perfil</a></li>
              
                    </ul>
                  </li>
                  <li class="nav-item dropdown active"><a class="nav-link dropdown-toggle active" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">Páginas</a>
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



























      <div class="container py-5 mb-lg-3">
        <h3 style="letter-spacing: var(--ls);" class="mt-3 text-primary">Términos Y Condiciones Generales</h3>
        <br>
        <h5 style="color:#4e54c8" class="mt-3">Le damos la bienvenida a los términos y condiciones de Masqfresco.com</h5>
        <p>Este contrato describe los términos y condiciones generales (en adelante únicamente TÉRMINOS Y CONDICIONES). Aplicable al uso de los contenidos, productos y servicios ofrecidos a través del sitio masqfresco.com (en adelante SITIO WEB). </p>
      
      
        <h5 style="color:#4e54c8"  class="mt-3">INFORMACIÓN RELEVANTE</h5>
        <p>
        Es requisito necesario para la compra de los productos que se ofrecen, o uso de los servicios, en  este SITIO WEB que usted lea y acepte los siguientes TÉRMINOS Y CONDICIONES que a continuación se detallan.
        <br><br>
Navegar por nuestro SITIO WEB, el dar de alta una cuenta de usuario, así como la compra de nuestros productos y utilización de nuestros servicios implicará que usted ha leído y ha aceptado los TÉRMINOS Y CONDICIONES del presente documento. Tenga en cuenta que estos TÉRMINOS Y CONDICIONES pueden ser actualizados en cualquier momento y pueden cambiar periódicamente. Cualquier función nueva o herramienta que se añadan a la tienda actual, también estarán sujetas a estos TÉRMINOS Y CONDICIONES. En todo caso, cualquier persona que no acepte los presentes TÉRMINOS Y CONDICIONES deberá abstenerse de utilizar el SITIO WEB y/o adquirir productos y servicios que en su caso sean ofrecidos.
<br><br>
Es su responsabilidad chequear este SITIO WEB periódicamente para verificar los cambios. Tú uso continuo o el acceso al sitio después de la publicación de cualquier cambio constituye la aceptación de dichos cambios, es decir, damos por hecho que usted entiende y acepta la modificación en los TÉRMINOS Y CONDICIONES si continúa usando este SITIO WEB después de la fecha de publicación de los cambios.
<br><br>
Este SITIO WEB se encuentra dirigido exclusivamente a personas que cuenten con la mayoría de edad (mayores de 18 años); en este sentido Grow Solutions llc declina cualquier responsabilidad por el incumplimiento de este requisito.
<br><br>
Al tratarse de un sitio web dirigido exclusivamente a personas que cuenten con la mayoría de edad; el usuario manifiesta ser mayor de edad y disponer de la capacidad jurídica necesaria para aceptar los presentes TÉRMINOS Y CONDICIONES.
<br><br>
El SITIO WEB se reserva la facultad de modificar en cualquier momento y sin previo aviso ni responsabilidad la presentación, los contenidos, la funcionalidad, los productos, los precios y los servicios y la configuración que pudiera estar contenida en la web; así como dejar de ofrecer algún producto o servicio por el motivo que sea. En este sentido el usuario reconoce y acepta que el SITIO WEB en cualquier momento podrá interrumpir, desactivar o cancelar cualquiera de los elementos que conforman el SITIO WEB o el acceso a los mismos.
<br><br>
Se hace de conocimiento del usuario que el TITULAR podrá administrar o gestionar el SITIO WEB en su totalidad o solo una parte de este, de manera directa o a través de un tercero, lo cual no modifica en ningún sentido lo establecido en los presentes TÉRMINOS Y CONDICIONES.
        </p>     
      







       <br> <h5 style="color:#4e54c8"  class="mt-3">USO NO AUTORIZADO</h5>
        


       <p>Usted no puede hacer uso indebido ni fraudulento de este SITIO WEB, ni con ninguno de los productos y servicios que aquí se ofrecen. No puede proporcionar información de pago falsa o que no pertenezca al titular de la cuenta. Este SITIO WEB no puede ser usado para ningún propósito ilegal, ni para pedirle a otros que realicen o participen en actos ilícitos; no puede ser usado para violar cualquier regulación, reglas, leyes internacionales, federales, provinciales o estatales, u ordenanzas locales; ni para infringir o violar el derecho de propiedad intelectual nuestro o de terceras partes.
       <br><br>
Usted no puede presentar información falsa o engañosa;  cargar o transmitir virus o cualquier otro tipo de código malicioso que sea o pueda ser utilizado en cualquier forma que pueda comprometer la funcionalidad o el funcionamiento del Servicio o de cualquier sitio web relacionado, otros sitios o Internet; para recopilar o rastrear información personal de otros; para generar spam, phish, pharm, pretext, spider, crawl, or scrape; para cualquier propósito obsceno o inmoral; o  para interferir con o burlar los elementos de seguridad del Servicio o cualquier sitio web relacionado a otros sitios o Internet. Nos reservamos el derecho de suspender el uso del Servicio o de cualquier sitio web relacionado por violar cualquiera de estos términos de uso no autorizado.
<br><br>
Es su responsabilidad asegurarse de que la ley le permite utilizar nuestros Servicios en la ubicación en la que se encuentre.</p>









        <br><h5 style="color:#4e54c8"  class="mt-3">REGISTRO DE USUARIO</h5>

        

        <p>Para adquirir un producto o servicio en este SITIO WEB será necesario la creación de una cuenta por parte del usuario (o si ya la tiene, iniciar sesión). El alta de una nueva cuenta es gratuita. El derecho de registro no existe. Cada cuenta de usuario puede ser usada por una sola persona y es intransferible. No se permite la creación de múltiples cuentas de usuario.
        <br><br>
El usuario se compromete a proporcionar toda la información de registro de forma completa, verídica y exacta. Si comprobamos o tenemos sospechas razonables de que alguna información proporcionada es falsa o incompleta, sin aviso previo y con aplicación inmediata, tenemos el derecho de retrasar la confirmación de alta de usuario (hasta ser analizados los datos), suspender o bloquear su cuenta indefinidamente y  cancelar su acceso actual y futuro a nuestro SITIO WEB.
<br><br>
En caso de cualquier cambio en la información de registro del usuario en el futuro, este es responsable de corregir la información de forma inmediata. Toda la información personal proporcionada será tratada de acuerdo a nuestra Política de privacidad, también definida en nuestro SITIO WEB. Datos personales adicionales solicitados al usuario están protegidos por la ley de protección de datos.
<br><br>
Los datos que se solicitan en este formulario incluyen: nombre y apellidos, número de teléfono, correo electrónico y definición de una contraseña. El TITULAR tiene el derecho de solicitar a cualquier usuario registrado la autenticación de la información personal proporcionada en el registro para verificar que haya sido correcta, en caso de alguna duda. Si el cliente no atiende a este requerimiento la cuenta de usuario puede quedar cancelada o suspendida indefinidamente, por no haber podido verificar que su identidad sea real.
<br><br>
La dirección de email que nos proporcione será usada para enviar emails informativos de bienvenida a cada nuevo usuario registrado, información personalizada sobre su compra, actualizaciones del estado de su compra, información de los productos y servicios de nuestra web así como nuestras novedades. Si no está de acuerdo con recibir alguna de estas informaciones o emails, después de registrase puede escribirnos a contacta@masqfreco.com y notificarnos por escrito que tipo de emails NO desea recibir.
<br><br>
El número de teléfono que nos proporcione será usado para contactarle directamente en caso de tener alguna duda con su compra o necesitar con urgencia algún dato no proporcionado o erróneo o necesitar algún dato adicional de la dirección para completar la entrega del producto.
<br><br>
El usuario es responsable de todas las actividades que ocurran bajo la cuenta de usuario. Es su responsabilidad mantener en secreto su contraseña y acceder a su cuenta de usuario cuidadosamente. Por favor, cambie su contraseña regularmente por propósitos de seguridad.
<br><br>
El SITIO WEB no asume la responsabilidad en caso de que revele dicha clave a terceros tanto directa como indirectamente. El usuario puede elegir y cambiar la clave para su acceso de administración de la cuenta en cualquier momento, en caso de que se haya registrado para la compra de alguno de nuestros productos.  En todo caso, el usuario notificará de forma inmediata al TITULAR acerca de cualquier hecho que permita suponer el uso indebido de la información registrada en dicho formulario tales como robo, extravío o acceso no autorizado a cuentas y/o contraseñas con el fin de proceder a su inmediata cancelación. Si olvida o pierde su contraseña, debe solicitar una nueva a través de  la sección ¨Olvidé mi contraseña¨ del SITIO WEB.
<br><br>
El usuario puede solicitarnos cerrar su cuenta en cualquier momento y sin justificación. Una vez que se elimine la cuenta, se borrarán todos los datos personales recogidos por el perfil de usuario, a menos que su almacenamiento durante un cierto período de tiempo sea requerido por la ley.
<br><br>
La suscripción a boletines de correos electrónicos publicitarios es voluntaria y podría ser seleccionada al momento de crear su cuenta. Si usted se suscribe y después cambia de opinión deberá escribir un correo a contacta@masqfreco.com informando que es su deseo que lo eliminen de la lista de suscripción.</p>




        <br><h5 style="color:#4e54c8"  class="mt-3">PROTECCIÓN DE DATOS PERSONALES</h5>
      
      <p>Nos aseguraremos de que todos los datos personales que tengamos en nuestro poder relativo y proporcionados por nuestros clientes cumplan con lo que estipula la legislación de protección de datos aplicable. No divulgaremos, alquilaremos, ni venderemos dicha información a terceros con la finalidad de lucrarnos de esta información. Solo revelaremos aquellos datos que nos sean obligados a dar por orden judicial o cualquier requerimiento legal. Así mismo el cliente está obligado a no divulgar cualquier información relativa a nuestra empresa que no sea de dominio público, independientemente del modo que le haya sido proporcionada.
      <br><br>
No almacenamos su datos bancarios o de tarjeta de crédito o débito en este SITIO WEB. Nuestro pago se procesa de forma segura a través de la plataforma TropiPay.  Si usted no tiene una cuenta Paypal, esta se le crea automáticamente al introducir sus datos eligiendo esa opción de pago.</p>
      




      <br><h5 style="color:#4e54c8"  class="mt-3">TÉRMINOS DE LOS ENVÍOS</h5>
      


      <p>Es responsabilidad de El Usuario informarse de las leyes aduanales y/o resoluciones que regulen el ingreso de los paquetes postales y mercancía con carácter no comercial al país de destino. El TITULAR, nuestra empresa no se responsabiliza por el pago de aranceles y servicios aduanales, pago de servicios internos u otros impuestos, tampoco así por decomiso y/o retención por violar la ley de aduanas del país de destino.
      <br><br>
Usted es conocer y es consciente que el servicio de entrega de los productos que se ofrecen en este SITIO WEB corre a cargo de terceros. Los Servicios proporcionados por proveedores externos, solo tienen la garantía que estos proveedores externos pueden proporcionarle a usted. No somos responsables de la calidad del servicio de entrega de los productos servidos por terceros. No nos hacemos responsables por demoras y retrasos en la entrega en el país de destino final.
<br><br>
La Empresa advierte al El Usuario que este tipo de envíos tanto marítimo como aéreos tiene un alto nivel de manipulación que deben tener en cuenta al hacer su compra, por tal motivo no existe posibilidad de establecer una garantía contra roturas, por lo que la empresa no responderá por deterioro ocasionada por la manipulación durante el transporte, no se admitirá reclamos por esta causa.
<br><br>
Todas las compras de productos que usted hace en este SITIO WEB o todas las encomiendas recibidas y entregadas al transportista serán colocadas y enviadas en su nombre, a título personal y no con fines comerciales o para reventa. Deben ser regalos o donaciones al destinatario final (familia inmediata).
<br><br>
El usuario acepta y afirma que todos los productos en esta orden son un regalo para el destinatario final, quien no es una persona sancionada por el gobierno de EEUU, y la mercancía no está destinada para fines comerciales.
<br><br>
Como medida de seguridad antifraude examinamos cada transacción en nuestra web, si alguna transacción nos parece sospechosa de fraude quedará retenida para una revisión más exhaustiva y el cliente no recibirá el producto adquirido hasta que no terminemos esta revisión y sea satisfactoria, en todos los casos el cliente puede reclamar la devolución del pago de estos pedidos pendientes de procesar.
<br><br>
Usted debe leer además, detenidamente, la información detallada que ofrecemos de cada producto en el SITIO WEB antes de adquirir el mismo.</p>











      <br><h5 style="color:#4e54c8"  class="mt-3">FORMA DE PAGO</h5>

      <p>El pago en nuestro sitio web es a través de TARJÉTA DE CRÉDITO o DÉBITO. Siempre debe proporcionarse información válida. El precio final que paga el cliente es el que se muestra en nuestra página. Nosotros no cobramos otra comisión adicional durante el proceso de compra.
      <br><br>
Todas las compras y transacciones que se lleven a cabo por medio de este SITIO WEB, están sujetas a un proceso de confirmación y verificación, el cual podría incluir validación de la forma de pago y el cumplimiento de las condiciones requeridas por el medio de pago seleccionado, por lo que para poder completar y enviar su pedido usted deberá proporcionar la información adicional que sea necesaria para comprobar su identidad. Usted conoce que el fraude de tarjeta de débito/crédito es un delito criminal. Nosotros hacemos un seguimiento personalizado de cada transacción. Incorporamos tecnología de detección y prevención de fraude en nuestro SITIO WEB En caso de detectar algún tipo de fraude, pondremos el caso inmediatamente a disposición de las autoridades policiales competentes.
<br><br>
El TITULAR no se responsabiliza por las actividades que se realicen en su cuenta, incluido el uso indebido de su tarjeta de crédito o débito. No estamos obligados a tomar otras medidas de autenticación o verificación de la identidad más allá de las que consideremos adecuadas y suficientes para proteger la seguridad y mantener un uso correcto del SITIO WEB y de nuestras Aplicaciones. Usted nos autoriza a cargar en su tarjeta de crédito o débito el importe total de cualquier producto que usted de instrucción de adquirir después de haber accedido a su cuenta en este SITIO WEB.
<br><br>
Tenga en cuenta que, si el importe a pagar por el producto que va a adquirir es en una  moneda diferente a la de su tarjeta de crédito o débito, puede corresponder una tarifa adicional de conversión de moneda por parte de la institución financiera a la que pertenece su tarjeta de crédito o débito.
<br><br>
Le enviaremos una confirmación por correo electrónico cuando su compra se haya completado satisfactoriamente con la información de los datos de recarga. Una vez procesada la recarga por el proveedor local del móvil de destino, ésta podrá utilizarse de inmediato. Este tipo de transacción  y el producto adquirido es irreversible y por tanto no admite devolución.</p>
      



<br><h5 style="color:#4e54c8"  class="mt-3">REEMBOLSO Y DEVOLUCIONES</h5>


    <p>-Todos nuestros servicios y productos son venta final.
    <br><br>
Al completar un pedido en nuestro SITIO WEB usted reconoce y acepta que todas las ventas son finales y no están sujetas a devolución para reembolso o cambio. Una vez realizada la compra es irreversible hasta su entrega al destinatario final.
<br><br>
El Usuario ante la inconformidad por faltante de contenido y peso recibido puede formular una reclamación en un término no mayor a 24 horas contadas a partir de recibida la encomienda por el destinatario, debe ser por escrito a nuestro correo electrónico contacta@masqfreco.com  y aportar las pruebas siguientes:
  <br><br>
-Fotos con la totalidad del contenido de los paquetes recibidos.
<br>
-Fotos de la etiqueta de las bolsas donde consta los datos de ese o esos envíos, así como cualquier otra prueba de respaldo que podamos solicitar.
<br>
-Foto del comprobante de recibo y recibo de pago del retiro de la encomienda para comprobar la fecha en que fue recibida la misma.
<br><br>
Toda reclamación deberá ser verificado y comprobada por La Empresa, si El Usuario no cumple con lo señalado en el párrafo anterior EL TITULAR no se hace responsable de ninguna reclamación.
<br><br>
No se considerará incumplimiento de nuestras obligaciones motivos considerados  por causa de fuerza mayor, desastres naturales, pandemias, embargo, fallas o interrupciones prolongadas en las conexiones de red, incendios, disposiciones gubernamentales, guerras, cualquier tipo de disturbio civil o por cualquier otra razón mencionada o no aquí que no dependa de nuestra empresa. No aceptamos reclamaciones en estos casos.
<br><br>
Los importes recibidos de las compras que consideremos sospechosas de fraude o que incumpla algunas de nuestras reglas serán devueltos a su cuenta de paypal o a su tarjeta. Nosotros tomamos un plazo de hasta 72 horas para procesar la devolución y después paypal puede tomar un plazo de 4 a 9 días para registrar el importe de la devolución en su cuenta. En todos los casos irá recibiendo correos electrónicos para que esté informado.</p>












      <br><h5 style="color:#4e54c8"  class="mt-3">SERVICIO DE ATENCIÓN AL CLIENTE Y CHAT EN LÍNEA</h5>
      
      <p>Con el fin de ofrecer un mejor servicio y atender a sus necesidades lo antes posible, en el momento que usted nos necesite le ofrecemos además de contactarnos a través de nuestro correo electrónico contacta@masqfreco.com la posibilidad de chatear con un representante de atención al cliente disponible siempre en horario laboral y accesible fácilmente desde cualquier parte de nuestro SITIO WEB. . Al contactar a nuestro Servicio al Cliente usted acepta que la conversación puede ser almacenada para fines de control de calidad o capacitación y para detección de posibles fraudes. No estamos obligados a responder a sus preguntas o consultas si usa un lenguaje que consideremos de acoso, violento, agresivo u ofensivo. Tampoco estamos obligado a responderle en las redes sociales por el motivo antes mencionado.</p>
      











      <br><h5 style="color:#4e54c8"  class="mt-3">DISPOSICIONES FINALES</h5>
      
      <p>Estos Términos y Condiciones se regirán y se interpretarán conforme a las leyes del estado de la Florida. En caso de alguna reclamación que surja por este contrato o por los productos y servicios que ofrecemos en este SITIO WEB usted acepta que la corte del condado de Miami-Dade tendrá jurisdicción sobre tal reclamación. Usted acepta renunciar a todas y cada una de las objeciones de jurisdicción o lugar.
      <br><br>
Cláusula de Divisibilidad: Si alguna disposición de estos términos y condiciones no es válida, las disposiciones restantes permanecerán. La disposición no válida será sustituida por una que sea legalmente efectiva con el mismo significado y propósito. Esto también se aplica para las lagunas en los términos y condiciones.
<br><br>
El uso de la información disponible para el usuario por parte de terceros para el envío de publicidad no solicitada queda contrariado. El TITULAR del SITIO WEB se reserva el derecho de emprender acciones legales en el caso de un delito.
<br><br>
Grow Solutions llc se reserva los derechos de cambiar o de modificar estos términos sin previo aviso.</p>
      

      <br><h5 style="color:#4e54c8"  class="mt-3">CONTACTO</h5>

     <p>Si tiene alguna pregunta sobre este sitio web o algo relacionado con estos términos y condiciones puede contactarnos al siguiente correo electrónico: contacta@masqfreco.com</p>

     
      </div>
    </main>





















    

      
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
        
      
        <script>
// Ocultar el preloader cuando la página haya cargado completamente
window.addEventListener('load', function() {
  document.getElementById('preloader').style.display = 'none';
});
</script>
</body></html>

<?php
// Cierra la conexión cuando hayas terminado
$conn->close();
?>