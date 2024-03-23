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

// Verificar si el usuario tiene una sesión iniciada
if (!isset($_SESSION["user_id"])) {
    // El usuario no tiene una sesión iniciada, redirigirlo a la página de inicio de sesión
    echo "<script>window.location.href = 'login';</script>";
    exit;
}


?>

<?php

// Obtener el ID del usuario actual (por ejemplo, desde una variable de sesión)
$id_usuario_actual = $_SESSION["user_id"];

// Consulta para obtener el número de productos en el carrito del usuario actual
$sql = "SELECT COUNT(*) as num_productos FROM carrito WHERE id_usuario=" . $id_usuario_actual;
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$num_productos = $row["num_productos"];

// Verificar si el usuario tiene algún producto en su carrito
if ($num_productos == 0) {
    // El usuario no tiene ningún producto en su carrito, redirigirlo a la página de productos
    echo "<script>window.location.href = 'products';</script>";
    exit;
}

?>



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

<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["form_name"] == "form_checkout") {
      
      // Verifica si el formulario fue enviado


        // Preparar sentencia SQL para insertar datos en la tabla check_out
        $stmt = $conn->prepare("INSERT INTO check_out (id_usuario, nombre, apellidos, correo, telefono, nombre_destinatario, apellido_destinatario, municipio, direccion_entrega, telefono_destinatario, cid, total_precio) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        if ($stmt === false) {
          die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
      }

        // Obtener valores del formulario
        $id_usuario = $_POST["id_usuario"];
        $nombre = $_POST["nombre"];
        $apellidos = $_POST["apellidos"];
        $correo = $_POST["correo"];
        $telefono = $_POST["telefono"];

        $nombre_destinatario = $_POST["nombre_destinatario"];
        $apellido_destinatario = $_POST["apellido_destinatario"];
        $municipio = $_POST["municipio"];
        $direccion_entrega = $_POST["direccion_entrega"];
        $telefono_destinatario = $_POST["telefono_destinatario"];
        $cid = $_POST["cid"];
        $total_precio = $_POST["total_precio"];
        $total_precio += 5;

        // Bind the parameters
        $stmt->bind_param("ssssssssssss", $id_usuario, $nombre, $apellidos, $correo, $telefono, $nombre_destinatario, $apellido_destinatario, $municipio, $direccion_entrega, $telefono_destinatario, $cid, $total_precio);
       
       
       
        // Ejecutar sentencia SQL para insertar datos en la tabla check_out
        if ($stmt->execute()) {

          $id_check_out = $stmt->insert_id;
            // Obtener el ID del último check_out insertado
            $id_usuario = $_SESSION['user_id'];

          // Consulta para obtener los datos del carrito del usuario
$query = "SELECT * FROM carrito WHERE id_usuario = ?";
$stmt = $db->prepare($query);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

// Verificar si hay resultados
if ($result->num_rows > 0) {
    // Recorrer los resultados y transferirlos a la tabla check_out_productos
    while ($row = $result->fetch_assoc()) {
        $id_producto = $row['id_producto'];
        $cantidad = $row['cantidad'];

        // Prepara la consulta SQL
        $stmt2 = $conn->prepare("SELECT nombre, precio FROM productos WHERE id_producto = ?");

        // Vincula el id_producto a la consulta
        $stmt2->bind_param("i", $id_producto);

        // Ejecuta la consulta
        $stmt2->execute();

        // Obtiene los resultados
        $result2 = $stmt2->get_result();

            // Obtiene los datos del producto
            $producto = $result2->fetch_assoc();
            $nombre_producto = $producto['nombre'];
            $precio_producto = $producto['precio'];

          

                    // Consulta para insertar los datos en la tabla check_out_productos
                    $query = "INSERT INTO check_out_productos (id_check_out, id_producto, nombre_producto, precio_producto, cantidad) VALUES (?, ?, ?, ?, ?)";
                    if ($stmt = $db->prepare($query)) {
                       

                        if ($stmt->bind_param("iisdi", $id_check_out, $id_producto, $nombre_producto, $precio_producto, $cantidad)) {
                         
                            if ($stmt->execute()) {
                           
                               
                            } else {
                                echo "Error al ejecutar consulta: " . mysqli_error($db); // Imprimir mensaje de error
                            }
                        } else {
                            echo "Error al enlazar parámetros: " . mysqli_error($db); // Imprimir mensaje de error
                        }
                    } else {
                        echo "Error al preparar consulta: " . mysqli_error($db); // Imprimir mensaje de error
                    }
                }
            
            } else {
                echo "No se encontraron productos en el carrito"; // Imprimir mensaje de depuración
            }
       
            echo "<script>window.location.href = 'token.php?checkout_id=$id_check_out';</script>";
            exit;
  
        } else {
            echo "Error: " . mysqli_error($conn);
        }

        $stmt->close();
    }
}
?>






