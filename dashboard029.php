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

// Verificar si el usuario tiene una sesión iniciada
if (!isset($_SESSION["user_id"])) {
    // El usuario no tiene una sesión iniciada, redirigirlo a la página de inicio de sesión
    echo "<script>window.location.href = 'login';</script>";
    exit;
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
if ($rango_usuario_actual == "Admin") { ?>



<!DOCTYPE html>

<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
  <title>Dashboard - Más Q'Fresco</title>
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
          <div class="container"><a class="navbar-brand d-none d-sm-flex me-3 flex-shrink-0" href="https://masqfresco.com/"> <img width="50px" src="https://masqfresco.com/img/logo.svg" alt="Logo"> <span style="font-family: 'Kalam', cursive;" class="h4 fw-bold my-auto ms-2">Más Q'Fresco</span></a><a class="navbar-brand d-sm-none me-2" href="https://masqfresco.com/"><img src="https://masqfresco.com/img/logo.svg" width="60" alt="Logo"></a>
            <!-- Toolbar-->
            <div class="navbar-toolbar d-flex align-items-center order-lg-3">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"><span class="navbar-toggler-icon"></span></button><a class="navbar-tool d-none d-lg-flex" href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#searchBox" role="button" aria-expanded="false" aria-controls="searchBox"><span class="navbar-tool-tooltip">Buscar</span>
                <div class="navbar-tool-icon-box"><i class="navbar-tool-icon ci-search"></i></div></a><a class="navbar-tool d-none d-lg-flex" href=""><span class="navbar-tool-tooltip">Favorites</span>
                <div class="navbar-tool-icon-box"><i class="navbar-tool-icon ci-heart"></i></div></a>



              <div class="navbar-tool ms-2"><a class="navbar-tool-icon-box border dropdown-toggle" href=""><img src="img/man.png" width="32" alt="MQF"></a>
              
              
              <a class="navbar-tool-text ms-n1" href=""><small>MQ'F.</small>$<span><?php

// Consulta para obtener la suma total de los precios de todos los productos
$sql = "SELECT SUM(total_precio) as total FROM check_out WHERE estado_pago = 'Pagado'";
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
?></span></a>
                
              </div>
              
            </div>
            <div class="collapse navbar-collapse me-auto order-lg-2" id="navbarCollapse">
              <!-- Search-->
              <div class="input-group d-lg-none my-3"><i class="ci-search position-absolute top-50 start-0 translate-middle-y text-muted fs-base ms-3"></i>
                <input class="form-control rounded-start" type="text" placeholder="Buscar productos">
              </div>
              
              <!-- Primary menu-->
              <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="https://masqfresco.com">Volver a la tienda</a></li>
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
      <div class="page-title-overlap bg-accent pt-4"  style="background-image:url(img/whooping_banner_shape_2.png); background-position: bottom left; background-repeat: space;
    background-size: cover; ">
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
                    <li class="border-bottom mb-0"  role="presentation"><a class="nav-link-style d-flex align-items-center px-4 py-3 active" role="tab" data-bs-toggle="tab" href="#tab-settings"><i class="bi-nut-fill  me-2"></i>Ajustes</a></li>


                    <li class="border-bottom mb-0" role="presentation"><a class="nav-link-style d-flex align-items-center px-4 py-3" role="tab" data-bs-toggle="tab" href="#tab-chat"><i class="bi-wechat me-2"></i>Chat</a></li>


                      <li class="border-bottom mb-0" role="presentation"><a class="nav-link-style d-flex align-items-center px-4 py-3" role="tab" data-bs-toggle="tab" href="#tab-sales"><i class="bi-credit-card-2-front-fill me-2"></i>Finanzas<span class="fs-sm text-muted ms-auto">$<span><?php

// Consulta para obtener la suma total de los precios de todos los productos
$sql = "SELECT SUM(total_precio) as total FROM check_out WHERE estado_pago = 'Pagado'";
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

                    <li class="border-bottom mb-0" role="presentation"><a class="nav-link-style d-flex align-items-center px-4 py-3" role="tab" data-bs-toggle="tab" href="#tab-products"><i class="bi-bag-fill me-2"></i>Productos<span class="fs-sm text-muted ms-auto"><span class="badge bg-info rounded-pill text-light fs-sm align-middle ms-2"><?php

// Crear la consulta SQL para contar el número de productos
$sql = "SELECT COUNT(*) AS total FROM productos";

// Ejecutar la consulta y obtener el resultado
$resultado = mysqli_query($db, $sql);
$fila = mysqli_fetch_assoc($resultado);
$total_productos = $fila['total'];

echo $total_productos;

?></span></span></a></li>

                    
                    <li class="border-bottom mb-0" role="presentation"><a class="nav-link-style d-flex align-items-center px-4 py-3" role="tab" data-bs-toggle="tab" href="#tab-payouts"><i class="bi-backpack-fill me-2"></i>Pedidos</a></li>

                    <li class="border-bottom mb-0" role="presentation"><a class="nav-link-style d-flex align-items-center px-4 py-3" role="tab" data-bs-toggle="tab" href="#tab-users"><i class="bi-people-fill me-2"></i>Usuarios<span class="fs-sm text-muted ms-auto"><span class="badge bg-success text-light rounded-pill fs-sm  align-middle ms-2"><?php

// Crear la consulta SQL para contar el número de productos
$sql = "SELECT COUNT(*) AS total FROM usuarios";

// Ejecutar la consulta y obtener el resultado
$resultado = mysqli_query($db, $sql);
$fila = mysqli_fetch_assoc($resultado);
$total_productos = $fila['total'];

echo $total_productos;

?></span></span></a></li>

                    

                    <li class="border-bottom mb-0" role="presentation"><a class="nav-link-style d-flex align-items-center px-4 py-3" role="tab" data-bs-toggle="tab" href="#tab-prom"><i class="bi-megaphone-fill me-2"></i>Agregar Promociones</a></li>

                    <li class="border-bottom mb-0" role="presentation"><a class="nav-link-style d-flex align-items-center px-4 py-3" role="tab" data-bs-toggle="tab" href="#tab-add-product"><i class="bi-bag-plus-fill me-2"></i>Agregar producto</a></li>

                    <li class="border-bottom mb-0" role="presentation"><a class="nav-link-style d-flex align-items-center px-4 py-3" role="tab" data-bs-toggle="tab" href="#tab-cat"><i class="bi-folder-fill me-2"></i>Agregar Categorías</a></li>


                    
                  </ul>
                
                  <a class="text-dark d-flex align-items-center px-4 py-3" href="index"><i class="bi-house-up-fill me-2"></i>Volver al inicio</a>

                
   
                  <hr>
                </div>
              </div>
            </aside>
            <!-- Content-->
            <section class="col-lg-8 pt-lg-4 pb-4 mb-3">
              <div class="tab-content">










              <div class="tab-pane fade" id="tab-chat" role="tabpanel">


              <div class="bg-light p-2 me-lg-4 me-2">
              <h3 class="ms-2 fw-light">Chats</h3>

            
              <ul class="list-unstyled mb-0 d-flex"  role="tablist">


              
              <?php
$sql = "SELECT sms_c.id_user, usuarios.nombre, usuarios.rgbcolor
FROM sms_c 
JOIN usuarios ON sms_c.id_user = usuarios.id_user 
GROUP BY sms_c.id_user, usuarios.nombre, usuarios.rgbcolor
ORDER BY MAX(sms_c.fecha_sms_c) DESC";



$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Obtiene las dos primeras letras del nombre
        $initials = strtoupper(substr($row["nombre"], 0, 2));

?>

<li class="nav-item" role="presentation">
    <a class="nav-link px-0" href="#tab-thread-<?php echo $row["id_user"]; ?>" data-bs-toggle="tab" role="tab" aria-selected="true">
        <div class="me-2 shadow" style="background-color: <?php echo $row["rgbcolor"]; ?>; width: 60px; height: 60px; border-radius: 50%; display: flex; justify-content: center; align-items: center; opacity: 0.3;">
            <span style="color: white; font-size: 24px;"><?php echo $initials; ?></span>
        </div>
    </a>
    <center>
    <p><?php echo $row["nombre"]; ?></p>
    </center>
</li>

<?php
    }
}
?>




                </ul></div>


                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $(".nav-item").click(function(){
    $(".nav-item").find('.me-2').css('opacity', '0.3'); // Añade opacidad a todos los elementos
    $(this).find('.me-2').css('opacity', '1'); // Quita la opacidad del elemento seleccionado
  });
});
</script>

               



                <style>
                  .scrollbar, .offcanvas.faq-sidebar, .tox .tox-toolbar--scrolling, .picmo__picker.picmo__picker .picmo__emojiArea, html:not(.navbar-vertical-collapsed) .navbar-vertical .navbar-vertical-content, .scrollbar-overlay {
    overflow: auto;
}.flex-column-reverse {
    -webkit-box-orient: vertical !important;
    -webkit-box-direction: reverse !important;
    -ms-flex-direction: column-reverse !important;
    flex-direction: column-reverse !important;
}
                </style>

              <div class="tab-content">



              <?php

