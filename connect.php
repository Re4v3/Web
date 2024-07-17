<?php
$host = 'dpg-cqb74iuehbks73dkm78g-a.oregon-postgres.render.com';
$dbname = 'lovepotion_db';
$username = 'root';
$password = 'LjmX4r6w3FM21BZlOyCUmXUZuDiIaZbN';

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