<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style type="text/css" class="drift-base-styles">.drift-bounding-box,.drift-zoom-pane{position:absolute;pointer-events:none}@keyframes noop{0%{zoom:1}}@-webkit-keyframes noop{0%{zoom:1}}.drift-zoom-pane.drift-open{display:block}.drift-zoom-pane.drift-closing,.drift-zoom-pane.drift-opening{animation:noop 1ms;-webkit-animation:noop 1ms}.drift-zoom-pane{overflow:hidden;width:100%;height:100%;top:0;left:0}.drift-zoom-pane-loader{display:none}.drift-zoom-pane img{position:absolute;display:block;max-width:none;max-height:none}</style>


<style>
    /* Estilos para el preloader */
    #preloader {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 9999;
      background-color: #fff;
      transition: opacity 0.3s;

    }

  

    #preloader .spinner {
      display: block;
      position: relative;
      left: 50%;
      top: 50%;
      width: 100px;
  height: 100px;
  margin: -50px 0 0 -50px;
      border-radius: 50%;
      border: 5px solid transparent;
      border-top-color: #FF8240;
      -webkit-animation: spin 2s linear infinite; /* Safari */
      animation: spin 2s linear infinite;
    }
    /* Animación del preloader */
    @-webkit-keyframes spin {
      0% { -webkit-transform: rotate(0deg); }
      100% { -webkit-transform: rotate(360deg); }
    }
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
  </style>

    
    <title>Más Q'Fresco</title>
    <!-- SEO Meta Tags-->
    <meta name="robots" content="noindex">
    <meta name="description" content="Más Q'Fresco - Tienda Online">
    <meta name="keywords" content="tienda, shop, e-commerce, market, modern, responsive,  business, mobile, bootstrap, html5, css3, js, gallery, slider, touch, creative, clean, cuba, pay">
    <meta name="author" content="Uixsoftware">
    <!-- Viewport-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
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

    <div id="preloader">
  <div class="spinner"></div>
</div>
   

    




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
          <form class="needs-validation" enctype="multipart/form-data"  method="post"> 
          <input type="hidden" name="form_name" value="form_login">
          <div class="mb-3">
                <label class="form-label txsub" for="si-name">Correo</label>
                <input class="form-control dark" type="text" name="nombre" id="nombre" required="">
                <div class="invalid-feedback">Please provide a valid email address.</div>
              </div>
              <div class="mb-3">
                <label class="form-label txsub" for="si-password">Contraseña</label>
                <div class="password-toggle">
                  <input class="form-control dark" type="password" name="contrasena" id="password" required="">
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


            <form method="post" enctype="multipart/form-data">
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
                <input class="form-control dark" type="number" name="numero_telefono" id="phone" placeholder="(+53) 55-55-55-55" required="">
                <div class="invalid-feedback">Please fill in your name.</div>
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

