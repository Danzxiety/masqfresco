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
if ($rango_usuario_actual == "Delivery") { ?>



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
              <h3 class="text-light  mb-0">Panel de Entregas</h3><span class="d-block text-light fs-ms opacity-60 py-1">Powered by Uixsoftware</span>
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
                    <li class="border-bottom mb-0"  role="presentation"><a class="nav-link-style d-flex align-items-center px-4 py-3 active" role="tab" data-bs-toggle="tab" href="#tab-settings"><i class="ci-currency-exchange opacity-60 me-2"></i>Pedidos</a></li>



                    <li class="mb-0" role="presentation"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="index"><i class="ci-sign-out opacity-60 me-2"></i>Volver al inicio</a></li>
                  </ul>
   
                  <hr>
                </div>
              </div>
            </aside>
            <!-- Content-->
            <section class="col-lg-8 pt-lg-4 pb-4 mb-3">
              <div class="tab-content">


            



                <div class="tab-pane fade show active" id="tab-settings" role="tabpanel">
              <div class="pt-2 px-4 ps-lg-0 pe-xl-5">
                <h2 class="h3 py-2 text-center text-sm-start">Pedidos</h2>
                <!-- Tabs-->
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
                        
                          <th># Pedido</th>
                            <th>Nombre</th>
                            <th>Telefono</th>
                            <th>Entrega</th>
                            <th>Fecha</th>
                            <th>Ver</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php


// Crear la consulta SQL para seleccionar todas las filas de las tablas check_out y check_out_productos
$sql = "SELECT * FROM check_out WHERE estado_pago = 'Pagado' AND estado_envio = 'Pendiente' ORDER BY id_check_out DESC";

// Ejecutar la consulta y obtener los resultados
$resultado = mysqli_query($db, $sql);

// Verificar si se encontraron filas
if (mysqli_num_rows($resultado) > 0) {
    // Se encontraron filas, recorrer los resultados y mostrarlos en pantalla
    while ($row = mysqli_fetch_assoc($resultado)) {?>

        
<tr>


                            <td><?php
    if ($row["id_payment"] == null) {
        echo "Pendiente";
    } else {
        echo $row["id_payment"];
    }
?></td>
                            <td><?php echo $row["nombre_destinatario"]; ?></td>
                            <td><?php echo $row["telefono_destinatario"]; ?></td>
                            <td><?php
    if ($row["estado_envio"] == "Pendiente") {
        echo '<span class="badge bg-danger m-0">' . $row["estado_envio"] . '</span>';
    } else if ($row["estado_envio"] == "En curso") {
        echo '<span class="badge bg-info m-0">' . $row["estado_envio"] . '</span>';
    } else if ($row["estado_envio"] == "Entregado") {
      echo '<span class="badge bg-success m-0">' . $row["estado_envio"] . '</span>';
  }
?></td>
                            <td><?php echo $row["fecha_check"]; ?></td>
                            <td><a class="text-primary" href="#" data-bs-toggle="modal" data-bs-target="#details-modal" data-id="<?php echo $row["id_check_out"]; ?>">Ver más</a></td>
                          </tr>

        <?php
    }
} else {
    // No se encontraron filas, mostrar un mensaje al usuario
    echo "No hay pedidos pendientes aún . . .";
}
?>


                          
                        </tbody>
                      </table>
                    </div>


                  </div>






                  <!-- Completados-->
                  <div class="tab-pane fade" id="notifications" role="tabpanel">
                    





                  <div class="table-responsive fs-md mb-4">
              <table class="table table-hover mb-0">
                <thead class="bg-secondary">
                          <tr>
                          <th># Pedido</th>
                            <th>Nombre</th>
                            <th>Telefono</th>
                            <th>Entrega</th>
                            <th>Fecha</th>
                            <th>Ver</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php


// Crear la consulta SQL para seleccionar todas las filas de las tablas check_out y check_out_productos
$sql = "SELECT * FROM check_out WHERE estado_pago = 'Pagado' AND estado_envio = 'En curso' ORDER BY id_check_out DESC";

// Ejecutar la consulta y obtener los resultados
$resultado = mysqli_query($db, $sql);

// Verificar si se encontraron filas
if (mysqli_num_rows($resultado) > 0) {
    // Se encontraron filas, recorrer los resultados y mostrarlos en pantalla
    while ($row = mysqli_fetch_assoc($resultado)) {?>

        
<tr>

                            <td><?php
    if ($row["id_payment"] == null) {
        echo "Pendiente";
    } else {
        echo $row["id_payment"];
    }
?></td>
                            <td><?php echo $row["nombre_destinatario"]; ?></td>
                            <td><?php echo $row["telefono_destinatario"]; ?></td>
                            <td><?php
    if ($row["estado_envio"] == "Pendiente") {
        echo '<span class="badge bg-danger m-0">' . $row["estado_envio"] . '</span>';
    } else if ($row["estado_envio"] == "En curso") {
        echo '<span class="badge bg-info m-0">' . $row["estado_envio"] . '</span>';
    } else if ($row["estado_envio"] == "Entregado") {
      echo '<span class="badge bg-success m-0">' . $row["estado_envio"] . '</span>';
  }
?></td>
                            <td><?php echo $row["fecha_check"]; ?></td>
                            <td><a class="text-primary" href="#" data-bs-toggle="modal" data-bs-target="#details-modal" data-id="<?php echo $row["id_check_out"]; ?>">Ver más</a></td>
                          </tr>

        <?php
    }
} else {
    // No se encontraron filas, mostrar un mensaje al usuario
    echo "No hay pedidos en curso aún . . .";
}
?>


                          
                        </tbody>
                      </table>
                    </div>





                  </div>






                  <!-- Cancelados-->
                  <div class="tab-pane fade" id="payment" role="tabpanel">


                  
                  <div class="table-responsive fs-md mb-4">
              <table class="table table-hover mb-0">
                <thead class="bg-secondary">
                          <tr>
                          <th># Pedido</th>
                            <th>Nombre</th>
                            <th>Telefono</th>
                            <th>Entrega</th>
                            <th>Fecha</th>
                            <th>Ver</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php


// Crear la consulta SQL para seleccionar todas las filas de las tablas check_out y check_out_productos
$sql = "SELECT * FROM check_out WHERE estado_pago = 'Pagado' AND estado_envio = 'Entregado' ORDER BY id_check_out DESC";

// Ejecutar la consulta y obtener los resultados
$resultado = mysqli_query($db, $sql);

// Verificar si se encontraron filas
if (mysqli_num_rows($resultado) > 0) {
    // Se encontraron filas, recorrer los resultados y mostrarlos en pantalla
    while ($row = mysqli_fetch_assoc($resultado)) {?>

        
<tr>

                            <td><?php
    if ($row["id_payment"] == null) {
        echo "Pendiente";
    } else {
        echo $row["id_payment"];
    }
?></td>
                            <td><?php echo $row["nombre_destinatario"]; ?></td>
                            <td><?php echo $row["telefono_destinatario"]; ?></td>
                            <td><?php
    if ($row["estado_envio"] == "Pendiente") {
        echo '<span class="badge bg-danger m-0">' . $row["estado_envio"] . '</span>';
    } else if ($row["estado_envio"] == "En curso") {
        echo '<span class="badge bg-info m-0">' . $row["estado_envio"] . '</span>';
    } else if ($row["estado_envio"] == "Entregado") {
      echo '<span class="badge bg-success m-0">' . $row["estado_envio"] . '</span>';
  }
?></td>
                            <td><?php echo $row["fecha_check"]; ?></td>
                            <td><a class="text-primary" href="#" data-bs-toggle="modal" data-bs-target="#details-modal" data-id="<?php echo $row["id_check_out"]; ?>">Ver más</a></td>
                          </tr>

        <?php
    }
} else {
    // No se encontraron filas, mostrar un mensaje al usuario
    echo "No hay pedidos completados aún . . .";
}
?>


                          
                        </tbody>
                      </table>
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
    xhr.open('POST', 'delivery_id.php')
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