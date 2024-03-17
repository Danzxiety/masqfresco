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

<?php


// Obtener el ID del usuario actual (por ejemplo, desde una variable de sesión)
$id_usuario_actual = $_SESSION['user_id'];

// Consulta para obtener el rango del usuario actual
$sql = "SELECT rango FROM usuarios WHERE id_user=" . $id_usuario_actual;
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$rango_usuario_actual = $row["rango"];

// Verificar si el rango del usuario es "admin"
if ($rango_usuario_actual == "admin") {?>




<?php
// Verifica si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if ($_POST["form_name"] == "form_prod") {
    // Incluye el archivo con las constantes de la base de datos

    // Recupera los valores del formulario
    $nombre = $_POST["nombre"];
    $categoria = $_POST["categoria"];
    $precio = $_POST["precio"];
    $descripcion = $_POST["descripcion"];
    $marca = $_POST["marca"];

    // Prepara la consulta SQL para insertar el producto
    $sql = "INSERT INTO productos (nombre, categoria, precio, descripcion, marca)
    VALUES ('$nombre', '$categoria', '$precio', '$descripcion', '$marca')";

    // Ejecuta la consulta
    if ($conn->query($sql) === TRUE) {
        // Recupera el ID del producto insertado
        $id_producto = $conn->insert_id;

        // Verifica si se subieron archivos
        if (isset($_FILES["fotos"])) {
            // Recorre los archivos subidos
            foreach ($_FILES["fotos"]["tmp_name"] as $index => $tmp_name) {
                // Verifica si el archivo fue subido correctamente
                if (is_uploaded_file($tmp_name)) {
                    // Genera un nombre único para el archivo
                    $file_name = uniqid() . "." . pathinfo($_FILES["fotos"]["name"][$index], PATHINFO_EXTENSION);

                    // Mueve el archivo a la carpeta de destino
                    move_uploaded_file($tmp_name, "uploads/" . $file_name);

                    // Prepara la consulta SQL para insertar la foto
                    $sql = "INSERT INTO fotos_productos (id_producto, foto_url)
                    VALUES ('$id_producto', 'uploads/$file_name')";

                    // Ejecuta la consulta
                    if ($conn->query($sql) !== TRUE) {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }
            }
        }

        echo "Producto y fotos agregados correctamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

  }
}
?>



<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if ($_POST["form_name"] == "form_cat") {
    // Obtén los valores de los campos del formulario
    $nombre_categoria = $_POST["nombre_categoria"];
    $icono = $_POST["icono"];

    
$nombre_categoria = mysqli_real_escape_string($conn, $nombre_categoria);
$icono = mysqli_real_escape_string($conn, $icono);


$resultado = mysqli_query($conn, 'INSERT INTO categorias(nombre_categoria, icono) VALUES("' . $nombre_categoria . '","' . $icono . '")');


if ($resultado)
{
  echo "Categoría agregada correctamente";
}
else
{
  echo "ERROR";
     }
    }
}
?>


<?php
// Verifica si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if ($_POST["form_name"] == "remove_user") {
 
    $id_user = $_POST['id_user'];


    // Primero, eliminar las filas relacionadas en la tabla carrito
    $stmt = $conn->prepare('DELETE FROM usuarios WHERE id_user = ?');
    if (!$stmt) {
        // Mostrar el error
        echo 'Error al preparar la consulta: ' . $conn->error;
    } else {
        $stmt->bind_param('i', $id_user);

        // Ejecutar la consulta
        if (!$stmt->execute()) {
            // Mostrar el error
            echo 'Error al ejecutar la consulta: ' . $stmt->error;
        }
    }

    $id_usuario = $_POST['id_user'];
       // Primero, eliminar las filas relacionadas en la tabla carrito
       $stmt = $conn->prepare('DELETE FROM carrito WHERE id_usuario = ?');
       if (!$stmt) {
           // Mostrar el error
           echo 'Error al preparar la consulta: ' . $conn->error;
       } else {
           $stmt->bind_param('i', $id_usuario);
   
           // Ejecutar la consulta
           if (!$stmt->execute()) {
               // Mostrar el error
               echo 'Error al ejecutar la consulta: ' . $stmt->error;
           }
       }
   
  }
}
?>


<?php
// Verifica si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if ($_POST["form_name"] == "remove_product") {
 
    $id_producto = $_POST['id_producto'];


    // Primero, eliminar las filas relacionadas en la tabla carrito
    $stmt = $conn->prepare('DELETE FROM carrito WHERE id_producto = ?');
    if (!$stmt) {
        // Mostrar el error
        echo 'Error al preparar la consulta: ' . $conn->error;
    } else {
        $stmt->bind_param('i', $id_producto);

        // Ejecutar la consulta
        if (!$stmt->execute()) {
            // Mostrar el error
            echo 'Error al ejecutar la consulta: ' . $stmt->error;
        }
    }

       // Primero, eliminar las filas relacionadas en la tabla carrito
       $stmt = $conn->prepare('DELETE FROM fotos_productos WHERE id_producto = ?');
       if (!$stmt) {
           // Mostrar el error
           echo 'Error al preparar la consulta: ' . $conn->error;
       } else {
           $stmt->bind_param('i', $id_producto);
   
           // Ejecutar la consulta
           if (!$stmt->execute()) {
               // Mostrar el error
               echo 'Error al ejecutar la consulta: ' . $stmt->error;
           }
       }
    
    $stmt = $conn->prepare('DELETE FROM comentarios_productos WHERE id_producto = ?');
    if (!$stmt) {
        // Mostrar el error
        echo 'Error al preparar la consulta: ' . $conn->error;
    } else {
        $stmt->bind_param('i', $id_producto);

        // Ejecutar la consulta
        if (!$stmt->execute()) {
            // Mostrar el error
            echo 'Error al ejecutar la consulta: ' . $stmt->error;
        }
    }


     // Preparar la consulta SQL para eliminar el producto
     $stmt = $conn->prepare('DELETE FROM productos WHERE id_producto = ?');
     if (!$stmt) {
         // Mostrar el error
         echo 'Error al preparar la consulta: ' . $conn->error;
     } else {
         $stmt->bind_param('i', $id_producto);
      
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

// Verifica si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if ($_POST["form_name"] == "banners") {

 
    $presentacion = $_POST['presentacion'];
    $titulo = $_POST['titulo'];
    $discripcion = $_POST['discripcion'];
    $foto = $_FILES['foto']['name'];
    $texto_del_boton = $_POST['texto_del_boton'];
    $enlace_del_boton = $_POST['enlace_del_boton'];


    $sql = "INSERT INTO promociones (presentacion, titulo, discripcion, texto_del_boton, enlace_del_boton, foto)
    VALUES ('$presentacion', '$titulo', '$discripcion', '$texto_del_boton', '$enlace_del_boton', '$foto')";
    


$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["foto"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Verifica si el archivo es una imagen
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["foto"]["tmp_name"]);
    if($check !== false) {
        echo "El archivo es una imagen - " . $check["mime"] . ".";
    } else {
        echo "El archivo no es una imagen.";
    }
}