$sql = "SELECT * FROM usuarios ";

$result = $conn->query($sql);


// Verifica si se encontraron comentarios
if ($result->num_rows > 0) {
    // Muestra los comentarios del producto
    while ($row = $result->fetch_assoc()) {
      
?>
              <div class="tab-pane fade" id="tab-thread-<?php echo $row["id_user"]; ?>" role="tabpanel">

              <div class="bg-light d-flex align-items-center shadow rounded-3 p-3 me-lg-4 me-2">
    <i class="ci-send text-dark me-3"></i>
    <div>
        <h5 class="mb-0 ms-2"><?php echo $row["nombre"]; ?> <?php echo $row["apellido"]; ?></h5>
        <p class="mb-0 ms-2 fs-xs"><?php echo $row["correo_electronico"]; ?></p>
    </div>
</div>





                <div class="h-100 text-start bg-secondary px-4">


            <div style="  height: 30rem;">
        <div class="d-flex flex-column-reverse scrollbar h-100 p-3">



        <div style=" display: flex; justify-content: flex-end; flex-direction: column;" id="chatContainer-<?php echo $row["id_user"]; ?>"></div>

        


                      
                <?php
$sql2 = "SELECT 'sms_c' as type, id_sms_c as id, id_user, mensaje_c as mensaje, fecha_sms_c as fecha
FROM sms_c WHERE id_user='" . $row["id_user"] . "'
UNION ALL
SELECT 'sms_o' as type, id_sms_o as id, id_user_send as id_user, mensaje_o as mensaje, fecha_sms_o as fecha
FROM sms_o WHERE id_user_send='" . $row["id_user"] . "'
ORDER BY fecha DESC";
$result2 = $conn->query($sql2);
  // Clave de cifrado - asegúrate de que esta clave sea segura y no la compartas
  $clave_cifrado = 'clave-secreta';


if ($result2->num_rows > 0) {
    while ($row2 = $result2->fetch_assoc()) {

        $mensaje_descifrado = openssl_decrypt($row2["mensaje"], 'AES-128-ECB', $clave_cifrado);
        $initials = strtoupper(substr($row["nombre"], 0, 2));
        if ($row2["type"] == "sms_c") {
            // Muestra el mensaje del cliente
            ?>
            
            <div class="d-flex chat-message">
                    <div class="d-flex mb-2 flex-1">
                      <div class="w-100 w-xxl-75">
                        <div class="d-flex hover-actions-trigger">
                        <div class="me-2 shadow" style="background-color: <?php echo $row["rgbcolor"]; ?>; width: 30px; height: 30px; border-radius: 50%; display: flex; justify-content: center; align-items: center;">
            <span style="color: white; font-size: 12px;"><?php echo $initials; ?></span>
        </div>
                          <div class="chat-message-content received me-2">
                            <div style="border-radius: 0px 20px 20px 20px;" class="mb-1 received-message-content border p-3">
                              <p class="mb-0"><?php echo $mensaje_descifrado; ?></p>
                            </div>
                          </div>
                          
                        </div>
                        <p style="font-size: 10px;" class="mb-0 ms-5"><?php echo $row2["fecha"]; ?></p>
                      </div>
                    </div>
                  </div>
            <?php
        } else if ($row2["type"] == "sms_o") {
            // Muestra el mensaje del operador
            ?>
            <div style="max-width: 70%; margin-left: auto;" class="chat-message">
    <div class="d-flex mb-2 justify-content-end flex-1">
      <div class="w-100 w-xxl-75">
        <div class="d-flex flex-end-center hover-actions-trigger">
          <div class="chat-message-content me-2">
            <div style="border-radius: 20px 20px 0px 20px; background-color: <?php echo $row["rgbcolor"]; ?>" class="mb-1 sent-message-content light p-3 text-white">
              <p class="mb-0"><?php echo $mensaje_descifrado; ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
            <?php
        }
    }
}


?>



<div style="max-width: 70%; margin-left: auto;" class="chat-message">
    <div class="d-flex mb-2 justify-content-end flex-1">
      <div class="w-100 w-xxl-75">
        <div class="d-flex flex-end-center hover-actions-trigger">
          <div class="chat-message-content me-2">
            <div style="border-radius: 20px 20px 0px 20px; background-color: <?php echo $row["rgbcolor"]; ?>" class="mb-1 sent-message-content light p-3 text-white">
              <p class="mb-0">Bienvenido a nuestra plataforma! Preguntenos cualquier duda o sugerencia que tenga</p>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>




</div></div>




<hr class="pt-4">
<div class="w-100 pt-3 me-lg-4 me-2">
  <div class="d-flex align-items-center">
    <form action="funtions" class="formsmso d-flex align-items-center w-100" method="post" enctype="multipart/form-data" data-user-id="<?php echo $row["id_user"]; ?>" data-user-color="<?php echo $row["rgbcolor"]; ?>">
      <input type="hidden" name="form_name" value="form_sms_o">
      <input type="hidden" name="id_user_send" value="<?php echo $row["id_user"]; ?>">
      <input class="form-control flex-grow-1 me-2 rounded-pill" name="mensaje_o" type="text" placeholder="Escribe tu mensaje" required>
      <button style="background-color: <?php echo $row["rgbcolor"]; ?>; " class="btn px-4 py-2 rounded-pill text-light" type="submit">Enviar <i class="ci-send text-light"></i></button>
    </form>
  </div>
</div>













                </div>
              </div>

              
              <?php
    }
}

