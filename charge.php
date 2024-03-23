require_once 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

\Stripe\Stripe::setApiKey($_ENV['STRIPE_SECRET_KEY']);

$token = $_POST['stripeToken'];
$name = $_POST['name'];
$email = $_POST['email'];
$amount = $_POST['amount'];

try {
  $charge = \Stripe\Charge::create([
      'amount' => $amount,
      'currency' => 'usd',
      'description' => 'Example charge',
      'source' => $token,
      'receipt_email' => $email,
  ]);

  echo 'Payment successful, charge ID: ' . $charge->id;
} catch (\Stripe\Exception\CardException $e) {
  // The card has been declined
  echo 'Error: ' . $e->getMessage();
} catch (\Exception $e) {
  // Something else happened, unrelated to Stripe
  echo 'Error: ' . $e->getMessage();
}