// Mueve el archivo subido a la carpeta de destino
if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
    echo "El archivo ". htmlspecialchars( basename( $_FILES["foto"]["name"])). " ha sido subido.";
} else {
    echo "Lo siento, hubo un error al subir el archivo.";
}

// Almacena el nombre del archivo en una variable
$foto = basename($_FILES["foto"]["name"]);


if ($conn->query($sql) === TRUE) {
  echo "Los datos se han insertado correctamente";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

   
}}
?>

<?php

// Verifica si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if ($_POST["form_name"] == "form_sale") {

// Obtener los valores del formulario
$id_producto = $_POST['id_producto'];
$nuevo_precio = $_POST['nuevo_precio'];


// Crear la consulta SQL
$sql = "UPDATE productos SET old_precio = precio, precio = ?, estado = 'oferta' WHERE id_producto = ?";

// Preparar la consulta
$stmt = $conn->prepare($sql);

// Vincular los parámetros
$stmt->bind_param("di", $nuevo_precio, $id_producto);

// Ejecutar la consulta
if ($stmt->execute()) {
    echo "Producto actualizado con éxito";
} else {
    echo "Error al actualizar el producto: " . $stmt->error;
}
}}

?>



<!DOCTYPE html>

<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
  <title>Dashboard - Más Q'Fresco</title>
  <!-- SEO Meta Tags-->
  <meta name="description" content="Más Q'Fresco - Tienda Online">
  <meta name="keywords" content="tienda, shop, e-commerce, market, modern, responsive,  business, mobile, bootstrap, html5, css3, js, gallery, slider, touch, creative, clean, cuba, pay">
  <meta name="author" content="Uixsoftware">
    <!-- Viewport-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon and Touch Icons-->
    <link rel="apple-touch-icon" sizes="180x180" href="img/logo.svg">
    <link rel="icon" type="image/png" sizes="32x32" href="img/logo.svg">
    <link rel="icon" type="image/png" sizes="16x16" href="img/logo.svg">

    <!-- Vendor Styles including: Font Icons, Plugins, etc.-->
    <link rel="stylesheet" media="screen" href="css/simplebar.min.css">
    <link rel="stylesheet" media="screen" href="css/tiny-slider.css">
    <!-- Main Theme Styles + Bootstrap-->
    <link rel="stylesheet" media="screen" href="css/theme.min.css">
 
  </head>
  <!-- Body-->
  <body class="handheld-toolbar-enabled">
  <style>img[alt="www.000webhost.com"]{display:none};</style>

    <!-- Sign in / sign up modal-->
    <div class="modal fade" id="signin-modal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header bg-secondary">
            <ul class="nav nav-tabs card-header-tabs" role="tablist">
              <li class="nav-item" role="presentation"><a class="nav-link fw-medium active" href="#signin-tab" data-bs-toggle="tab" role="tab" aria-selected="true"><i class="ci-unlocked me-2 mt-n1"></i>Sign in</a></li>
              <li class="nav-item" role="presentation"><a class="nav-link fw-medium" href="#signup-tab" data-bs-toggle="tab" role="tab" aria-selected="false" tabindex="-1"><i class="ci-user me-2 mt-n1"></i>Sign up</a></li>
            </ul>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body tab-content py-4">
            <form class="needs-validation tab-pane fade show active" autocomplete="off" novalidate="" id="signin-tab" role="tabpanel">
              <div class="mb-3">
                <label class="form-label" for="si-email">Email address</label>
                <input class="form-control" type="email" id="si-email" placeholder="johndoe@example.com" required="">
                <div class="invalid-feedback">Please provide a valid email address.</div>
              </div>
              <div class="mb-3">
                <label class="form-label" for="si-password">Password</label>
                <div class="password-toggle">
                  <input class="form-control" type="password" id="si-password" required="">
                  <label class="password-toggle-btn" aria-label="Show/hide password">
                    <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
                  </label>
                </div>
              </div>
              <div class="mb-3 d-flex flex-wrap justify-content-between">
                <div class="form-check mb-2">
                  <input class="form-check-input" type="checkbox" id="si-remember">
                  <label class="form-check-label" for="si-remember">Remember me</label>
                </div><a class="fs-sm" href="">Forgot password?</a>
              </div>
              <button class="btn btn-primary btn-shadow d-block w-100" type="submit">Sign in</button>
            </form>
            <form class="needs-validation tab-pane fade" autocomplete="off" novalidate="" id="signup-tab" role="tabpanel">
              <div class="mb-3">
                <label class="form-label" for="su-name">Full name</label>
                <input class="form-control" type="text" id="su-name" placeholder="John Doe" required="">
                <div class="invalid-feedback">Please fill in your name.</div>
              </div>
              <div class="mb-3">
                <label for="su-email">Email address</label>
                <input class="form-control" type="email" id="su-email" placeholder="johndoe@example.com" required="">
                <div class="invalid-feedback">Please provide a valid email address.</div>
              </div>
              <div class="mb-3">
                <label class="form-label" for="su-password">Password</label>
                <div class="password-toggle">
                  <input class="form-control" type="password" id="su-password" required="">
                  <label class="password-toggle-btn" aria-label="Show/hide password">
                    <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
                  </label>
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label" for="su-password-confirm">Confirm password</label>
                <div class="password-toggle">
                  <input class="form-control" type="password" id="su-password-confirm" required="">
                  <label class="password-toggle-btn" aria-label="Show/hide password">
                    <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
                  </label>
                </div>
              </div>
              <button class="btn btn-primary btn-shadow d-block w-100" type="submit">Sign up</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <main class="page-wrapper">
      <!-- Add Payment Method-->
      <form class="needs-validation modal fade" method="post" id="add-payment" tabindex="-1" novalidate="">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add a payment method</h5>
              <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="form-check mb-4">
                <input class="form-check-input" type="radio" id="paypal" name="payment-method">
                <label class="form-check-label" for="paypal">PayPal<img class="d-inline-block align-middle ms-2" src="./Cartzilla _ Account Settings_files/card-paypal.png" width="39" alt="PayPal"></label>
              </div>
              <div class="form-check mb-4">
                <input class="form-check-input" type="radio" id="card" name="payment-method" checked="">
                <label class="form-check-label" for="card">Credit / Debit card<img class="d-inline-block align-middle ms-2" src="./Cartzilla _ Account Settings_files/cards.png" width="187" alt="Credit card"></label>
              </div>
              <div class="row g-3 mb-2">
                <div class="col-sm-6">
                  <input class="form-control" type="text" name="number" placeholder="Card Number" required="">
                  <div class="invalid-feedback">Please fill in the card number!</div>
                </div>
                <div class="col-sm-6">
                  <input class="form-control" type="text" name="name" placeholder="Full Name" required="">
                  <div class="invalid-feedback">Please provide name on the card!</div>
                </div>
                <div class="col-sm-3">
                  <input class="form-control" type="text" name="expiry" placeholder="MM/YY" required="">
                  <div class="invalid-feedback">Please provide card expiration date!</div>
                </div>
                <div class="col-sm-3">
                  <input class="form-control" type="text" name="cvc" placeholder="CVC" required="">
                  <div class="invalid-feedback">Please provide card CVC code!</div>
                </div>
                <div class="col-sm-6">
                  <button class="btn btn-primary d-block w-100" type="submit">Register this card</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
      <!-- Navbar Marketplace-->
      <!-- Remove "navbar-sticky" class to make navigation bar scrollable with the page.-->
      <header class="bg-light shadow-sm navbar-sticky">
        <div class="navbar navbar-expand-lg navbar-light">
          <div class="container"><a class="navbar-brand d-none d-sm-flex me-3 flex-shrink-0" href="index"> <img width="60px" src="img/logo.svg" alt=""> <img src="img/title.svg" width="120" alt="MasQFresco"></a><a class="navbar-brand d-sm-none me-2" href="index"><img src="img/logo.svg" width="65" alt="MasQFresco"></a>
            <!-- Toolbar-->
            <div class="navbar-toolbar d-flex align-items-center order-lg-3">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"><span class="navbar-toggler-icon"></span></button><a class="navbar-tool d-none d-lg-flex" href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#searchBox" role="button" aria-expanded="false" aria-controls="searchBox"><span class="navbar-tool-tooltip">Buscar</span>
                <div class="navbar-tool-icon-box"><i class="navbar-tool-icon ci-search"></i></div></a><a class="navbar-tool d-none d-lg-flex" href=""><span class="navbar-tool-tooltip">Favorites</span>
                <div class="navbar-tool-icon-box"><i class="navbar-tool-icon ci-heart"></i></div></a>
              <div class="navbar-tool ms-2"><a class="navbar-tool-icon-box border dropdown-toggle" href=""><img src="img/man.png" width="32" alt="Createx Studio"></a><a class="navbar-tool-text ms-n1" href=""><small>MQ'F.</small>$1,375.00</a>
                
              </div>
              
            </div>
            <div class="collapse navbar-collapse me-auto order-lg-2" id="navbarCollapse">
              <!-- Search-->
              <div class="input-group d-lg-none my-3"><i class="ci-search position-absolute top-50 start-0 translate-middle-y text-muted fs-base ms-3"></i>
                <input class="form-control rounded-start" type="text" placeholder="Buscar productos">
              </div>
              
              <!-- Primary menu-->
              <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="index">Volver a la tienda</a></li>
              </ul>
            </div>
          </div>
        </div>
        <!-- Search collapse-->
        <div class="search-box collapse" id="searchBox">
          <div class="card pt-2 pb-4 border-0 rounded-0">
            <div class="container">
              <div class="input-group"><i class="ci-search position-absolute top-50 start-0 translate-middle-y text-muted fs-base ms-3"></i>
                <input class="form-control rounded-start" type="text" placeholder="Buscar productos">
              </div>
            </div>
          </div>
        </div>
      </header>






















      
      <!-- Dashboard header-->
      <div class="page-title-overlap bg-accent pt-4">
        <div class="container d-flex flex-wrap flex-sm-nowrap justify-content-center justify-content-sm-between align-items-center pt-2">
          <div class="d-flex align-items-center pb-3">
           
            <div class="ps-3">
              <h3 class="text-light  mb-0">Dashboard</h3><span class="d-block text-light fs-ms opacity-60 py-1">Powered by Uixsoftware</span>
            </div>
          </div>
        </div>
      </div>
      <div class="container mb-5 pb-3">
        <div class="bg-light shadow-lg rounded-3 overflow-hidden">
          <div class="row">
            <!-- Sidebar-->
            <aside class="col-lg-4 pe-xl-5">
              <!-- Account menu toggler (hidden on screens larger 992px)-->
              <div class="d-block d-lg-none p-4"><a class="btn btn-outline-accent d-block" href="#account-menu" data-bs-toggle="collapse"><i class="ci-menu me-2"></i>Menu</a></div>
              <!-- Actual menu-->
              <div class="h-100 border-end mb-2">
                <div class="d-lg-block collapse" id="account-menu">
                  <div class="bg-secondary p-4">
                    <h3 class="fs-sm mb-0 text-muted">Panel Admin</h3>
                  </div>
                  <ul class="list-unstyled mb-0"  role="tablist">

                  <li role="presentation"><a class="active" role="tab" data-bs-toggle="tab" href="#tab-details"></a></li>


                    <li class="border-bottom mb-0"  role="presentation"><a class="nav-link-style d-flex align-items-center px-4 py-3" role="tab" data-bs-toggle="tab" href="#tab-settings"><i class="ci-settings opacity-60 me-2"></i>Ajustes</a></li>


                      <li class="border-bottom mb-0" role="presentation"><a class="nav-link-style d-flex align-items-center px-4 py-3" role="tab" data-bs-toggle="tab" href="#tab-sales"><i class="ci-dollar opacity-60 me-2"></i>Finanzas<span class="fs-sm text-muted ms-auto">$<span><?php