?>

                </div></div>


                




                <script>
$(document).on('submit', '.formsmso', function(e) {
    e.preventDefault();


    var form = $(this);
    // Obtén el mensaje del campo de entrada
    var mensaje = $(this).find('input[name="mensaje_o"]').val();

    // Obtén el ID del usuario del atributo de datos del formulario
    var userId = $(this).data('user-id');

    // Crea un objeto FormData con los datos del formulario
    var formData = new FormData(this);

    $.ajax({
        type: 'post',
        url: 'funtions.php',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {


          var color = form.data('user-color');
            // Crea los elementos HTML necesarios
            var mensajeElement = $(
        '<div style="max-width: 70%; margin-left: auto;" class="chat-message">' +
            '<div class="d-flex mb-2 justify-content-end flex-1">' +
                '<div class="w-100 w-xxl-75">' +
                    '<div class="d-flex flex-end-center hover-actions-trigger">' +
                        '<div class="chat-message-content me-2">' +
                        '<div style="border-radius: 20px 20px 0px 20px; background-color:' + color + ';" class="mb-1 sent-message-content light p-3 text-white">' +
                                '<p class="mb-0"></p>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +
                '</div>' +
            '</div>' +
        '</div>');

            // Añade el mensaje al elemento <p>
            mensajeElement.find('p').text(mensaje);

            // Añade el nuevo mensaje al contenedor del chat correcto
            $('#chatContainer-' + userId).append(mensajeElement);


            // Borrar el contenido del campo de entrada
            $('input[name="mensaje_o"]').val('');
        }
    });
});



</script>
              



              <div class="tab-pane fade" id="tab-users" role="tabpanel">

              <h2 class="h3 py-2 text-center text-sm-start fw-light">Usuarios</h2>

              <form id="form-busqueda_user" method="post">

<div class="input-group flex-nowrap mb-3"><i class="ci-search position-absolute top-50 start-0 translate-middle-y ms-3"></i>

<input style="border-radius: 10px 0px 0px 10px; background:white; border-width:0px; width: 100%" href="#searchBo"  data-bs-toggle="collapse" name="busqueda_user" id="campo-busqueda_user"  aria-expanded="false" aria-controls="searchBo" class="form-control dark filter  shadow w-100" type="text" placeholder="Busqueda de pedidos">
<button class="btn btn-light shadow flex-shrink-0" type="submit" style="width: 10rem; border-radius: 0px 10px 10px 0px;  border-width:0px;">Buscar</button>

</form>
          </div>


              <div class="table-responsive fs-md mb-4">
              <table class="table table-hover mb-0">
                <thead class="bg-secondary">
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


$products_per_page = 10;

// Recupera el número de página actual
$page_user = isset($_GET["page_user"]) ? (int)$_GET["page_user"] : 1;

// Calcula el índice del primer producto a mostrar
$offset = ($page_user - 1) * $products_per_page;

// Consulta para seleccionar los nombres de las categorías
$sql = "SELECT * FROM usuarios LIMIT $offset, $products_per_page";
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
                            <td>
                              <div class="d-flex">
                            <button class="btn bg-faded-info btn-icon me-2" type="button"  data-bs-toggle="modal" data-bs-target="#user-modal" data-id="<?php echo $row["id_user"]; ?>"><i class="ci-edit text-info"></i></button>

                            <form action="funtions" method="post">
                       <input type="hidden" name="form_name" value="remove_user">
                       <input type="hidden" name="id_user" value="<?php echo $row["id_user"]; ?>">

                       <button class="btn bg-faded-danger btn-icon" type="submit" data-bs-toggle="tooltip" aria-label="Delete" data-bs-original-title="Delete"><i class="ci-trash text-danger"></i></button>
                          </form>
                          </div>
                        </td>
                          </tr>
                          


                          <?php
    }
    
                      
  
    // Prepara la consulta SQL para contar el total de productos
    $sql = "SELECT COUNT(*) as total FROM usuarios";

     // Ejecuta la consulta
     $result = $conn->query($sql);
     $row = $result->fetch_assoc();
     $total_products = $row["total"];
 
     // Calcula el número total de páginas
     $total_pages = ceil($total_products / $products_per_page);

     
     echo '<nav class="d-flex justify-content-between pb-3" aria-label="Page navigation">';
     echo '  <ul class="pagination">';
     if ($page_user > 1) {
         echo '    <li class="page-item"><a class="page-link" href="?page_user=' . ($page_user - 1) . '"><i class="ci-arrow-left me-2"></i>Prev</a></li>';
     } else {
         echo '    <li class="page-item disabled"><span class="page-link"><i class="ci-arrow-left me-2"></i>Prev</span></li>';
     }
     echo '  </ul>';
     echo '  <ul class="pagination">';
     for ($i = 1; $i <= $total_pages; $i++) {
         if ($i == $page_user) {
             echo '    <li class="page-item active" aria-current="page"><span class="page-link">' . $i . '<span class="visually-hidden">(current)</span></span></li>';
         } else {
             echo '    <li class="page-item"><a class="page-link" href="?page_user=' . $i . '">' . $i . '</a></li>';
         }
     }
     echo '  </ul>';
     echo '  <ul class="pagination">';
     if ($page_user < $total_pages) {
         echo '    <li class="page-item"><a class="page-link" href="?page_user=' . ($page_user + 1) . '" aria-label="Next">Next<i class="ci-arrow-right ms-2"></i></a></li>';
     } else {
         echo '    <li class="page-item disabled"><span class="page-link">Next<i class="ci-arrow-right ms-2"></i></span></li>';
     }
     echo '  </ul>';
     echo '</nav>';


} else {
    echo "No hay miembros";
}

?>
           


           </tbody>
</table>

                         
                        
                    </div>

                
                </div>



  



  
  <div class="tab-pane fade" id="tab-prom" role="tabpanel">

  <h3 class="mt-2 fw-light">Agregar promoción</h3>
                <form action="funtions" method="post" enctype="multipart/form-data">
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
  <?php
