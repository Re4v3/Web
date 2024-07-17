<?php
// ข้อมูลสำหรับเชื่อมต่อฐานข้อมูล PostgreSQL
$dburl = "postgresql://root:LjmX4r6w3FM21BZlOyCUmXUZuDiIaZbN@dpg-cqb74iuehbks73dkm78g-a.oregon-postgres.render.com/lovepotion_db";

// ทำการแยกข้อมูลจาก URL
$urlParts = parse_url($dburl);

$host = $urlParts['host'];
$user = $urlParts['user'];
$password = $urlParts['pass'];
$dbname = ltrim($urlParts['path'], '/');

try {
    // สร้างการเชื่อมต่อ PDO
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);

    // ตั้งค่า PDO เพื่อให้แสดง error ออกมา
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connected successfully";
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