// Consulta para obtener la suma total de los precios de todos los productos
$sql = "SELECT SUM(precio) as total FROM productos";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total = $row["total"];

if ($total === NULL) {
  // No hay productos, mostrar 00.00 como el total
  echo "00.00";
} else {
  // Hay productos, mostrar el total
  echo $total;
}
?></span></span></a></li>

                    <li class="border-bottom mb-0" role="presentation"><a class="nav-link-style d-flex align-items-center px-4 py-3" role="tab" data-bs-toggle="tab" href="#tab-products"><i class="ci-package opacity-60 me-2"></i>Productos<span class="fs-sm text-muted ms-auto"></span></a></li>

                    
                    <li class="border-bottom mb-0" role="presentation"><a class="nav-link-style d-flex align-items-center px-4 py-3" role="tab" data-bs-toggle="tab" href="#tab-payouts"><i class="ci-currency-exchange opacity-60 me-2"></i>Pedidos</a></li>

                    <li class="border-bottom mb-0" role="presentation"><a class="nav-link-style d-flex align-items-center px-4 py-3" role="tab" data-bs-toggle="tab" href="#tab-users"><i class="ci-user opacity-60 me-2"></i>Usuarios<span class="fs-sm text-muted ms-auto"></span></a></li>

                    

                    <li class="border-bottom mb-0" role="presentation"><a class="nav-link-style d-flex align-items-center px-4 py-3" role="tab" data-bs-toggle="tab" href="#tab-prom"><i class="ci-cloud-upload opacity-60 me-2"></i>Agregar Promociones</a></li>

                    <li class="border-bottom mb-0" role="presentation"><a class="nav-link-style d-flex align-items-center px-4 py-3" role="tab" data-bs-toggle="tab" href="#tab-add-product"><i class="ci-cloud-upload opacity-60 me-2"></i>Agregar producto</a></li>

                    <li class="border-bottom mb-0" role="presentation"><a class="nav-link-style d-flex align-items-center px-4 py-3" role="tab" data-bs-toggle="tab" href="#tab-cat"><i class="ci-cloud-upload opacity-60 me-2"></i>Agregar Categorías</a></li>


                    <li class="mb-0" role="presentation"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="/index"><i class="ci-sign-out opacity-60 me-2"></i>Volver al inicio</a></li>
                  </ul>
   
                  <hr>
                </div>
              </div>
            </aside>
            <!-- Content-->
            <section class="col-lg-8 pt-lg-4 pb-4 mb-3">
              <div class="tab-content">

              

