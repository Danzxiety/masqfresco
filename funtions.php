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
// Verifica si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if ($_POST["form_name"] == "form_login") {
    // Obtén los datos del usuario
    $correo_electronico = $_POST['correo_electronico'];
    $contrasena = $_POST['contrasena'];

    // Prepara la consulta SQL
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE correo_electronico = ?");
    $stmt->bind_param("s", $correo_electronico);
    
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
        $_SESSION['user_apellido'] = $user['apellido'];
        $_SESSION['user_mail'] = $user['correo_electronico'];


          $nuevaURL = 'https://www.masqfresco.com/';
header('Location: ' . $nuevaURL);

        
    } else {
        echo "<script>javascript:history.back();</script>";
      } 
        

     } else {
      echo "<script>javascript:history.back();</script>";
    } 
}}
?>


<?php
// Verifica si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
  if ($_POST["form_name"] == "form_cart") {
    if (isset($_SESSION['user_id'])) {
    // Obtén los datos del formulario
   // Obtén los datos del formulario
$id_usuario = $_SESSION['user_id'];
$id_producto = $_POST['id_producto'];
if (isset($_POST['quantity'])) {
    $cantidad = $_POST['quantity'];
} else {
    $cantidad = 1;
}

// Obtén la cantidad en stock del producto
$stmt = $conn->prepare("SELECT stock FROM productos WHERE id_producto = ?");
$stmt->bind_param("i", $id_producto);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stock = $row['stock'];

// Obtén la cantidad total del producto en el carrito
$stmt = $conn->prepare("SELECT SUM(cantidad) as total FROM carrito WHERE id_usuario = ? AND id_producto = ?");
$stmt->bind_param("ii", $id_usuario, $id_producto);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$totalEnCarrito = $row['total'];

if ($cantidad + $totalEnCarrito > $stock) {?>


<center>
<link rel="stylesheet" media="screen" href="css/theme.min.css">
<div class="container py-5 mb-lg-3">
        <div class="row justify-content-center pt-lg-4 text-center">
          <div class="col-lg-8 col-md-7 col-sm-9 mb-5" ><img class="d-block mx-auto mb-5" src="img/nocart.svg" width="280" alt="Error">
            <h1 class="h3">Sin stock!</h1>
            <h3 class="h5 fw-normal mb-5">Lo sentimos, no hay suficientes productos en stock para completar tu pedido.</h3>
            
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-xl-8 col-lg-10">
            <div class="row">
              <div class="col-sm-6 mb-3"><a class="card h-100 border-0 shadow-sm" href="https://masqfresco.com">
                  <div class="card-body">
                    <div class="d-flex align-items-center"><i class="ci-home text-primary h4 mb-0"></i>
                      <div class="ps-3">
                        <h5 class="fs-sm mb-0">Inicio</h5><span class="text-muted fs-ms">Vuelve a la página principal</span>
                      </div>
                    </div>
                  </div></a></div>
              <div class="col-sm-6 mb-3"><a class="card h-100 border-0 shadow-sm" href="https://masqfrescoweb.com/products">
                  <div class="card-body">
                    <div class="d-flex align-items-center"><i class="ci-view-grid text-success h4 mb-0"></i>
                      <div class="ps-3">
                        <h5 class="fs-sm mb-0">Productos</h5><span class="text-muted fs-ms">Busca algo interesante</span>
                      </div>
                    </div>
                  </div></a></div>

              
            </div>
          </div>
        </div>
      </div>
      </center>




    <?php
} else {
  
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
        echo "<script>javascript:history.back();</script>";
   
      } else {
        // El producto no está en el carrito, inserta una nueva fila
        $stmt = $conn->prepare("INSERT INTO carrito (id_usuario, id_producto, cantidad) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $id_usuario, $id_producto, $cantidad);
        $stmt->execute();
        echo "<script>javascript:history.back();</script>";
  
      }
  
}

  
  } else {

    echo "<script>window.location.href = 'https://masqfresco.com/login';</script>";
    exit;
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

        echo "<script>javascript:history.back();</script>";
      }
    }
  }
}
?>