$sql = "SELECT * FROM promociones";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // Salida de datos por cada fila
  while($row = $result->fetch_assoc()) {
    echo '<div class="row mt-4">
            <div style="align-items: center; justify-content: center;" class="col-6">
              <p>'.$row["presentacion"].'</p>
              <h4>'.$row["titulo"].'</h4>
              <p>'.$row["discripcion"].'</p>
              <button class="btn btn-primary">'.$row["texto_del_boton"].'</button>
            </div>
            <div class="col-6 d-flex">
            <form action="funtions" method="post">
            <input type="hidden" name="form_name" value="remove_promo">
            <input type="hidden" name="id" value="'.$row["id"].'">

            <button class="btn bg-faded-danger btn-icon" type="submit" data-bs-toggle="tooltip" aria-label="Delete" data-bs-original-title="Delete"><i class="ci-trash text-danger"></i></button>
               </form>
            </div>
          </div>';
  }
} else {
  echo "0 results";
}
?>
</div>
</div>



              <div class="tab-pane fade" id="tab-cat" role="tabpanel">



              <h3 class="fw-light">Añadir Categoría</h3>
                <form  method="post" action="funtions" enctype="multipart/form-data">
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

                <h3 class="mt-2 fw-light">Agregar producto</h3>
                <form method="post" action="funtions" enctype="multipart/form-data">
    
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

                    <div class="col-sm-6">
                      <label class="form-label" for="dashboard-profile-name">Stock</label>
                      <input class="form-control" type="number" name="stock" id="stock">
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
                <form  method="post" action="funtions" enctype="multipart/form-data">
                <input type="hidden" name="form_name" value="form_sale">
                 
               
                  <div class="row gx-4 gy-3">
                    <div class="col-sm-6">
                      <label class="form-label" for="dashboard-fn">ID del producto</label>
                      <input class="form-control" type="number" id="nombre" name="id_producto" placeholder="0">
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
                    <h2 class="h3 py-2 text-center text-sm-start fw-light">Pedidos</h2>
                    <div class="row mx-n2 py-2">
                    <?php
                    // Crear la consulta SQL para seleccionar todas las filas de las tablas check_out y check_out_productos
$sql = "SELECT * FROM check_out ORDER BY id_check_out DESC LIMIT 1";

// Ejecutar la consulta y obtener los resultados
$resultado = mysqli_query($db, $sql);

// Verificar si se encontraron filas
if (mysqli_num_rows($resultado) > 0) {
    // Se encontraron filas, recorrer los resultados y mostrarlos en pantalla
    while ($row = mysqli_fetch_assoc($resultado)) {?>
                      <div class="col-sm-6 px-2 mb-4">
                        <div class="bg-secondary h-100 rounded-3 p-4">
                          <h3 class="h5">Último pedido</h3>
                          <p class="fs-sm">Este pedido tuvo un total de <span class="fw-medium">$<?php echo $row["total_precio"]; ?></span> y fue realizado: <?php echo $row["fecha_check"]; ?></p>
                        </div>
                      </div>
                      <?php
    }
} else {
    // No se encontraron filas, mostrar un mensaje al usuario
    echo "No hay pedidos aún . . .";
}
?>
                      
                      
                    </div>
                    <h3 class="h5 pb-2">Historial de pedidos</h3>
                    
                    <form id="form-busqueda" method="post">

                    <div class="input-group flex-nowrap mb-3"><i class="ci-search position-absolute top-50 start-0 translate-middle-y ms-3"></i>
                    
                    <input style="border-radius: 10px 0px 0px 10px; background:white; border-width:0px; width: 100%" href="#searchBo"  data-bs-toggle="collapse" name="busqueda" id="campo-busqueda"  aria-expanded="false" aria-controls="searchBo" class="form-control dark filter  shadow w-100" type="text" placeholder="Busqueda de pedidos">
            <button class="btn btn-light shadow flex-shrink-0" type="submit" style="width: 10rem; border-radius: 0px 10px 10px 0px;  border-width:0px;">Buscar</button>
           
</form>

          </div>
                    
                    


                    <ul class="nav nav-tabs nav-justified" role="tablist">
                  <li class="nav-item" role="presentation"><a class="nav-link px-0 active" href="#profile" data-bs-toggle="tab" role="tab" aria-selected="true">
                      <div class="d-none d-lg-block">Pendientes</div>
                      <div class="d-lg-none text-center"><span class="fs-ms">Pendientes</span></div></a></li>
                  <li class="nav-item" role="presentation"><a class="nav-link px-0" href="#notifications" data-bs-toggle="tab" role="tab" aria-selected="false" tabindex="-1">
                      <div class="d-none d-lg-block">En cursos</div>
                      <div class="d-lg-none text-center"><span class="fs-ms">En cursos</span></div></a></li>
                  <li class="nav-item" role="presentation"><a class="nav-link px-0" href="#payment" data-bs-toggle="tab" role="tab" aria-selected="false" tabindex="-1">
                      <div class="d-none d-lg-block">Completados</div>
                      <div class="d-lg-none text-center"><span class="fs-ms">Completados</span></div></a></li>
                      
                </ul>





                 <!-- Tab content-->
                 <div class="tab-content">
                 


                 <!-- Pendientes-->
                   <div class="tab-pane fade show active" id="profile" role="tabpanel">
 
 
                   <div class="table-responsive fs-md mb-4">
              <table class="table table-hover mb-0">
                <thead class="bg-secondary">
                          <tr>
                          <th>Entrega</th>
                          <th>ID</th>
                          <th>Valor</th>
                          <th>Nombre</th>
                          <th>$Pago</th>
                          <th>Fecha</th>
                          <th>Ver</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php


$user_id = $_SESSION['user_id'];


$products_per_page = 10;

// Recupera el número de página actual
$page_orders1 = isset($_GET["page_orders1"]) ? (int)$_GET["page_orders1"] : 1;

// Calcula el índice del primer producto a mostrar
$offset = ($page_orders1 - 1) * $products_per_page;


// Crear la consulta SQL para seleccionar todas las filas de las tablas check_out y check_out_productos
$sql = "SELECT * FROM check_out WHERE estado_pago = 'Pagado' AND estado_envio = 'Pendiente' ORDER BY id_check_out DESC LIMIT $offset, $products_per_page";

// Ejecutar la consulta y obtener los resultados
$resultado = mysqli_query($db, $sql);

