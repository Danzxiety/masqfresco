<?php
require_once 'vendor/autoload.php';
require_once 'secrets.php';

\Stripe\Stripe::setApiKey($stripeSecretKey);

// Configura el webhook
$endpoint_secret = 'whsec_b8fb684ef14ae90b14f620fc252e9030010e3751094620afb6de4c6ed82929d8';

// Obtiene el payload del webhook
$payload = @file_get_contents('php://input');
$sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
$event = null;

try {
  $event = \Stripe\Webhook::constructEvent(
    $payload, $sig_header, $endpoint_secret
  );
} catch(\UnexpectedValueException $e) {
  // El payload no es válido, puedes responder con un error 400
  http_response_code(400);
  exit();
} catch(\Stripe\Exception\SignatureVerificationException $e) {
  // La firma del webhook no es válida, puedes responder con un error 400
  http_response_code(400);
  exit();
}

// Maneja el evento
if ($event->type == 'checkout.session.completed') {
  $session = $event->data->object;

  // Aquí puedes realizar acciones basadas en la finalización de la sesión de Checkout
  // Por ejemplo, puedes redirigir al usuario a la página de revisión
  header('Location: ' . $YOUR_DOMAIN . '/review?session_id=' . $session->id);
} else {
  // Responde con un error 400 si no puedes manejar el evento
  http_response_code(400);
  exit();
}

// Responde con un código de estado 200 para indicar que el webhook se procesó correctamente
http_response_code(200);
?>