$stmt = $conn->prepare("SELECT carrito.cantidad, productos.id_producto, productos.nombre, productos.descripcion, productos.precio, MAX(fotos_productos.foto_url) AS foto_url FROM carrito INNER JOIN productos ON carrito.id_producto = productos.id_producto INNER JOIN fotos_productos ON carrito.id_producto = fotos_productos.id_producto WHERE carrito.id_usuario = ? GROUP BY carrito.cantidad, productos.id_producto, productos.nombre, productos.descripcion, productos.precio");
$stmt->bind_param("i", $id_usuario);

// Ejecuta la consulta
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  // Hay productos en el carrito, muéstralos
  while ($row = $result->fetch_assoc()) {
  
  ?>
<div class="widget-cart-item pb-2 border-bottom d-flex">
<form method="post">
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
  // No hay productos en el carrito, muestra un mensaje
  echo "No hay productos en el carrito";
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
              <h4 class="modal-title product-title"><a href="#" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Ver la página del producto">Dejanos tu opinión</a></h4>
              <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form class="needs-validation" method="post">
                        <div class="mb-3">

                        <input type="hidden" name="form_name" value="form_comen">

                          <label class="form-label" for="review-name">Nombre<span class="text-danger">*</span></label>
                          <input class="form-control" name="nombre_cliente" type="text" required="" id="review-name">
                          <div class="invalid-feedback">Please enter your name!</div><small class="form-text text-muted">Will be displayed on the comment.</small>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="review-email">Correo<span class="text-danger">*</span></label>
                          <input class="form-control" name="correo_cliente" type="email" required="" id="review-email">
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

$stmt = $conn->prepare("SELECT carrito.cantidad, productos.id_producto, productos.nombre, productos.descripcion, productos.precio, MAX(fotos_productos.foto_url) AS foto_url FROM carrito INNER JOIN productos ON carrito.id_producto = productos.id_producto INNER JOIN fotos_productos ON carrito.id_producto = fotos_productos.id_producto WHERE carrito.id_usuario = ? GROUP BY carrito.cantidad, productos.id_producto, productos.nombre, productos.descripcion, productos.precio");
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


































      <!-- Page Title-->
      <div class="page-title-overlap bg-secondary pt-4">
        <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
          <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-dark flex-lg-nowrap justify-content-center justify-content-lg-start">
                <li class="breadcrumb-item"><a class="text-nowrap text-muted" href="index.html"><i class="ci-home"></i>Inicio</a></li>
                <li class="breadcrumb-item text-nowrap text-muted"><a href="">Carrito</a>
                </li>
                <li class="breadcrumb-item text-nowrap active text-dark" aria-current="page">Checkout</li>
              </ol>
            </nav>
          </div>
          <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
            <h1 class="h3 text-dark mb-0">Completar pedido</h1>
          </div>
        </div>
      </div>
      <div class="container pb-5 mb-2 mb-md-4">
        <div class="row">
          <section class="col-lg-8">
            <!-- Steps-->
            <div class="steps steps-light pt-2 pb-3 mb-5"><a class="step-item active text-dark" href="">
                <div class="step-progress" style="background-color: rgb(37, 180, 80); color:white;"><span class="step-count" style="background-color: rgb(37, 180, 80); color:white;">1</span></div>
                <div class="step-label" ><i class="ci-cart text-dark"></i>Carrito</div></a><a class="step-item  text-dark current" href="">
                <div class="step-progress" style="background-color: rgb(37, 180, 80); color:white;"><span class="step-count" style="background-color: rgb(37, 180, 80); color:white;">2</span></div>
                <div class="step-label"><i class="ci-user-circle text-dark"></i>Detalles</div></a><a class="step-item text-dark" href="">
                
                <div class="step-progress bg-light"><span class="bg-light step-count shadow-lg text-dark">3</span></div>
                <div class="step-label"><i class="ci-card text-dark"></i>Pago</div></a><a class="step-item text-dark" href="">
                <div class="step-progress  bg-light"><span class="step-count bg-light shadow-lg text-dark">4</span></div>
                <div class="step-label"><i class="ci-check-circle text-dark"></i>Finalizar</div></a></div>
            <!-- Autor info-->

            <?php

// Especificar el ID del usuario que deseas obtener
$id_usuario = $_SESSION['user_id'];

// Consulta para obtener el usuario con el ID especificado
$sql = "SELECT * FROM usuarios WHERE id_user=" . $id_usuario;
$result = $conn->query($sql);
$row = $result->fetch_assoc();

?>
            <div class="d-sm-flex justify-content-between align-items-center bg-secondary p-4 rounded-3 mb-grid-gutter">
              <div class="d-flex align-items-center">
                <div class="img-thumbnail rounded-circle position-relative flex-shrink-0"><img class="bg-light rounded-circle" src="img/avatar.webp" width="90" alt="Avatar"></div>
                <div class="ps-3">
                  <h3 class="fs-base mb-0"><?php echo $row["nombre"]; ?> <?php echo $row["apellido"]; ?></h3><span class="text-accent fs-sm"><?php echo $row["correo_electronico"]; ?></span>
                </div>
              </div><a class="btn btn-light btn-sm btn-shadow mt-3 mt-sm-0" href="profile"><i class="ci-edit me-2"></i>Ver perfil</a>
            </div>
            <!-- Shipping address-->
            <form method="post" novildate>
            <input type="hidden" name="form_name" value="form_checkout">

            <input type="hidden" name="id_usuario" value="<?php echo $_SESSION['user_id']; ?>">

            <input type="hidden" name="total_precio" value="<?php

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
                echo $total;


              } else {
                // El usuario no ha iniciado sesión, muestra un mensaje de advertencia
                echo "$ 00.00";
              }
            ?>">