<?php
// Verifica si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if ($_POST["form_name"] == "remove_promo") {
    // Obtén los datos del formulario
    $id = $_POST['id'];

    // Prepara la consulta SQL
    $stmt = $conn->prepare("DELETE FROM promociones WHERE id = ?");
    if (!$stmt) {
      // Muestra el error
      echo "Error al preparar la consulta: " . $conn->error;
    } else {
      $stmt->bind_param("i", $id);
      
      // Ejecuta la consulta
      if (!$stmt->execute()) {
        // Muestra el error
        echo "Error al ejecutar la consulta: " . $stmt->error;
      } else {

        echo "<script>javascript:history.back();</script>";
      }
    }
  }
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
    $codigo_pais = $_POST['codigo_pais'];
    $numero_tel = $_POST['numero_tel'];
    $numero_telefono = $codigo_pais . $numero_tel;

    // Genera un color aleatorio
    $color = sprintf('#%06X', mt_rand(0, 0xFFFFFF));

    // Encripta la contraseña del usuario
    $contrasena_encriptada = password_hash($contrasena, PASSWORD_DEFAULT);

    // Prepara la consulta SQL
    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, apellido, correo_electronico, contrasena, numero_telefono, rgbcolor) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $nombre, $apellido, $correo_electronico, $contrasena_encriptada, $numero_telefono, $color);
    
    // Ejecuta la consulta
    if ($stmt->execute()) {

        echo "<script>window.location.href = 'https://masqfresco.com/login';</script>";
        exit;

    } else {

        echo "Error: " . $stmt->error;
        
    }
  }
}
?>








<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if ($_POST["form_name"] == "form_comen_product") {


$product_id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;
// Crea la conexión
$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
// Verifica si la conexión es exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
} 
// Verifica si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  $product_id = isset($_POST["id_producto"]) ? (int)$_POST["id_producto"] : 0;

    // Crea la conexión
    $conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    // Verifica si la conexión es exitosa
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Obtiene los valores del formulario
    $id_producto = $_POST["id_producto"];
    $nombre_cliente = $_POST["nombre_cliente"];
    $estrellas = $_POST["estrellas"];
    $comentario = $_POST["comentario"];
    $correo_cliente = $_POST["correo_cliente"];

    // Crea la consulta SQL
    $sql = "INSERT INTO comentarios_productos (id_producto, nombre_cliente, estrellas, comentario, correo_cliente) VALUES ('$id_producto', '$nombre_cliente', '$estrellas', '$comentario', '$correo_cliente')";

    if ($conn->query($sql) === TRUE) {
      // Redirige al usuario a la página details.php con el id del producto como parámetro en la URL utilizando JavaScript
      echo "<script>javascript:history.back();</script>";

  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }

} } 
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
        echo "<script>javascript:history.back();</script>";       
    } else {
        echo "Hubo un error al subir el comentario";
    }  
}
}
?>



<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if ($_POST["form_name"] == "form_sms_c") {

    $id_user = $_SESSION['user_id'];
    $mensaje_c = $_POST['mensaje_c'];

    // Clave de cifrado - asegúrate de que esta clave sea segura y no la compartas
    $clave_cifrado = 'clave-secreta';

    // Cifrar el mensaje
    $mensaje_cifrado = openssl_encrypt($mensaje_c, 'AES-128-ECB', $clave_cifrado);

    $sql = "INSERT INTO sms_c (id_user, mensaje_c) VALUES ('$id_user', '$mensaje_cifrado')";

    if ($conn->query($sql) === TRUE) {
    
    } else {
      
    }
    
       
  }
}
?>



<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if ($_POST["form_name"] == "form_sms_o") {

    $id_user_send = $_POST['id_user_send'];
    $mensaje_o = $_POST['mensaje_o'];

    // Clave de cifrado - asegúrate de que esta clave sea segura y no la compartas
    $clave_cifrado = 'clave-secreta';

    // Cifrar el mensaje
    $mensaje_cifrado = openssl_encrypt($mensaje_o, 'AES-128-ECB', $clave_cifrado);

    $sql = "INSERT INTO sms_o (id_user_send, mensaje_o) VALUES ('$id_user_send', '$mensaje_cifrado')";

    if ($conn->query($sql) === TRUE) {
    
    } else {

      echo "Hubo un error al subir el comentario";
      
    }
    
       
  }
}
?>




















































