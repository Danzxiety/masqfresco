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
    // Asumiendo que has establecido una conexión mysqli $conn
    $id_check_out = isset($_GET["id"]) ? (int)$_GET["id"] : 0;

    // Preparar la consulta SQL
    $sql = "UPDATE check_out SET estado_envio = 'En curso' WHERE id_check_out = ?";

    // Preparar la declaración
    if($stmt = $conn->prepare($sql)){
        // Vincular variables a la declaración preparada como parámetros
        $stmt->bind_param("i", $id_check_out);

        // Intentar ejecutar la declaración preparada
        if($stmt->execute()){
           
        } else{
           
        }
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">

    <title>Imprimir System MSQF</title>
    <link rel="apple-touch-icon" sizes="180x180" href="img/logo.svg">
    <link rel="icon" type="image/png" sizes="32x32" href="img/logo.svg">
    <link rel="icon" type="image/png" sizes="16x16" href="img/logo.svg">

    <!-- Vendor Styles including: Font Icons, Plugins, etc.-->
    <link rel="stylesheet" media="screen" href="css/simplebar.min.css">
    <link rel="stylesheet" media="screen" href="css/tiny-slider.css">
    <!-- Main Theme Styles + Bootstrap-->
    <link rel="stylesheet" media="screen" href="css/theme.min.css">
</head>
<body class="bg-secondary">
<style>img[alt="www.000webhost.com"]{display:none};</style>
    
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
       


    
       


<div style="max-width: 320px;" class="container bg-light p-4 rounded-3 mt-3">
<center><div style="display: flex; justify-content: center;">
<img class="mt-1" src="img/logo.svg" width="60" height="60" alt="">
<img class="mt-1" src="img/title.svg" width="120" alt=""></div>
</center>



<div style="display: flex; justify-content: space-between; margin-top:8px;">
    <h2 style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin-top:0px; margin-bottom:0px;">• Componentes</h2>
    <p style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin-top:0px; margin-bottom:0px;">Cant.</p>

    
</div>


<hr>


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
      

      <div style="display: flex; justify-content: space-between;">
    <p style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin-top:0px; margin-bottom:0px; font-size: 22px;"><?php echo $fila["nombre"]; ?></p>
    <p style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin-top:0px; margin-bottom:0px; font-size: 22px;">x<strong><?php echo $fila["cantidad"]; ?></strong></p>
</div>

    

        <?php
    }
} else {
    // No se encontraron filas, mostrar un mensaje al usuario
    echo "No hay pedidos aún";
}
?>




<h2 style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin-top:20px; margin-bottom:0px;">• Remitente</h2>
<hr>
<p style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin-top:0px; margin-bottom:0px; font-size: 22px;"><?php echo $row["nombre"]; ?> <?php echo $row["apellidos"]; ?></p>


<h2 style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin-top:20px; margin-bottom:0px;">• Destinatario</h2>
<hr>

<p style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin-top:0px; margin-bottom:0px; font-size: 22px;"><?php echo $row["nombre_destinatario"]; ?> <?php echo $row["apellido_destinatario"]; ?></p>
<p  style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin-top:5px; margin-bottom:0px; font-size: 22px;"><strong>CID:</strong> <span><?php echo $row["cid"]; ?></span></p>





<h2 style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin-top:20px; margin-bottom:0px;">• Dirección & Telefono</h2>
<hr>

<p style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin-top:0px; margin-bottom:0px; font-size: 22px;"><?php echo $row["direccion_entrega"]; ?></p>
<p  style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin-top:5px; margin-bottom:0px; font-size: 22px;"><strong>Municipio: </strong><span><?php echo $row["municipio"]; ?></span></p>
<p  style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin-top:5px; margin-bottom:0px; font-size: 22px;"><strong>Telefono: </strong><span><?php echo $row["telefono_destinatario"]; ?></span></p>
<p  style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin-top:5px; margin-bottom:0px; font-size: 22px;"><strong>Fecha y Hora: </strong><span><?php echo $row["fecha_check"]; ?></span></p>
<p  style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin-top:5px; margin-bottom:0px; font-size: 22px;"><strong>Referencia: </strong><span><?php
    if ($row["id_payment"] == null) {
        echo "Pendiente";
    } else {
        echo $row["id_payment"];
    }?></span></p>
<hr>


<h3 style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin-top:20px; margin-bottom:8px;">FIRMO QUE ESTOY CONFORME CON LA ENTREGA DE LOS PRODUCTOS</h3>

<div style="height: 80px; border-width: 1px; border-color: #4b4b4b; border: dashed; border-radius: 12px;"></div>

                        


                      


                         
    

                        








                          <hr class="mt-5 mb-2">

                          <a class="text_info" style="cursor: pointer;" onclick="window.print()">Imprimir</a>

                        </div>
               
                    </div>









        <?php
   
} else {
    // No se encontraron filas, mostrar un mensaje al usuario
    echo "No se encontró el checkout con el ID especificado";
}
?>


</body>
</html>








