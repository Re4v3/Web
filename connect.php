<?php
$database_url = "postgresql://root:LjmX4r6w3FM21BZlOyCUmXUZuDiIaZbN@dpg-cqb74iuehbks73dkm78g-a.oregon-postgres.render.com/lovepotion_db";

// Parse the database URL
$url = parse_url($database_url);

$servername = $url['host'];
$username = $url['user'];
$password = $url['pass'];
$dbname = ltrim($url['path'], '/');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