<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if ($_POST["form_name"] == "form_delivery") {

    $id_check_out = $_POST['id_check_out'];
    $estado_envio = $_POST['estado_envio'];

    // Sube la imagen al servidor
 // Sube la imagen al servidor
if(isset($_FILES['img_comprobante'], $_FILES['img_entrega'])){
  $errors= array();
  $file_name = $_FILES['img_comprobante']['name'];
  $file_size =$_FILES['img_comprobante']['size'];
  $file_tmp =$_FILES['img_comprobante']['tmp_name'];
  $file_type=$_FILES['img_comprobante']['type'];

  // Ruta del archivo original
  $originalFile = $file_tmp;

  // Obtén las dimensiones originales de la imagen
  list($originalWidth, $originalHeight) = getimagesize($originalFile);

  // Define el ancho y alto máximo para la nueva imagen (puedes cambiar estos valores)
  $maxWidth = 800;
  $maxHeight = 800;

  // Calcula el ratio de redimensionamiento
  $ratio = min($maxWidth / $originalWidth, $maxHeight / $originalHeight);

  // Calcula las nuevas dimensiones de la imagen
  $newWidth = round($originalWidth * $ratio);
  $newHeight = round($originalHeight * $ratio);

  // Crea una nueva imagen con las nuevas dimensiones
  $newImage = imagecreatetruecolor($newWidth, $newHeight);

  // Carga la imagen original
  $originalImage = imagecreatefromjpeg($originalFile);

  // Redimensiona la imagen original y la copia en la nueva imagen
  imagecopyresampled($newImage, $originalImage, 0, 0, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight);

  // Verifica si el archivo ya existe y cambia el nombre si es necesario
  while(file_exists("comprobantes/" . $file_name)) {
      $file_name = rand(10, 1000) . "_" . $file_name;
  }

   // Almacena la ruta completa del archivo en una variable
   $target_file = "comprobantes/" . basename($file_name);

   // Guarda la nueva imagen en un archivo (puedes cambiar la calidad a un valor entre 0 y 100)
   imagejpeg($newImage, $target_file, 65);
   


      // Proceso para img_entrega
      $file_name_entrega = $_FILES['img_entrega']['name'];
      $file_size_entrega =$_FILES['img_entrega']['size'];
      $file_tmp_entrega =$_FILES['img_entrega']['tmp_name'];
      $file_type_entrega=$_FILES['img_entrega']['type'];

      while(file_exists("entregas/" . $file_name_entrega)) {
          $file_name_entrega = rand(10, 1000) . "_" . $file_name_entrega;
      }

      if(move_uploaded_file($file_tmp_entrega,"entregas/".$file_name_entrega)){
          
      } else {
          echo "Lo siento, hubo un error al subir el archivo.";
      }

      $target_file_entrega = "entregas/" . basename($file_name_entrega);

        // Actualizar la tabla
        $sql = "UPDATE check_out SET estado_envio='$estado_envio', img_comprobante='$target_file', img_entrega='$target_file_entrega' WHERE id_check_out=$id_check_out";

        if ($conn->query($sql) === TRUE) {


          $sql2 = "SELECT correo FROM check_out WHERE id_check_out = $id_check_out";

// Ejecuta la consulta
$result = $conn->query($sql2);

if ($result->num_rows > 0) {
    // Obtiene el resultado
    $row2 = $result->fetch_assoc();
    $correo = $row2["correo"];
} else {
    echo "No se encontró el correo electrónico del usuario.";
}

          $id_check_out = $_POST['id_check_out'];

         
$file_paths = array($target_file, $target_file_entrega);

// Genera un separador
$separator = md5(time());

// Prepara los encabezados
$headers = "From: MásQ'Fresco.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"\r\n";

// Prepara el cuerpo del mensaje
$body = "--" . $separator . "\r\n";
$body .= "Content-type:text/plain; charset=utf-8\r\n";
$body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
$body .= "¡Estimado cliente!\r\n\r\n";
$body .= "Nos complace informarte que tu pedido ha sido entregado con éxito. ¡Esperamos que disfrutes de tus nuevos productos de masqfresco.com\r\n\r\n";
$body .= "Nos gustaría aprovechar esta oportunidad para agradecerte por elegirnos. Tu apoyo nos permite seguir ofreciendo productos de alta calidad que amas.\r\n\r\n";
$body .= "Además, estamos emocionados de compartir contigo que hemos añadido nuevos productos a nuestra tienda. Te invitamos a visitar masqfresco.com y descubrir lo que hemos preparado para ti.\r\n\r\n";
$body .= "Si tienes alguna pregunta o necesitas asistencia con tu pedido, no dudes en ponerte en contacto con nosotros. Estamos aquí para ayudarte.\r\n\r\n";
$body .= "¡Gracias por ser un valioso cliente de Masqfresco.com! Esperamos verte pronto.\r\n\r\n";
$body .= "Con cariño, El equipo de Masqfresco.com \r\n";

// Agrega los archivos adjuntos al mensaje
foreach ($file_paths as $file_path) {
    // Lee el archivo
    $file = fopen($file_path, 'rb');
    $data = fread($file, filesize($file_path));
    fclose($file);

    // Codifica el archivo en base64
    $data = chunk_split(base64_encode($data));

    $body .= "--" . $separator . "\r\n";
    $body .= "Content-Type: application/octet-stream; name=\"" . basename($file_path) . "\"\r\n";
    $body .= "Content-Transfer-Encoding: base64\r\n";
    $body .= "Content-Disposition: attachment\r\n\r\n";
    $body .= $data . "\r\n";
}

// Envia el correo
if(mail($correo, "Su pedido ah sido entregado!", $body, $headers)) {
  echo "El correo electrónico se envió correctamente.";
} else {
  echo "Hubo un error al enviar el correo electrónico.";
}



            echo "<script>javascript:history.back();</script>"; 
        } else {
            echo "Error updating record: " . $conn->error;
        }

    }
}}
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
    echo "<script>javascript:history.back();</script>"; 
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
}}
?>

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
    $stock = $_POST["stock"];

    // Prepara la consulta SQL para insertar el producto
    $sql = "INSERT INTO productos (nombre, categoria, precio, descripcion, marca, stock)
    VALUES ('$nombre', '$categoria', '$precio', '$descripcion', '$marca', '$stock')";

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

        ?>
        <script>
    window.location.href = document.referrer;
