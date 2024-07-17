<?php
// กำหนดค่าเชื่อมต่อฐานข้อมูล PostgreSQL
$db_host = 'dpg-cqb74iuehbks73dkm78g-a.oregon-postgres.render.com';
$db_port = '5432';
$db_name = 'lovepotion_db';
$db_user = 'root';
$db_password = 'LjmX4r6w3FM21BZlOyCUmXUZuDiIaZbN';

// ทำการเชื่อมต่อฐานข้อมูล
$conn = new PDO("pgsql:host=$db_host;port=$db_port;dbname=$db_name;user=$db_user;password=$db_password");

// เช็คการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully";
?>