<div class="tab-pane fade show active" id="tab-details" role="tabpanel">

<?php

// Obtener el ID del checkout desde la URL
$id_check_out = isset($_GET["id"]) ? (int)$_GET["id"] : 0;

// Crear la consulta SQL para seleccionar los detalles del checkout con el ID especificado
$sql = "SELECT * FROM check_out INNER JOIN check_out_productos ON check_out.id_check_out = check_out_productos.id_check_out WHERE check_out.id_check_out = $id_check_out";

// Ejecutar la consulta y obtener los resultados
$resultado = mysqli_query($db, $sql);

// Verificar si se encontraron filas
if (mysqli_num_rows($resultado) > 0) {
    // Se encontraron filas, recorrer los resultados y mostrarlos en pantalla
    $row = $resultado->fetch_assoc(); ?>
       


    
       
<h4>Pedido#: <span><?php echo $row["id_check_out"]; ?></span></h4>

<div class="bg-secondary rounded-3 p-4 mb-4">
                      
                        <div class="ps-3">
                          <h5>Información</h5>
                          <h6 class="fs-ms">Nombre: <span><?php echo $row["nombre"]; ?> <?php echo $row["apellidos"]; ?></span></h6>
                          <h6 class="fs-ms">Correo: <span><?php echo $row["correo"]; ?></span></h6>
                          <h6 class="fs-ms">CID: <span><?php echo $row["cid"]; ?></span></h6>
                          <h6 class="fs-ms">Telefono: <span><?php echo $row["telefono"]; ?></span></h6>
                          <h6 class="fs-ms">Telefono: <span><?php echo $row["provincia"]; ?></span></h6>
                          <h6 class="fs-ms">Municipio: <span><?php echo $row["municipio"]; ?></span></h6>
                          <h6 class="fs-ms">Direccion: <span><?php echo $row["direccion_entrega"]; ?></span></h6>
                          <h6 class="fs-ms">Subtotal: <span>$<?php echo $row["total_precio"]; ?></span></h6>
                          <h6 class="fs-ms">Estado del pedido: <span class="text-success"><?php echo $row["estado_pago"]; ?></span></h6>

                          <hr class="mt-3 mb-2">
                          <h5>Productos</h5>


                          <?php


// Obtener el ID del checkout desde la URL
$id_check_out = isset($_GET["id"]) ? (int)$_GET["id"] : 0;

// Crear la consulta SQL para seleccionar todas las filas de las tablas check_out, check_out_productos y productos
$sql = "SELECT check_out_productos.id_producto, productos.nombre, check_out_productos.cantidad FROM check_out INNER JOIN check_out_productos ON check_out.id_check_out = check_out_productos.id_check_out INNER JOIN productos ON check_out_productos.id_producto = productos.id_producto WHERE check_out.id_check_out = $id_check_out";

// Ejecutar la consulta y obtener los resultados
$resultado = mysqli_query($db, $sql);

// Verificar si se encontraron filas
if (mysqli_num_rows($resultado) > 0) {
    // Se encontraron filas, recorrer los resultados y mostrarlos en pantalla
    while ($fila = mysqli_fetch_assoc($resultado)) {?>
      
      <h6 class="fs-ms"><span>ID: </span><span><?php echo $fila["id_producto"]; ?></span>  <?php echo $fila["nombre"]; ?><span>  x</span><span><?php echo $fila["cantidad"]; ?></span></h6>


        <?php
    }
} else {
    // No se encontraron filas, mostrar un mensaje al usuario
    echo "No hay pedidos aún";
}
?>


                         
    

                        








                          <hr class="mt-5 mb-2">

                          <a class="text_info" href="print?id=<?php echo $row["id_check_out"]; ?>">Ir a imprimir</a>

                        </div>      
               
                        </div>








        <?php
   
} else {
    // No se encontraron filas, mostrar un mensaje al usuario
    echo "No se encontró el checkout con el ID especificado";
}
?>


                
                </div>

              <div class="tab-pane fade" id="tab-users" role="tabpanel">

              <h3 class="text-dark">Usuarios</h3>


              <div class="table-responsive">
                      <table class="table table-layout-fixed fs-sm mb-0">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Telefono</th>
                            <th>Rango</th>
                            <th>Acciones</th>
                          </tr>
                        </thead>
                        <tbody>


                        <?php



// Consulta para seleccionar los nombres de las categorías
$sql = "SELECT * FROM usuarios LIMIT 10";
$result = $db->query($sql);

// Mostrar los resultados
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      ?>




                          <tr>
                            <td><?php echo $row["id_user"]; ?></td>
                            <td><?php echo $row["nombre"]; ?></td>
                            <td><?php echo $row["apellido"]; ?></td>
                            <td><?php echo $row["numero_telefono"]; ?></td>
                            <td><?php echo $row["rango"]; ?></td>
                            <td><form method="post">
                       <input type="hidden" name="form_name" value="remove_user">
                       <input type="hidden" name="id_user" value="<?php echo $row["id_user"]; ?>">

                       <button class="btn bg-faded-danger btn-icon" type="submit" data-bs-toggle="tooltip" aria-label="Delete" data-bs-original-title="Delete"><i class="ci-trash text-danger"></i></button>
                          </form></td>
                          </tr>
                          


        <?php

    }
} else {
    echo "No hay miembros";
}