</script>
<?php
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
  ?>
  <script>
window.location.href = document.referrer;
</script>
<?php
}
else
{
  echo "ERROR";
     }
    }
}
?>




<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if ($_POST["form_name"] == "remove_user") {
 
    $id_user = $_POST['id_user'];

    // Primero, eliminar las filas relacionadas en la tabla sms_c
    $stmt = $conn->prepare('DELETE FROM sms_c WHERE id_user = ?');
    if (!$stmt) {
        echo 'Error al preparar la consulta: ' . $conn->error;
    } else {
        $stmt->bind_param('i', $id_user);
        if (!$stmt->execute()) {
            echo 'Error al ejecutar la consulta: ' . $stmt->error;
        }
    }

    // Luego, eliminar las filas relacionadas en la tabla carrito
    $stmt = $conn->prepare('DELETE FROM carrito WHERE id_usuario = ?');
    if (!$stmt) {
        echo 'Error al preparar la consulta: ' . $conn->error;
    } else {
        $stmt->bind_param('i', $id_user);
        if (!$stmt->execute()) {
            echo 'Error al ejecutar la consulta: ' . $stmt->error;
        }
    }

    // Finalmente, eliminar el usuario en la tabla usuarios
    $stmt = $conn->prepare('DELETE FROM usuarios WHERE id_user = ?');
    if (!$stmt) {
        echo 'Error al preparar la consulta: ' . $conn->error;
    } else {
        $stmt->bind_param('i', $id_user);
        if (!$stmt->execute()) {
            echo 'Error al ejecutar la consulta: ' . $stmt->error;
        }
    }




    echo "<script>javascript:history.back();</script>"; 

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


    echo "<script>javascript:history.back();</script>"; 


  }
}
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
  ?>
  <script>