<?php

// Especificar el ID del usuario que deseas obtener
$id_usuario = $_SESSION['user_id'];

// Consulta para obtener el usuario con el ID especificado
$sql = "SELECT * FROM usuarios WHERE id_user=" . $id_usuario;
$result = $conn->query($sql);
$row = $result->fetch_assoc();

?>
            
            <h2 class="h6 pt-1 pb-3 mb-3 border-bottom">Detalles de su cuenta:</h2>
            <div class="row">
              <div class="col-sm-6">
                <div class="mb-3">
                  <label class="form-label" for="nombre">Nombre</label>
                  <input class="form-control" type="text" name="nombre" id="nombre" value="<?php echo $row["nombre"]; ?>" required>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="mb-3">
                  <label class="form-label" for="checkout-ln">Apellidos</label>
                  <input class="form-control" type="text" name="apellidos" id="checkout-ln" value="<?php echo $row["apellido"]; ?>" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="mb-3">
                  <label class="form-label" for="checkout-email">Correo</label>
                  <input class="form-control" type="email" name="correo" id="checkout-email" value="<?php echo $row["correo_electronico"]; ?>" required>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="mb-3">
                  <label class="form-label" for="checkout-phone">Teléfono</label>
                  <input class="form-control" type="tel" name="telefono" id="checkout-phone" value="<?php echo $row["numero_telefono"]; ?>" required>
                </div>
              </div>
            </div>
     


            <h2 class="h6 pt-1 pb-3 mb-3 mt-4 border-bottom">Detalles del destinatario:</h2>
 

            <div class="row">
              <div class="col-sm-6">
                <div class="mb-3">
                  <label class="form-label" for="nombre">Nombre</label>
                  <input class="form-control" type="text" name="nombre_destinatario" id="nombre_destinatario" required>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="mb-3">
                  <label class="form-label" for="checkout-ln">Apellidos</label>
                  <input class="form-control" type="text" name="apellido_destinatario" id="checkout-ln" required>
                </div>
              </div>
            </div>



            <div class="row">
              <div class="col-sm-6">
                <div class="mb-3">
                  <label class="form-label" for="checkout-zip">Municipio</label>
                  <select class="form-select" name="municipio" id="checkout-city" required>
                    <option>Arroyo Naranjo</option>
                    <option>Boyeros</option>
                    <option>Centro Habana</option>
                    <option>Cerro</option>
                    <option>Cotorro</option>
                    <option>Diez de Octubre</option>
                    <option>Guanabacoa</option>
                    <option>Habana Vieja</option>
                    <option>La Lisa</option>
                    <option>Marianao</option>
                    <option>Playa</option>
                    <option>Plaza</option>
                    <option>Regla</option>
                    <option>San Miguel</option>
                  </select>
                </div>
              </div>

              <div class="col-sm-6">
                <div class="mb-3">
                  <label class="form-label" for="checkout-address-1">Dirección para entrega</label>
                  <input class="form-control" name="direccion_entrega" type="text" id="checkout-address-1" required>
                </div>
              </div>

            </div>


            <div class="row">
              
            <div class="col-sm-6">
                <div class="mb-3">
                  <label class="form-label" for="checkout-phone">Teléfono</label>
                  <input class="form-control" type="tel" name="telefono_destinatario" id="checkout-phone" placeholder="+5355555555" required>
                </div>
              </div>

              <div class="col-sm-6">
                <div class="mb-3"> 
                  <label class="form-label" for="checkout-address-2">Carnet de identidad</label>
                  <input class="form-control" name="cid" type="number" id="checkout-address-2" required>
                </div>
              </div>

            </div>
            
     
            <!-- Navigation (desktop)-->
            <div class="d-flex pt-4 mt-3">
              <div class="w-50 pe-3"><a class="btn btn-secondary d-block w-100" href="index"><i class="ci-arrow-left mt-sm-0 me-1"></i><span class="d-none d-sm-inline">Volver al inicio</span><span class="d-inline d-sm-none">Volver</span></a></div>
              <div class="w-50 ps-2"><button type="submit" class="btn btn-primary d-block w-100"><span class="d-none d-sm-inline">Continuar</span><span class="d-inline d-sm-none">Continuar</span><i class="ci-arrow-right mt-sm-0 ms-1"></i></button></div>
            </div>
            </form>
          </section>
          <!-- Sidebar-->




          <aside class="col-lg-4 pt-4 pt-lg-0 ps-xl-5">
            <div class="bg-white rounded-3 shadow-lg p-4 ms-lg-auto">
              <div class="py-2 px-xl-2">


                <div class="widget mb-3">
                  <h2 class="widget-title text-center">Su compra:</h2>


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
<form method="post">
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
  // No hay productos en el carrito, muestra un mensaje
  echo "No hay productos en el carrito";
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



                </div>
                <ul class="list-unstyled fs-sm pb-2 border-bottom">
                  <li class="d-flex justify-content-between align-items-center"><span class="me-2">Subtotal:</span><span class="text-end"><?php

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
                echo $total;


              } else {
                // El usuario no ha iniciado sesión, muestra un mensaje de advertencia
                echo "$00.00";
              }
            ?></span></li>
              
                  <li class="d-flex justify-content-between align-items-center"><span class="me-2">Domicilio:</span><span class="text-end">$5.00</small></span></li>
                  <li class="d-flex justify-content-between align-items-center"><span class="me-2">Descuentos:</span><span class="text-end">—</span></li>
                </ul>
                <h3 class="fw-normal text-center my-4"><?php echo '$' . number_format($total + 5, 2); ?></h3>
                <form class="needs-validation" method="post" novalidate="">
                  <div class="mb-3">
                    <input class="form-control" type="text" placeholder="Código de promoción" required="">
                    <div class="invalid-feedback">Please provide promo code.</div>
                  </div>
                  <button class="btn btn-outline-primary d-block w-100" type="submit">Verificar</button>
                </form>
              </div>
            </div>
          </aside>
        </div>
        <!-- Navigation (mobile)-->
        
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