?>
           




                         
                        </tbody>
                      </table>
                    </div>

                
                </div>



  



  
  
                <div class="tab-pane fade" id="tab-prom" role="tabpanel">

<h3 class="mt-2">Agregar promoción</h3>
              <form  method="post" enctype="multipart/form-data">
              <input type="hidden" name="form_name" value="banners">
               
                <label class="form-label">Imagen de la promoción</label>
                <input  class="form-control mb-3" type="file"  name="foto" id="foto">


                <div class="row gx-4 gy-3">
                  <div class="col-sm-6">
                    <label class="form-label" >Presentación</label>
                    <input class="form-control" type="text"  name="presentacion" >
                  </div>
                  <div class="col-sm-6">
                    <label class="form-label" >Título</label>
                    <input class="form-control" type="text"  name="titulo"  >
                  </div>
                  <div class="col-sm-6">
                    <label class="form-label" >Descripción</label>
                    <input class="form-control" type="text" name="discripcion">
                  </div>
                  <div class="col-sm-6">
                    <label class="form-label" >Texto Botón</label>
                    <input class="form-control"  type="text" name="texto_del_boton" >
                  </div>

                  <div class="col-sm-12">
                    <label class="form-label" >Enlace del botón</label>
                    <input class="form-control"  type="text" name="enlace_del_boton">
                  </div>

                  <input class="btn btn-primary" type="submit" value="Enviar">
                  </div>
</form>

            
<h3 class="text-dark pt-5">Promociones</h3>

<div class="container p-3 bg-secondary">
<div class="row">
  <div style="align-items: center; justify-content: center;" class="col-6">

  <p>World of music with</p>
  <h4>Headphones</h4>
  <p>Choose between</p>

  <button class="btn btn-primary">Shop Now</button>

  </div>


<div class="col-6 d-flex">

<img class="img-fluid" src="img/05(2).jpg" width="200" height="200" alt="foto">

</div>

</div>
</div>
</div>



              <div class="tab-pane fade" id="tab-cat" role="tabpanel">



              <h3>Añadir Categoría</h3>
                <form  method="post" enctype="multipart/form-data">
                <input type="hidden" name="form_name" value="form_cat">
              

                  <div class="row gx-4 gy-3">
                    <div class="col-sm-6">
                      <label class="form-label" for="dashboard-fn">Nombre del categoría</label>
                      <input class="form-control" type="text" id="nombre" name="nombre_categoria">
                    </div>
                    
                  
                    <div class="col-sm-6">
                      <label class="form-label" for="dashboard-country">Icono</label>
                      <select class="form-select" name="icono" id="icono">
                        <option value="ci-basket-alt">Por defecto</option>
                        <option value="ci-monitor">TV</option>
                        <option value="ci-mobile">Celular</option>
                        <option value="ci-watch">Reloj</option>
                        <option value="ci-earphones">Audifonos</option>
                        <option value="ci-speaker">Bocinas</option>
                        <option value="ci-laptop">Laptop</option>
                        <option value="ci-bread">Pan</option>
                        <option value="ci-ham-leg">Carne</option>
                        <option value="ci-apple">Manzana</option>
                        <option value="ci-fish">Pescado</option>
                        <option value="ci-toilet-paper">Papel Sanitario</option>
                        <option value="ci-juice">Jugo</option>
                        <option value="ci-cheese">Queso</option>
                        <option value="ci-wine">Botella</option>
                        <option value="ci-ice-cream">Helado</option>

                      </select>
                    </div>

            
                    
                    <div class="col-12">
                      <hr class="mt-2 mb-4">
                      <div class="d-sm-flex justify-content-between align-items-center">

                        <input class="btn btn-primary mt-3 mt-sm-0" type="submit" value="Publicar">

                      </div>
                    </div>
                  </div>
                </form>
                </div>






                <div class="tab-pane fade" id="tab-add-product" role="tabpanel">

                <h3 class="mt-2">Agregar producto</h3>
                <form  method="post" enctype="multipart/form-data">
                <input type="hidden" name="form_name" value="form_prod">
                 
                  <label class="form-label" for="dashboard-fn">Imagen del producto</label>
                  <input  class="form-control mb-3" type="file" multiple name="fotos[]" id="fotos">


                  <div class="row gx-4 gy-3">
                    <div class="col-sm-6">
                      <label class="form-label" for="dashboard-fn">Nombre del producto</label>
                      <input class="form-control" type="text" id="nombre" name="nombre" >
                    </div>
                    <div class="col-sm-6">
                      <label class="form-label" for="dashboard-ln">Marca o Proveedor</label>
                      <input class="form-control" type="text" id="marca" name="marca"  >
                    </div>
                    <div class="col-sm-6">
                      <label class="form-label" for="dashboard-email">Descripción del producto</label>
                      <input class="form-control" type="text" name="descripcion" id="descripcion">
                    </div>
                    <div class="col-sm-6">
                      <label class="form-label" for="dashboard-profile-name">Precio</label>
                      <input class="form-control" step="0.01" type="text" name="precio" id="precio">
                    </div>
                    <div class="col-sm-6">
                      <label class="form-label" for="dashboard-country">Categoría</label>
                      <select class="form-select" name="categoria" id="categoria">

                      <?php



// Consulta para seleccionar los nombres de las categorías
$sql = "SELECT nombre_categoria FROM categorias";
$result = $db->query($sql);

// Mostrar los resultados
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      ?>

<option value="<?php echo $row["nombre_categoria"]; ?>"><?php echo $row["nombre_categoria"]; ?></option>


        <?php

    }
} else {
    echo "No se encontraron resultados";
}

