<?php
// Check if running on localhost or Render.com
if ($_SERVER['HTTP_HOST'] == 'localhost') {
    // Localhost configuration
    $servername = "localhost";
    $username = "root";
    $password = ""; // รหัสผ่านของ MySQL ใน localhost
    $dbname = "lovepotion_db";
} else {
    // Render.com configuration
    $servername = getenv('POSTGRES_HOST');
    $username = getenv('POSTGRES_USERNAME');
    $password = getenv('POSTGRES_PASSWORD');
    $dbname = getenv('POSTGRES_DATABASE');
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
