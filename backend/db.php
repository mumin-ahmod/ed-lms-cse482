<?php
// db.php
require __DIR__ . '/../vendor/autoload.php'; 

// Database configuration
$host = 'localhost'; // Database host, usually 'localhost'
$dbname = 'ed_lms'; // Replace with your database name
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password

$options = array(
    'cluster' => 'ap2',
    'useTLS' => true
  );
  $pusher = new Pusher\Pusher(
    'bb168db3fb3adf7ea72d',
    '46e5249a8ca361c08113',
    '1898433',
    $options
  );



try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Optional: Set the default fetch mode to associative array
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Optional: Turn on error reporting
    // error_reporting(E_ALL);
    // ini_set('display_errors', 1);

} catch (PDOException $e) {
    // Handle connection errors
    echo "Connection failed: " . $e->getMessage();
    exit();
}