// Verificar si se encontraron filas
if (mysqli_num_rows($resultado) > 0) {
    // Se encontraron filas, recorrer los resultados y mostrarlos en pantalla
    while ($row = mysqli_fetch_assoc($resultado)) {?>

        
<tr>

<td><?php
    if ($row["estado_envio"] == "Pendiente") {
        echo '<span class="badge bg-danger m-0">' . $row["estado_envio"] . '</span>';
    } else if ($row["estado_envio"] == "En curso") {
        echo '<span class="badge bg-info m-0">' . $row["estado_envio"] . '</span>';
    } else if ($row["estado_envio"] == "Entregado") {
      echo '<span class="badge bg-success m-0">' . $row["estado_envio"] . '</span>';
  }
?></td>
                            <td><?php
    if ($row["id_payment"] == null) {
        echo "Pendiente";
    } else {
        echo $row["id_payment"];
    }
?></td>
                            <td>$<?php echo $row["total_precio"]; ?></td>
                            <td><?php echo $row["nombre"]; ?> <?php echo $row["apellidos"]; ?></td>
                            <td><?php
    if ($row["estado_pago"] == "Pendiente") {
        echo '<span class="badge bg-warning m-0">' . $row["estado_pago"] . '</span>';
    } else if ($row["estado_pago"] == "Pagado") {
        echo '<span class="badge bg-success m-0">' . $row["estado_pago"] . '</span>';
    }
?></td>
                            <td><?php echo $row["fecha_check"]; ?></td>
                            <td>
                            <button class="btn bg-faded-primary btn-icon me-2" type="button" data-bs-toggle="modal" data-bs-target="#details-modal" data-id="<?php echo $row["id_check_out"]; ?>"><i class="ci-eye text-primary"></i></button></td>
                          </tr>

                          <?php
    }


    
                      
    
    // Prepara la consulta SQL para contar el total de productos
    $sql = "SELECT COUNT(*) as total FROM check_out WHERE estado_pago = 'Pagado' AND estado_envio = 'Pendiente'";

     // Ejecuta la consulta
     $result = $conn->query($sql);
     $row = $result->fetch_assoc();
     $total_products = $row["total"];
 
     // Calcula el número total de páginas
     $total_pages = ceil($total_products / $products_per_page);
 
     // Genera los enlaces de paginación
     
     echo '<nav class="d-flex justify-content-between pb-3" aria-label="Page navigation">';
     echo '  <ul class="pagination">';
     if ($page_orders1 > 1) {
         echo '    <li class="page-item"><a class="page-link" href="?page_orders1=' . ($page_orders1 - 1) . '"><i class="ci-arrow-left me-2"></i>Prev</a></li>';
     } else {
         echo '    <li class="page-item disabled"><span class="page-link"><i class="ci-arrow-left me-2"></i>Prev</span></li>';
     }
     echo '  </ul>';
     echo '  <ul class="pagination">';
     for ($i = 1; $i <= $total_pages; $i++) {
         if ($i == $page_orders1) {
             echo '    <li class="page-item active" aria-current="page"><span class="page-link">' . $i . '<span class="visually-hidden">(current)</span></span></li>';
         } else {
             echo '    <li class="page-item"><a class="page-link" href="?page_orders1=' . $i . '">' . $i . '</a></li>';
         }
     }
     echo '  </ul>';
     echo '  <ul class="pagination">';
     if ($page_orders1 < $total_pages) {
         echo '    <li class="page-item"><a class="page-link" href="?page_orders1=' . ($page_orders1 + 1) . '" aria-label="Next">Next<i class="ci-arrow-right ms-2"></i></a></li>';
     } else {
         echo '    <li class="page-item disabled"><span class="page-link">Next<i class="ci-arrow-right ms-2"></i></span></li>';
     }
     echo '  </ul>';
     echo '</nav>';

} else {
    // No se encontraron filas, mostrar un mensaje al usuario
    echo "No hay pedidos pendientes . . .";
}
?>


                          
</tbody>
</table>
                    </div>

 
 
                   </div>
 
 
 
 
 
 
                   <!-- En cursos-->
                   <div class="tab-pane fade" id="notifications" role="tabpanel">
                     
 
 
                   <div class="table-responsive fs-md mb-4">
              <table class="table table-hover mb-0">
                <thead class="bg-secondary">
                          <tr>
                          <th>Entrega</th>
                          <th>ID</th>
                          <th>Valor</th>
                          <th>Nombre</th>
                          <th>$Pago</th>
                          <th>Fecha</th>
                          <th>Ver</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php


$user_id = $_SESSION['user_id'];


$products_per_page = 10;

// Recupera el número de página actual
$page_orders2 = isset($_GET["page_orders2"]) ? (int)$_GET["page_orders2"] : 1;

// Calcula el índice del primer producto a mostrar
$offset = ($page_orders2 - 1) * $products_per_page;


// Crear la consulta SQL para seleccionar todas las filas de las tablas check_out y check_out_productos
$sql = "SELECT * FROM check_out WHERE estado_pago = 'Pagado' AND estado_envio = 'En curso' ORDER BY id_check_out DESC LIMIT $offset, $products_per_page";

// Ejecutar la consulta y obtener los resultados
$resultado = mysqli_query($db, $sql);

// Verificar si se encontraron filas
if (mysqli_num_rows($resultado) > 0) {
    // Se encontraron filas, recorrer los resultados y mostrarlos en pantalla
    while ($row = mysqli_fetch_assoc($resultado)) {?>

        
<tr>

<td><?php
    if ($row["estado_envio"] == "Pendiente") {
        echo '<span class="badge bg-danger m-0">' . $row["estado_envio"] . '</span>';
    } else if ($row["estado_envio"] == "En curso") {
        echo '<span class="badge bg-info m-0">' . $row["estado_envio"] . '</span>';
    } else if ($row["estado_envio"] == "Entregado") {
      echo '<span class="badge bg-success m-0">' . $row["estado_envio"] . '</span>';
  }
?></td>
                            <td><?php
    if ($row["id_payment"] == null) {
        echo "Pendiente";
    } else {
        echo $row["id_payment"];
    }
?></td>
                            <td>$<?php echo $row["total_precio"]; ?></td>
                            <td><?php echo $row["nombre"]; ?> <?php echo $row["apellidos"]; ?></td>
                            <td><?php
    if ($row["estado_pago"] == "Pendiente") {
        echo '<span class="badge bg-warning m-0">' . $row["estado_pago"] . '</span>';
    } else if ($row["estado_pago"] == "Pagado") {
        echo '<span class="badge bg-success m-0">' . $row["estado_pago"] . '</span>';
    }
?></td>
                            <td><?php echo $row["fecha_check"]; ?></td>
                            <td>
                            <button class="btn bg-faded-primary btn-icon me-2" type="button" data-bs-toggle="modal" data-bs-target="#details-modal" data-id="<?php echo $row["id_check_out"]; ?>"><i class="ci-eye text-primary"></i></button></td>
                          </tr>

                          <?php
    }


    // Prepara la consulta SQL para contar el total de productos
    $sql = "SELECT COUNT(*) as total FROM check_out WHERE estado_pago = 'Pagado' AND estado_envio = 'En curso'";

     // Ejecuta la consulta
     $result = $conn->query($sql);
     $row = $result->fetch_assoc();
     $total_products = $row["total"];
 
     // Calcula el número total de páginas
     $total_pages = ceil($total_products / $products_per_page);
 
     
     echo '<nav class="d-flex justify-content-between pb-3" aria-label="Page navigation">';
     echo '  <ul class="pagination">';
     if ($page_orders2 > 1) {
         echo '    <li class="page-item"><a class="page-link" href="?page_orders2=' . ($page_orders2 - 1) . '"><i class="ci-arrow-left me-2"></i>Prev</a></li>';
     } else {
         echo '    <li class="page-item disabled"><span class="page-link"><i class="ci-arrow-left me-2"></i>Prev</span></li>';
     }
     echo '  </ul>';
     echo '  <ul class="pagination">';
     for ($i = 1; $i <= $total_pages; $i++) {
         if ($i == $page_orders2) {
             echo '    <li class="page-item active" aria-current="page"><span class="page-link">' . $i . '<span class="visually-hidden">(current)</span></span></li>';
         } else {
             echo '    <li class="page-item"><a class="page-link" href="?page_orders2=' . $i . '">' . $i . '</a></li>';
         }
     }
     echo '  </ul>';
     echo '  <ul class="pagination">';
     if ($page_orders2 < $total_pages) {
         echo '    <li class="page-item"><a class="page-link" href="?page_orders2=' . ($page_orders2 + 1) . '" aria-label="Next">Next<i class="ci-arrow-right ms-2"></i></a></li>';
     } else {
         echo '    <li class="page-item disabled"><span class="page-link">Next<i class="ci-arrow-right ms-2"></i></span></li>';
     }
     echo '  </ul>';
     echo '</nav>';

} else {
    // No se encontraron filas, mostrar un mensaje al usuario
    echo "No hay pedidos en curso aún . . .";
}
?>

