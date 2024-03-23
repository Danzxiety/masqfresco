<?php


$checkout_id = $_GET['checkout_id'];


header("Location: payment?checkout_id=$checkout_id");


?>
