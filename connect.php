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
    $db = new PDO('pgsql:host=dpg-cqb74iuehbks73dkm78g-a.oregon-postgres.render.com;dbname=lovepotion_db', 'root', 'LjmX4r6w3FM21BZlOyCUmXUZuDiIaZbN');
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}

?>