</tbody>
</table>

                          
                        </tbody>
                      </table>
                    </div>

 
 
 
 
                   </div>
 
 
 
 
 
 
                   <!-- Completados-->
                   <div class="tab-pane fade" id="payment" role="tabpanel">


                   <div class="table-responsive fs-md mb-4">
              <table class="table table-hover mb-0">
                <thead class="bg-secondary">
                          <tr>
                          <th>Entrega</th>
                          <th>ID</th>
                          <th>Valor</th>
                          <th>Nombre</th>
                          <th>$Pago</th>
                          <th>Fecha</th>
                          <th>Ver</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php


$user_id = $_SESSION['user_id'];


$products_per_page = 10;

// Recupera el número de página actual
$page_orders3 = isset($_GET["page_orders3"]) ? (int)$_GET["page_orders3"] : 1;

// Calcula el índice del primer producto a mostrar
$offset = ($page_orders3 - 1) * $products_per_page;


// Crear la consulta SQL para seleccionar todas las filas de las tablas check_out y check_out_productos
$sql = "SELECT * FROM check_out WHERE estado_pago = 'Pagado' AND estado_envio = 'Entregado' ORDER BY id_check_out DESC LIMIT $offset, $products_per_page";

// Ejecutar la consulta y obtener los resultados
$resultado = mysqli_query($db, $sql);

// Verificar si se encontraron filas
if (mysqli_num_rows($resultado) > 0) {
    // Se encontraron filas, recorrer los resultados y mostrarlos en pantalla
    while ($row = mysqli_fetch_assoc($resultado)) {?>

        
<tr>

<td><?php
    if ($row["estado_envio"] == "Pendiente") {
        echo '<span class="badge bg-danger m-0">' . $row["estado_envio"] . '</span>';
    } else if ($row["estado_envio"] == "En curso") {
        echo '<span class="badge bg-info m-0">' . $row["estado_envio"] . '</span>';
    } else if ($row["estado_envio"] == "Entregado") {
      echo '<span class="badge bg-success m-0">' . $row["estado_envio"] . '</span>';
  }
?></td>
                            <td><?php
    if ($row["id_payment"] == null) {
        echo "Pendiente";
    } else {
        echo $row["id_payment"];
    }
?></td>
                            <td>$<?php echo $row["total_precio"]; ?></td>
                            <td><?php echo $row["nombre"]; ?> <?php echo $row["apellidos"]; ?></td>
                            <td><?php
    if ($row["estado_pago"] == "Pendiente") {
        echo '<span class="badge bg-warning m-0">' . $row["estado_pago"] . '</span>';
    } else if ($row["estado_pago"] == "Pagado") {
        echo '<span class="badge bg-success m-0">' . $row["estado_pago"] . '</span>';
    }
?></td>
                            <td><?php echo $row["fecha_check"]; ?></td>
                            <td>
                            <button class="btn bg-faded-primary btn-icon me-2" type="button" data-bs-toggle="modal" data-bs-target="#details-modal" data-id="<?php echo $row["id_check_out"]; ?>"><i class="ci-eye text-primary"></i></button></td>
                          </tr>

                          <?php
    }

    // Prepara la consulta SQL para contar el total de productos
    $sql = "SELECT COUNT(*) as total FROM check_out WHERE estado_pago = 'Pagado' AND estado_envio = 'Entregado'";

     // Ejecuta la consulta
     $result = $conn->query($sql);
     $row = $result->fetch_assoc();
     $total_products = $row["total"];
 
     // Calcula el número total de páginas
     $total_pages = ceil($total_products / $products_per_page);
 
   
     
     echo '<nav class="d-flex justify-content-between pb-3" aria-label="Page navigation">';
     echo '  <ul class="pagination">';
     if ($page_orders3 > 1) {
         echo '    <li class="page-item"><a class="page-link" href="?page_orders3=' . ($page_orders3 - 1) . '"><i class="ci-arrow-left me-2"></i>Prev</a></li>';
     } else {
         echo '    <li class="page-item disabled"><span class="page-link"><i class="ci-arrow-left me-2"></i>Prev</span></li>';
     }
     echo '  </ul>';
     echo '  <ul class="pagination">';
     for ($i = 1; $i <= $total_pages; $i++) {
         if ($i == $page_orders3) {
             echo '    <li class="page-item active" aria-current="page"><span class="page-link">' . $i . '<span class="visually-hidden">(current)</span></span></li>';
         } else {
             echo '    <li class="page-item"><a class="page-link" href="?page_orders3=' . $i . '">' . $i . '</a></li>';
         }
     }
     echo '  </ul>';
     echo '  <ul class="pagination">';
     if ($page_orders3 < $total_pages) {
         echo '    <li class="page-item"><a class="page-link" href="?page_orders3=' . ($page_orders3 + 1) . '" aria-label="Next">Next<i class="ci-arrow-right ms-2"></i></a></li>';
     } else {
         echo '    <li class="page-item disabled"><span class="page-link">Next<i class="ci-arrow-right ms-2"></i></span></li>';
     }
     echo '  </ul>';
     echo '</nav>';

} else {
    // No se encontraron filas, mostrar un mensaje al usuario
    echo "No hay pedidos completados aún . . .";
}
?>
       </tbody>
</table>

                          
                        </tbody>
                      </table>
                    </div>


                     
                 </div>
 
 
 
 
 
 
               </div>











                   
                    
                  </div>
                </div>





                <div class="tab-pane fade" id="tab-sales" role="tabpanel">
                  <div class="pt-2 px-4 ps-lg-0 pe-xl-5">
                    <h2 class="h3 py-2 text-center text-sm-start fw-light">Estadisticas / Finanzas</h2>
                    <div class="row mx-n2 pt-2">
                      <div class="col-md-4 col-sm-6 px-2 mb-4">
                        <div class="bg-secondary h-100 rounded-3 p-4 text-center">
                          <h3 class="fs-sm text-muted">Vendido Hoy</h3>
                          

                          <p class="h2 mb-2">$<span><?php
// Obtén la fecha de hoy en formato Y-m-d
$fecha_hoy = date("Y-m-d");

// Consulta para obtener la suma del dinero de los pedidos pagados hoy
$sql = "SELECT SUM(total_precio) as total FROM check_out WHERE estado_pago = 'Pagado' AND DATE(fecha_check) = '$fecha_hoy'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total = $row["total"];

if ($total === NULL) {
  // No hay pedidos pagados hoy, mostrar 0.00 como el total
  echo "0.00";
} else {
  // Hay pedidos pagados hoy, mostrar el total
  echo $total;
}
?>