?>

                      </select>
                    </div>

            
                    
                    <div class="col-12">
                      <hr class="mt-2 mb-4">
                      <div class="d-sm-flex justify-content-between align-items-center">

                        <input class="btn btn-primary mt-3 mt-sm-0" type="submit" value="Publicar">

                      </div>
                    </div>
                  </div>
                </form>

                <hr class="mt-4 mb-4">
                <h3 class="mt-2">Ofertar producto</h3>
                <form  method="post" enctype="multipart/form-data">
                <input type="hidden" name="form_name" value="form_sale">
                 
               
                  <div class="row gx-4 gy-3">
                    <div class="col-sm-6">
                      <label class="form-label" for="dashboard-fn">ID del producto</label>
                      <input class="form-control" type="text" id="nombre" name="id_producto" placeholder="0">
                    </div>
                    
                    <div class="col-sm-6">
                      <label class="form-label" for="dashboard-profile-name">Nuevo precio</label>
                      <input class="form-control" step="0.01" type="number" name="nuevo_precio" id="precio" placeholder="00.00">
                    </div>
                  
                    
                    <div class="col-12">
                      <hr class="mt-2 mb-4">
                      <div class="d-sm-flex justify-content-between align-items-center">

                        <input class="btn btn-danger mt-3 mt-sm-0" type="submit" value="Ofertar">

                      </div>
                    </div>
                  </div>
                </form>
                </div>

                <div class="tab-pane fade" id="tab-payouts" role="tabpanel">
                  <div class="pt-2 px-4 ps-lg-0 pe-xl-5">
                    <h2 class="h3 py-2 text-center text-sm-start">Pedidos</h2>
                    <div class="row mx-n2 py-2">
                      <div class="col-sm-6 px-2 mb-4">
                        <div class="bg-secondary h-100 rounded-3 p-4">
                          <h3 class="h5">Último pedido</h3>
                          <p class="fs-sm">Your current earnings of <span class="fw-medium">$1,375.00</span> will be sent to you 8/15/2019</p>
                        </div>
                      </div>
                      
                    </div>
                    <h3 class="h5 pb-2">Historial de pedidos</h3>
                    <div class="table-responsive">
                      <table class="table table-layout-fixed fs-sm mb-0">
                        <thead>
                          <tr>
                          <th>ID</th>
                            <th>Cantidad</th>
                            <th>Nombre</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                            <th>Ver</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php


// Crear la consulta SQL para seleccionar todas las filas de las tablas check_out y check_out_productos
$sql = "SELECT * FROM check_out";

// Ejecutar la consulta y obtener los resultados
$resultado = mysqli_query($db, $sql);

// Verificar si se encontraron filas
if (mysqli_num_rows($resultado) > 0) {
    // Se encontraron filas, recorrer los resultados y mostrarlos en pantalla
    while ($row = mysqli_fetch_assoc($resultado)) {?>

        
<tr>
                            <td><?php echo $row["id_check_out"]; ?></td>
                            <td>$<?php echo $row["total_precio"]; ?></td>
                            <td><?php echo $row["nombre"]; ?> <?php echo $row["apellidos"]; ?></td>
                            <td><span class="badge bg-info m-0"><?php echo $row["estado_pago"]; ?></span></td>
                            <td><?php echo $row["fecha_check"]; ?></td>
                            <td><a class="text-primary" href="dashboard029_details?id=<?php echo $row["id_check_out"]; ?>">Ver más</a></td>
                          </tr>

        <?php
    }
} else {
    // No se encontraron filas, mostrar un mensaje al usuario
    echo "No hay pedidos aún . . .";
}
?>


                          
                        </tbody>
                      </table>
                    </div>
                    
                  </div>
                </div>





                <div class="tab-pane fade" id="tab-sales" role="tabpanel">
                  <div class="pt-2 px-4 ps-lg-0 pe-xl-5">
                    <h2 class="h3 py-2 text-center text-sm-start">Estadisticas / Finanzas</h2>
                    <div class="row mx-n2 pt-2">
                      <div class="col-md-4 col-sm-6 px-2 mb-4">
                        <div class="bg-secondary h-100 rounded-3 p-4 text-center">
                          <h3 class="fs-sm text-muted">Productos (Total)</h3>
                          

                          <p class="h2 mb-2">$<span><?php

// Consulta para obtener la suma total de los precios de todos los productos
$sql = "SELECT SUM(precio) as total FROM productos";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total = $row["total"];

if ($total === NULL) {
  // No hay productos, mostrar 00.00 como el total
  echo "00.00";
} else {
  // Hay productos, mostrar el total
  echo $total;
}
?></span></p>
           
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 px-2 mb-4">
                        <div class="bg-secondary h-100 rounded-3 p-4 text-center">
                          <h3 class="fs-sm text-muted">Your balance</h3>
                          <p class="h2 mb-2">$1,375.<small>00</small></p>
                          <p class="fs-ms text-muted mb-0">To be paid on 8/15/2021</p>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-12 px-2 mb-4">
                        <div class="bg-secondary h-100 rounded-3 p-4 text-center">
                          <h3 class="fs-sm text-muted">Lifetime earnings</h3>
                          <p class="h2 mb-2">$9,156.<small>74</small></p>
                          <p class="fs-ms text-muted mb-0">Based on list price</p>
                        </div>
                      </div>
                
                      
                    </div>
                  </div>
                </div>



                <div class="tab-pane fade" id="tab-products" role="tabpanel">
                  <div class="pt-2 px-4 ps-lg-0 pe-xl-5">
                    <!-- Title-->
                    <div class="d-sm-flex flex-wrap justify-content-between align-items-center border-bottom">
                      <h2 class="h3 py-2 me-2 text-center text-sm-start">Productos<span class="badge bg-faded-accent fs-sm text-body align-middle ms-2">5</span></h2>
                    </div>



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

// Prepara la consulta SQL para seleccionar los productos
$sql = "SELECT * FROM productos ORDER BY id_producto DESC LIMIT $offset, $products_per_page";

