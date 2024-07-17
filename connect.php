<?php
$host = 'https://lovepotion.onrender.com'; // หรือใช้ localhost ถ้าใช้ที่ Render.com ก็ใช้ชื่อ host ของ Render.com
$dbname = 'your_pg_database_name'; // ชื่อฐานข้อมูลของคุณ
$user = 'your_pg_username'; // ชื่อผู้ใช้ฐานข้อมูลของคุณ
$password = 'your_pg_password'; // รหัสผ่านฐานข้อมูลของคุณ
$port = 'your_pg_port'; // พอร์ตของฐานข้อมูลของคุณ

$conn = new mysqli($host, $user, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