window.location.href = document.referrer;
</script>
<?php
} else {
    echo "Error al actualizar el producto: " . $stmt->error;
}
}}

?>




<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($_POST["form_name"] == "form_edituser") {
    // Assuming you have established a mysqli connection $conn
    $id_user = $_POST['id_user']; // Get the id from session

    // Initialize an array to hold the query parts
    $query_parts = array();
    $types = '';
    $values = array();

    // Check each POST variable and add it to the query if it's set and not empty
    foreach (array('rango') as $field) {
        if (isset($_POST[$field]) && !empty($_POST[$field])) {
            $query_parts[] = "$field = ?";
            $types .= 's';
            $values[] = $_POST[$field];
        }
    }

    // Add the id_user to the values array
    $types .= 'i';
    $values[] = $id_user;

    try {
        // Build the query string
        $query_string = "UPDATE usuarios SET " . implode(', ', $query_parts) . " WHERE id_user = ?";

        $stmt = $conn->prepare($query_string);

        // Bind the parameters
        $stmt->bind_param($types, ...$values);

        // Execute the UPDATE statement
        $stmt->execute();

        echo "<script>javascript:history.back();</script>";
        exit();

    } catch(mysqli_sql_exception $e) {
        echo "Error: " . $e->getMessage();
        
    }
}}
?>



<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if ($_POST["form_name"] == "form_editprod") {
      // Assuming you have established a mysqli connection $conn
      $id_producto = $_POST['id_producto']; // Get the id from session

      // Initialize an array to hold the query parts
      $query_parts = array();
      $types = '';
      $values = array();

      // Check each POST variable and add it to the query if it's set and not empty
      foreach (array('nombre', 'descripcion', 'precio', 'stock') as $field) {
          if (isset($_POST[$field]) && !empty($_POST[$field])) {
              $query_parts[] = "$field = ?";
              $types .= 's';
              $values[] = $_POST[$field];
          }
      }

      // Add the id_producto to the values array
      $types .= 'i';
      $values[] = $id_producto;

      try {
          // Build the query string
          $query_string = "UPDATE productos SET " . implode(', ', $query_parts) . " WHERE id_producto = ?";

          $stmt = $conn->prepare($query_string);

          // Bind the parameters
          $stmt->bind_param($types, ...$values);

          // Execute the UPDATE statement
          $stmt->execute();

          // Check if a file was uploaded
          if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
              // Get the file extension
              $ext = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);

              // Generate a unique file name
              $img_name = uniqid() . '.' . $ext;

              // Specify the path to the uploads directory
              $target_dir = "uploads/";

              // Specify the path to the new image file
              $target_file = $target_dir . $img_name;

              // Move the uploaded file to the uploads directory
              if (move_uploaded_file($_FILES['img']['tmp_name'], $target_file)) {
                  echo "The file ". htmlspecialchars( basename( $_FILES["img"]["name"])). " has been uploaded.";
                  
                  // Prepare an UPDATE statement for the image URL
                  $stmt = $conn->prepare("UPDATE fotos_productos SET foto_url = ? WHERE id_producto = ?");

                  // Bind the parameters
                  $stmt->bind_param('si', $target_file, $id_producto);

                  // Execute the UPDATE statement
                  if ($stmt->execute() === FALSE) {
                      echo "Error updating record: " . $conn->error;
                  }
              } else {
                  echo "Sorry, there was an error uploading your file.";
              }
          }

          echo "<script>javascript:history.back();</script>";
          exit();

      } catch(mysqli_sql_exception $e) {
          echo "Error: " . $e->getMessage();
          
      }
  }
}

?>







<?php
// Cierra la conexión cuando hayas terminado
$conn->close();
?>
