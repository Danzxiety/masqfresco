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
// Verifica si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  if ($_POST["form_name"] == "form_comen") {


    // Obtiene los valores del formulario
    $nombre_cliente = $_POST["nombre_cliente"];
    $estrellas = $_POST["estrellas"];
    $comentario = $_POST["comentario"];
    $correo_cliente = $_POST["correo_cliente"];

    // Crea la consulta SQL
    $sql = "INSERT INTO comentarios (nombre_cliente, estrellas, comentario, correo_cliente) VALUES ('$nombre_cliente', '$estrellas', '$comentario', '$correo_cliente')";

    // Ejecuta la consulta
    if ($conn->query($sql) === TRUE) {
      
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
        background-color: #42d697;
        color: #ffffff;
        padding: 15px;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.103);
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
          <i class="ci-check fs-md me-1"></i>
         Operación realizada con éxito!
        </div>
        </div>
  
        <script>  showPopup();</script>
        <?php
        
    } else {
      ?>
      <div class="bg-danger text-light text-center pt-1 pb-1"> 
        <p class="mb-0">Upss, hubo un error</p>
        <?php
        echo "Error: " . $sql . "<br>" . $conn->error;
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
 
  if ($_POST["form_name"] == "form_cart") {
    if (isset($_SESSION['user_id'])) {
    // Obtén los datos del formulario
    $id_usuario = $_SESSION['user_id'];
    $id_producto = $_POST['id_producto'];
    $cantidad = 1;

    // Verifica si el producto ya está en el carrito
    $stmt = $conn->prepare("SELECT * FROM carrito WHERE id_usuario = ? AND id_producto = ?");
    $stmt->bind_param("ii", $id_usuario, $id_producto);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
      // El producto ya está en el carrito, actualiza la cantidad
      $stmt = $conn->prepare("UPDATE carrito SET cantidad = cantidad + ? WHERE id_usuario = ? AND id_producto = ?");
      $stmt->bind_param("iii", $cantidad, $id_usuario, $id_producto);
      $stmt->execute();
 
    } else {
      // El producto no está en el carrito, inserta una nueva fila
      $stmt = $conn->prepare("INSERT INTO carrito (id_usuario, id_producto, cantidad) VALUES (?, ?, ?)");
      $stmt->bind_param("iii", $id_usuario, $id_producto, $cantidad);
      $stmt->execute();

    }

  } else {

    ?>
    <div class="bg-danger text-light text-center pt-1 pb-1"> 
      <p class="mb-0">Inicia Sesión para realizar esta acción </p>
      <a style="text-decoration: underline; color: #ffffff;" href="#signin-modal" data-bs-toggle="modal">Click Aqui!</a>
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
    <!-- Viewport-->
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
                  <li class="nav-item active"><a class="nav-link" href="https://masqfresco.com/products">Productos</a>
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

























      <!-- Page Title-->
      <div  class="page-title-overlap bg-secondary pt-4">
        <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
          <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-dark flex-lg-nowrap justify-content-center justify-content-lg-start">
                <li class="breadcrumb-item"><a class="text-nowrap" href="index"><i class="ci-home"></i>Inicio</a></li>
                <li class="breadcrumb-item text-nowrap active" aria-current="page">Productos</li>
              </ol>
            </nav>
          </div>
          <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
            <h1 class="h4 text-dark mb-0">Resultados:</h1>
          </div>
        </div>
      </div>
      <div class="container pb-5 mb-2 mb-md-4">
        <div class="row">
          <!-- Sidebar-->
         
          <?php

// Crear la consulta SQL para contar el número de productos
$sql = "SELECT COUNT(*) AS total FROM productos";

// Ejecutar la consulta y obtener el resultado
$resultado = mysqli_query($db, $sql);
$fila = mysqli_fetch_assoc($resultado);
$total_productos = $fila['total'];
?>


          <!-- Content  -->
          <section class="col-lg-12">
           


            <!-- Products grid-->
            <div class="row mx-n2">


            <?php
// Número de productos por página
$products_per_page = 16;

// Recupera el número de página actual
$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;

// Calcula el índice del primer producto a mostrar
$offset = ($page - 1) * $products_per_page;

// Crea la conexión
$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
// Verifica si la conexión es exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
if (isset($_GET['busqueda'])) {

$busqueda = $_GET['busqueda'];

$sql = "SELECT * FROM productos WHERE (nombre LIKE '%" . $busqueda . "%' OR descripcion LIKE '%" . $busqueda . "%') AND stock > 0";

    $result = $conn->query($sql);

// Verifica si se encontraron productos
if ($result->num_rows > 0) {
    // Muestra los productos
    while ($row = $result->fetch_assoc()) {
        // Recupera la primera foto del producto
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
 <div class="col-lg-3 col-md-4 col-6 px-2 mb-4">
            <div class="card shadow-lg rounded-3 product-card">
              <div class="product-card-actions d-flex align-items-center">
              <img class="rounded-circle" src="img/logo.svg" width="45" alt="Avatar">
                <?php
                echo '    </div><a class="card-img-top d-block overflow-hidden"><img class="w-100 p-2" src="' . htmlspecialchars($foto_url) . '" alt="Product" style="object-fit: contain; height: 250px; width: 200px;"></a>' 
                ?>
              <div class="card-body py-2"><a class="product-meta d-block fs-xs pb-1" href="details.php?id=<?php echo $row["id_producto"]; ?>"><?php echo $row["categoria"]; ?></a>
                <h3 class="product-title fs-sm"><a href="details.php?id=<?php echo $row["id_producto"]; ?>"><?php echo $row["nombre"]; ?></a></h3>
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
              <form method="post">
                <input type="hidden" name="form_name" value="form_cart">
                <input type="hidden" name="id_producto" value="<?php echo $row["id_producto"]; ?>">
                <button class="btn btn-primary btn-sm d-block w-100 mb-2" type="submit"><i class="ci-cart fs-sm me-1"></i>Añadir</button>
                </form>
                <div class="text-center"><a class="nav-link-style fs-ms" href="details.php?id=<?php echo $row["id_producto"]; ?>"><i class="ci-eye align-middle me-1"></i>Ver producto</a></div>
              </div>
            </div>
            <hr class="d-sm-none">
          </div>




          

        <?php
    }

    // Prepara la consulta SQL para contar el total de productos
    $sql = "SELECT COUNT(*) as total FROM productos";

     // Ejecuta la consulta
     $result = $conn->query($sql);
     $row = $result->fetch_assoc();
     $total_products = $row["total"];
 
     // Calcula el número total de páginas
     $total_pages = ceil($total_products / $products_per_page);
 
     // Genera los enlaces de paginación
     echo '<hr class="my-3">';
     
     echo '<nav class="d-flex justify-content-between pt-2" aria-label="Page navigation">';
     echo '  <ul class="pagination">';
     if ($page > 1) {
         echo '    <li class="page-item"><a class="page-link" href="?page=' . ($page - 1) . '"><i class="ci-arrow-left me-2"></i>Prev</a></li>';
     } else {
         echo '    <li class="page-item disabled"><span class="page-link"><i class="ci-arrow-left me-2"></i>Prev</span></li>';
     }
     echo '  </ul>';
     echo '  <ul class="pagination">';
     for ($i = 1; $i <= $total_pages; $i++) {
         if ($i == $page) {
             echo '    <li class="page-item active" aria-current="page"><span class="page-link">' . $i . '<span class="visually-hidden">(current)</span></span></li>';
         } else {
             echo '    <li class="page-item"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
         }
     }
     echo '  </ul>';
     echo '  <ul class="pagination">';
     if ($page < $total_pages) {
         echo '    <li class="page-item"><a class="page-link" href="?page=' . ($page + 1) . '" aria-label="Next">Next<i class="ci-arrow-right ms-2"></i></a></li>';
     } else {
         echo '    <li class="page-item disabled"><span class="page-link">Next<i class="ci-arrow-right ms-2"></i></span></li>';
     }
     echo '  </ul>';
     echo '</nav>';
 } else {
     echo '<h3 class="mt-5 bg-light p-4 rounded-4 mb-5">No hay resultados</h3>';
 }
}

 ?>



          </section>
        </div>
      </div>
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

    <nav style="height: 80px !important; width: 100px !important;" class="navbar navbar-light mb-5 navbar-expand fixed-bottom">
      <div class="container-fluid"><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
          <div class="collapse navbar-collapse fw-normal text-start text-dark float-start justify-content-start" id="navcol-1" style="box-shadow: 0px 0px;margin-left:-15px; margin-right: 8px;"><a class="btn btn-primary text-start float-start visible bounce animated" role="button" style="margin-top: -20px;padding-left:50px; margin-left:-15px; border-width: 0px;border-top-right-radius: 50px;border-bottom-right-radius: 50px;border-bottom-left-radius: 0px;border-top-left-radius: 0px;padding: 8px;padding-top: 8px;padding-right: 8px;padding-bottom: 8px;padding-left: 20px;background: #36d058;" href="https://api.whatsapp.com/send?phone=+5350007663&text=Hola"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-brand-whatsapp" style="font-size: 35px;color: rgb(255,255,255);">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9"></path>
                      <path d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1"></path>
                  </svg></a></div>
      </div>
  </nav>


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