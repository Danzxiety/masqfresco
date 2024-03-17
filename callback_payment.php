<?php
session_start();
include 'config.php';

// Crea la conexión
$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
// Verifica si la conexión es exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
} 


    // Obtener los valores de la notificación de TropiPay
    $bankOrderCode = $_GET['bankOrderCode'];
    $state = $_GET['state'];
    
    // Obtener el ID del checkout de la URL
    $checkout_id = $_GET['checkout_id'];
    
    

    // Verificar si la transacción fue exitosa
if ($state == 5) {
    // Actualizar el estado del pago y guardar el bankOrderCode en la tabla check_out
    $stmt = $conn->prepare("UPDATE check_out SET estado_pago = 'Pagado', id_payment = ? WHERE id_check_out = ?");
    $stmt->bind_param('si', $bankOrderCode, $checkout_id);
    $stmt->execute();



    // Obtener los productos del checkout
$stmt = $conn->prepare("SELECT id_producto, cantidad FROM check_out_productos WHERE id_check_out = ?");
$stmt->bind_param('i', $checkout_id);
$stmt->execute();
$result = $stmt->get_result();

$productos = array();
while ($row = $result->fetch_assoc()) {
    $productos[] = $row;
}

// Recorrer los productos y actualizar el stock
foreach ($productos as $producto) {
    $id_producto = $producto['id_producto'];
    $cantidad = $producto['cantidad'];

     // Actualizar el stock del producto
     $stmt = $conn->prepare("UPDATE productos SET stock = stock - ? WHERE id_producto = ?");
     $stmt->bind_param('ii', $cantidad, $id_producto);
     $stmt->execute();


     // Verificar si el stock del producto llegó a 0
     $stmt = $conn->prepare("SELECT stock FROM productos WHERE id_producto = ?");
     $stmt->bind_param('i', $id_producto);
     $stmt->execute();
     $result2 = $stmt->get_result();
     if ($result2->num_rows > 0) {
         $row2 = $result2->fetch_assoc();
         if ($row2['stock'] == 0) {
             // Eliminar el producto de todos los carritos de los usuarios
             $stmt = $conn->prepare("DELETE FROM carrito WHERE id_producto = ?");
             $stmt->bind_param('i', $id_producto);
             $stmt->execute();
         }
     }




     // Obtener el ID del usuario
 $stmt = $conn->prepare("SELECT id_usuario FROM check_out WHERE id_check_out = ?");
 $stmt->bind_param('i', $checkout_id);
 $stmt->execute();
 $result = $stmt->get_result();
 $row = $result->fetch_assoc();
 $id_usuario = $row['id_usuario'];

 // Eliminar los datos del carrito del usuario
 $stmt = $conn->prepare("DELETE FROM carrito WHERE id_usuario = ?");
 $stmt->bind_param('i', $id_usuario);
 $stmt->execute();
 
 
}



       
    echo "<script>window.location.href = 'review?bankOrderCode=$bankOrderCode';</script>";
    exit;
}





    $conn->close();

    
?>