</span></p>
           
                        </div>
                      </div>





                      <div class="col-md-4 col-sm-6 px-2 mb-4">
                        <div class="bg-secondary h-100 rounded-3 p-4 text-center">
                          <h3 class="fs-sm text-muted">Vendido en el mes</h3>
                          

                          <p class="h2 mb-2">$<span><?php
// Obtén el año y el mes actual
$anio_actual = date("Y");
$mes_actual = date("m");

// Consulta para obtener la suma del dinero de los pedidos pagados este mes
$sql = "SELECT SUM(total_precio) as total FROM check_out WHERE estado_pago = 'Pagado' AND YEAR(fecha_check) = $anio_actual AND MONTH(fecha_check) = $mes_actual";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total = $row["total"];

if ($total === NULL) {
  // No hay pedidos pagados este mes, mostrar 0.00 como el total
  echo "0.00";
} else {
  // Hay pedidos pagados este mes, mostrar el total
  echo $total;
}
?>


</span></p>
           
                        </div>
                      </div>


                      <div class="col-md-4 col-sm-6 px-2 mb-4">
                        <div class="bg-secondary h-100 rounded-3 p-4 text-center">
                          <h3 class="fs-sm text-muted">Vendido en la página</h3>
                          <p class="h2 mb-2">$<span><?php

// Consulta para obtener la suma total de los precios de todos los productos
$sql = "SELECT SUM(total_precio) as total FROM check_out WHERE estado_pago = 'Pagado'";

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


                      <hr>
<br><hr>



                      <div class="col-md-4 col-sm-6 px-2 mb-4">
                        <div class="bg-secondary h-100 rounded-3 p-4 text-center">
                          <h3 class="fs-sm text-muted">Dinero invertido en productos</h3>
                          

                          <p class="h2 mb-2">$<span><?php

// Consulta para obtener la suma total de los precios de todos los productos
$sql = "SELECT SUM(precio * stock) as total FROM productos";
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


           





                      
                     
                
                      
                    </div>
                  </div>
                </div>



                <div class="tab-pane fade" id="tab-products" role="tabpanel">
                  <div class="pt-2 px-4 ps-lg-0 pe-xl-5">
                    <!-- Title-->
                    <div class="d-sm-flex flex-wrap justify-content-between align-items-center border-bottom">
                      <h2 class="py-2 me-2 text-center text-sm-start h3 fw-light">Productos<span class="badge bg-faded-accent fs-sm text-body align-middle ms-2"><?php

// Crear la consulta SQL para contar el número de productos
$sql = "SELECT COUNT(*) AS total FROM productos";

// Ejecutar la consulta y obtener el resultado
$resultado = mysqli_query($db, $sql);
$fila = mysqli_fetch_assoc($resultado);
$total_productos = $fila['total'];

echo $total_productos;

?></span></h2>
                    </div>



                    <?php
// Número de productos por página
$products_per_page = 5;

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
                    <div class="d-block d-sm-flex align-items-center pb-1 border-bottom"><a class="d-block mb-3 mb-sm-0 me-sm-4 ms-sm-0 mx-auto" href="details.php?id=<?php echo $row["id_producto"]; ?>" style="width: 12.5rem;"><?php
                echo '<img class="w-100 p-2" src="' . htmlspecialchars($foto_url) . '" alt="Product" style="object-fit: contain; height: 150px; width: 100px;">' 
                ?></a>
                      <div class="text-center text-sm-start">
                        <h3 class="h6 product-title mb-2"><a href="details.php?id=<?php echo $row["id_producto"]; ?>"><?php echo $row["nombre"]; ?></a></h3>
                        <div class="d-inline-block text-accent">$ <span><?php echo $row["precio"]; ?></span></div>
                        <div class="d-inline-block text-muted fs-ms border-start ms-2 ps-2">Categoría: <span class="fw-medium"><?php echo $row["categoria"]; ?></span></div>
                        <div class="d-inline-block text-muted fs-ms border-start ms-2 ps-2">ID: <span class="fw-medium"><?php echo $row["id_producto"]; ?></span></div>
                        <div class="d-inline-block text-muted fs-ms border-start ms-2 ps-2">Stock: <span class="fw-medium"><?php echo $row["stock"]; ?></span></div>
                        <div class="d-flex justify-content-center justify-content-sm-start pt-3">
      
                          <button class="btn bg-faded-info btn-icon me-2" type="button" data-bs-toggle="modal" data-bs-target="#products-modal" data-id="<?php echo $row["id_producto"]; ?>"><i class="ci-edit text-info"></i></button>

                          <form action="funtions" method="post">
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

                <div class="tab-pane fade show active" id="tab-settings" role="tabpanel">
              <div class="pt-2 px-4 ps-lg-0 pe-xl-5">
               
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
    <footer class="footer bg-dark py-2">
      <div class="container">
          <div class="d-md-flex justify-content-between pt-4">
            <div class="fs-xs text-light opacity-50 text-center text-md-start">© All rights reserved. Powered by <a class="text-light" href="" target="_blank" rel="noopener">Uixsoftare</a></div>
            <div class="widget widget-links widget-light pb-4">
              <ul class="widget-list d-flex flex-wrap justify-content-center justify-content-md-start">
                <li class="widget-list-item ms-4"><a class="widget-list-link fs-ms" href="https://masqfresco.com/terms">Términos de uso</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- Toolbar for handheld devices (Marketplace)-->




    <!-- Vista previa Modal-->
    <div  class="modal fade" id="search-users-modal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content rounded-4">
            <div class="d-flex">
          <button class="btn-close mt-3 ms-3 me-3" type="button" data-bs-dismiss="modal" aria-label="Close"></button>

          <h5 class="pt-3 ms-2 fw-light">Resultados: Usuarios</h5>
          </div>
            <div class="modal-body">

            

          
            


                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>





      <script>
(function() {
    // Tu código aquí
    $(document).ready(function() {
        $('#form-busqueda_user').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: 'search_user.php',
                type: 'post',
                data: $(this).serialize(),
                success: function(data) {
                    var usuarios = JSON.parse(data);

                    // Limpiar el contenido modal existente
                    $('#search-users-modal .modal-body').empty();

                    // Crear la tabla
                    var tabla = $('<table>').addClass('table table-hover mb-0');
                    var thead = $('<thead>').addClass('bg-secondary');
                    var tbody = $('<tbody>');

                    // Añadir los encabezados de la tabla
                    var encabezados = ['ID', 'Nombre', 'Apellido', 'Telefono', 'Rango', 'Acciones'];
                    var filaEncabezado = $('<tr>');
                    encabezados.forEach(function(encabezado) {
                        filaEncabezado.append($('<th>').text(encabezado));
                    });
                    thead.append(filaEncabezado);
                    tabla.append(thead);

                    // Añadir los resultados a la tabla
                    usuarios.forEach(function(usuario) {
                        var fila = $('<tr>');
                        fila.append($('<td>').text(usuario.id_user));
                        fila.append($('<td>').text(usuario.nombre));
                        fila.append($('<td>').text(usuario.apellido));
                        fila.append($('<td>').text(usuario.numero_telefono));
                        fila.append($('<td>').text(usuario.rango));
                        var botonVer = $('<button>').addClass('btn bg-faded-info btn-icon me-2').attr('type', 'button').attr('data-bs-toggle', 'modal').attr('data-bs-target', '#user-modal').attr('data-id', usuario.id_user).html('<i class="ci-edit text-info"></i>');
                        fila.append($('<td>').append(botonVer));
                        tbody.append(fila);
                    });
                    tabla.append(tbody);

                    // Añadir la tabla al modal
                    $('#search-users-modal .modal-body').append(tabla);

                    // Mostrar el modal
                    $('#search-users-modal').modal('show');
                }
            });
        });
    });
})();

      </script>






















      <!-- Vista previa Modal-->
      <div  class="modal fade" id="search-orders-modal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content rounded-4">
          <div class="d-flex">
          <button class="btn-close mt-3 ms-3 me-3" type="button" data-bs-dismiss="modal" aria-label="Close"></button>

          <h5 class="pt-3 ms-2 fw-light">Resultados: Pedidos</h5>
          </div>
            <div class="modal-body">

            

          
            


                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>




      <script>


