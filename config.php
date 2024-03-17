<?php 
// Database configuration  
define('DB_HOST', 'databases_masqfresco-db'); 
define('DB_USERNAME', 'mysql'); 
define('DB_PASSWORD', 'b8997437ba8bc6d790b7'); 
define('DB_NAME', 'databases');


// Create database connection
$db = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}