// Ejecuta la consulta
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
                    <div class="d-block d-sm-flex align-items-center py-4 border-bottom"><a class="d-block mb-3 mb-sm-0 me-sm-4 ms-sm-0 mx-auto" href="details.php?id=<?php echo $row["id_producto"]; ?>" style="width: 12.5rem;"><?php
                echo '    <img class="rounded-3" src="' . htmlspecialchars($foto_url) . '" alt="Product">' 
                ?></a>
                      <div class="text-center text-sm-start">
                        <h3 class="h6 product-title mb-2"><a href="details.php?id=<?php echo $row["id_producto"]; ?>"><?php echo $row["nombre"]; ?></a></h3>
                        <div class="d-inline-block text-accent">$ <span><?php echo $row["precio"]; ?></span></div>
                        <div class="d-inline-block text-muted fs-ms border-start ms-2 ps-2">Categoría: <span class="fw-medium"><?php echo $row["categoria"]; ?></span></div>
                        <div class="d-inline-block text-muted fs-ms border-start ms-2 ps-2">ID: <span class="fw-medium"><?php echo $row["id_producto"]; ?></span></div>
                        <div class="d-flex justify-content-center justify-content-sm-start pt-3">
      
                          <button class="btn bg-faded-info btn-icon me-2" type="button" data-bs-toggle="tooltip" aria-label="Edit" data-bs-original-title="Edit"><i class="ci-edit text-info"></i></button>

                          <form method="post">
                       <input type="hidden" name="form_name" value="remove_product">
                       <input type="hidden" name="id_producto" value="<?php echo $row["id_producto"]; ?>">

                       <button class="btn bg-faded-danger btn-icon" type="submit" data-bs-toggle="tooltip" aria-label="Delete" data-bs-original-title="Delete"><i class="ci-trash text-danger"></i></button>
                          </form>
                          
                        </div>
                      </div>
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
     echo '<h3 class="mt-5 mb-5">No hay productos</h3>';
 }
 

 ?>











                  </div>
                </div>

                <div class="tab-pane fade" id="tab-settings" role="tabpanel">
              <div class="pt-2 px-4 ps-lg-0 pe-xl-5">
                <h2 class="h3 py-2 text-center text-sm-start">Ajustes</h2>
                <!-- Tabs-->
                <ul class="nav nav-tabs nav-justified" role="tablist">
                  <li class="nav-item" role="presentation"><a class="nav-link px-0 active" href="#profile" data-bs-toggle="tab" role="tab" aria-selected="true">
                      <div class="d-none d-lg-block"><i class="ci-user opacity-60 me-2"></i>Perfil</div>
                      <div class="d-lg-none text-center"><i class="ci-user opacity-60 d-block fs-xl mb-2"></i><span class="fs-ms">Perfil</span></div></a></li>
                  <li class="nav-item" role="presentation"><a class="nav-link px-0" href="#notifications" data-bs-toggle="tab" role="tab" aria-selected="false" tabindex="-1">
                      <div class="d-none d-lg-block"><i class="ci-bell opacity-60 me-2"></i>Notifications</div>
                      <div class="d-lg-none text-center"><i class="ci-bell opacity-60 d-block fs-xl mb-2"></i><span class="fs-ms">Notifications</span></div></a></li>
                  <li class="nav-item" role="presentation"><a class="nav-link px-0" href="#payment" data-bs-toggle="tab" role="tab" aria-selected="false" tabindex="-1">
                      <div class="d-none d-lg-block"><i class="ci-card opacity-60 me-2"></i>Payment methods</div>
                      <div class="d-lg-none text-center"><i class="ci-card opacity-60 d-block fs-xl mb-2"></i><span class="fs-ms">Payment</span></div></a></li>
                </ul>
                <!-- Tab content-->
                <div class="tab-content">
                 
                  <div class="tab-pane fade show active" id="profile" role="tabpanel">
                    <div class="bg-secondary rounded-3 p-4 mb-4">
                      <div class="d-flex align-items-center"><img class="rounded" src="img/man.png" width="90" alt="MQF">
                        <div class="ps-3">
                          <button class="btn btn-light btn-shadow btn-sm mb-2" type="button"><i class="ci-loading me-2"></i>Cambiar <span class="d-none d-sm-inline">avatar</span></button>
                          <div class="p mb-0 fs-ms text-muted">Upload JPG, GIF or PNG image. 300 x 300 required.</div>
                        </div>
                      </div>
                    </div>
                    <div class="row gx-4 gy-3">
                    <?php

// Especificar el ID del usuario que deseas obtener
$id_usuario = $_SESSION['user_id'];

// Consulta para obtener el usuario con el ID especificado
$sql = "SELECT * FROM usuarios WHERE id_user=" . $id_usuario;
$result = $conn->query($sql);
$row = $result->fetch_assoc();