(function() {
    // Tu código aquí
    $(document).ready(function() {
    $('#form-busqueda').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: 'search_orders.php',
            type: 'post',
            data: $(this).serialize(),
            success: function(data) {
                var pedidos = JSON.parse(data);

                // Limpiar el contenido modal existente
                $('#search-orders-modal .modal-body').empty();

                // Crear la tabla
                var tabla = $('<table>').addClass('table table-hover mb-0');
                var thead = $('<thead>').addClass('bg-secondary');
                var tbody = $('<tbody>');

                // Añadir los encabezados de la tabla
                var encabezados = ['Entrega', 'ID', 'Valor', 'Nombre', '$Pago', 'Fecha', 'Ver'];
                var filaEncabezado = $('<tr>');
                encabezados.forEach(function(encabezado) {
                    filaEncabezado.append($('<th>').text(encabezado));
                });
                thead.append(filaEncabezado);
                tabla.append(thead);

                // Añadir los resultados a la tabla
                pedidos.forEach(function(pedido) {
                    var fila = $('<tr>');
                    fila.append($('<td>').text(pedido.estado_envio));
                    fila.append($('<td>').text(pedido.id_payment));
                    fila.append($('<td>').text('$' + pedido.total_precio));
                    fila.append($('<td>').text(pedido.nombre + ' ' + pedido.apellidos));
                    fila.append($('<td>').text(pedido.estado_pago));
                    fila.append($('<td>').text(pedido.fecha_check));
                    var botonVer = $('<button>').addClass('btn bg-faded-primary btn-icon me-2').attr('type', 'button').attr('data-bs-toggle', 'modal').attr('data-bs-target', '#details-modal').attr('data-id', pedido.id_check_out).html('<i class="ci-eye text-primary"></i>');
                    fila.append($('<td>').append(botonVer));
                    tbody.append(fila);
                });
                tabla.append(tbody);

                // Añadir la tabla al modal
                $('#search-orders-modal .modal-body').append(tabla);

                // Mostrar el modal
                $('#search-orders-modal').modal('show');
            }
        });
    });
});

})();


       

      </script>



     
     <!-- Vista previa Modal-->
     <div  class="modal fade" id="user-modal" tabindex="-1">
        <div class="modal-dialog modal-sm modal-dialog-centered">
          <div class="modal-content rounded-4">
          <button class="btn-close mt-3 ms-3 me-3" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">

            

            <div id="user-details"></div>
            


                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>



      <script>
  var userModal = document.getElementById('user-modal')
  userModal.addEventListener('show.bs.modal', function (event) {
    // Obtener el enlace que activó el modal
    var link = event.relatedTarget

    // Obtener el id del atributo data-id del enlace
    var id = link.getAttribute('data-id')

    // Enviar el id al servidor mediante una solicitud AJAX
    var xhr = new XMLHttpRequest()
    xhr.open('POST', 'user_id.php')
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    xhr.onload = function () {
      if (xhr.status === 200) {
        // Actualizar el contenido del modal con la respuesta del servidor
        var userDetailsElement = userModal.querySelector('#user-details')
        userDetailsElement.innerHTML = xhr.responseText
      }
    }
    xhr.send('id=' + encodeURIComponent(id))
  })
</script>




    <!-- Vista previa Modal-->
    <div  class="modal fade" id="products-modal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content rounded-4">
          <button class="btn-close mt-3 ms-3 me-3" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">

            <div id="products-details"></div>



                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>




      <script>
  var productsModal = document.getElementById('products-modal')
  productsModal.addEventListener('show.bs.modal', function (event) {
    // Obtener el enlace que activó el modal
    var link = event.relatedTarget

    // Obtener el id del atributo data-id del enlace
    var id = link.getAttribute('data-id')

    // Enviar el id al servidor mediante una solicitud AJAX
    var xhr = new XMLHttpRequest()
    xhr.open('POST', 'products_id.php')
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    xhr.onload = function () {
      if (xhr.status === 200) {
        // Actualizar el contenido del modal con la respuesta del servidor
        var productsDetailsElement = productsModal.querySelector('#products-details')
        productsDetailsElement.innerHTML = xhr.responseText
      }
    }
    xhr.send('id=' + encodeURIComponent(id))
  })
</script>


    
     <!-- Vista previa Modal-->
     <div  class="modal fade" id="details-modal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content rounded-4">
          <button class="btn-close mt-3 ms-3 me-3" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">

            


            <div id="checkout-details"></div>


            
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>




      <script>
  var detailsModal = document.getElementById('details-modal')
  detailsModal.addEventListener('show.bs.modal', function (event) {
    // Obtener el enlace que activó el modal
    var link = event.relatedTarget

    // Obtener el id del atributo data-id del enlace
    var id = link.getAttribute('data-id')

    // Enviar el id al servidor mediante una solicitud AJAX
    var xhr = new XMLHttpRequest()
    xhr.open('POST', 'store_id.php')
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    xhr.onload = function () {
      if (xhr.status === 200) {
        // Actualizar el contenido del modal con la respuesta del servidor
        var checkoutDetailsElement = detailsModal.querySelector('#checkout-details')
        checkoutDetailsElement.innerHTML = xhr.responseText
      }
    }
    xhr.send('id=' + encodeURIComponent(id))
  })
</script>






<script>
 // Almacenar la pestaña actual en el almacenamiento local cuando se hace clic en una pestaña
document.querySelectorAll('.nav-link-style').forEach(function(tab) {
  tab.addEventListener('click', function(e) {
    e.preventDefault();
    var tabId = this.getAttribute('href');
    localStorage.setItem('activeTab', tabId);
    history.pushState(null, null, "dashboard029" + tabId);
  });
});

// Comprobar si hay una pestaña almacenada en el almacenamiento local cuando la página se carga
document.addEventListener('DOMContentLoaded', function() {
  var activeTabId = localStorage.getItem('activeTab');
  if (activeTabId) {
    var activeTab = document.querySelector('.nav-link-style[href="' + activeTabId + '"]');
    if (activeTab) {
      activeTab.click();
    }
  }
});
</script>
    


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

$conn->close();
?>
