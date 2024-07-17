<?php
// Ensure no output before session_start
session_start();

// Check if running on localhost or Render.com
if ($_SERVER['HTTP_HOST'] == 'localhost') {
    // Localhost configuration
    $host = "localhost";
    $username = "root";
    $password = ""; // รหัสผ่านของ MySQL ใน localhost
    $dbname = "lovepotion_db";
} else {
    // Render.com configuration
    $host = getenv('POSTGRES_HOST');
    $username = getenv('POSTGRES_USERNAME');
    $password = getenv('POSTGRES_PASSWORD');
    $dbname = getenv('POSTGRES_DATABASE');
    $port = getenv('POSTGRES_PORT') ?: 5432; // Default to 5432 if POSTGRES_PORT is not set
}

// Create connection string
$conn_string = "host=$host dbname=$dbname user=$username password=$password port=$port";

// Create connection
$conn = pg_connect($conn_string);

// Check connection
if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

echo "Connected successfully!";
?>