?>


                      <div class="col-sm-6">
                        <label class="form-label" for="dashboard-fn">Nombre</label>
                        <input class="form-control" type="text" id="dashboard-fn" value="<?php echo $row["nombre"]; ?>" disabled="">
                      </div>
                      <div class="col-sm-6">
                        <label class="form-label" for="dashboard-ln">Apellidos</label>
                        <input class="form-control" type="text" id="dashboard-ln" value="<?php echo $row["apellido"]; ?>" disabled="">
                      </div>
                      <div class="col-sm-6">
                        <label class="form-label" for="dashboard-email">Correo</label>
                        <input class="form-control" type="text" id="dashboard-email" value="<?php echo $row["correo_electronico"]; ?>" disabled="">
                      </div>
                      <div class="col-sm-6">
                        <label class="form-label" for="dashboard-profile-name">Telefono</label>
                        <input class="form-control" type="text" id="dashboard-profile-name" value="<?php echo $row["numero_telefono"]; ?>" disabled="">
                      </div>
                      
                      
                    </div>
                  </div>
                  <!-- Notifications-->
                  <div class="tab-pane fade" id="notifications" role="tabpanel">
                    <div class="bg-secondary rounded-3 p-4">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="nf-disable-all" data-master-checkbox-for="#notifocation-settings">
                        <label class="form-check-label fw-medium" for="nf-disable-all">Enable/disable all notifications</label>
                      </div>
                    </div>
                    <div id="notifocation-settings">
                      <div class="border-bottom p-4">
                        <div class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" id="nf-product-sold" checked="">
                          <label class="form-check-label" for="nf-product-sold">Product sold notifications</label>
                        </div>
                        <div class="form-text">Send an email when someone purchased one of my products</div>
                      </div>
                      <div class="border-bottom p-4">
                        <div class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" id="nf-product-updated" checked="">
                          <label class="form-check-label" for="nf-product-updated">Product update notifications</label>
                        </div>
                        <div class="form-text">Send an email when a product I've purchased is updated</div>
                      </div>
                      <div class="border-bottom p-4">
                        <div class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" id="nf-product-comment" checked="">
                          <label class="form-check-label" for="nf-product-comment">Product comment notifications</label>
                        </div>
                        <div class="form-text">Send an email when someone comments on one of my products</div>
                      </div>
                      <div class="border-bottom p-4">
                        <div class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" id="nf-product-review" checked="">
                          <label class="form-check-label" for="nf-product-review">Product review notification</label>
                        </div>
                        <div class="form-text">Send an email when someone leaves a review with their rating</div>
                      </div>
                      <div class="border-bottom p-4">
                        <div class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" id="nf-daily-summary">
                          <label class="form-check-label" for="nf-daily-summary">Daily summary emails</label>
                        </div>
                        <div class="form-text">Send me a daily summary of all products sold, commented or reviewed</div>
                      </div>
                    </div>
                    <div class="text-sm-end mt-4">
                      <button class="btn btn-primary" type="button">Save changes</button>
                    </div>
                  </div>
                  <!-- Payment methods-->
                  <div class="tab-pane fade" id="payment" role="tabpanel">
                    <div class="bg-secondary rounded-3 p-4 mb-4">
                      <p class="fs-sm text-muted mb-0">Primary payment method is used by default</p>
                    </div>
                    <div class="table-responsive fs-md mb-4">
                      <table class="table table-hover mb-0">
                        <thead>
                          <tr>
                            <th>Your credit / debit cards</th>
                            <th>Name on card</th>
                            <th>Expires on</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="py-3 align-middle">
                              <div class="d-flex align-items-center"><img src="./Cartzilla _ Account Settings_files/card-visa.png" width="39" alt="Visa">
                                <div class="ps-2"><span class="fw-medium text-heading me-1">Visa</span>ending in 4999<span class="align-middle badge badge-info ms-2">Primary</span></div>
                              </div>
                            </td>
                            <td class="py-3 align-middle">John doe</td>
                            <td class="py-3 align-middle">08 / 2019</td>
                            <td class="py-3 align-middle"><a class="nav-link-style me-2" href="" data-bs-toggle="tooltip" aria-label="Edit" data-bs-original-title="Edit"><i class="ci-edit"></i></a><a class="nav-link-style text-danger" href="" data-bs-toggle="tooltip" aria-label="Remove" data-bs-original-title="Remove">
                                <div class="ci-trash"></div></a></td>
                          </tr>
                          <tr>
                            <td class="py-3 align-middle">
                              <div class="d-flex align-items-center"><img src="./Cartzilla _ Account Settings_files/card-master.png" width="39" alt="MesterCard">
                                <div class="ps-2"><span class="fw-medium text-heading me-1">MasterCard</span>ending in 0015</div>
                              </div>
                            </td>
                            <td class="py-3 align-middle">John doe</td>
                            <td class="py-3 align-middle">11 / 2021</td>
                            <td class="py-3 align-middle"><a class="nav-link-style me-2" href="" data-bs-toggle="tooltip" aria-label="Edit" data-bs-original-title="Edit"><i class="ci-edit"></i></a><a class="nav-link-style text-danger" href="" data-bs-toggle="tooltip" aria-label="Remove" data-bs-original-title="Remove">
                                <div class="ci-trash"></div></a></td>
                          </tr>
                          <tr>
                            <td class="py-3 align-middle">
                              <div class="d-flex align-items-center"><img src="./Cartzilla _ Account Settings_files/card-paypal.png" width="39" alt="PayPal">
                                <div class="ps-2"><span class="fw-medium text-heading me-1">PayPal</span>j.doe@example.com</div>
                              </div>
                            </td>
                            <td class="py-3 align-middle">—</td>
                            <td class="py-3 align-middle">—</td>
                            <td class="py-3 align-middle"><a class="nav-link-style me-2" href="#" data-bs-toggle="tooltip" aria-label="Edit" data-bs-original-title="Edit"><i class="ci-edit"></i></a><a class="nav-link-style text-danger" href="#" data-bs-toggle="tooltip" aria-label="Remove" data-bs-original-title="Remove">
                                <div class="ci-trash"></div></a></td>
                          </tr>
                          <tr>
                            <td class="py-3 align-middle">
                              <div class="d-flex align-items-center"><img src="./Cartzilla _ Account Settings_files/card-visa.png" width="39" alt="Visa">
                                <div class="ps-2"><span class="fw-medium text-heading me-1">Visa</span>ending in 6073</div>
                              </div>
                            </td>
                            <td class="py-3 align-middle">John doe</td>
                            <td class="py-3 align-middle">09 / 2021</td>
                            <td class="py-3 align-middle"><a class="nav-link-style me-2" href="#" data-bs-toggle="tooltip" aria-label="Edit" data-bs-original-title="Edit"><i class="ci-edit"></i></a><a class="nav-link-style text-danger" href="#" data-bs-toggle="tooltip" aria-label="Remove" data-bs-original-title="Remove">
                                <div class="ci-trash"></div></a></td>
                          </tr>
                          <tr>
                            <td class="py-3 align-middle">
                              <div class="d-flex align-items-center"><img src="./Cartzilla _ Account Settings_files/card-visa.png" width="39" alt="Visa">
                                <div class="ps-2"><span class="fw-medium text-heading me-1">Visa</span>ending in 9791</div>
                              </div>
                            </td>
                            <td class="py-3 align-middle">John doe</td>
                            <td class="py-3 align-middle">05 / 2021</td>
                            <td class="py-3 align-middle"><a class="nav-link-style me-2" href="#" data-bs-toggle="tooltip" aria-label="Edit" data-bs-original-title="Edit"><i class="ci-edit"></i></a><a class="nav-link-style text-danger" href="#" data-bs-toggle="tooltip" aria-label="Remove" data-bs-original-title="Remove">
                                <div class="ci-trash"></div></a></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="text-sm-end"><a class="btn btn-primary" href="#add-payment" data-bs-toggle="modal">Add payment method</a></div>
                  </div>
                </div>
              </div>
            </div>
            </div>
            </section>
          </div>
        </div>
      </div>
    </main>
    <!-- Footer-->
    <footer class="footer bg-dark pt-5">
      <div class="container pt-2 pb-3">
          <div class="d-md-flex justify-content-between pt-4">
            <div class="pb-4 fs-xs text-light opacity-50 text-center text-md-start">© All rights reserved. Made by <a class="text-light" href="" target="_blank" rel="noopener">Uixsoftare</a></div>
            <div class="widget widget-links widget-light pb-4">
              <ul class="widget-list d-flex flex-wrap justify-content-center justify-content-md-start">
                <li class="widget-list-item ms-4"><a class="widget-list-link fs-ms" href="#">Políticas de privacidad</a></li>
                <li class="widget-list-item ms-4"><a class="widget-list-link fs-ms" href="#">Soporte web</a></li>
                <li class="widget-list-item ms-4"><a class="widget-list-link fs-ms" href="#">Términos de uso</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- Toolbar for handheld devices (Marketplace)-->
   <!-- Toolbar for handheld devices (Default)-->
   
    <!-- Back To Top Button--><a class="btn-scroll-top" href="#top" data-scroll=""><span class="btn-scroll-top-tooltip text-muted fs-sm me-2">Top</span><i class="btn-scroll-top-icon ci-arrow-up">   </i></a>
    <!-- Vendor scrits: js libraries and plugins-->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/simplebar.min.js"></script>
    <script src="js/tiny-slider.js"></script>
    <script src="js/smooth-scroll.polyfills.min.js"></script>
    <!-- Main theme script-->
    <script src="js/theme.min.js"></script>
  
</body></html>

<?php

} else {
    // El usuario no es un admin, redirigirlo a otra página o mostrar un mensaje de error
    echo "<script>window.location.href = 'index';</script>";
    exit;
}
?>